<?
class Plan_Controller extends MY_Controller {

	private $exerciseImageUploadPath = './images/exercises/';
	private $imgError;

	function __construct()
	{
		parent::__construct();
		enableProfiler();

		/* Check if user is logged in */
		requireLogin();
	}

	private function handle_error($err) {
		$this->imgError = str_replace('<p>', '<p class="label label-danger" style="display: block; font-size: 12px; font-weight: bold">', $err) . "\r\n";
	}

	/* Make sure the logged in user is trainer and the client belongs to him */
	function verifyTrainer($trainer, $client) {

		if ($trainer->is_trainer == 0 or !$trainer->isTrainerOf($client)) {
			$data = array(
				'template' => platform() . '/my/permission_denied'
			);
			$this->load->view(platform() . '/page', $data);
			return false;
		}
		return true;
	}

	/* Make sure the training plan belongs to the client */
	function verifyPlan($plan, $clientId) {
		if (!$plan || ($plan->client_id != $clientId)) {
			$data = array(
				'template' => platform() . '/my/permission_denied'
			);
			$this->load->view(platform() . '/page', $data);
			return false;
		}
		return true;
	}

	/* Client training plans */
	function index($clientId) {

		/* Load the required models and helpers*/
		$this->load->model('user');
		$this->load->helper('form');

		/* Load the client and trainer */
		$user = $this->user->getById(activeUser()->id);
		$client = $this->user->getById($clientId);

		/* Make sure the logged in user is trainer and the client belongs to him */
		if (!$this->verifyTrainer($user, $client->id)) {
			return;
		}

		$data = array(
			'client' => $client,
			'plans' => $client->getTrainingPlansByTrainer($user->id),
			'template' => platform() . '/trainer/client_plans'
		);

		/* Show template */
		$this->load->view(platform() . '/page', $data);
	}

	/* Insert training plan to database */
	function create() {

		/* Load the required models */
		$this->load->model('user');
		$this->load->model('training_plan');

		/* Load the client and trainer */
		$user = $this->user->getById(activeUser()->id);
		$clientId = $this->input->post('clientId');

		/* Make sure the logged in user is trainer and the client belongs to him */
		if (!$this->verifyTrainer($user, $clientId)) {
			return;
		}

		$this->training_plan->insert($clientId, $this->input->post());
		redirect('/my/clients/' . $clientId . '/plans');
	}

	/* Specific training plan */
	function plan($clientId, $planId, $addFormOpen = null) {

		/* Load the required models and helpers*/
		$this->load->model('user');
		$this->load->model('training_plan');
		$this->load->helper('form');

		/* Load the client, trainer and plan */
		$user = $this->user->getById(activeUser()->id);
		$client = $this->user->getById($clientId);
		$plan = $this->training_plan->getById($planId);

		/* Make sure the logged in user is trainer and the client belongs to him */
		if (!$this->verifyTrainer($user, $client->id)) {
			return;
		}

		/* Make sure the training plan belongs to the selected client */
		if (!$this->verifyPlan($plan, $client->id)) {
			return;
		}

		/* Get the exercises for this training plan */
		$exercises = $plan->getExercises();
		foreach ($exercises AS $exercise) {
			$images = $exercise->getImages();
			$exercise->images = $images;
			$exercise->imageCount = count($images);
		}

		$data = array(
			'client' => $client,
			'plan' => $plan,
			'exercises' => $exercises,
			'allowedImageCount' => 5,
			'addFormOpen' => $addFormOpen,
			'template' => platform() . '/trainer/client_plan'
		);

		/* Show template */
		$this->load->view(platform() . '/page', $data);

	}

	/* Add exercise to the training plan */
	function add_exercise() {

		/* Load models necessary for this method */
		$this->load->model('training_plan');
		$this->load->library('form_validation');

		$planId = $this->input->post('planId');
		$clientId = $this->input->post('clientId');

		/* Form validation */
		if ($this->form_validation->run() == FALSE) {
			$this->plan($clientId, $planId, true);
			return;
		}

		/* Check if any files were attached with the exercise */
		$filesAttached = FALSE;
		foreach($_FILES as $key => $fileData) {
			if (!empty($fileData['name'])) {
				$filesAttached = TRUE;
				break;
			}
		}

		/* If no files were attached, save the exercise without images and show the edit page */
		if (!$filesAttached) {
			if ($this->training_plan->addExercise($planId, $this->input->post())) {
				redirect('/my/clients/' . $clientId . '/plans/' . $planId);
				return;
			}
			else {
				echo "something went terribly wrong";
				return;
			}
		}

		/* IMAGE UPLOAD */

		/* Image upload configuration */

		$config['upload_path'] = $this->exerciseImageUploadPath;
		$config['allowed_types'] = 'jpg|png';
		$config['max_size'] = 5000;
		$config['max_width'] = 0;
		$config['max_height'] = 0;
		$config['overwrite'] = false;
		$config['encrypt_name'] = true;

		$i = 0;
		$files = array();
		$is_file_error = FALSE;

		/* Go over each uploaded file */
		foreach($_FILES as $key => $fileData) {
			if (!empty($fileData['name'])) {

				/* Load the necessary libraries for file upload */
				$this->load->library('upload', $config);

				/* If picture is taken with phone or ipad, check for orientation and rotate if necessary */
				rotateImageFromMobileDevice($fileData['tmp_name']);

				/* Do upload */
				if (!$this->upload->do_upload($key)) {
					$this->handle_error($this->upload->display_errors());
					$is_file_error = TRUE;
				}
				else {
					$files[$i] = $this->upload->data();
					resizeImage($this->exerciseImageUploadPath, $files[$i]['file_name'], 120);
					$i++;
				}
			}
		}

		/* There were errors, we have to delete the uploaded files */
		if ($is_file_error && $files) {
			for ($i = 0; $i < count($files); $i++) {
				$file = $this->exerciseImageUploadPath . $files[$i]['file_name'];
				if (file_exists($file)) {
					unlink($file);
				}
			}
		}

		/* All is good with the images, now let's add the exercise to the plan */
		if (!$is_file_error && $files) {

			$resp = $this->training_plan->addExercise($planId, $this->input->post(), $files);

			/* If for some reason saving the exercise fails, remove files */
			if ($resp === FALSE) {
				for ($i = 0; $i < count($files); $i++) {
					$file = $this->exerciseImageUploadPath . $files[$i]['file_name'];
					if (file_exists($file)) {
						unlink($file);
					}
				}
				$this->handle_error('Error while saving file info to Database.');
			}
		}

		/* All done, show the edit page */
		redirect('/my/clients/' . $clientId . '/plans/' . $planId);
	}

	/* Delete exercise from training plan */
	function delete_exercise($exerciseId) {

		/* Load models necessary for this method */
		$this->load->model('exercise');

		$exercise = $this->exercise->getById($exerciseId);
		$plan = $exercise->getPlan();
		$client = $plan->getClient();
		$user = $this->user->getById(activeUser()->id);

		/* Make sure the logged in user is trainer and the client belongs to him */
		if (!$this->verifyTrainer($user, $client->id)) {
			return;
		}

		if (!$exercise->delete()) {
			echo 'Something went wrong while deleting exercise';
			return;
		}
		redirect('/my/clients/' . $client->id . '/plans/' . $plan->id);
	}
}

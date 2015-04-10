<?
class Training extends MY_Controller {

	/* The stuff before */
	function __construct(){
		parent::__construct();

		/* Enable profiler */
		enableProfiler();

		/* If the user is not logged in, redirect to login page */
		requireLogin();
	}

	/* My training plans */
	function plans() {

		/* Load necessary modals */
		$this->load->model('user');
		$user = $this->user->getById(activeUser()->id);

		/* Assign data to training plans template */
		$data = array(
			'template' => platform() . '/my/plans',
			'plans' => $user->getTrainingPlans()
		);

		/* Show training plans template */
		$this->load->view(platform() . '/page', $data);
	}

	/* Specific training plan */
	function plan($planId) {
		$this->load->model('training_plan');
		$plan = $this->training_plan->getById($planId);

		/* If the training plan does not belong to the active user */
		if (activeUser()->id != $plan->client_id) {
			return;
		}

		/* Get the exercises for this training plan */
		$exercises = $plan->getExercises();
		foreach ($exercises AS $exercise) {
			$images = $exercise->getImages();
			$exercise->images = $images;
			$exercise->imageCount = count($images);
		}

		/* Assign data to training plans template */
		$data = array(
			'template' => platform() . '/my/plan',
			'plan' => $plan,
			'exercises' => $exercises
		);

		/* Show training plans template */
		$this->load->view(platform() . '/page', $data);
	}
}
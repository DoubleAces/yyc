<?
class Client extends MY_Controller {

	function __construct() {
		parent::__construct();
		enableProfiler();
	}

	function index($clientId) {

		/* Check if user is logged in */
		requireLogin();

		/* Load the required models */
		$this->load->model('user');

		/* Load the client and trainer */
		$user = $this->user->getById(activeUser()->id);
		$client = $this->user->getById($clientId);

		/* If the user is not trainer or the client doesn't belong to the trainer*/
		if ($user->is_trainer == 0 or !$user->isTrainerOf($clientId)) {
			$data = array(
				'template' => platform() . '/my/permission_denied'
			);
			$this->load->view(platform() . '/page', $data);
			return;
		}

		$data = array(
			'client' => $client,
			'template' => platform() . '/trainer/client'
		);

		/* Show template */
		$this->load->view(platform() . '/page', $data);
	}

}
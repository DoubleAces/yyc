<?
class My extends MY_Controller {


	/* The stuff before */
	function __construct() {
		parent::__construct();
		enableProfiler();
	}

	/* The user home page */
	function index() {

		/* Check if the user is logged in */
		if (!isLoggedIn()) {
			$this->login();
			return;
		}

		/* Assign data to template */
		$data = array(
			'template' => platform() . '/my/index'
		);

		/* Show template */
		$this->load->view(platform() . '/page', $data);
	}

	/* Login form */
	function login($err = false) {

		/* Load necessary helpers for this view */
		$this->load->helper('form');

		/* If the user is already logged in, redirect the user to the user home page */
		if (isLoggedIn()) {
			redirect('/my');
			return;
		}

		/* Assign data to user login template */
		$data = array(
			'error' => $err,
			'template' => platform() . '/login'
		);

		/* Show the user login template */
		$this->load->view(platform() . '/page', $data);
	}

	/* Log the user in */
	function enter() {

		/* Load the required libraries */
		$this->load->library('form_validation');

		/* Validate form */
		if ($this->form_validation->run() == FALSE) {
			$this->login();
			return;
		}

		$input = $this->input->post();

		/* Query the database for a user by username and password */
		$this->db->where('username', $input['username']);
		$q = $this->db->get('yyc_users');

		/* If there is a result, assign the user data to session and redirect the user to the user home page */
		if ($q->num_rows() == 1) {
			$user = $q->row();

			/* If password is correct*/
			if (password_verify($input['password'], $user->password)) {
				$this->session->activeUser = $user;
				$this->session->is_logged_in = true;
				redirect('/my');
				return;
			}

			/* Password incorrect */
			$this->login('Password incorrect');
			return;
		}

		/* If user not found, show login form again */
		$this->login();
	}

	/* Log the user out */
	function logout() {
		$this->db->delete('ci_sessions', array('id' => session_id()));
		$this->session->sess_destroy();
		redirect('/home');
	}

	/* Register form */
	function register() {

		/* If the user is already logged in, redirect the user to the user home page */
		if (isLoggedIn()) {
			redirect('/my');
			return;
		}

		/* Required helpers */
		$this->load->helper('form');

		/* Assign data to registration template */
		$data = array(
			'template' => platform() . '/register'
		);

		/* Show the registration template */
		$this->load->view(platform() . '/page', $data);
	}

	/* Register the user */
	function signup() {

		/* Load the required libraries */
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('user');

		/* Validate form */
		if ($this->form_validation->run() == FALSE) {
			$this->register();
			return;
		}

		/* Save user to database */
		$createdUserId = $this->user->insert($this->input->post());
		if ($createdUserId) {

			/* Doing direct query instead of using "getUserById" cause for some reason it returns incomplete object */
			$this->db->where('id', $createdUserId);
			$user = $this->db->get('yyc_users')->row();

			$this->session->activeUser = $user;
			$this->session->is_logged_in = true;
			redirect('/my');
			return;
		}
		else {
			echo "Something went terribly wrong";
			$this->register();
			return;
		}
	}

	/* If user is trainer, get his clients */
	function clients() {

		/* Check if user is logged in */
		requireLogin();

		/* Load the required models */
		$this->load->model('user');

		/* Load the trainer */
		$user = $this->user->getById(activeUser()->id);

		/* If the user is not trainer */
		if ($user->is_trainer == 0) {
			$data = array(
				'template' => platform() . '/my/permission_denied'
			);
		}

		/* User is trainer. Pass clients and clients template to page */
		else {
			$data = array(
				'clients' => $user->getClients(),
				'template' => platform() . '/trainer/clients'
			);
		}

		/* Show template */
		$this->load->view(platform() . '/page', $data);
	}
}
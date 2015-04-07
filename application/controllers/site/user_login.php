<?php

class User_Login extends MY_Controller {

	private $activeUser;
	private $platform;

	public function index() {
		$this->load->helper('form_helper');
		$this->load->view('login');
	}

	function __construct() {
		parent::__construct();
		if ($_SERVER['REMOTE_ADDR'] == '90.191.68.181') {
			$this->output->enable_profiler(TRUE);
		}
		$this->platform = $this->session->userdata('platform');
		//$this->isLoggedIn();
	}

	function isLoggedIn() {
		$isLoggedIn = $this->session->userdata('is_logged_in');
		$this->activeUser = $this->session->userData('activeUser');

		/* If user is not logged in, show login form */
		if (isset($isLoggedIn) || $isLoggedIn == true) {
			redirect('/my/dashboard');
		}
		else {
			$this->login();
		}
	}

	function login() {
		$this->isLoggedIn();
		$data = array(
			'template' => $this->platform . '/login'
		);
		$this->load->view($this->platform . '/page', $data);
	}

	function enter() {
		$this->load->model('user');
		$user = $this->user->getByUsernameAndPassword($this->input->post('username'), md5($this->input->post('password')));

		if ($user) {
			$data = array(
				'activeUser' => $user,
				'is_logged_in' => true
			);
			$this->session->set_userdata($data);
			redirect('/');
			return;
		}

		$this->index();
	}

}
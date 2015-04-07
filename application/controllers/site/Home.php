<?php

class Home extends MY_Controller {

	private $platform;

	function __construct() {
		parent::__construct();
		if ($_SERVER['REMOTE_ADDR'] == '90.191.68.181' && $this->session->userdata('platform') != 'mobile') {
			$this->output->enable_profiler(TRUE);
		}

		/* Common data across all templates */
		$this->platform = $this->session->userdata('platform');
	}

	function index() {
		$activeUser = $this->session->userdata('activeUser');
		$data = array(
			'template' => $this->platform . '/home'
		);
		$this->load->view($this->session->userdata('platform') . '/page', $data);

//		if (!$activeUser) {
//			$this->load->view($this->session->userdata('platform') . '/intropage');
//			return;
//		}
//
//		/* If logged out, show default home, otherwise show trainer/client UI */
//		if ($activeUser->is_trainer) {
//			redirect('/trainer/dashboard');
//			return;
//		}
//		$data = array(
//			'template' => $this->session->userdata('platform') . '/home'
//		);
//		$this->load->view($this->session->userdata('platform') . '/page', $data);
//		else {
//			redirect('/home');
//			return;
//		}

	}
}
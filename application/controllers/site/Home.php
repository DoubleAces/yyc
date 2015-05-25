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
		$trainers = $this->db->select('*')
			->from('yyc_users')
			->where('is_trainer = 1')->get()->result();

		$data = array(
			'trainers' => $trainers,
			'template' => $this->platform . '/home'
		);
		$this->load->view($this->session->userdata('platform') . '/page', $data);


	}
}
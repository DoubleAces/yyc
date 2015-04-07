<?php
class MY_Controller extends CI_Controller {

	public function __construct() {
		parent::__construct();

		/* First things first. Let's detect the user agent */
		$this->load->library('Mobile_Detect');
		$detect = new Mobile_Detect();
		$device = $detect->isMobile() ? 'mobile' : 'desktop';
		$this->session->set_userdata('platform', $device);
	}
}

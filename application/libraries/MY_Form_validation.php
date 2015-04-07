<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation {

	function __construct($config = array()){
		parent::__construct($config);
	}

	function run($group = '') {
		if($group == '')  {
			$group = implode('/', array_slice($this->CI->uri->rsegment_array(), 0, 2));
		}

		return parent::run($group);
	}

	function username_exists($username) {
		$CI = & get_instance();
		$CI->load->model('user');
		$user = $CI->user->getByUsername($username);
		if (!$user) {
			return false;
		}
		return true;
	}

}
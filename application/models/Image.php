<?php

class Image extends CI_Model {

	private static $db;
	private $imagePath = './images/exercises/';

	function __construct() {
		parent::__construct();
		self::$db = &get_instance()->db;
	}

	function getById($imageId) {
		$this->load->model('image');
		return self::$db->where('id', $imageId)->get('yyc_plan_exercise_images')->row(0, 'Image');
	}

	function delete() {

		/* Remove image from server */
		@unlink($this->imagePath . $this->filename);
		@unlink($this->imagePath . '120x120/' . $this->filename);

		/* Remove image from database */
		$this->db->delete('yyc_plan_exercise_images', array('id' => $this->id));

	}
}
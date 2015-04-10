<?php

class Exercise extends CI_Model {

	private static $db;

	function __construct() {
		parent::__construct();
		self::$db = &get_instance()->db;
	}

	function getById($exerciseId) {
		$this->load->model('exercise');
		return self::$db->where('id', $exerciseId)->get('yyc_plan_exercises')->row(0, 'Exercise');
	}

	function getImages() {
		$this->load->model('Image');
		$this->db->select('id, filename');
		$this->db->from('yyc_plan_exercise_images');
		$this->db->where('exercise_id', $this->id);
		return $this->db->get()->result('Image');
	}

	function delete() {

		/* Remove all exercise images */
		$images = $this->getImages();
		foreach ($images as $image) {
			$image->delete();
		}

		/* Remove all exercise sets */
		$this->db->delete('yyc_plan_exercise_sets', array('exercise_id' => $this->id));

		/* Remove exercise from database */
		$this->db->delete('yyc_plan_exercises', array('id' => $this->id));

		/* Check if everything went well */
		if (!$this->db->affected_rows()) {
			return false;
		}
		return true;
	}

	function getPlan() {
		$this->load->model('training_plan');
		return $this->db->where('id', $this->plan_id)->get('yyc_training_plans')->row(0, 'Training_Plan');
	}

	function getSets() {
		$db = $this->db;
		$db->select('reps, sets, weight');
		$db->from('yyc_plan_exercise_sets');
		$db->where('exercise_id = ' . $this->id);
		return $db->get()->result();
	}

}
<?php

class Training_Plan extends CI_Model {

	private $activeUser;
	private static $db;

	function __construct() {
		parent::__construct();
		self::$db = &get_instance()->db;
		$this->activeUser = $this->session->activeUser;
	}

	function getById($planId) {
		$this->load->model('training_plan');
		return self::$db->where('id', $planId)->get('yyc_training_plans')->row(0, 'Training_Plan');
	}

	function getExercises() {
		$this->load->model('Exercise');
		$this->db->select('id, plan_id, name, description, breathing, reps');
		$this->db->from('yyc_plan_exercises');
		$this->db->where('plan_id', $this->id);
		return $this->db->get()->result('Exercise');
	}

	function getExerciseCount() {
		$this->load->model('Exercise');
		$this->db->from('yyc_plan_exercises');
		$this->db->where('plan_id', $this->id);
		return $this->db->count_all_results();
	}

	function insert($clientId, $input) {

		$dateObject = new DateTime('now');
		$date = $dateObject->format('Y-m-d');
		$data = array(
			'trainer_id' => $this->activeUser->id,
			'client_id' => $clientId,
			'name' => $input['plan_name'],
			'description' => $input['plan_description'],
			'added' => $date
		);
		$this->db->insert('yyc_training_plans', $data);
		return $this->db->insert_id();
	}

	function addExercise($planId, $input, $files = array()) {
		$data = array(
			'name' => $input['name'],
			'description' => $input['description'],
			'breathing' => $input['breathing'],
			'reps' => $input['reps'],
			'plan_id' => $planId
		);
		$this->db->insert('yyc_plan_exercises', $data);

		if (!count($files)) {
			return TRUE;
		}

		$exerciseId = $this->db->insert_id();
		$this->db->trans_start();
		$file_data = array();
		foreach ($files as $file) {
			$file_data[] = array(
				'filename' => $file['file_name'],
				'exercise_id' => $exerciseId
			);
		}
		$this->db->insert_batch('yyc_plan_exercise_images', $file_data);
		$this->db->trans_complete();

		//check transaction status
		if ($this->db->trans_status() === FALSE) {
			foreach ($files as $file) {
				$file_path = $file['full_path'];

				//delete the file from destination
				if (file_exists($file_path)) {
					unlink($file_path);
				}
			}

			//rollback transaction
			$this->db->trans_rollback();
			return FALSE;
		}
		else {
			//commit the transaction
			$this->db->trans_commit();
			return TRUE;
		}
	}

	function getFirstExerciseImage() {
		$this->db->select('t1.id, t1.filename');
		$this->db->from('yyc_plan_exercise_images AS `t1`, yyc_plan_exercises AS `t2`, yyc_training_plans AS `t3`');
		$this->db->where('`t3`.`id` = `t2`.`plan_id` AND `t1`.`exercise_id` = `t2`.`id` AND `t3`.`id` = ' . $this->id);
		$this->db->limit(1);
		return $this->db->get()->first_row();
	}

	function getClient() {
		$this->load->model('user');
		return $this->db->where('id', $this->client_id)->get('yyc_users')->row(0, 'User');
	}

	function getTrainer() {
		$this->load->model('user');
		return $this->db->where('id', $this->trainer_id)->get('yyc_users')->row(0, 'User');
	}

}
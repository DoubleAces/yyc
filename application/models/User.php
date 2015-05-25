<?php

class User extends CI_Model {

	private static $db;
	private $activeUser;

	function __construct() {
		parent::__construct();
		self::$db = &get_instance()->db;
		$this->activeUser = $this->session->userdata('activeUser');
	}

	function get_all() {
		$this->db->select('id, first_name, last_name, username, email, is_trainer, is_admin');
		$this->db->from('yyc_users');
		return $this->db->get()->result();
	}

	function get($userId) {
		return $this->db->get_where('yyc_users', array('id' => $userId))->first_row();
	}

   function update($userId, $data) {
        $this->db->where('id', $userId);
        $this->db->update('yyc_users', $data);
    }

	function insert($data) {
		$data = array(
			'username' => $data['username'],
			'first_name' => $data['first_name'],
			'last_name' => $data['last_name'],
			'email' => $data['email'],
			'password' => password_hash($data['password'], PASSWORD_DEFAULT)
		);
		$this->db->insert('yyc_users', $data);
		if ($this->db->affected_rows() == 1) {
			return $this->db->insert_id();
		}
		return false;

	}

	function getById($userId) {
		return self::$db->where('id', $userId)->get('yyc_users')->row(0, 'User');
	}

	function getByUsernameAndPassword($username, $password) {
		return self::$db->where(array('username' => $username, 'password' => $password))->get('yyc_users')->row(0, 'User');
	}

	function getByUsername($username) {
		return self::$db->where(array('username' => $username))->get('yyc_users')->row(0, 'User');
	}

	/* Gets all the training plans for the user. Meant for the user view */
	function getTrainingPlans() {
		$this->load->model('training_plan');

		$this->db->select("t1.id, t1.name, t1.description, t1.added, CONCAT(t2.first_name, ' ', t2.last_name) as trainer_name", false);
		$this->db->from('yyc_training_plans as t1, yyc_users as t2');
		$this->db->where('client_id = ' . $this->id . ' AND t1.trainer_id = t2.id');

		return $this->db->get()->result('Training_Plan');
	}

	/* Gets all the training plans for the user for a specific trainer. Meant for the trainer clients view */
	function getTrainingPlansByTrainer($trainerId) {
		$this->load->model('training_plan');

		$this->db->select("t1.id, t1.name, t1.description, t1.added");
		$this->db->from('yyc_training_plans as t1');
		$this->db->where('client_id', $this->id);
		$this->db->where('trainer_id', $trainerId);

		return $this->db->get()->result('Training_Plan');
	}

	function getActiveUserClientCount() {
		$this->db->from('yyc_trainer_clients');
		$this->db->where('trainer_id = ' . $this->activeUser->id);
		return $this->db->count_all_results();
	}

	function getClients() {
		$this->db->select('t1.id, t1.first_name, t1.last_name, t1.username, t1.email, t1.photo')
			->from('yyc_users AS t1, yyc_trainer_clients AS t2')
			->where('t1.id = t2.client_id')
			->where('t2.trainer_id = ' . $this->id);
		return $this->db->get()->result();
	}

	function isTrainerOf($clientId) {
		$db = $this->db;
		
		$db->select('1');
		$db->from('yyc_trainer_clients');
		$db->where('client_id', $clientId);
		$db->where('trainer_id', $this->id);
		$q = $db->get();

		if ($q->num_rows() != 0) {
			return true;
		}
		return false;
	}

	function getTrainers() {

	}
}
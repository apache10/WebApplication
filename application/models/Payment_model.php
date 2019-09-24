<?php
class Payment_model extends CI_Model {

	public function __construct() {
		$this->load->database();
	}

	
	public function pay($table,$dataDB)
	{
		$query = $this->db->insert('orders', $dataDB);
		return TRUE;
	}
}
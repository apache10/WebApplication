<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Example {

	public function __construct() {
	}
    
	public function example($email, $password) {
		// $query = $this->db->get_where("users", array('email' => $email));
		$query = $this->db->query("SELECT * FROM users WHERE email = '" . $email . "'");
		
		$row = $query->row_array();
		echo $row;
		if (isset($row)) {
			return ($password == $row['password']);
		} else {
			return FALSE;
		}

	}
}
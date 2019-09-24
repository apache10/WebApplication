<?php
class Register_model extends CI_Model {

	public function __construct() {
		$this->load->database();
	}

	public function register($name,$email,$phone,$password,$vkey) {
		// $query = $this->db->get_where("users", array('email' => $email));
		$pass = $this->hashPass($password);
		$query = $this->db->query("INSERT INTO users(name, email, phone, password, vkey) VALUES(?,?,?,?,?)",array($name,$email,$phone,$pass,$vkey));

		if (isset($query)) {
			return TRUE;
		} else {
			return FALSE;
		}

	}

	public function checkEmail($email) {
		$query = $this->db->query("SELECT * FROM users WHERE email = ? ", array($email));
		$row = $query->row_array();
		if (isset($row)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	public function verify($vkey)
	{
		$query = $this->db->query("UPDATE users SET verified = 1 WHERE vkey=?", array($vkey));
		if (isset($query) && $query!=0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

//https://www.php.net/manual/en/function.password-hash.php for refernce
	public function hashPass($password)
   {
       $hash = password_hash($password,PASSWORD_DEFAULT);
       return $hash;
   }
}
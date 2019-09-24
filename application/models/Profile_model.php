<?php
class Profile_model extends CI_Model {

	public function __construct() {
		$this->load->database();
	}

	public function update($email,$name,$phone) {
		// $query = $this->db->get_where("users", array('email' => $email));
		$query = $this->db->query("UPDATE users SET name=?, phone=? WHERE email=?", array($name,$phone,$email));
		if (isset($query)) {
			$session_data = array(
				'name' => $name,
				'phone' => $phone
			);
			$this->session->set_userdata($session_data);
			return TRUE;
		} else {
			return FALSE;
		}

	}

	public function updatePath($email, $path)
	{
		$query = $this->db->query("UPDATE users SET filename=? WHERE email=?", array($path,$email));
		if (isset($query)) {
			$session_data = array(
				'filename' => $path,
			);
			$this->session->set_userdata($session_data);
			return TRUE;
		} else {
			return FALSE;
		}
	}
	public function filename($email)
	{
		$query = $this->db->query("SELECT filename FROM users WHERE email=?", array($email));
		$row = $query->row_array();
		if (isset($row['filename'])) {

			$session_data = array(
				'filename' => $row['filename']
			);
			$this->session->set_userdata($session_data);
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function updatePassword($email,$password) {
		// $query = $this->db->get_where("users", array('email' => $email));
		$pass = $this->hashPass($password);
		$query = $this->db->query("UPDATE users SET password=? WHERE email=?", array($pass,$email));
		if (isset($query)) {
			return TRUE;
		} else {
			return FALSE;
		}

	}

	public function hashPass($password)
   {
       $hash = password_hash($password,PASSWORD_DEFAULT);
       return $hash;
   }
}
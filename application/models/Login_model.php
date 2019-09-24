<?php
class Login_model extends CI_Model {

	public function __construct() {
		$this->load->database();
	}
    
	public function authenticate($email, $password) {
		// $query = $this->db->get_where("users", array('email' => $email));
		$query = $this->db->query("SELECT * FROM users WHERE email = ? AND verified = '1'", array($email));
		
		$row = $query->row_array();
		

		if (isset($row)) {
			if($this->verifyHash($password,$row['password'])){
				$session_data = array(
					'email' => $row['email'],
					'name' => $row['name'],
					'vkey' => $row['vkey'],
					'phone' => $row['phone'],
					'user_id' => $row['id']
				);
				$this->session->set_userdata($session_data);
				return TRUE;
			}
			return FALSE;
		} else {
			return FALSE;
		}

	}
	public function updatePassword($vkey, $password)
	{
		$pass = $this->hashPass($password);
		$query = $this->db->query("UPDATE users SET password =? WHERE vkey=?",array($pass,$vkey));
	}

	public function hashPass($password)
   {
       $hash = password_hash($password,PASSWORD_DEFAULT);
       return $hash;
   }

   //verify password
   public function verifyHash($password,$vpassword)
   {
       if(password_verify($password,$vpassword))
       {
           return TRUE;
       }
       else{
           return FALSE;
       }
   }


}
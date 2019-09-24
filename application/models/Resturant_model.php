<?php
class Resturant_model extends CI_Model {

	public function __construct() {
		$this->load->database();
	}
    
	
	public function addMenu($name, $details, $category, $price, $userId, $path)
	{   
        $query = $this->db->query("INSERT  INTO dish(name, details, category, price, user_id, filename) VALUES(?,?,?,?,?,?)",array($name,$details,$category,$price,$userId,$path));
        if (isset($query)) {
			return TRUE;
		} else {
			return FALSE;
		}
    }
    

    public function showMenu()
    {
        $this->db->select('name, details, category, price, user_id,filename');
        $query = $this->db->get('dish');
        return $query->result();
    }

     public function searchedItem($keyword)
	    {
	        $this->db->select('name, details, category, price, user_id, filename');
			$this->db->like('name', $keyword, 'both');
			$query = $this->db->get('dish');

			// --------------------------------
			// Uncomment the following line when you finished your Query builder
			return $query->result();   
	    }


}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->data['status'] = "";
        $this->load->model('profile_model');
    }

	public function index()
	{
        $this->profile_model->filename($_SESSION["email"]);
        $this->load->view('layout/header');
        $this->load->view('profile',$this->data);
        // $this->load->view('map');
        $this->load->view('layout/footer');
    }
    
    public function update()
    {
        //update profile
        $email = $_SESSION["email"];
        $name = $this->input->post('name');
        $phone = $this->input->post('phone');
        if($this->profile_model->update($email, $name, $phone))
        {
            $this->data['status'] = "Updated Successful!";
            $this->index();
        }
        else
        {
            $this->data['status'] = "Oops! something went wrong!";
            $this->index();
        }
        
    }

    public function updatePassword()
    {
        //update password
        $password='';
        if (isset($_SESSION["email"])) 
        {
            $email = $_SESSION["email"];
            $password = $this->input->post('password');
        }
        // elseif ($this->input->post('password'))
        // {
        //     $email = $this->input->get('email');
        //     $password = $this->input->post('password');
        // }
        else
        {
            $this->data['status'] = "Oops! something went wrong!";
            $this->load->view('404', $this->data);
        }
        if($this->profile_model->updatePassword($email, $password))
        {
            $this->data['status'] = "Password Updated Successful!";
            $this->index();
        }
        else
        {
            $this->data['status'] = "Oops! something went wrong!";
            $this->index();
        }
        
    }

    public function uploadPic()
    {
        $config = array(
            'upload_path' => "./profilePic/",
            'allowed_types' => "gif|jpg|png|jpeg|pdf",
            'file_name' => $_SESSION['name'],
            'overwrite' => TRUE,
            'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
            'max_height' => "1024",
            'max_width' => "1024"
            );
        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('userfile'))
        {
            $this->data['status'] = $this->upload->display_errors();
            $this->index();
        }
        else
        {
            $path = $this->upload->data('file_name');
            $email = $_SESSION["email"];
            $this->profile_model->updatePath($email, $path);
            $this->data['status'] = "Profile Picture has been updated."; //$this->upload->data('full_path');
            $this->index();
        }
    }

}
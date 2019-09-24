<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resturant extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->data['status'] = "";
                $this->data['menu']="";
                $this->load->model('resturant_model');
        }
        public function index()
        {
            if(isset($_SESSION['name']) and $_SESSION['name']=='admin'){
                $this->data['menu'] = $this->resturant_model->showMenu();
                $this->load->view('layout/header');
                $this->load->view('resturant/resturantadmin',$this->data);
                $this->load->view('layout/footer');
            }
            else{
                $this->data['menu'] = $this->resturant_model->showMenu();
                $this->load->view('layout/header');
                $this->load->view('resturant/resturant1', $this->data);
                $this->load->view('layout/footer');
            }
        }


    public function addMenu()
    {
        $name = $this->input->post('name');
        $details = $this->input->post('details');
        $category = $this->input->post('category');
        $price = $this->input->post('price');

        if($name == '')
        {
                $this->data['status'] = "Sorry please try again!";
                $this->index();
        }


        $config = array(
                'upload_path' => "./profilePic/",
                'allowed_types' => "gif|jpg|png|jpeg|pdf",
                'file_name' => $name,
                'overwrite' => TRUE,
                'max_size' => "4096000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                'max_height' => "1024",
                'max_width' => "1024"
                );
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('userfile'))
            {
                //$this->upload->display_errors();
                $this->data['status'] = $this->upload->display_errors();
                // $this->index();
                 $this->index();
            }
            else
            {
                // $this->upload->data('file_path');
                $this->upload->data('full_path');
                // $this->data['status'] = $this->upload->data('full_path');//"Profile Picture has been updated.";
                // $this->index();
                $path = $this->upload->data('file_name');
                if ($this->resturant_model->addMenu($name, $details, $category, $price, $_SESSION['user_id'], $path))
                {
                        $this->data['status'] = "Item has been updated successfully!";
                        $this->index();
                }else{
                        $this->data['status'] = "Sorry please try again!";
                        $this->index();
                }
            }
            

    }

    public function uploadPic()
    {
        
    }

    public function showMenu()
    {
        $data['menu'] = $this->resturant_model->showMenu();
        $this->index();
    }


    public function searchedItem()
        {
                $keyword = $this->input->get('keyword');
                // echo $keyword;
                if(isset($keyword)){
                    $data['keyword'] = $keyword;
                    $this->data['menu'] = $this->resturant_model->searchedItem($keyword);
                    $this->load->view('layout/header');
                    $this->load->view('resturant/resturant1', $this->data);
                    $this->load->view('layout/footer');
            }

        }
}
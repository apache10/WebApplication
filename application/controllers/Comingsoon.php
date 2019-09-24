<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comingsoon extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
        }

	public function index()
	{
        $this->load->view('layout/header');
        $this->load->view('comingsoon');
        $this->load->view('layout/footer');
        }
        
        
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->data['status'] = "";
        $this->load->model('login_model');
    }

    public function index() {
        $this->load->view('layout/header');
        $this->load->view('login', $this->data);
        $this->load->view('layout/footer');
    }

    public function login() {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $remember = $this->input->post('remember');

        if ($remember) {
            setcookie("email", $_POST["email"], time() + 60*60*24, "/");            
        } else {
            setcookie("email", '', time() -1, "/");
        }
        if ($this->login_model->authenticate($email, $password)) {
            if(isset($_SESSION['name']) and $_SESSION['name']=='admin')
            {
                redirect(base_url().'resturant');
            }
            redirect(base_url());
        } else {
            $this->data['status'] = "Your email or password is incorrect!";
            $this->session->set_flashdata('error','Invalid username and password.');
            $this->index();
        }
        
    }

    public function forgotPassword()
    {
        if ($this->input->get('vkey'))
        {
            $vkey = $this->input->get('vkey');
            $session_data = array(
                'vkey' => $vkey
            );
            $this->session->set_userdata($session_data);
            $this->load->view('changePassword', $this->data);
            
        }else
        {
        $this->load->view('forgotPassword', $this->data);
        }
    }

    public function sendEmail() {
        $email = $this->input->post('email');
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'mailhub.eait.uq.edu.au',
            'smtp_port' => 25,//25
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );
        $vkey = md5($email);
        $message = '<a href="'. base_url().'login/forgotPassword?vkey='.$vkey.'">Please chnage password by clicking this link</a>';
        
        // $this->load->library('email', $config);
        $this->load->library('email');
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->from('gaurav.gupta@uqconnect.edu.au'); // 
        $this->email->to($email);// 
        $this->email->subject('Change Password!');
        $this->email->message($message);
        
        if($this->email->send()){
            $this->data['status'] = "Email sent Successful! change your password using email link";
            $this->load->view('forgotPassword', $this->data);
        }else{
            // echo $this->email->send();
            show_error($this->email->print_debugger());
            $this->data['status'] = "something went wrong";
            $this->load->view('forgotPassword', $this->data);
        }
    }

    public function updatePassword()
    {
        //update password
        if (isset($_SESSION["vkey"])) 
        {
            $vkey = $_SESSION["vkey"];
            $password = $this->input->post('password');
        }
        else
        {
            $this->data['status'] = "Oops! something went wrong!";
            $this->load->view('404', $this->data);
        }
        $this->login_model->updatePassword($vkey, $password);
        $this->data['status'] = "Password Updated Successful!";
        $this->index();
    }

    public function logout() {
        session_destroy();
        redirect(base_url());
    }
}

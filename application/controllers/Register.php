<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Register extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->data['status'] = "";
        $this->load->library('form_validation');
        $this->load->model('register_model');
        
    }

	public function index()
	{
        $this->load->view('layout/header');
        $this->load->view('register', $this->data);
    }

    
    
    public function register()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $name = $this->input->post('name');
        $phone = $this->input->post('mobile');
        $repassword = $this->input->post('repassword');
        $remember = $this->input->post('remember');
        $vkey = md5($email);
        if($password == $repassword)
        {
            if ($this->register_model->register($name,$email,$phone,$password,$vkey)) {
                //$this->data['status'] = "Register Successful!";
                $this->sendEmail($vkey, $email);
                //$this->index();
            } else {
                $this->data['status'] = "Register Unsuccessful!";
                $this->index();
            }
        }
        else 
        {
            $this->data['status'] = "Passwords Do not match!";
            $this->index();
        }
    }
    public function checkPass()
    {
        $pass =  $this->input->post('pass');
        if (strlen($pass) ==0) {
            echo '<span style="color:red" >enter password</span>';
        }
        elseif (strlen($pass) >7) {

            $uc = 0; $lc = 0; $num = 0; $other = 0;
            for ($i = 0, $j = strlen($pass); $i < $j; $i++) {
                $c = substr($pass,$i,1);
                if (preg_match('/^[[:upper:]]$/',$c)) {
                    $uc++;
                } elseif (preg_match('/^[[:lower:]]$/',$c)) {
                    $lc++;
                } elseif (preg_match('/^[[:digit:]]$/',$c)) {
                    $num++;
                } else {
                    $other++;
                }
            }
            // the password must have more than two characters of at least 
            // two different kinds 
            $max = 1;
            if ($uc < $max) {
                echo '<span style="color:orange" >good password </span>';
            }
            elseif ($lc < $max) {
                echo '<span style="color:orange" >good password </span>';
            }
            elseif ($num < $max) {
            echo '<span style="color:orange" >good password </span>';
            }
            else {
                echo '<span style="color:green" > Strong password </span>';
            }

        }
        else {
            echo '<span style="color:red" > not a good password.</span>';
        }
    }
    public function checkEmail()
    {
        $email = $this->input->post('email');
        if($this->register_model->checkEmail($email)) 
        {
            echo '<span style="color:red">email not available </span>';
        }
        else {
            echo '<span style="color:green">email available </span>';
        }
    }
    public function rePass()
    {
        $rePass = $this->input->post('repass');
        $pass = $this->input->post('pass');
        if($rePass == $pass)
        {
            echo '<span style="color:green">Perfect!!.</span>';
        }
        else
        {
            echo '<span style="color:red">Passwords Do not match!.</span>';
        }
        
    }
    public function sendEmail($vkey, $email) {
        
         $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'mailhub.eait.uq.edu.au',
            'smtp_port' => 25,//25
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );
        $message = '<a href="'. base_url().'register/verify?vkey='.$vkey.'">Please verify your account by clicking this link</a>';
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('gaurav.gupta@uqconnect.edu.au'); // 
        $this->email->to($email);// 
        $this->email->subject('Account verifications!');
        $this->email->message($message);
        
        if($this->email->send()){
            $this->data['status'] = "Email sent Successful!";
            $this->index();
        }else{
            show_error($this->email->print_debugger());
            $this->data['status'] = "something went wrong";
            $this->index();
        }
    }


    public function verify()
    {
        $vkey = $this->input->get('vkey');
        if($this->register_model->verify($vkey))
        {
            $this->load->view('verify');
        }
        else
        {
            $this->load->view('404');
        }
    }
}
<?php
 class Login extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        $this->load->model("Patient_model");
    }

    public function index(){
		$this->load->view("template/Login");
    }

    public function checkLogin(){
        $checkValidation=$this->Patient_model->validateLogin();
        if(!$checkValidation){
            $this->index();
        }
        else{
            $result=$this->Patient_model->getUsers();

            if($result){
                $auth_user=[
                    'id'=>$result->id,
                    'name'=>$result->name,
                ];

                $this->session->set_userdata('auth_user',$auth_user);
                $this->session->set_flashdata("success","Logged In Successfully");
              redirect('/index.php/Patient/');  
            }
            
            else{
            $this->session->set_flashdata("failed","These credentials do not match our records.");
            $this->index();
            }
        }
    }
    public function logout(){
        $this->session->sess_destroy();
        $this->session->unset_userdata('auth_user');
        $this->session->set_flashdata('success',"You are logged out successfully!");
        $this->index();
    }
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient extends CI_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->model("Patient_model");
      }

	// Registration view starts here----------------->
	public function index()
	{
		$rows=$this->Patient_model->getAllPatients();
		if($rows){
			$data['rows']=$rows;
			$this->load->view('Registration',$data);
		}else{
			$this->load->view('Registration');
		}
	}
	

// 	public function index()
// {
//     $page = $this->input->get('page') ? $this->input->get('page') : 1;
//     $limit = 10;
//     $offset = ($page - 1) * $limit;
//     $rows = $this->Patient_model->getAllPatients($limit, $offset);
//     $data['rows'] = $rows;
//     $data['current_page'] = $page;
//     $this->load->view('Registration', $data);
// 	echo json_encode($data);
// }


	public function registerData(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name',"Name","required|min_length[5]|max_length[50]|trim|regex_match[/^[a-zA-Z\s]+$/]");
		$this->form_validation->set_rules('age', 'Age',"required|numeric|less_than_equal_to[130]");
		$this->form_validation->set_rules('gender',"Gender","required");
		$this->form_validation->set_rules('languages[]', 'Language','required|in_list[English,Nepali,Other]');
		$this->form_validation->set_rules('country', 'Country', 'required');
		$this->form_validation->set_rules('province', 'Province', 'required');
		$this->form_validation->set_rules('district', 'District', 'required');
		$this->form_validation->set_rules('municipality', 'Municipality', 'required');
		$this->form_validation->set_rules('address', 'Address', 'required');
		$this->form_validation->set_rules('mobile', 'Mobile Number','required|exact_length[10]|numeric|regex_match[/^[0-9]+$/]');

		if($this->form_validation->run()===true){
			$id=$this->Patient_model->insertPatientData();
			if($id){
			$row=$this->Patient_model->getRow($id);
			$data=$row;
			$response['row']=$data;
			}
			$response['status']=1;
		}
		else{
			$response['name'] = strip_tags(form_error('name'));
			$response['age'] = strip_tags(form_error('age'));
			$response['gender'] = strip_tags(form_error('gender'));
			$response['language'] = strip_tags(form_error('languages[]'));
			$response['country'] = strip_tags(form_error('country'));
			$response['province'] = strip_tags(form_error('province'));
			$response['district'] = strip_tags(form_error('district'));
			$response['municipality'] = strip_tags(form_error('municipality'));
			$response['address'] = strip_tags(form_error('address'));
			$response['mobile'] = strip_tags(form_error('mobile'));
			$response['status']=0;
		}
		echo json_encode($response);
	}

	public function loadRegBilling(){
		$uriSegments = explode('/', $this->uri->uri_string());
		$value = end($uriSegments);	
		if($value){
		$data['value'] = $value;
		$this->load->view('patient-reg-billing',$data);
		}
	}

	public function getTests(){
		$data=$this->Patient_model->getTestItems();
		if($data){
		echo json_encode($data);
		}
	}

	public function getSinglePatient(){
		$id=$this->input->post('pid');
		if($id){
		$data=$this->Patient_model->getAPatient($id);
		if($data){
		echo json_encode($data);
		}
		}else{
			return false;
		}
	}

//Reg&Billing section starts here------------->

public function saveBillingData()
{
    $this->db->trans_start();
    $rowData = $this->input->post('rowData');
    $rowData2 = $this->input->post('rowData2');
	if($rowData){
	$sampleNo = $this->Patient_model->insertIntoBillingInfo();
	if($sampleNo&&$rowData2){
	$affectedRows=$this->Patient_model->insertIntoBillingItems($sampleNo);
	if($affectedRows){
		if ($this->db->trans_status() === false) {
			$this->db->trans_rollback(); 
			echo json_encode("failure");
		} else {
			$this->db->trans_commit(); 
			echo json_encode("success");
		}
	}
	}
	}
	else{
		echo json_encode("failure");
	}
}


	//Billing section starts here------------->

	public function billing(){
		$rows=$this->Patient_model->getBillingInfo();
		if($rows){
		$data['rows']=$rows;
		$this->load->view("Billing.php",$data);
		}else{
			$this->load->view("Billing.php");
		}
	}

	public function invoiceDetails(){
		$sampleNo = $this->input->post('sampleNo');
		if($sampleNo){
		$data=$this->Patient_model->getSamples($sampleNo);
		if($data){
		echo json_encode($data);
		}
		}else{
			return false;
		}
		
	}

}



<?php
class Patient_model extends CI_model{

    public function validateLogin(){
        $this->form_validation->set_rules('email','Email','required|valid_email');
        $this->form_validation->set_rules('password','Password','required');
        if($this->form_validation->run()==false){
            return false;
        }else{
            return true;
        }
    }

    public function getUsers(){
        $data=array(
            'email'=>$this->input->post('email'),
            'password'=>md5($this->input->post("password")),
        );
        
        $this->db->where('email',$data['email']);
        $this->db->where('password',$data['password']);
        $this->db->from('users');
        $this->db->limit(1);
        $query=$this->db->get();
        if($query->num_rows()>0){
            return $query->row();
        }
        else{
            return false;
        }
    }

    public function insertPatientData(){
        $formArray=array();
			$formArray['Name']=$this->input->post('name');
			$formArray['Age']=$this->input->post('age');
			$formArray['Gender']=$this->input->post('gender');
			$formArray['Language']= json_encode($this->input->post('languages'));
			$formArray['Country']=$this->input->post('country');
			$formArray['Province']=$this->input->post('province');
			$formArray['District']=$this->input->post('district');
			$formArray['Municipality']=$this->input->post('municipality');
			$formArray['Address']=$this->input->post('address');
			$formArray['MobileNumber']=$this->input->post('mobile');
        $this->db->insert('patients',$formArray);
        return $this->db->insert_id();
    }

    public function getRow($id){
        $this->db->where('PatientID',$id);
        return $row= $this->db->get('patients')->row_array();
    }

    public function getMunicipalityData($province){
        $this->db->select('municipality');
        $this->db->from('locations');
        $this->db->where('province',$province);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }else{
            return false;
        }
    }

    public function deleteAPatient($id){
        $this->db->where('PatientID',$id);
        $this->db->delete('patients');
    }

    function getAllPatients(){
        return $result=$this->db->order_by('PatientID','ASC')->get('patients')->result_array();
    }


    // public function getAllPatients($limit, $offset)
    // {
    //     $this->db->limit($limit, $offset);
    //     $query = $this->db->get('patients');
    //     return $query->result_array();
    // }


    public function getTestItems(){
        $this->db->select('*');
        $this->db->from('testitems');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }else{
            return false;
        }
    }
    public function getAPatient($id){
        $this->db->select('*');
        $this->db->from('patients');
        $this->db->where('PatientID',$id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }else{
            return false;
        }
    }

    public function insertIntoBillingInfo(){
        $rowData = $this->input->post('rowData');
        if ($rowData) {
            $data = array(
                'PatientID' => $rowData['patientID'],
                'Subtotal' => $rowData['subTotal'],
                'DiscountPercent' => $rowData['discountPercent'],
                'DiscountAmount' => $rowData['discountAmount'],
                'NetTotal' => $rowData['netTotal']
            );
		$this->db->insert('BillingInfo', $data);
        return $this->db->insert_id();
        }else{
            return false;
        }
    }

    public function insertIntoBillingItems($sampleNo){
        $rowData2 = $this->input->post('rowData2');
        if ($rowData2 && $sampleNo) {
            $batchData = array();
            foreach ($rowData2 as &$item) {
                $item['sampleNo'] = $sampleNo;
            }
            foreach ($rowData2 as $row) {
                $sampleNo = $row['sampleNo'];
                $patientID = $row['patientID'];
                $testItems = $row['testItems'];
                $qty = $row['qty'];
                $unitPrice = $row['unitPrice'];
                $discountPercent = $row['discountPercent'];
    
                $data = array(
                    'SampleNo' => $sampleNo,
                    'PatientID' => $patientID,
                    'TestItems' => $testItems,
                    'Qty' => $qty,
                    'UnitPrice' => $unitPrice,
                    'DiscountPercent' => $discountPercent
                );
                $batchData[] = $data;
            }
            $this->db->insert_batch('billingitems', $batchData);
            return $this->db->affected_rows() > 0;
        }
        else{
            return false;
        }
    }

    public function getBillingInfo(){
        $this->db->select('*');
        $this->db->from('billinginfo');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }else{
            return false;
        }
    }
    public function getSamples($sampleNo){
        $this->db->select('patients.*, billingitems.BillID, billingitems.PatientID, billingitems.SampleNo, billingitems.TestItems, billingitems.Qty, billingitems.UnitPrice, billingitems.DiscountPercent');
        $this->db->from('billingitems');
        $this->db->join('patients', 'billingitems.PatientID = patients.PatientID');
        $this->db->where('billingitems.SampleNo', $sampleNo);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }else{
            return false;
        }
    }
}
?>
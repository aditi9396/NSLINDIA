<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lrtracking_Controller extends CI_Controller {

    public function lrtracking() {
        $this->load->model('Auth_model');
        $data['user'] = $this->Auth_model->user_data($this->session->userdata('user_id'));
        $this->load->view('frontend/lrtracking', $data);
    }

    public function Search()
    {
        $searchTerm = $this->input->get('term');
        $data = $this->getAutocompleteData1($searchTerm);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }

    private function getAutocompleteData1($searchTerm)
    {
        $this->load->database(); 

        $query = $this->db
            ->select('LRNO')
            ->from('lr')
            ->like('LRNO', $searchTerm)
            ->limit(5)
            ->get();

        $data = $query->result_array();
        return $data;
    }


// ====================
 public function search5()
    {
        $searchTerm = $this->input->get('term');
        $data = $this->getAutocompleteData6($searchTerm);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }

    private function getAutocompleteData6($searchTerm)
    {
        $this->load->database(); 
        $query = $this->db
            ->select('CustCode, CustName')
            ->group_start()
                ->like('CustName', $searchTerm)
                ->or_like('CustCode', $searchTerm)
            ->group_end()
            ->where('Status', '1')
            ->limit(5)
            ->get('customers');

        $data = $query->result_array();
        return $data;
    }


// =====================

public function search2()
{
    $searchTerm = $this->input->get('term');
    $data = $this->getAutocompleteData3($searchTerm);

    $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
}

private function getAutocompleteData3($searchTerm)
{
    $this->load->database(); 

    $query = $this->db
        ->select('Consignee')
        ->from('lr')
        ->like('Consignee', $searchTerm)
        ->limit(5)
        ->get();

    $data = $query->result_array();
    return $data;
}

// =====================

public function search3()
{
    $searchTerm = $this->input->get('term');
    $data = $this->getAutocompleteData4($searchTerm);

    $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
}

private function getAutocompleteData4($searchTerm)
{
    $this->load->database(); 

    $query = $this->db
        ->select('InvoiceNo')
        ->from('lr')
        ->like('InvoiceNo', $searchTerm)
        ->limit(5)
        ->get();

    $data = $query->result_array();
    return $data;
}


// =====================

public function search4()
{
    $searchTerm = $this->input->get('term');
    $data = $this->getAutocompleteData5($searchTerm);

    $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
}

private function getAutocompleteData5($searchTerm)
{
    $this->load->database(); 

    $query = $this->db
        ->select('ToPlace')
        ->from('lr')
        ->like('ToPlace', $searchTerm)
        ->limit(5)
        ->get();

    $data = $query->result_array();
    return $data;
}
// ============================/


public function searchlrdata() {
    $this->load->model('Auth_model');
    $data['user']=$this->Auth_model->user_data($this->session->userdata('user_id'));
    $lrNo = $this->input->post('LRNO');
    $custName = $this->input->post('CustName');
    $consignee = $this->input->post('Consignee');
    $invoiceNo = $this->input->post('InvoiceNo');
    $toPlace = $this->input->post('ToPlace');

    $this->load->model('LrTracking_Model');

    $data['result'] = $this->LrTracking_Model->searchData($lrNo, $custName, $consignee, $invoiceNo, $toPlace);
   
    $this->load->view('frontend/lrtracking', $data);

}

public function insert() {
    $this->load->model('Auth_model');
    $data['user'] = $this->Auth_model->user_data($this->session->userdata('user_id'));

    $this->load->model('Lrtracking_Model');
    
    if ($this->input->post('save')) {
        $lrData = array(
            'LRNO' => $this->input->post('LRNO'),
            'Date' => date('Y-m-d'),            
            'PersonName' => $this->input->post('PersonName'),
            'PersonMobile' => $this->input->post('PersonMobile'),
            'CATEGORY' => $this->input->post('CATEGORY'),
            'Problem' => $this->input->post('Problem'),
            'Responce' => $this->input->post('Responce'),
            'Feedback' => $this->input->post('Feedback')

        );

        $this->Lrtracking_Model->insert_data($lrData);
        $data['success_message'] = "Data inserted successfully.";        
        redirect('lrtracking');
    }
}
public function trackLR($lrno) {
    $this->load->model('Auth_model');
    $data['user'] = $this->Auth_model->user_data($this->session->userdata('user_id'));
    $this->load->model('LrTracking_Model'); 
    $data['result'] = $this->LrTracking_Model->getLRData($lrno);
  $weightLR = $data['result']['ActualWeight'];
    $lr_profit = $data['result']['profit_loss'];
    $singlelrcost = $data['result']['SINGLR_LR_COST'];
    $totallrcost = 0;  
    $totallrcost = $totallrcost + $singlelrcost; 

    // Additional code for location adjustment
    $startdepo = $data['result']['Location'];
    $enddepo = $data['result']['Depot'];

    if ($startdepo == 'SHV' || $startdepo == 'URL') {
        $startdepo = 'PNA';
    }

    if ($enddepo == 'SHV' || $enddepo == 'URL') {
        $enddepo = 'PNA';
    }

    $srrsy = "('$startdepo','$enddepo')";
 $people = array("('PNA','AUR')", "('PNA','NSK')","('PNA','KOP')", "('PNA','SGN')", 
    "('PNA','NRG')", "('PNA','STR')", "('PNA','BRS')", "('AUR','PNA')", "('AUR','NSK')", "('AUR','KOP')", "('AUR','SGN')", "('AUR','NRG')", "('AUR','STR')","('AUR','BRS')", "('NSK','PNA')", "('NSK','AUR')", "('NSK','KOP')", "('NSK','SGN')", "('NSK','NRG')", "('NSK','STR')", "('NSK','BRS')", "('KOP','PNA')", "('KOP','AUR')", "('KOP','NSK')", "('KOP','SGN')", "('KOP','NRG')", "('KOP','STR')", "('KOP','BRS')", "('SGN','PNA')", "('SGN','AUR')", "('SGN','NSK')", "('SGN','KOP')", "('SGN','NRG')", "('SGN','STR')", "('SGN','BRS')", "('NRG','PNA')", "('NRG','AUR')", "('NRG','NSK')", "('NRG','KOP')", "('NRG','SGN')", "('NRG','STR')", "('NRG','BRS')", "('STR','PNA')", "('STR','AUR')", "('STR','NSK')", "('STR','KOP')", "('STR','SGN')", "('STR','NRG')", "('STR','BRS')", "('BRS','PNA')", "('BRS','AUR')", "('BRS','NSK')", "('BRS','KOP')", "('BRS','SGN')", "('BRS','NRG')", "('BRS','STR')", "('NAG','AKL')","('AKL','AUR')","('AKL','NAG')","('AUR','AKL')");

        $rateakola=array("('PNA','AKL')", "('NSK','AKL')", "('AKL','PNA')", "('AKL','NSK')");
        $ratenagpur=array("('PNA','NAG')", "('NAG','PNA')","('NAG','NSK')","('NAG','BRS')", "('NSK','NAG')", "('BRS','NAG')");


    $rate = 0;  
      $totalthccost = 0;  

    if (in_array($srrsy, $people)) {
        $rate = 2;
    } elseif (in_array($srrsy, $rateakola)) {
        $rate = 2.5;
    } elseif (in_array($srrsy, $ratenagpur)) {
        $rate = 3;
    } else {
        //echo "Match not found";
        $rate = 0;
    }

    $single_thcLR = $weightLR * $rate;
    $totalthccost = $totalthccost + $single_thcLR;

    // Update the data array
    $data['lr_profit'] = $lr_profit;
    $data['singlelrcost'] = $singlelrcost;
    $data['totallrcost'] = $totallrcost;
    $data['single_thcLR'] = $single_thcLR;
    $data['srrsy'] = $srrsy;
    $data['rate'] = $rate;





    
    if ($lr_profit < 0) {
        $loss = abs($lr_profit);
    } else {
        $loss = 0;
    }
    $data['loss'] = $loss; 

    $this->load->view('frontend/LrTracking_View', $data);
}

public function ViewFeedback() {
        $this->load->model('Auth_model');
        $data['user'] = $this->Auth_model->user_data($this->session->userdata('user_id'));
        $this->load->view('frontend/ViewFeedback', $data);
    }






    
}





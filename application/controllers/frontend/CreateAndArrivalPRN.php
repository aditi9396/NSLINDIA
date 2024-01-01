<?php

 class CreateAndArrivalPRN extends CI_Controller
{
	public function Createprn() {  
    $this->load->model('Auth_model');
       $data['user']=$this->Auth_model->user_data($this->session->userdata('user_id'));
       $data['header']='frontend/header';
       $data['body']='frontend/CreatePRN';
       $data['sidebar']='frontend/sidebar';
       $data['footer']='frontend/footer';
       $data['meta'] = array('title'=>'HOME |NSLINDIA','page_title'=>'cpcontractmaster');
       $this->load->view('frontend/backend_template', $data);   
 
   }

   public function createprnview() {  
    $this->load->model('Auth_model');
       $data['user']=$this->Auth_model->user_data($this->session->userdata('user_id'));
       $data['header']='frontend/header';
       $data['body']='frontend/createprnview';
       $data['sidebar']='frontend/sidebar';
       $data['footer']='frontend/footer';
       $data['meta'] = array('title'=>'HOME |NSLINDIA','page_title'=>'cpcontractmaster');
       $this->load->view('frontend/backend_template', $data);   
 
   }
public function get_vehicle_data()
{
    $this->load->model('Auth_model');
   
    $searchTerm = $this->input->get('search') ?: $this->input->post('search');

    $data = $this->Auth_model->getVehicle($searchTerm);

    $result = [];
    foreach ($data as $item) {
        $result[] = array(
            'label' => $item['Vehicle_No'],
            'value' => $item['Vehicle_No'], 
        );
    }

    echo json_encode($result);
}

public function get_customer_data() {
    $this->load->model('Auth_model');

    $searchTerm = $this->input->post('search');

    try {
        $data = $this->Auth_model->getCustomerData($searchTerm);

        $result = [];
        foreach ($data as $item) {
            $result[] = array(
                'label' => $item['CustCode'],
                'value' => $item['CustName'],
            );
        }

        echo json_encode($result);

    } catch (Exception $e) {
        log_message('error', 'Exception in get_customer_data: ' . $e->getMessage());
        show_error('An unexpected error occurred. Please try again later.');
    }
}


public function getLRNumbersdata() {
        $partyId = $this->input->post('party_id');
        $selectedDate = $this->input->post('selected_date');
        $fromDate = $this->input->post('from_Date');

        $data = array();

        $this->load->model('Auth_model'); 

        $result = $this->Auth_model->getLRNumbers($partyId, $selectedDate, $fromDate);

        if ($result) {
            echo json_encode($result);
        } else {
            echo json_encode(array("error" => "Database error."));
        }
    }

  public function saveprn() {
    $this->load->model('Auth_model');



    $depot = $this->input->post('depot');   
    $maxIdResult = $this->Auth_model->getMaxId();
    $Id = ($maxIdResult['maxId'] === null) ? 1 : $maxIdResult['maxId'] + 1;

    $PRNNO = "PR/$depot/2425/" . str_pad($Id, 6, 0, STR_PAD_LEFT);

    $partyid = $this->input->post('partyid');
    $partyname = $this->input->post('partyname');
    $VehicleNo = $this->input->post('num');
    $Hvendor = $this->input->post('Hvendor');
    $hamaliamount = $this->input->post('hamaliamount');
    $PRNDate = date('Y-m-d H:i:s');

    $data = array(
        'VehicleNo' => $VehicleNo,
        'PRNId' => $PRNNO,
        'CustomerCode' => $partyid,
        'CustomerName' => $partyname,
        'Prncreatehamaliname' => $Hvendor,
        'PRNDate' => $PRNDate,
        'prncreatehamaliamount' => $hamaliamount
    );

    $prnVehicleId = $this->Auth_model->insertPrnVehicle($data);

    $lrno = isset($_POST['lr_to_save']) ? $_POST['lr_to_save'] : [];
    $result = false;

    if (!empty($lrno)) {
        foreach ($lrno as $lrnoValue) {
            $lrData = array(
                'PRNId' => $PRNNO,
                'LRNO' => $lrnoValue,
                'PRNDate' => date('Y-m-d H:i:s')
            );

            $result = $this->Auth_model->insertPrnApp($lrData);
            $this->Auth_model->updateLrTable($lrnoValue);
        }
    }

    if ($result) {
        $response = array('success' => true, 'message' => 'Create PRN successfully', 'PRNNO' => $PRNNO);
    } else {
        $response = array('success' => false, 'message' => 'Error creating PRN');
    }

    // Send JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
}

public function fetchprnwise() {

     $this->load->model('Auth_model');
       $data['user']=$this->Auth_model->user_data($this->session->userdata('user_id'));
   
        $searchBy = $this->input->post('searchby');  

        if ($searchBy == 'Bydate') {
            $dateFrom = $this->input->post('d1');
            $dateTo = $this->input->post('d2');

            $dateFrom = date('Y-m-d', strtotime($dateFrom));
            $dateTo = date('Y-m-d', strtotime($dateTo));

            $data['results'] = $this->Auth_model->searchByDatePRN($dateFrom, $dateTo);
        } elseif ($searchBy == 'THCNO') {
            $prnNo = $this->input->post('THCNO');
            $data['results'] = $this->Auth_model->searchByPrnNo($prnNo);
        }

         $this->load->view('frontend/SearchPrn',$data);
    
}

public function UpdatePrnStock()
{
    $this->load->model('Auth_model'); 
       $data['user']=$this->Auth_model->user_data($this->session->userdata('user_id'));


    $Edit_PrnStock = $this->input->post('Edit_PrnStock');

    
    $detailsResult = $this->Auth_model->get_UpdatePrnStock_details($Edit_PrnStock);
    $data['Edit_PrnStock_details'] = $detailsResult;

   
    $alldetailsResult = $this->Auth_model->get_UpdatePrnStock_alldetails($Edit_PrnStock);
    $data['Edit_PrnStock_alldetails'] = $alldetailsResult; 

    $this->load->view('frontend/UpdatePrnStock', $data);
}

public function prnarrivaldetails() {
    $this->load->model('Auth_model');
    $data['user']=$this->Auth_model->user_data($this->session->userdata('user_id'));

    if ($this->input->post('Submit')) {
        $data['User1'] = $this->session->userdata('User1');
        $data['thcno'] = $this->input->post('thcno');     

        $data['Unloadingornot'] = $this->input->post('loadingtype');
        $data['Hvendor'] = $this->input->post('Hvendor');
        $data['hamali'] = $this->input->post('hamali');
        $data['Vehicleno'] = $this->input->post('Vehicleno');
        
        // Ensure that LRDetails is an array
        $data['LRDetails'] = $this->input->post('LRNO') ? $this->input->post('LRNO') : [];
        
        foreach ($data['LRDetails'] as &$lrow) {
    $lrow = [
        'LRNO' => $lrow,
        'qty_' => $this->input->post('qty_' . $lrow),
        'received_qty' => $this->input->post('received_qty_' . $lrow),
        'reason' => $this->input->post('reason_' . $lrow),
    ];
      //print_r($lrow);
}    
      
       // print_r($data);

        $result = $this->Auth_model->updatePrnDetails($data);

        if ($result) {         
      
             echo "<script>alert('Records Updated successfully');</script>"; 
              $this->load->view('frontend/SearchPrn',$data);
        } else {
     
            $this->session->set_flashdata('error', 'Error updating records');
        }
       // echo $this->load->db->last_query();
    } else {
        // Handle GET request or show form
        $this->load->view('frontend/SearchPrn',$data);
    }
}

//DRS APPROVAL 

public function DrsProfitApprovalForm() {     

        $this->load->model('Auth_model'); 
        
       $data['user']=$this->Auth_model->user_data($this->session->userdata('user_id'));
       $data['header']='frontend/header';
       $data['body']='frontend/DrsProfitApprovalForm';
       $data['sidebar']='frontend/sidebar';
       $data['footer']='frontend/footer';
       $data['meta'] = array('title'=>'HOME |NSLINDIA','page_title'=>'cpcontractmaster');
       $this->load->view('frontend/backend_template', $data);  


    }


  public function insertDRSProfitApproval()
{
    $this->load->model('Auth_model');

    $vendorName = $this->input->post('vendorName');
    $vehicleNo = $this->input->post('vehicleNo');
    $date = $this->input->post('date');
    $reason = $this->input->post('reason');
    $approvalUser = $this->input->post('approvalUser');

    $formdata = array(
        'vendorName' => $vendorName,
        'vehicleNo' => $vehicleNo,
        'date' => $date,
        'reason' => $reason,
        'approvalUser' => $approvalUser
    );

    $result = $this->Auth_model->insertDrsProfitApproval($formdata);

    if ($result) {
        $response = array('success' => true, 'message' => 'DRS Approval Insert Successfully');
    } else {
        $response = array('success' => false, 'message' => 'Error inserting DRS Approval');
    }

   header('Content-Type: application/json');
    echo json_encode($response);
}

  public function UpdateDRSProfitApproval()
  {


    $this->load->model('Auth_model');
     $data['user']=$this->Auth_model->user_data($this->session->userdata('user_id'));

    $editdrsid = $this->input->post('editdrsid');
    $vendorName = $this->input->post('vendorName');
    $vehicleNo = $this->input->post('vehicleNo');
    $date = $this->input->post('date');
    $reason = $this->input->post('reason');
    $approvalUser = $this->input->post('approvalUser');

    $formdata = array(
        'vendorName' => $vendorName,
        'vehicleNo' => $vehicleNo,
        'date' => $date,
        'reason' => $reason,
        'approvalUser' => $approvalUser      
        
    );
  
    $this->Auth_model->edit_drsapproval($editdrsid, $formdata);   
  
    if ($this->db->affected_rows() > 0) {
        echo "<script>alert('DRS Approval updated successfully')</script>";
       
    } 
    else {
        echo "Error updating vendor";
    }

   $this->load->view('frontend/DrsProfitApprovalReport', $data);
      
  }

  /*public function DRSProfitApprovalReport()
    {

        $this->load->model('Auth_model');
        $data['user']=$this->Auth_model->user_data($this->session->userdata('user_id'));    
         
        $fromDate = $this->input->post('fromdate');
        $toDate = $this->input->post('Todate');

        $fromDate = date('Y-m-d', strtotime($fromDate));
        $toDate = date('Y-m-d', strtotime($toDate));

        $data['records'] = $this->Auth_model->getFilteredRecords($fromDate, $toDate);

        //echo $this->db->last_query();

        $this->load->view('frontend/DrsProfitApprovalReport', $data); 

    }*/


   public function DRSProfitApprovalReport()
{
    $this->load->model('Auth_model');
    $data['user'] = $this->Auth_model->user_data($this->session->userdata('user_id'));

   
    if (isset($_POST['searchButton'])) {
     
        $fromDate = $this->input->post('fromdate');
        $toDate = $this->input->post('Todate');

        // Check if date values are set before converting
        if ($fromDate && $toDate) {
            // Explicitly specify date format
            $fromDate = date('Y-m-d', strtotime($fromDate));
            $toDate = date('Y-m-d', strtotime($toDate));

            $data['records'] = $this->Auth_model->getFilteredRecords($fromDate, $toDate);

            if (empty($data['records'])) {
                // Set flashdata for displaying a message in the view
                $this->session->set_flashdata('no_results_message', 'No results found.');
            }
           // echo $this->db->last_query();
        } else {
            // Handle the case where date values are not set
            $data['records'] = [];
        }
    } else {
        
        $data['records'] = [];
        $fromDate = date('Y-m-d');
        $toDate = date('Y-m-d');
    }

    $this->load->view('frontend/DrsProfitApprovalReport', $data);
}


public function edit_drsapproval()
{
    $this->load->model('Auth_model');
     $data['user']=$this->Auth_model->user_data($this->session->userdata('user_id'));

    $edit_Approval = $this->input->post('Edit_Approval');

    $EditDRS_Approval = $this->Auth_model->get_Drsapproval_details($edit_Approval);
    
    $data['EditDRS_Approval_details'] = $EditDRS_Approval;

    $this->load->view('frontend/EditDRSApproval', $data);

}


public function delete_drsapproval()
{
    $this->load->model('Auth_model');
     $data['user']=$this->Auth_model->user_data($this->session->userdata('user_id'));

    $Delete_Approval = $this->input->post('Delete_Approval');
   
    if ($Delete_Approval) {
        $this->Auth_model->delete_Drsapproval($Delete_Approval);
        echo "<script>alert('DRS Approval deleted successfully')</script>";
         $this->load->view('frontend/DrsProfitApprovalReport', $data);   
       
    }

    
}


}

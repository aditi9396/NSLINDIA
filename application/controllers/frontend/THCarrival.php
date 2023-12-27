<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class THCarrival extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Auth_model');
    }
    
    public function thc_arrival()
    {
        $searchType = $this->input->get('searchby');
        $searchValue = $this->input->get('THCNO');
        $d1 = $this->input->get('d1');
        $d2 = $this->input->get('d2');

        $this->load->model('Auth_model');
        $data['results'] = $this->Auth_model->getTHCResults($searchType, $searchValue, $d1, $d2);

        $data['total_records'] = $this->Auth_model->countTHCResults($searchType, $searchValue, $d1, $d2);

        $data['user'] = $this->Auth_model->user_data($this->session->userdata('user_id'));

        $this->load->view('frontend/thcarrival', $data);
    }

    public function getLRDetail() {
        $this->load->model('Auth_model');
        $data['user'] = $this->Auth_model->user_data($this->session->userdata('user_id'));

        $LRNO = $this->input->get('searchbyLR');

        $results = $this->Auth_model->searchByLRNO($LRNO);

        $data['results'] = $results;
        $this->load->view('frontend/getlrdetails', $data);
    }



    public function thcarrivalupdate()
    {
       $thcno = $this->input->get('THCNO');

       $data['user'] = $this->Auth_model->user_data($this->session->userdata('user_id'));

       $this->load->model('Auth_model');
       $thcDetails = $this->Auth_model->getTHCDetails($thcno);
       $data['thcDetails'] = $thcDetails;
       $this->load->view('frontend/thcupdate', $data);
   }

   public function UPADTETHC() {
    $thcno = $this->input->post('THCNO');
    $LRNO = $this->input->post('LRNO');
    $UpdatedQty = $this->input->post('received_qty');
    $Reason = $this->input->post('Reason');

    $user = $this->db->query("SELECT `EmpName`,`UserName`,`Designation`,`Depot` FROM employee WHERE EmpID = " . $this->session->userdata('user_id'));
    $user_data = $user->row();
    $EmpName = $user_data->EmpName;

    $data = array(
        "Reason" => $Reason,
        "CreatedBy" => $EmpName,
        "ClosingKM" => $this->input->post('closingkm'),
        "ArrivalDate" => $this->input->post('arrivaldate'),
        "THCArrivalHvendor" => $this->input->post('THCArrivalHvendor'),
        "Hamali" => $this->input->post('HHamali'),
        "FinalHamali" => $this->input->post('UnloadingHamali'),
        "paymentschedule" => $this->input->post('Paymenttype'),
        "TransactionID" => $this->input->post('Referenceid'),
        "OverLoadingCharge" => $this->input->post('laodingtype'),
    );

    $this->db->where('THCNO', $thcno);
    $this->db->update('thc', $data);

    $data1 = array(
        "Reason" => $Reason,
        "UpdatedQty" => $UpdatedQty,
    );
    $this->db->where('THCNO', $thcno);
    $this->db->update('lrthcdetails', $data1);

    if (is_array($LRNO)) {
        foreach ($LRNO as $lrno) {
            $datanew = array(
                "DRS_THCNO" => $thcno,
                "ArriveQty" => $UpdatedQty,
            );

            $this->db->where('LRNO', $lrno);
            $this->db->update('lr', $datanew);
        }
    } else {
    }
    $response = array('msg' => 'THC ARRIVAL created successfully', "status" => true, 'DRS_THCNO' => $thcno);
    echo json_encode($response);
    return;
}



public function getLRcancel() {
    $LRNO = $this->input->post('LRNO'); 
    $CancelReason = $this->input->post('LRReason');
    $LRDetails = $this->Auth_model->getLR($LRNO);
    $user = $this->db->query("SELECT `EmpName`,`UserName`,`Designation`,`Depot` FROM employee WHERE EmpID = " . $this->session->userdata('user_id'));
    $user_data = $user->row();
    $UserName = $user_data->UserName;

    $data = array(
        "CancelReason" => $CancelReason,
        "CancelUser" => $UserName,
    );

    $this->db->where('LRNO', $LRNO); 
    $this->db->update('lr', $data);
}



public function search() {

   $this->load->model('Auth_model');

   $thcNo = $this->input->get('searchby');

   $results = $this->Auth_model->searchByTHCNo($thcNo);

   $data = array(
    'results' => $results
);
   $data['user'] = $this->Auth_model->user_data($this->session->userdata('user_id'));

   $this->load->view('frontend/thc_cancel',$data);
}

public function search1() {

   $data['user'] = $this->Auth_model->user_data($this->session->userdata('user_id'));
   $this->load->model('Auth_model');

   $DRSNO = $this->input->get('searchby1');
   $results = $this->Auth_model->searchByDRSNo($DRSNO);

   $data = array(
    'results' => $results
);
   $data['user'] = $this->Auth_model->user_data($this->session->userdata('user_id'));

   $this->load->view('frontend/drs_cancel',$data);
}


public function search4() {

   $data['user'] = $this->Auth_model->user_data($this->session->userdata('user_id'));
   $this->load->model('Auth_model');

   $LRNO = $this->input->get('searchbyLR');

   $results = $this->Auth_model->searchByLR($LRNO);

   $data = array(
    'results' => $results
);
   $data['user'] = $this->Auth_model->user_data($this->session->userdata('user_id'));

   $this->load->view('frontend/getlrdetails',$data);
}


public function search2() {
   $this->load->model('Auth_model');
   $DRSNO = $this->input->get('searchby1');
   $results = $this->Auth_model->searchByDRSNo($DRSNO);
   $data = array(
    'results' => $results,
);
   $data['user'] = $this->Auth_model->user_data($this->session->userdata('user_id'));

   $this->load->view('frontend/verify_POD',$data);
}


public function search3() {
    $this->load->model('Auth_model');
    $thcNo = $this->input->get('searchby');
    $query = $this->db->select('lr.id, lr.LRNO, lr.LRDate, lr.LRDT, lr.ArriveDate, lr.FromPlace, lr.ToPlace, lr.PayBasis, lr.Consignor, lr.Consignee, lr.ConsigneeMar, lr.PkgsNo, lr.ActualWeight, lr.DocketTotal, lr.FRTRate, lr.Status, lr.InvoiceNo, lr.Origin, lr.CoastCenter, lr.Destination, lr.CurrentLocation, lr.NextLocation, lr.BookingType, lr.ConsignorId, lr.ConsigneeId, lr.FRTType, lr.DRS_THCNO, lr.ArriveQty, lr.CancelReason, lr.CancelDate, lr.CancelUser, lr.MOT, lr.ServiceType, lr.PickupDelType, lr.ConsigneeAdd, lr.ConsigneeAddMar, lr.ConsigneeMob, lr.DocCharge, lr.Hamali, lr.OtherCharge, lr.DoordelCharge, lr.ExcesswtCharge, lr.CSGSTRate, lr.CSGSTAmount, lr.CreatedBy, lr.FreightCharge, lr.BillingParty, lr.ConsignorAdd, lr.ConsignorMob, lr.EDD, lr.EWBNo, lr.EWBDate, lr.DeliveredQty, lr.Billgenerate, lr.DeliveryDate, lr.ReturnLR, lr.ManualLRNO, lr.LRedituser, lr.StatementNos, lr.LRHamalis, lr.Paidtype, lr.CPvaluesearch, lr.LSNO, lr.ManifestNo, lr.perbox ,lrthcdetails.Qty')
    ->from('lrthcdetails')
    ->join('lr', 'lrthcdetails.LRNO = lr.LRNO', 'left')
    ->where('lrthcdetails.THCNO', $thcNo)
    ->get();


    $thcNoData = $query->result();
    $results = $this->Auth_model->searchByTHCNo($thcNo);

    $data = array(
        'thcNoData' => $thcNoData,
        'results' => $results,
        'user' => $this->Auth_model->user_data($this->session->userdata('user_id'))
    );

    $this->load->view('frontend/verify_THC', $data);
}


public function drscancel() {
    $DRSNO = $_POST['DRSNO'];
    $LRNO = $this->input->get('LRNO');
    $CancelReason = $this->input->post('cancelreason');
    $CancelDT = $this->input->post('drsdate');
    $thcDetails = $this->Auth_model->getDRSDetails($drsno);
    $user = $this->db->query("SELECT `EmpName`,`UserName`,`Designation`,`Depot` FROM employee WHERE EmpID = " . $this->session->userdata('user_id'));
    $user_data = $user->row();
    $UserName = $user_data->UserName;
    $EmpName = $user_data->EmpName;

    $data = array(
        "CancelReason" => $CancelReason,
        "Canceluser" => $UserName,
        "CancelDT" => $CancelDT, 
        "CreatedBy" => $EmpName, 
    );
    $this->db->where('DRSNO', $DRSNO);
    $this->db->update('vtcpod1', $data);

}

public function lrcancel() {
    $LRNO = $_POST['LRNO'];
    $CancelReason = $this->input->post('LRreason');
    $CancelDate = $this->input->post('LRDate');
    $LRDetails = $this->Auth_model->getLRDetails($LRNO);
    $user = $this->db->query("SELECT `EmpName`,`UserName`,`Designation`,`Depot` FROM employee WHERE EmpID = " . $this->session->userdata('user_id'));
    $user_data = $user->row();
    $UserName = $user_data->UserName;
    $EmpName = $user_data->EmpName;

    $data = array(
        "CancelReason" => $CancelReason,
        "Canceluser" => $UserName,
        "CancelDate" => $CancelDate, 
        "CreatedBy" => $EmpName, 
        "status"=>2,
    );
    
    $this->db->where('LRNO', $LRNO);
    $this->db->update('lr', $data);
}

public function thccancel() {
    $THCNO = $_POST['THCNO'];
    $thccancel = $this->input->post('thccancel');
    $CancelDT = $this->input->post('drsdate');
    $thcDetails = $this->Auth_model->getTHCDetails($THCNO);
    $user = $this->db->query("SELECT `EmpName`,`UserName`,`Designation`,`Depot` FROM employee WHERE EmpID = " . $this->session->userdata('user_id'));
    $user_data = $user->row();
    $UserName = $user_data->UserName;

    $data = array(
        "CancelReason" => $thccancel,
        "Canceluser" => $UserName,
        "CancelDT" => $CancelDT, 
    );
    $this->db->where('THCNO', $THCNO);
    $this->db->update('thc', $data);
}


public function sendotpthc()
{
    $mobile = $this->input->post('mobileno');

    if (strlen($mobile) != 10) {
        echo 'Invalid mobile number.';
        return;
    }

    $url = 'http://mobicomm.dove-sms.com/submitsms.jsp';
    $otp = mt_rand(100000, 999999);
    $message = "Your OTP for mobile verification is $otp. VTC3PL SERVICES PVT LTD";

    $params = array(
        'user' => 'Harsal',
        'key' => '97e1eb345dXX',
        'mobile' => $mobile,
        'message' => $message,
        'senderid' => 'VTCSMS',
        'accusage' => '1',
        'entityid' => '1701158047394329108',
        'tempid' => '1707165909710698116'
    );

    $url .= '?' . http_build_query($params);

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Cookie: JSESSIONID=6B13F25616545945D3811214693CE962'
        ),
    ));

    $response = curl_exec($curl);

    if (curl_errno($curl)) {
        echo 'Error: ' . curl_error($curl);
    } else {
        echo 'Success.';
    }

    curl_close($curl);
}

public function verify_otpthc() {
    $otp = $this->input->post('otp');
    $storedOTP = $this->session->userdata('otp');

    if (strlen($otp) !== 6 || !ctype_digit($otp)) {
      echo "Please enter a valid 6-digit numeric OTP.";
      return;
  }

  if ($otp === $storedOTP) {
      echo "Success.";
  } else {
      echo "Error. Invalid OTP entered.";
  }
}

public function hamali_data()
{
    $this->load->database();
    $keyword = $this->input->get('keyword'); 
    $this->db->like('Hvendor', $keyword); 
    $hamalidata = $this->db->get('hamalivendor');
    $result = $hamalidata->result_array();
    $this->output->set_content_type('application/json')->set_output(json_encode($result));
}

public function str_LRNO()
{
    $keyword = $this->input->get('keyword');
    $this->load->model('Auth_model');

    $results = $this->Auth_model->LRNO($keyword);

    $html = '';
    foreach ($results as $LR) {
        $html .= '<option>'.$LR->LRNO.'</option>';
    }

    echo $html;
}


public function getlrdataJUNETHC()
{

 if (!isset($_POST['LRNO'])) {
    $response = [
        'success' => false,
        'message' => 'LRNO not provided in POST data',
    ];

    $this->output
    ->set_content_type('application/json')
    ->set_output(json_encode($response));
    return; 
}

$str_lr_no = $_POST['LRNO'];
$this->db->select(' lr.id,lr.LRNO,lr.LRDate,lr.LRDT,lr.ArriveDate,lr.FromPlace,lr.ToPlace,lr.PayBasis,lr.Consignor,lr.Consignee, 
    lr.ConsigneeMar,lr.PkgsNo,lr.ActualWeight,lr.DocketTotal,lr.FRTRate,lr.Status,lr.InvoiceNo, lr.Origin, 
    lr.CoastCenter, lr.Destination,lr.CurrentLocation, lr.NextLocation,lr.BookingType,lr.ConsignorId, 
    lr.ConsigneeId, lr.FRTType, lr.DRS_THCNO, lr.ArriveQty,lr.CancelReason,lr.CancelDate,lr.CancelUser, 
    lr.MOT,lr.ServiceType,lr.PickupDelType,lr.ConsigneeAdd, lr.ConsigneeAddMar,lr.ConsigneeMob, 
    lr.DocCharge,lr.Hamali, lr.OtherCharge,lr.DoordelCharge, lr.ExcesswtCharge, lr.CSGSTRate,lr.CSGSTAmount, 
    lr.CreatedBy, lr.FreightCharge, lr.BillingParty,lr.ConsignorAdd,  lr.ConsignorMob, lr.EDD,lr.EWBNo, 
    lr.EWBDate, lr.DeliveredQty,lr.Billgenerate,lr.DeliveryDate,lr.ReturnLR,lr.ManualLRNO,lr.LRedituser, 
    lr.StatementNos, lr.LRHamalis,lr.Paidtype, lr.CPvaluesearch,lr.LSNO, lr.ManifestNo,lr.perbox');
$this->db->from('lr');
$this->db->where('lr.LRNO', $str_lr_no); 

$query = $this->db->get();

if ($query->num_rows() > 0) {
    $lr_data = $query->row_array();

    $response = [
        'success' => true,
        'data' => $lr_data,
    ];
} else {
    $response = [
        'success' => false,
        'message' => 'LR No. Not Found'
    ];
}

$this->output
->set_content_type('application/json')
->set_output(json_encode($response));
}

public function Attendence(){
 $this->load->model('Auth_model');
 $data['body'] = 'frontend/attendence';
 $data['meta'] = array('title'=>'HOME |NSLINDIA','page_title'=>'cpadd_contract');
 $this->load->view('frontend/frontend-template', $data);
}


public function photoupload(){
 $this->load->model('Auth_model');
 $data['user']=$this->Auth_model->user_data($this->session->userdata('user_id'));
 $data['body'] = 'frontend/uploadImage';
 $data['meta'] = array('title'=>'HOME |NSLINDIA','page_title'=>'cpadd_contract');
 $this->load->view('frontend/frontend-template', $data);
}

public function save_photo() {

    // if ($this->input->is_ajax_request()) {
  $photoData = $this->input->post('photo');


  $data = array(
    'photos' => $photoData,
);

  $inserted = $this->db->insert('APPattendance', $data);

    //   $response = array(
    //     'success' => $inserted
    // );

//       header('Content-Type: application/json');
//       echo json_encode($response);
//   } else {
//     show_404();
// }
}

}

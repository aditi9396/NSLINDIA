<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Autocomplete extends CI_Controller {

    function __construct() 

    {
        parent::__construct();
        
    }

    public function createlr(){
        $this->load->model('Auth_model');
        $data['user']=$this->Auth_model->user_data($this->session->userdata('user_id'));
        $data['header'] = 'frontend/header';
        $data['sidebar'] = 'frontend/sidebar';
        $data['body']='frontend/createlr';
        $data['meta'] = array('title'=>'HOME |NSLINDIA','page_title'=>'cpcontractmaster');
        $this->load->view('frontend/backend_template', $data);
    }


    public function searchcustomers()
    {
        $keyword = $this->input->get('keyword');
        $user = $this->db->query("SELECT `EmpName`,`UserName`,`Designation`,`Depot` FROM employee WHERE EmpID = " . $this->session->userdata('user_id'));
        $user_data = $user->row();
        $Depot = $user_data->Depot;
        $this->load->model('Transport_model');
        $results = $this->Transport_model->customers($keyword, $Depot);
        
        foreach ($results as $customer) {
            $customer->Category = str_replace('PAID,', '', $customer->Category);
        }


        $data = array();
        foreach ($results as $customers) {
            $optioncode = $customers->CustCode;
            $optionText = $customers->CustName;
            $optionText2 = $customers->Category;
            $data[] = array(
                'label' => $optioncode,
                'value' => $optionText,
                'value2' => $optionText2,
            );
        }
        $this->output->set_content_type('application/json');
        echo json_encode($data);

    }

    public function SimpleLR()
    {
        $LRDate = $this->input->post('lrdatedd');
        $LRDT= $this->input->post('lrdatedd');
        $FromPlace = $this->input->post('FromPlace');
        $invoiceno = $this->input->post('invoiceno');
        $EDD = $this->input->post('lrdatedd');
        $InvDate = $this->input->post('invdate');
        $ProductType = $this->input->post('product');
        $declval = $this->input->post('declval');
        $PkgsNo = $this->input->post('pkgno');
        $actwtperpkg = $this->input->post('actwtperpkg');
        $actwt = $this->input->post('actwt');
        $actwtperpkg_w = $this->input->post('actwtperpkg_w');
        $actwt_w = $this->input->post('actwt_w');
        $Exwtchrgs = $this->input->post('Exwtchrgs');
        $tdeclval = $this->input->post('tdeclval');
        $tpkgno = $this->input->post('tpkgno');
        $tactwt = $this->input->post('tactwt');
        $actwttotal = $this->input->post('actwttotal');
        $DocketTotal = $this->input->post('grandtotal');
        $FRTRate = $this->input->post('freightotal');
        $Status = $this->input->post('Status');
        $Origin = $this->input->post('Origin');
        $CoastCenter = $this->input->post('CoastCenter');
        $Destination = $this->input->post('Destination');
        $CurrentLocation = $this->input->post('CurrentLocation');
        $NextLocation = $this->input->post('NextLocation');
        $BookingType = $this->input->post('BookingType');
        $FRTType = $this->input->post('FRTType');
        $DRS_THCNO = $this->input->post('DRS_THCNO');
        $ArriveQty = $this->input->post('ArriveQty');
        $CancelReason = $this->input->post('CancelReason');
        $CancelDate = $this->input->post('CancelDate');
        $CancelUser = $this->input->post('CancelUser');
        $MOT = $this->input->post('MOT');
        $ServiceType = $this->input->post('ServiceType');
        $ActualWeight = $this->input->post('actwtperpkg_w');
        $DoordelCharge = $this->input->post('DoordelCharge');
        $ExcesswtCharge = $this->input->post('ExcesswtCharge');
        $CSGSTRate = $this->input->post('CSGSTRate');
        $CSGSTAmount = $this->input->post('csgst');
        $PayBasis = $this->input->post('pt'); 
        $ToPlace = $this->input->post('dt');
        $Hamali = $this->input->post('hamalicharge');
        $DocCharge = $this->input->post('doccharge');
        $OtherCharge = $this->input->post('othercharge');
        $FreightCharge = $this->input->post('freightotal');
        $FRTType = $this->input->post('freighttype');
        $PkgType = $this->input->post('pkg');
        $EWBNo = $this->input->post('EWBNOS');
        $Consignee = $this->input->post('WIConsignee');
        $Consignor = $this->input->post('FMConsignor');
        $ConsigneeMar = $this->input->post('WIConsignee');
        $ConsignorId = $this->input->post('FMConsignor');
        $ConsigneeAdd = $this->input->post('WIConsigneeadd');
        $ConsigneeAddMar = $this->input->post('WIConsigneeadd');
        $ConsigneeMob = $this->input->post('WIConsigneemob');
        $ConsignorAdd = $this->input->post('WIConsignoradd'); 
        $ConsignorMob = $this->input->post('WIConsignormob');

        $user = $this->db->query("SELECT `EmpName`,`UserName`,`Designation`,`Depot` FROM employee WHERE EmpID = " . $this->session->userdata('user_id'));
        $user_data = $user->row();
        $Depot = $user_data->Depot;
        $EmpName = $user_data->EmpName;

        $query = $this->db->query("SELECT `CustCode`, `CustName`, `Address`, `MobileNo` FROM Customers WHERE CustCode = ?", array($Consignor));

        $data['customerparty'] = $query->result_array();


        $coastcenterCode = "";
        if ($PayBasis == "TO PAY") {
            $coastcenterCode = "CCPTOP01";
        } elseif($PayBasis == "PAID"){
            $coastcenterCode = "CCPPAI01";
        }

        $ConsignorAdd = "";
        $ConsignorMob = "";
        $ConsignorId = "";
        $ConsigneeId = "";

        if ($PayBasis == "TO PAY" || $PayBasis == "PAID") {
            $Consignor = $this->input->post('FMConsignor');
            $ConsignorAdd = $this->input->post('WIConsignoradd');
            $ConsignorMob = $this->input->post('WIConsignormob');
            $ConsignorId=8888;
            $ConsigneeId=8888;
        } elseif ($PayBasis == "TBB") {
            $query = $this->db->query("SELECT `CustCode`,`CostCenter`, `CustName`, `Address`, `MobileNo` FROM Customers WHERE CustCode = ?", array($Consignor));
            $result = $query->row();

            if ($result) {
                $ConsignorAdd = $result->Address;
                $ConsignorMob = $result->MobileNo;
                $coastcenterCode=$result->CostCenter;
                $ConsignorId=$result->CustCode;
                $ConsigneeId=8888;
                $Consignor=$result->CustName;

            } else {
                $ConsignorAdd = "Address not found";
                $ConsignorMob = "MobileNo not found";
                $coastcenterCode = "Default Value";
                $ConsignorId = "Default Value";
                $ConsigneeId = "Default Value or Error Message";
                $Consignor = "Default Value or Error Message";
            }
        }


        $data1 = array(
            "PayBasis"=>$PayBasis,
            "ConsignorId" => $ConsignorId,
            "ConsigneeId" => $ConsigneeId,
            "ConsignorAdd"=>$ConsignorAdd,
            "CoastCenter" => $coastcenterCode,
            "ConsigneeMar" => $ConsigneeMar,
            "FromPlace" => $Depot,
            "LRDate" => $LRDate,
            "LRDT" => $LRDT,
            "EDD" => $EDD,
            "PkgsNo" => $PkgsNo[0],
            "ActualWeight" => $ActualWeight[0],
            "FRTType" => $FRTType[0],
            "InvoiceNo" => $invoiceno[0],
            "Destination" => $Depot,
            "DocketTotal" => $DocketTotal,
            "Hamali" => $Hamali,
            "DocCharge" => $DocCharge,
            "OtherCharge" => $OtherCharge,
            "FreightCharge" => $FreightCharge,
            "FRTType" => $FRTType,
            "ToPlace" => $ToPlace,
            "FRTRate"=>$FRTRate,
            "Status"=>1,
            "Origin"=>$Depot,
            "CurrentLocation"=>$Depot,
            "CreatedBy"=>$EmpName,
            // "CSGSTAmount"=>$CSGSTAmount,
            // "EWBNo" => $EWBNo,
            "Consignee" => $Consignee,
            "Consignor" => $Consignor,
            "ConsigneeAdd" => $ConsigneeAdd,
            "ConsigneeAddMar" => $ConsigneeAddMar,
            "ConsigneeMob" => $ConsigneeMob,
            "ConsignorMob"=>$ConsignorMob,
        );

        $this->db->insert('lr', $data1);
        $insert_id = $this->db->insert_id();
        $user_id = $this->session->userdata('user_id');
        $user_query = $this->db->query("SELECT `EmpName`, `UserName`, `Designation`, `Depot` FROM employee WHERE EmpID = $user_id");
        $user_data = $user_query->row();
        $depot = $user_data->Depot;
        $Origin = $depot; 
        $this->db->select_max('LRNO', 'max_lr');
        $this->db->where('Origin', $Origin);
        $query = $this->db->get('lr');
        $row = $query->row();

        if ($row->max_lr) {
            $next_lr = $Origin . sprintf("%010d", intval(substr($row->max_lr, strlen($Origin))) + 1);
        } else {
         $next_lr = $Origin . "%010d";

     }


     $data2 = array(
        "LRNO" => $next_lr,
    );

     $this->db->where('id', $insert_id);
     $this->db->update('lr', $data2);


     for ($i = 0; $i < count($invoiceno); $i++) {

        $data = array(
            "LRNO" => $next_lr,
            "PkgType"=>$PkgType,
            "InvDate" => $InvDate,
            "InvoiceNo" => $invoiceno[$i],
            "ProductType" => $ProductType,
            "Invoicevalue" => $declval[$i],
            "PkgsNo" => $PkgsNo[$i],
            "ActwtperPkg" => $actwtperpkg_w[$i],
            "ActualWeight" => $actwt_w[$i],
            "ExcessRate" => $Exwtchrgs[$i],
        );
        $this->db->insert('lrdetails', $data);
    }
    $dataewbill =array(
        "LRNO" => $next_lr,
        "EWBNo" => $EWBNo,
    );

    $this->db->insert('ewbill', $dataewbill);

    if ($this->db->affected_rows() > 0) {
        $query = $this->db->get('lrdetails');
        $output = $query->result();
        $response = array('msg' => 'LR Generated Successfully', "status" => true, 'lr_no' => $next_lr);
    } else {
        $response = array('err' => 'LR Not Generated Successfully', "status" => false);
    }

    echo json_encode($response);
    return;
}
public function fetch_contract() {
    if ($this->input->method() == 'post') {
        $ConsignorID = $this->input->post('ConID');
        $LRDate = date('Y-m-d');
        $PayType = $this->input->post('PayType');

        $sql = "SELECT `id`, `ContractID`, `StartDate`, `EndDate`, `ContractType`, `Status`, `ConsignorID`, `ConsignorName`, `PkgsTYPE` FROM `contract` WHERE `ContractID` = ? LIMIT 1";

        $query = $this->db->query($sql, array($ConsignorID));

        if ($query->num_rows() > 0) {
            $contract_data = $query->row_array();
            $contractEndDate = $contract_data['EndDate'];

            if ($contractEndDate < $LRDate) {
                $response = array(
                    'message' => 'Contract Update Required',
                    'data' => $contract_data
                );
            } else {
                $response = array(
                    'message' => 'Success',
                    'data' => $contract_data
                );
            }
        } else {
            $response = array('message' => 'Contract Not Exist');
        }
    } else {
        $response = array('message' => 'Invalid request method');
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}
public function fetch_data() {
    $conID = $this->input->post('ConID');
    $ContractID = $this->input->post('ConID');
    $payType = $this->input->post('paytype');
    $Qty = $this->input->post('pkgno'); 
    $ToPlace = $this->input->post('ToPlace'); 

    $data = $this->fetchDataFromModel($conID);
    $data1 = $this->fetchdatafrommodelnew($ContractID);
    $this->output
    ->set_content_type('application/json')
    ->set_output(json_encode(['data' => $data, 'data1' => $data1]));
}

private function fetchdatafrommodelnew($ContractID)
{
   $query1= "SELECT `id`, `ContractID`, `ConsignorCode`, `ConsignorName`, `ContractType`, `Product`, `ServiceType`, `RateTypesAllowed`, `MatricesAllowed`, `PickupDelivery`, `FreightDiscountAllowed`, `DiscountRate`, `DiscountRateType`, `Discount`, `DeliveryReattempt`, `DeliveryReattemptRate`, `ExcessWeight`, `DemuBillGen`, `DemuBillGenType`, `FreeStorageDays`, `MinDemuCharge`, `DemurrageRate`, `DemurrageRateType`, `MaxDemuCharge`, `FuelSurcharges`, `OctroiSurcharges`, `SKUWise`, `TaxPayer`, `DocumentCharges`, `Doordeliverycharge`, `SlabRangeType` FROM `serviceselection` WHERE `ContractID` = ?";
   $result1 = $this->db->query($query1, array($ContractID));
   $data1 = $result1->result_array();
   return $data1; 
}

private function fetchDataFromModel($conID) {
    $query = "SELECT `Id`, `ContractID`, `CustCode`, `CustName`, `FromPlace`, `ToPlace`, `TransitDay`, `Slab1`, `Slab2`, `Slab3`, `Slab4`, `Slab5`, `Slab6`, `Slab7`, `Slab8`, `Zone` 
    FROM `ltlslab` 
    WHERE `ContractID` = ?";
    $result = $this->db->query($query, array($conID));
    $data = $result->result_array();

    return $data; 
}


public function step2click() {
    if ($this->input->is_ajax_request()) {
        $cityexist = false;
        $fromcity = $this->input->get('fromcity');
        $response = $this->checkCity($fromcity);
        if ($response == "Success") {
            $cityexist = true;
        }

        if (!$cityexist) {
            $response = array('error' => 'From City is not in City Master.');
            echo json_encode($response);
            return;
        }

        $cityexist = false;
        $tocity = $this->input->get('tocity');
        $response = $this->checkCity($tocity);
        if ($response == "Success") {
            $cityexist = true;
        }

        if (!$cityexist) {
            $response = array('error' => 'To City is not in City Master.');
            echo json_encode($response);
            return;
        }
    } else {
    }
}


public function checkCity() {
    $this->load->model('Transport_model');
    $searchTerm = $this->input->get('term'); 
    $result = $this->Transport_model->checkCityExists($searchTerm);
    if($result) {
        echo "Success";
    } else {
        echo "Failed";
    }
}

}

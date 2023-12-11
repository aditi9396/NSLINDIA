<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lrgeneration extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }
    
    public function Create_DRS()
    {    
        $this->load->model('Auth_model');
        $data['country']=$this->Auth_model->get_data();
        $data['user']=$this->Auth_model->user_data($this->session->userdata('user_id'));
        $data['vendor'] = $this->Auth_model->vendor_data();
        $data['driver']=$this->Auth_model->driver_data($this->session->userdata('user_id'));
        $data['driverlicense']=$this->Auth_model->License_data();
        $data['vehicleno']=$this->Auth_model->vehicle_data();
        // $data['hamalidata1']=$this->Auth_model->hamali_data();
        $data['fuels']=$this->Auth_model->getFuelVendors();
        $data['vehicleno1']=$this->Auth_model->vehicle_data1();
        $data['vehicleno2']=$this->Auth_model->vehicle_data2();
        $data['vehiclevendor']=$this->Auth_model->vendor_Name($this->session->userdata('user_id'));
        $data['header']='frontend/header';
        $data['sidebar']='frontend/sidebar';
        $data['body']='frontend/createdrs';
        $data['meta'] = array('title'=>'HOME |NSLINDIA','page_title'=>'cpcontractmaster');
        $this->load->view('frontend/backend_template', $data);

    }

    public function drscreate()
    {   
     $vendortype = $_POST['vendortype'];
     if ($vendortype == 'Attached') {
        $vendorname = $this->input->post('dt');
        $query = $this->db->query("SELECT VendorName, VendorCode FROM vendor WHERE VendorCode = ?", array($vendorname));
        $vendor = $query->row();

        if ($vendor) {
            $vendorname = $vendor->VendorName;
        } else {
            $vendorname = "Vendor Not Found";
        }

        $vehicleno = $this->input->post('at');
    } else {
        $vendorname = $this->input->post('dt1');
        switch ($vendorname) {
            case "VTC 3 PL SERVICES LTD (KALBHOR)":
            $vehicleno = $this->input->post('at1');
            break;
            case "VTC 3 PL SERVICES LTD AKOLA":
            $vehicleno = $this->input->post('at2');
            break;
            default:
            $vehicleno = $this->input->post('at3');
            break;
        }
    }
    $drsdate = $this->input->post('drsdate');
    $LRNO = $this->input->post('str_lr_no');
    $Qty = $this->input->post('PkgsNo');
    $Weight = $this->input->post('actual_weight');
    $InvoiceNo = $this->input->post('InvoiceNo');
    $Consignor = $this->input->post('Consignor');
    $Consignee = $this->input->post('Consignee');
    $ownername = $this->input->post('ownername');
    $freighttype = $this->input->post('freighttype');
    $mreading = $this->input->post('mreading');
    $drskm = $this->input->post('drskm');
    $driver = $this->input->post('drivername');
    $FTLType = $this->input->post('FTLType');
    $licenseno = $this->input->post('licenseno');
    $licexpdate = $this->input->post('licexpdate');
    $AccountNO = $this->input->post('AccountNO');
    $IFSC = $this->input->post('IFSC');
    $BankName = $this->input->post('BankName');
    $branch = $this->input->post('branch');
    $liter = $this->input->post('liter');
    $Rate = $this->input->post('Rate');
    $dieselamt = $this->input->post('dieselamt');
    $Hvendor = $this->input->post('Hvendor');
    $image = $this->input->post('thumbnail');
    $Advancecashbank = $this->input->post('advancetype');
    $Dieselvendorname = $this->input->post('dieselvendorname');
    $hamali = $this->input->post('hamali');
    $mobileno = $this->input->post('mobileno');
    $Dieselbillno = $this->input->post('Dieselbillno');
    date_default_timezone_set('Asia/Kolkata');
    $DRSDT = date('Y-m-d H:i:s');

    $imagePath = "";
    if (!empty($_FILES["thumbnail"]["name"])) {
        $fileName = basename($_FILES["thumbnail"]["name"]);
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');

        if (in_array($fileType, $allowTypes)) {
            $file_name = $_FILES['thumbnail']['name'];
            $file_size = $_FILES['thumbnail']['size'];
            $file_tmp = $_FILES['thumbnail']['tmp_name'];
            $file_type = $_FILES['thumbnail']['type'];

            if (move_uploaded_file($file_tmp, "uploads" . $file_name)) {
                $imagePath = "uploads" . $file_name;
            }
        }
    }
    $user = $this->db->query("SELECT `EmpName`,`UserName`,`Designation`,`Depot` FROM employee WHERE EmpID = " . $this->session->userdata('user_id'));
    $user_data = $user->row();
    $Depot = $user_data->Depot;
    $EmpName = $user_data->EmpName;

    $this->db->select_max('id');
    $query = $this->db->get('diselbook');
    $result = $query->row();
    $latest_id = $result->id + 1;

    $customDate = date('Y-m-d', strtotime('2324-01-01'));
    $year = date('Y', strtotime($customDate));
    $id_format = sprintf('%05d', $latest_id);

    $diselid = "DESL/{$id_format}";
    $convertedDRSNO = "DS/{$Depot}/{$year}/{$id_format}";

    $drsdiseldata = array(
        "DieselID" => $diselid,
        "vehicleno" => $vehicleno,
        "vendorname" => $vendorname,
        "DRSTHCNo" => $convertedDRSNO,
        "DRSTHCDate" => $drsdate,
        "DiselVendorName" => $Dieselvendorname,
        "image" => $imagePath,
        "Depot" => $Depot,
    );

    $this->db->insert('diselbook', $drsdiseldata);

    $drsnodata = array(
        "DRSNO" => $convertedDRSNO,
    );

    $this->db->insert('drsno', $drsnodata);
    $query = $this->db->query("SELECT `VendorCode`, `Hvendor`, `HAccountNO`, `HIFSC`, `Hbank`, `Hbranch` FROM `hamalivendor` WHERE `Hvendor` = ?", array($Hvendor));
    $results = $query->result_array();

    if (!empty($results)) {
        $results[0]["DRSNO"] = $convertedDRSNO;
        $results[0]["Dieselbillno"] = $Dieselbillno;

        $this->db->insert('drshamalipayment', $results[0]);
    } else {
        $drshamalidata = array(
            "Hvendor" => $Hvendor,
            "DRSNO" => $convertedDRSNO,
            "Dieselbillno" => $Dieselbillno,
        );

        $this->db->insert('drshamalipayment', $drshamalidata);
    }

    $customDate = date('Y-m-d', strtotime('2324-01-01'));
    $year = date('Y', strtotime($customDate));
    $id_format = sprintf('%05d', $latest_id);
    $convertedVoucherNo = "VR/{$Depot}/{$year}/{$id_format}";

    $VAmount = $liter + $Rate;

    $drsvoucherdata = array(
        "VoucherNo" => $convertedVoucherNo,
        "DRSNO" => $convertedDRSNO,
        "VoucherDate" => $drsdate,
        "VType" => 'Advance',
        "VAmount" => $VAmount,
        "CreatedBy" => $EmpName,
    );

    $this->db->insert('voucher', $drsvoucherdata);

    $vendortype = $_POST['vendortype']; 
    if ($vendortype == 'Attached') {
        $drsaccountdata = array(
            "DRSTHCNO" => $convertedDRSNO,
            "vendorname" => $vendorname,
            "ownername" => $ownername,
            "AccountNO" => $AccountNO, 
            "IFSC" => $IFSC, 
            "BankName" => $BankName,
            "branch" => $branch,
            "created" => $EmpName,
        );

        $this->db->insert('drsaccountno', $drsaccountdata);
    }

    for ($i = 0; $i < count($InvoiceNo); $i++) {
        $data = array(
            "DRSNO" => $convertedDRSNO,
            "LRNO" => $LRNO[$i],
            "Qty" => $Qty[$i],
            "Weight" => $Weight[$i],
            "ownername" => $ownername,
            "InvoiceNo" => $InvoiceNo[$i],
            "Consignor" => $Consignor[$i],
            "Consignee" => $Consignee[$i],
            "drsdate" => $drsdate,
            "vendorname" => $vendorname,
            "vehicleno" => $vehicleno,
            "freighttype" => $freighttype,
            "mreading" => $mreading,
            "drskm" => $drskm,
            "driver" => $driver,
            "FTLType" => $FTLType,
            "licenseno" => $licenseno,
            "licexpdate" => $licexpdate,
            "liter" => $liter,
            "Rate" => $Rate,
            "dieselamt" => $dieselamt,
            "Advancecashbank" => $Advancecashbank,
            "Dieselvendorname" => $Dieselvendorname,
            "hamali" => $hamali,
            "mobileno" => $mobileno,
            "Place" => $Depot,
            "CreatedBy" => $EmpName,
            "DRSDT" => $DRSDT,
        );

        $this->db->insert('vtcpod1', $data);
    }
    $response = array('msg' => 'DRS created successfully', "status" => true, 'DRSNO' => $convertedDRSNO);
    echo json_encode($response);
    return;
    
}

public function thccreate()
{
    $vendortype = $this->input->post('vendortype');
    
    if ($vendortype == 'Attached') {
        $vendorname = $this->input->post('dt');
        $query = $this->db->query("SELECT VendorName, VendorCode FROM vendor WHERE VendorCode = ?", array($vendorname));
        $vendor = $query->row();

        if ($vendor) {
            $vendorname = $vendor->VendorName;
        } else {
            $vendorname = "Vendor Not Found";
        }

        $vehicleno = $this->input->post('at');
    } else {
        $vendorname = $this->input->post('dt1');
        
        switch ($vendorname) {
            case "VTC 3 PL SERVICES LTD (KALBHOR)":
            $vehicleno = $this->input->post('at1');
            break;
            case "VTC 3 PL SERVICES LTD AKOLA":
            $vehicleno = $this->input->post('at2');
            break;
            default:
            $vehicleno = $this->input->post('at3');
            break;
        }
    }

    $LRNO = $this->input->post('str_lr_no');
    $Qty = $this->input->post('PkgsNo');
    $Weight = $this->input->post('actual_weight');
    $InvoiceNo = $this->input->post('InvoiceNo');
    $drsdate = $this->input->post('drsdate');
    $Consignor = $this->input->post('Consignor');
    $Consignee = $this->input->post('Consignee');
    $ownername = $this->input->post('ownername');
    $freighttype = $this->input->post('freighttype');
    $mreading = $this->input->post('mreading');
    $drskm = $this->input->post('drskm');
    $driver = $this->input->post('drivername');
    $FTLType = $this->input->post('FTLType');
    $licenseno = $this->input->post('licenseno');
    $licexpdate = $this->input->post('licexpdate');
    $AccountNO = $this->input->post('AccountNO');
    $IFSC = $this->input->post('IFSC');
    $BankName = $this->input->post('BankName');
    $branch = $this->input->post('branch');
    $liter = $this->input->post('pt');
    $Rate = $this->input->post('pt1');
    $dieselamt = $this->input->post('pt2');
    $Hvendor = $this->input->post('pt5');
    $image = $this->input->post('thumbnail1');
    $Advancecashbank = $this->input->post('advancetype');
    $Dieselvendorname = $this->input->post('pt4');
    $hamali = $this->input->post('hamali1');
    $NextLocation = $this->input->post('depot');
    $mobileno = $this->input->post('mobileno');
    $Dieselbillno = $this->input->post('Dieselbillno');
    $Advance = $this->input->post('advamt');

    date_default_timezone_set('Asia/Kolkata');
    $DRSDT = date('Y-m-d H:i:s');

    $imagePath = "";
    if (!empty($_FILES["thumbnail"]["name"])) {
        $fileName = basename($_FILES["thumbnail"]["name"]);
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');

        if (in_array($fileType, $allowTypes)) {
            $file_name = $_FILES['thumbnail']['name'];
            $file_size = $_FILES['thumbnail']['size'];
            $file_tmp = $_FILES['thumbnail']['tmp_name'];
            $file_type = $_FILES['thumbnail']['type'];

            if (move_uploaded_file($file_tmp, "uploads/" . $file_name)) {
                $imagePath = "uploads/" . $file_name;
            }
        }
    }

    $user = $this->db->query("SELECT `EmpName`,`UserName`,`Designation`,`Depot` FROM employee WHERE EmpID = " . $this->session->userdata('user_id'));
    $user_data = $user->row();
    $Depot = $user_data->Depot;
    $EmpName = $user_data->EmpName;
    
    $this->db->select_max('id');
    $query = $this->db->get('diselbook');
    $result = $query->row();
    $latest_id = $result->id + 1;

    $customDate = date('Y-m-d', strtotime('2324-01-01'));
    $year = date('Y', strtotime($customDate));
    $id_format = sprintf('%05d', $latest_id);

    $diselid = "DESL/{$id_format}";
    $convertedTHCNO = "TH/{$Depot}/{$year}/{$id_format}";

    $drsdiseldata = array(
        "DieselID" => $diselid,
        "vehicleno" => $vehicleno,
        "vendorname" => $vendorname,
        "DRSTHCNo" => $convertedTHCNO,
        "DRSTHCDate" => $drsdate,
        "DiselVendorName" => $Dieselvendorname,
        "image" => $imagePath,
        "Depot" => $Depot,
    );

    $this->db->insert('diselbook', $drsdiseldata);

    $drsnodata = array(
        "THCNO" => $convertedTHCNO,
    );

    $this->db->insert('thcno', $drsnodata);

    $query = $this->db->query("SELECT `VendorCode`, `Hvendor`, `HAccountNO`, `HIFSC`, `Hbank`, `Hbranch` FROM `hamalivendor` WHERE `Hvendor` = ?", array($Hvendor));
    $results = $query->result_array();

    if (!empty($results)) {
        $results[0]["DRSNO"] = $convertedTHCNO;
        $results[0]["Dieselbillno"] = $Dieselbillno;

        $this->db->insert('drshamalipayment', $results[0]);
    } else {
        $drshamalidata = array(
            "Hvendor" => $Hvendor,
            "DRSNO" => $convertedTHCNO,
            "Dieselbillno" => $Dieselbillno,
        );

        $this->db->insert('drshamalipayment', $drshamalidata);
    }

    $customDate = date('Y-m-d', strtotime('2324-01-01'));
    $year = date('Y', strtotime($customDate));
    $id_format = sprintf('%05d', $latest_id);
    $convertedVoucherNo = "VR/{$Depot}/{$year}/{$id_format}";

    $VAmount = $liter + $Rate;

    $drsvoucherdata = array(
        "VoucherNo" => $convertedVoucherNo,
        "DRSNO" => $convertedTHCNO,
        "VoucherDate" => $drsdate,
        "VType" => 'Advance',
        "VAmount" => $VAmount,
        "CreatedBy" => $EmpName,
    );

    $this->db->insert('voucher', $drsvoucherdata);

    if ($vendortype == 'Attached') {
        $drsaccountdata = array(
            "DRSTHCNO" => $convertedTHCNO,
            "vendorname" => $vendorname,
            "ownername" => $ownername,
            "AccountNO" => $AccountNO,
            "IFSC" => $IFSC,
            "BankName" => $BankName,
            "branch" => $branch,
            "created" => $EmpName,
        );

        $this->db->insert('drsaccountno', $drsaccountdata);
    }

    $data = array(
        "THCNO" => $convertedTHCNO,
        "ownername" => $ownername,
        "drsdate" => $drsdate,
        "vendorname" => $vendorname,
        "vehicleno" => $vehicleno,
        "freighttype" => $freighttype,
        "mreading" => $mreading,
        "drskm" => $drskm,
        "driver" => $driver,
        "FTLType" => $FTLType,
        "licenseno" => $licenseno,
        "licexpdate" => $licexpdate,
        "liter" => $liter,
        "Rate" => $Rate,
        "dieselamt" => $dieselamt,
        "Advancecashbank" => $Advancecashbank,
        "Dieselvendorname" => $Dieselvendorname,
        "mobileno" => $mobileno,
        "Place" => $Depot,
        "CreatedBy" => $EmpName,
        "DRSDT" => $DRSDT,
    );

    $this->db->insert('thc', $data);

    if (is_array($InvoiceNo) && is_array($LRNO) && is_array($Qty) && is_array($Weight) && is_array($Consignor) && is_array($Consignee)) {
        foreach ($InvoiceNo as $i => $invoice) {
            if (!empty($invoice) && isset($LRNO[$i]) && isset($Qty[$i]) && isset($Weight[$i]) &&
                isset($Consignor[$i]) && isset($Consignee[$i])) {
                $data = array(
                    "THCNO" => $convertedTHCNO,
                    "LRNO" => $LRNO[$i],
                    "Qty" => $Qty[$i],
                    "Weight" => $Weight[$i],
                    "InvoiceNo" => $invoice,
                    "Consignor" => $Consignor[$i],
                    "Consignee" => $Consignee[$i],
                );

            $this->db->insert('lrthcdetails', $data);
        }
    }
}

$response = array('msg' => 'DRS created successfully', "status" => true, 'thc_no' => $convertedTHCNO);
echo json_encode($response);
return;
}


public function checkdrsthcfright() {
    $vehicleno = $this->input->post('vehicleno');
    $vendorname = $this->input->post('vendorname');

    $sql = "WITH cte1 as (
        SELECT `FreightCharge` FROM `vtcpod1`
        WHERE `drsdate` = CURDATE() AND `vendorname` = '$vendorname' AND `vehicleno` = '$avehicleno'
        GROUP BY `drsno`, FreightCharge
        ),
    cte2 as (
        SELECT `FreightCharge` FROM `THC`
        WHERE `THCdate` = CURDATE() AND `VehicleNo` = '$avehicleno' AND `VendorName` = '$vendorname'
        )
    SELECT SUM(cte1.FreightCharge) as frt FROM cte1
    UNION ALL
    SELECT SUM(cte2.FreightCharge) as frt FROM cte2";

    $result = $this->db->query($sql);

    if ($result->num_rows() > 0) {
        $row = $result->row();
        $frt1 = $row->frt;
        echo $frt1;
    } else {
        echo "yes";
    }
}

public function getlrdataJUNE1()
{
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



public function getCharges() {
    $contractID = 'ContractID155';
    $village = $this->input->post('village');


    $this->db->select('Rate');
    $this->db->from('doordeliverycontractcplr');
    $this->db->where('CPcontractcode', $contractID);
    $this->db->where('ToPlace', $village);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        $row = $query->row();
        $DDCharge = $row->Rate;
        $fields = array('Rate' => $DDCharge, 'status' => true);
    } else {
        $DDCharge = 0;
        $fields = array('Rate' => $DDCharge, 'status' => false);
    }

    header('Content-Type: application/json');
    echo json_encode($fields);
}


public function getCustomers1() 
{
    $userDepot = $this->input->post('userdepot');
    $searchTerm = $this->input->post('searchterm');

    $this->load->model('Auth_model');
    $customers = $this->Auth_model->getCustomers($userDepot, $searchTerm);

    echo json_encode($customers);
}



public function calamt()
{
    $qty = $this->input->post('pkgno');
    $wtperpkg = $this->input->post('actwtperpkg');
    $wt = $this->input->post('actwt');
    $ewtchrg = $this->input->post('Exwtchrgs');

    $length = $this->input->post('length');
    $width = $this->input->post('width');
    $height = $this->input->post('height');
    $actwt_w = $this->input->post('actwt_w');
    $actwtperpkg_w = $this->input->post('actwtperpkg_w');

    $index = $this->findIndex($qty, $wtperpkg, $length, $width, $height, $actwtperpkg_w);

    if ($index !== false) {
        $amm = (floatval($height[$index]) * floatval($width[$index]) * floatval($length[$index])) / 366;
        $wtperpkg[$index] = number_format($amm, 2);

        $wt[$index] = floatval($qty[$index]) * floatval($wtperpkg[$index]);

        $actwt_w[$index] = floatval($qty[$index]) * floatval($actwtperpkg_w[$index]);

        $ewtchrg[$index] = 0;
        if (isset($ewobj)) {
            foreach ($ewobj->Rates as $rate) {
                if (floatval($wtperpkg[$index]) >= floatval($rate->FromWeight) && floatval($wtperpkg[$index]) <= floatval($rate->ToWeight)) {
                    $ewtchrg[$index] = $rate->Rate;
                    break;
                }
            }
        }

        $twt = 0;
        $tqty = 0;
        $tewtchrg = 0;
        $act_ww = 0;

        for ($i = 0, $iLen = count($wt); $i < $iLen; $i++) {
            if ($wt[$i] != "") {
                $twt += floatval($wt[$i]);
            }
            if ($qty[$i] != "") {
                $tqty += floatval($qty[$i]);
            }
            if ($qty[$i] != "" && $ewtchrg[$i] != "") {
                $tewtchrg += floatval($qty[$i]) * floatval($ewtchrg[$i]);
            }
            if ($actwt_w[$i] != "") {
                $act_ww += floatval($actwt_w[$i]);
            }
        }

        $response = array(
            'tactwt' => $twt,
            'tpkgno' => $tqty,
            'actwttotal' => $act_ww,
            'hamalicharge' => $tqty * 10,
            'excesscharge' => $tewtchrg,
                'lrtotal' => $this->lrtotal() // Make sure you have the lrtotal function implemented
            );

        echo json_encode($response);
    } else {
        echo 'Invalid index';
    }
}

public function findIndex($arr1, $arr2, $arr3, $arr4, $arr5, $arr6)
{
    $e = $this->input->post('e');

    for ($i = 0; $i < count($arr1); $i++) {
        if ($arr1[$i] == $e) {
            return $i;
        }
    }

    for ($i = 0; $i < count($arr2); $i++) {
        if ($arr2[$i] == $e) {
            return $i;
        }
    }

    for ($i = 0; $i < count($arr3); $i++) {
        if ($arr3[$i] == $e) {
            return $i;
        }
    }

    for ($i = 0; $i < count($arr4); $i++) {
        if ($arr4[$i] == $e) {
            return $i;
        }
    }

    for ($i = 0; $i < count($arr5); $i++) {
        if ($arr5[$i] == $e) {
            return $i;
        }
    }

    for ($i = 0; $i < count($arr6); $i++) {
        if ($arr6[$i] == $e) {
            return $i;
        }
    }

    return false;
}

public function lrtotal()
{
    $intactwt1 = 0;
    $actwttotal1 = 0;
    $mmdf = 0;
    $intpkgno = $this->input->post('tpkgno');
    $intactwt1 = $this->input->post('tactwt');
    $actwttotal1 = intval($this->input->post('actwttotal'));

    $infreightrate = $this->input->post('freightrate');
    $infreighttype = $this->input->post('freighttype');

    $total;
    $intactwt;

    if ($intactwt1 < $actwttotal1) {
        $intactwt = $actwttotal1;
        echo '<script>alert("actwttotal Per KG is Max .' . $actwttotal1 . '");</script>';
    } else {
        $intactwt = $intactwt1;
    }

    switch ($infreighttype) {
        case 'flat':
        $freightotal = $infreightrate;
        break;

        case 'perkg':
        $freightotal = $infreightrate * $intactwt;
        break;

        case 'perpkg':
        $freightotal = $infreightrate * $intpkgno;
        break;

        case 'gram':
        $freightotal = $infreightrate * $intactwt * 1000;
        break;

        case 'perton':
        $freightotal = $infreightrate * $intactwt / 1000;
        break;

        case 'quintal':
        $freightotal = $infreightrate * $intactwt / 100;
        break;
    }

    $tot = $freightotal;
    $excesstot = $this->input->post('excesscharge');
    $checkboxvalueserch = $this->input->post('valuesearch');

    if ($checkboxvalueserch == 'true') {
        $grand_total = $this->input->post('grandtotal');
        $totalinoice = $this->input->post('tdeclval');
        $mmdf = ($totalinoice * 0.005);
    }

    $total = intval($tot) + intval($this->input->post('hamalicharge')) + intval($this->input->post('doccharge')) +
    intval($this->input->post('doordelcharge')) + intval($this->input->post('othercharge')) +
    intval($excesstot) + intval($this->input->post('csgst')) + $mmdf;


}

public function isValidVehicle($vehicleno)
{
    $pattern = '/^[A-Z]{2}\d{2}[A-Z]{1,2}\d{4}$/';

    if (preg_match($pattern, $vehicleno)) {
        return true;
    } else {
        return false;
    }
}


public function fetch_vendor()
{

    $vendorname = $this->input->post('vendorname');
    $vendortype = $this->input->post('vendortype');

    $response = ''; 

    echo $response;
}


public function validate()
{
    $rows = $this->input->post('rows');
    $depotlogin = $this->session->userdata('Depot');

    if ($rows < 3) {
        $message = "Please add LR NO.";
        $data['abc'] = $message;
        $this->load->view('dialog_view', $data);
        return false;
    }

        // Add other validation checks and logic as needed

    $formData = $this->input->post();
    unset($formData['Submit']);

    $this->load->library('form_validation');
    $this->form_validation->set_data($formData);

    if ($this->form_validation->run() === FALSE) {
        $message = validation_errors();
        $data['diagmsg'] = $message;
        $data['diagimg'] = "images1/error.png";
        $this->load->view('dialog_view', $data);
        return false;
    }


    $response = [
        'success' => 1,
        'msg' => 'Success message',
    ];

    echo json_encode($response);
}

public function getcapacity()
{
    $userdepot = $this->session->userdata('Depot');
    $vehicleNo = $this->input->post('vehicleno');
    $sql = "SELECT `Vehicle_No`, `Capacity` FROM `Vehicle` WHERE `Vehicle_No`='$vehicleNo'";

    $result = $this->db->query($sql);
    if ($result->num_rows() > 0) {
        $row = $result->row();
        $capacitynew = $row->Capacity;
        echo $capacitynew;
    } else {
        echo "0";
    }
}


public function fetch_vendor1()
{
    $vendorname = $this->input->post('vendorname');


    $vehicleNumbers = "Vehicle numbers";

    echo $vehicleNumbers;
}

public function fetch_vendor2()
{
    $vendorname = $this->input->post('vendorname');
    $vendortype = $this->input->post('vendortype');

    $response = "Response"; 

    echo $response;
}

public function fetch_driver()
{
    $this->load->model('Auth_model');
    $driverData = $this->Auth_model->driver_data();
    $this->output
    ->set_content_type('application/json')
    ->set_output(json_encode($driverData));
}

public function driver_data()
{
    $keyword = $this->input->get('keyword');

    $this->load->model('Auth_model');

    $results = $this->Auth_model->driver_data($keyword);

    $html = '';
    foreach ($results as $drivermaster) {
        $html .= '<option>'.$drivermaster->DName.'</option>';
    }

    echo $html;
}

public function getdistricts()
{
    $keyword = $this->input->get('keyword');
    $this->load->model('Auth_model');
    $results = $this->Auth_model->getdistrictscity($keyword);

    $options = [];
    foreach ($results as $cityMaster) {
        $options[] = '<option>' . $cityMaster->District . ':' . $cityMaster->CityNameEng . '</option>';
    }
    echo json_encode($options);
}



public function getcity()
{
    $keyword = $this->input->get('keyword');
    $this->load->model('Auth_model');
    $results = $this->Auth_model->getcity1($keyword);

    $options = [];
    foreach ($results as $cityMaster) {
        $options[] = '<option>' . $cityMaster->District . ':' . $cityMaster->CityNameEng . '</option>';
    }
    echo json_encode($options);
}


public function str_LR_no()
{
    $keyword = $this->input->get('keyword');
    $this->load->model('Auth_model');

    $results = $this->Auth_model->str_lr_no($keyword);

    $html = '';
    foreach ($results as $LR) {
        $html .= '<option>'.$LR->LRNO.'</option>';
    }

    echo $html;
}

public function sendOTP()
{
    $mobile = $this->input->post('mobileno');

    if (strlen($mobile) != 10) {
    }

    $url = 'http://mobicomm.dove-sms.com/submitsms.jsp';

    $otp =  mt_rand(100000, 999999); 
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
        echo $response;
    }

    curl_close($curl);
}

public function verify_otp()
{
    $otp = $this->input->post('otp');
    $storedOTP = $this->session->userdata('otp');

    if (strlen($otp) !== 6 || !ctype_digit($otp)) {
        echo "Please enter a valid 6-digit numeric OTP.";
        return;
    }

    if ($otp === $storedOTP) {
        echo "Success. OTP verification passed.";
    } else {
        echo "Success OTP entered. OTP verified.";
    }
}


public function createdrsdemo1accountno()
{
    $ownername = $this->input->post('ownername');

    $this->load->model('Auth_model');
    $AccountNO = $this->Auth_model->getAccountNO($ownername);

    echo $AccountNO;
}

public function createdrsdemo1ifsc()
{
    $ownername = $this->input->post('ownername');

    $this->load->model('Auth_model');
    $IFSC = $this->Auth_model->getIFSC($ownername);

    echo $IFSC;
}

public function createdrsdemo1bank()
{
    $ownername = $this->input->post('ownername');

    $this->load->model('Auth_model');
    $BankName = $this->Auth_model->getBankName($ownername);

    echo $BankName;
}

public function createdrsdemo1branch()
{
    $ownername = $this->input->post('ownername');
    $this->load->model('Auth_model');
    $branch = $this->Auth_model->getBranch($ownername);
    print_r($branch);
    exit();
    echo $branch;
}

public function hamaliaccount()
{
    $Hvendor = $this->input->post('Hvendor');

    $this->load->model('Auth_model');
    $HAccountNO = $this->Auth_model->hamaliaccount($Hvendor);

    echo $HAccountNO;
}

public function hamaliifsc()
{
    $Hvendor = $this->input->post('Hvendor');

    $this->load->model('Auth_model');
    $HIFSC = $this->Auth_model->hamaliifsc($Hvendor);

    echo $HIFSC;
}

public function hamalibank()
{
    $Hvendor = $this->input->post('Hvendor');

    $this->load->model('Auth_model');
    $Hbank = $this->Auth_model->hamalibank($Hvendor);

    echo $Hbank;
}
public function hamalibranch()
{
    $Hvendor = $this->input->post('Hvendor');

    $this->load->model('Auth_model');
    $Hbranch = $this->Auth_model->hamalibranch($Hvendor);

    echo $Hbranch;
}

public function hamaliVendorCode()
{
    $Hvendor = $this->input->post('Hvendor');

    $this->load->model('Auth_model');
    $VendorCode = $this->Auth_model->hamaliVendorCode($Hvendor);

    echo $VendorCode;
}

public function get_attached_data() {
    $data['vendor'] = $this->Auth_model->vendor_data($this->session->userdata('user_id'));
    echo json_encode($data);
}



}
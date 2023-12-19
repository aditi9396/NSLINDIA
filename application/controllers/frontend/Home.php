<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('qrcode');
        

    }

    public function index()
    {
        // $this->load->view('frontend/home-header');
        $this->load->view('frontend/home');
        // $this->load->view('frontend/footer');
        $data['meta'] = array('title'=>'HOME |NSLINDIA','page_title'=>'');
        $this->load->view('frontend/frontend-template', $data);

    }
    public function header()
    {
        $this->load->model('Auth_model');
        $data['user']=$this->Auth_model->user_data($this->session->userdata('user_id'));
        $this->load->view('frontend/header', $data);
    }
    public function loader()
    {
        $this->load->view('frontend/footer');
        $data['meta'] = array('title'=>'HOME |NSLINDIA','page_title'=>'');
        $this->load->view('frontend/frontend-template', $data);
    }

    public function dashboard()
    {
       $this->load->model('Auth_model');
       $data['user']=$this->Auth_model->user_data($this->session->userdata('user_id'));
       $data['header']='frontend/header';
       $data['body']='frontend/main';
       $data['sidebar']='frontend/sidebar';
       $data['footer']='frontend/footer';
       $data['meta'] = array('title'=>'HOME |NSLINDIA','page_title'=>'cpcontractmaster');
       $this->load->view('frontend/backend_template', $data);
   }

   public function lrgeneration()
   {   
    $this->load->model('Auth_model');
    $data['user']=$this->Auth_model->user_data($this->session->userdata('user_id'));
    $LRNO = $this->uri->segment(2);
    $this->db->where('LRNO', $LRNO);
    $query = $this->db->get('lr');
    $data['requestdata'] = $query->row();
    $data['header']='frontend/header';
    $data['body'] = 'frontend/lrgeneration';
    $data['sidebar']='frontend/sidebar';
    $data['footer']='frontend/footer';
    $data['meta'] = array('title'=>'HOME |NSLINDIA','page_title'=>'lrgeneration');
    $this->load->view('frontend/backend_template', $data);
}
public  function printlr()
{
    $arr_segment = $this->uri->segment_array();
    $last_segment = array_slice($arr_segment, 1);
    $str_segment = implode('/',$last_segment);

    $this->load->model('Auth_model');
    $data['user']=$this->Auth_model->user_data($this->session->userdata('user_id'));
    $LRNO = $this->uri->segment(2);
    $this->db->where('LRNO', $LRNO);
    $query = $this->db->get('lr');
    $data['requestdata'] = $query->row();
    $data['header'] = 'frontend/header';
    $data['body']='frontend/printlr';
    $data['sidebar']='frontend/sidebar';
    $data['meta'] = array('title'=>'HOME |NSLINDIA','page_title'=>'cpcontractmaster');
    $this->load->view('frontend/backend_template', $data);

}

public function lrlazervolumetric() 
{
    $str_lr_no = $_GET['LRNO'];

    $barcode = generate_barcode($str_lr_no);
    $imagePath = FCPATH . 'barcode.png';
    file_put_contents($imagePath, $barcode);

    $this->load->helper('url');
    $imageURL = base_url('barcode.png');
    echo '<img src="'.$imageURL.'" alt="Barcode">';


    if ($str_lr_no) {
        $query = $this->db->query("SELECT cpvolumetricdetails.id, cpvolumetricdetails.LRDate, cpvolumetricdetails.LRNO, cpvolumetricdetails.str_lr_no, cpvolumetricdetails.InvoiceNo, cpvolumetricdetails.InvDate, cpvolumetricdetails.PkgType, cpvolumetricdetails.ProductType, cpvolumetricdetails.Invoicevalue, cpvolumetricdetails.PkgsNo, cpvolumetricdetails.LENGTH, cpvolumetricdetails.Width, cpvolumetricdetails.Height, cpvolumetricdetails.ActwtperPkg, cpvolumetricdetails.ActualWeight, cpvolumetricdetails.PerpkgsWeight, cpvolumetricdetails.PkgsWeightA, cpvolumetricdetails.ExcessRate, cpvolumetricdetails.EWBNo, cpvolumetricdetails.EWBExpdate, lr.LRDate, lr.PayBasis, lr.ToPlace,lr.EDD, lr.ConsignorMob, lr.Consignor, lr.ConsignorAdd, lr.ConsigneeMob, lr.Consignee, lr.Consignee, lr.ConsigneeMar, lr.ConsigneeAdd, lr.ConsigneeAddMar 
            FROM cpvolumetricdetails 
            LEFT JOIN lr ON cpvolumetricdetails.LRNO = lr.LRNO 
            WHERE cpvolumetricdetails.str_lr_no = ?", array($str_lr_no));

        $data['lrData'] = $query->result_array();

        $EmpID = $this->session->userdata('user_id');

        $query = $this->db->query("SELECT Depot, EmpName FROM employee WHERE EmpID = ?", array($EmpID));
        $depotData = $query->row();

        if ($depotData) {
            $data['selectedDepot'] = $depotData->Depot;
            $data['empName'] = $depotData->EmpName;
        } else {
            $data['selectedDepot'] = 'N/A';
            $data['empName'] = 'N/A';
        }


        if ($data['lrData']) {

            $data['meta'] = array('title'=>'HOME |NSLINDIA','page_title'=>'contractdetails');
            $this->load->view('frontend/lrlazervolumetric', $data);
        } else {
            echo "No data found for LR Number: " . $str_lr_no;
        }
    } else {
        echo "LR Number is not provided.";
    }
}

public function generateBarcode($str_lr_no)
{
    $this->load->library('ciqrcode');
    $query = $this->db->query("SELECT * FROM cpvolumetricdetails WHERE str_lr_no = ?", array($str_lr_no));
    $lrData = $query->row();

    if ($lrData) {
        $data = json_encode($lrData);

        $params['data'] = $data;
        $params['level'] = 's';
        $params['size'] = 5;
        $params['savename'] = FCPATH . 'assets_old/qrcodes/barcode.png';

        $this->ciqrcode->generate($params);

        return base_url('assets_old/qrcodes/barcode.png');
    } else {
        return false;
    }
}


public function stickerprint() 
{
    $str_lr_no = $_GET['LRNO'];
    if ($str_lr_no) {
        $query = $this->db->query("SELECT cpvolumetricdetails.id, cpvolumetricdetails.LRDate, cpvolumetricdetails.LRNO, cpvolumetricdetails.str_lr_no, cpvolumetricdetails.InvoiceNo, cpvolumetricdetails.InvDate, cpvolumetricdetails.PkgType, cpvolumetricdetails.ProductType, cpvolumetricdetails.Invoicevalue, cpvolumetricdetails.PkgsNo, cpvolumetricdetails.LENGTH, cpvolumetricdetails.Width, cpvolumetricdetails.Height, cpvolumetricdetails.ActwtperPkg, cpvolumetricdetails.ActualWeight, cpvolumetricdetails.PerpkgsWeight, cpvolumetricdetails.PkgsWeightA, cpvolumetricdetails.ExcessRate, cpvolumetricdetails.EWBNo, cpvolumetricdetails.EWBExpdate, lr.LRDate, lr.PayBasis, lr.ToPlace,lr.EDD, lr.ConsignorMob, lr.Consignor, lr.ConsignorAdd, lr.ConsigneeMob, lr.Consignee, lr.Consignee, lr.ConsigneeMar, lr.ConsigneeAdd, lr.ConsigneeAddMar 
            FROM cpvolumetricdetails 
            left JOIN lr ON cpvolumetricdetails.id = lr.id 
            WHERE cpvolumetricdetails.str_lr_no = ?", array($str_lr_no));

        $data['lrData'] = $query->row();

        if ($data['lrData']) {
            $data['meta'] = array('title' => 'HOME | NSLINDIA', 'page_title' => 'contractdetails');

            $qrCodeImageURL = $this->generateBarcode($str_lr_no);

            $data['qrCodeImage'] = $qrCodeImageURL;

            $this->load->view('frontend/stickerprint', $data);
        } else {
            echo "No data found for LR Number: " . $str_lr_no;
        }
    } else {
        echo "LR Number is not provided.";
    }
}


public function printdrsdemo(){

    $DRSNO = $_GET['DRSNO'];
    $barcode = generate_barcode($DRSNO);
    $imagePath = FCPATH . 'barcode.png';
    file_put_contents($imagePath, $barcode);

    $this->load->helper('url');
    $imageURL1 = base_url('barcode.png');
    echo '<img src="'.$imageURL1.'" alt="testing">';

    $query = $this->db->query("SELECT id, LRNO, DRSNO,Consignee,Consignor,FreightCharge, drsdate, Uploaded, Uploadtime, Verifytime, Consignor, WebXUploaded, Place, InvoiceNo, Qty, Weight, Consignee, BookingDate, vendorname, Delivered, DeliveryDate, DeliveryDT, CnoteUpdated, FreightCharge, Advance, BalanceFreight, PayScheduled, Paydate,  vehicleno, freighttype, mreading, drskm, ToPay, Reason, Hamali, UpdatedToPay, TopayMOP, TopayTransID, LRHamali, UpdatedQty, StatementNo, StatementDate, VerifyUser, DeliverUser, DRSKMUser, Remark, StatementUser, TransactionID, MOP, HamaliType, DRSDT, Location, driver, mobileno, FTLType, licenseno, licexpdate, CloseTrip, CreatedBy, CancelReason, Canceluser, CancelDT, CEWBNo, FinalHamali, IMPSCharges, HaltingCharge, OverLoadingCharge, ExtraDeliveryCharge, Penalty, OtherCharges, FinalRemark, vehiclecapacitymodel, paymentschedule, dieselamt, statementimagestatus, Advancecashbank, Dieselvendorname, liter, Rate, Status1, Status2, created_at, updated_at
        FROM vtcpod1 WHERE DRSNO =?", array($DRSNO));

    $data['drsdata'] = $query->result();

    if ($data['drsdata']) {
        $data['meta'] = array('title' => 'HOME | NSLINDIA', 'page_title' => 'DRS');

        $this->load->view('frontend/printdrsdemo', $data);
    } else {
        echo "No data found for DRS Number: " . $DRSNO;
    }

}

public function printthcdemo(){

    $THCNO = $_GET['THCNO'];
    $barcode = generate_barcode($THCNO);
    $imagePath = FCPATH . 'barcode.png';
    file_put_contents($imagePath, $barcode);

    $this->load->helper('url');
    $imageURL1 = base_url('barcode.png');
    echo '<img src="'.$imageURL1.'" alt="testing">';

    $query = $this->db->query("SELECT  `THCNO`, `drsdate`, `Uploaded`,  `ownername`, `Verifytime`,  `WebXUploaded`, `Place`, `driver`, `BookingDate`, `vendorname`, `Delivered`, `DeliveryDate`, `DeliveryDT`, `CnoteUpdated`, `FreightCharge`, `Advance`, `BalanceFreight`, `PayScheduled`, `Paydate`, `vehicleno`, `freighttype`, `mreading`, `drskm`, `ToPay`, `Reason`, `Hamali`, `UpdatedToPay`, `TopayMOP`, `TopayTransID`, `LRHamali`, `UpdatedQty`, `StatementNo`, `StatementDate`, `VerifyUser`, `DeliverUser`, `DRSKMUser`, `Remark`, `StatementUser`, `TransactionID`, `MOP`, `HamaliType`, `DRSDT`, `Location`, `FTLType`, `mobileno`, `licenseno`, `licexpdate`, `CloseTrip`, `CreatedBy`, `CancelReason`, `Canceluser`, `CancelDT`, `CEWBNo`, `FinalHamali`, `IMPSCharges`, `HaltingCharge`, `OverLoadingCharge`, `ExtraDeliveryCharge`, `Penalty`, `OtherCharges`, `FinalRemark`, `vehiclecapacitymodel`, `paymentschedule`, `dieselamt`, `statementimagestatus`, `Advancecashbank`, `Dieselvendorname`, `liter`, `Rate`, `Status1`, `Status2`
        FROM thc WHERE THCNO =?", array($THCNO));

    $data['thcdata'] = $query->row();

    if ($data['thcdata']) {
        $data['meta'] = array('title' => 'HOME | NSLINDIA', 'page_title' => 'thc');

        $this->load->view('frontend/printthcdemo', $data);
    } else {
        echo "No data found for DRS Number: " . $THCNO;
    }

}


public function printdrsvoucher()
{  
 $DRSNO = $_GET['DRSNO'];

 $query = $this->db->query("SELECT `VoucherNo`, `VoucherDate`, `DRSNO`, `VType`, `VAmount`, `Cancelled`, `CreatedBy`, `LaodingHamali`, `TotalExpenses`, `totalreceipts`, `TotalBalance`, `VoucherStatus`, `voucherBalance`
    FROM voucher WHERE DRSNO =?", array($DRSNO));
 $data['drsdata1'] = $query->row();

 $query = $this->db->query("SELECT `id`, `LRNO`, `DRSNO`,`Consignee`,`Consignor`,`FreightCharge`, `drsdate`, `Uploaded`, `Verifytime`, `Consignor`, `WebXUploaded`, `Place`,`InvoiceNo`, `Qty`, `Weight`,`Consignee`,`BookingDate`,`vendorname`,`Delivered`,`DeliveryDate`,`DeliveryDT`, `CnoteUpdated`, `FreightCharge`, `Advance`, `BalanceFreight`,`PayScheduled`, `Paydate`, `vehicleno`, `freighttype`, `mreading`,`drskm`, `ToPay`, `Reason`,`Hamali`, `UpdatedToPay`, `TopayMOP`, `TopayTransID`, `LRHamali`,`UpdatedQty`, `StatementNo`,`StatementDate`, `VerifyUser`, `DeliverUser`, `DRSKMUser`,`Remark`,`StatementUser`, `TransactionID`,`MOP`,`HamaliType`,`DRSDT`, `Location`,`driver`, `mobileno`,`FTLType`,`licenseno`,`licexpdate`, `CloseTrip`, `CreatedBy`, `CancelReason`, `Canceluser`, `CancelDT`,`CEWBNo`, `FinalHamali`, `IMPSCharges`,`HaltingCharge`, `OverLoadingCharge`, `ExtraDeliveryCharge`, `Penalty`, `OtherCharges`,`FinalRemark`, `vehiclecapacitymodel`,`paymentschedule`,`dieselamt`,`statementimagestatus`, `Advancecashbank`, `Dieselvendorname`, `liter`,`Rate`,`Status1`, `Status2`, `created_at`,`updated_at`
    FROM vtcpod1 WHERE DRSNO =?", array($DRSNO));

 $data['drsdata'] = $query->row();

 if ($data['drsdata']) {
    $data['meta'] = array('title' => 'HOME | NSLINDIA', 'page_title' => 'DRS');

    $this->load->view('frontend/printdrsvoucher', $data);
} else {
    echo "No data found for DRS Number: " . $DRSNO;
}

}

public function printdrskmtimemarkeradd(){
    $DRSNO = $_GET['DRSNO'];

    $query = $this->db->query("SELECT `VoucherNo`, `VoucherDate`, `DRSNO`, `VType`, `VAmount`, `Cancelled`, `CreatedBy`, `LaodingHamali`, `TotalExpenses`, `totalreceipts`, `TotalBalance`, `VoucherStatus`, `voucherBalance`
        FROM voucher WHERE DRSNO =?", array($DRSNO));
    $data['drsdata1'] = $query->row();

    $query = $this->db->query("SELECT `id`, `LRNO`, `DRSNO`,`Consignee`,`Consignor`,`FreightCharge`, `drsdate`, `Uploaded`, `Verifytime`, `Consignor`, `WebXUploaded`, `Place`,`InvoiceNo`, `Qty`, `Weight`,`Consignee`,`BookingDate`,`vendorname`,`Delivered`,`DeliveryDate`,`DeliveryDT`, `CnoteUpdated`, `FreightCharge`, `Advance`, `BalanceFreight`,`PayScheduled`, `Paydate`, `vehicleno`, `freighttype`, `mreading`,`drskm`, `ToPay`, `Reason`,`Hamali`, `UpdatedToPay`, `TopayMOP`, `TopayTransID`, `LRHamali`,`UpdatedQty`, `StatementNo`,`StatementDate`, `VerifyUser`, `DeliverUser`, `DRSKMUser`,`Remark`,`StatementUser`, `TransactionID`,`MOP`,`HamaliType`,`DRSDT`, `Location`,`driver`, `mobileno`,`FTLType`,`licenseno`,`licexpdate`, `CloseTrip`, `CreatedBy`, `CancelReason`, `Canceluser`, `CancelDT`,`CEWBNo`, `FinalHamali`, `IMPSCharges`,`HaltingCharge`, `OverLoadingCharge`, `ExtraDeliveryCharge`, `Penalty`, `OtherCharges`,`FinalRemark`, `vehiclecapacitymodel`,`paymentschedule`,`dieselamt`,`statementimagestatus`, `Advancecashbank`, `Dieselvendorname`, `liter`,`Rate`,`Status1`, `Status2`, `created_at`,`updated_at`
        FROM vtcpod1 WHERE DRSNO =?", array($DRSNO));

    $data['drsdata'] = $query->row();

    if ($data['drsdata']) {

        $data['meta'] = array('title' => 'HOME | NSLINDIA', 'page_title' => 'DRS');

        $this->load->view('frontend/printdrskmtimemarkeradd', $data);
    } else {
        echo "No data found for DRS Number: " . $DRSNO;
    }

}

public function printthckmtimemarkeradd(){
    $THCNO = $_GET['THCNO'];

    $query = $this->db->query("SELECT `VoucherNo`, `VoucherDate`, `DRSNO`, `VType`, `VAmount`, `Cancelled`, `CreatedBy`, `LaodingHamali`, `TotalExpenses`, `totalreceipts`, `TotalBalance`, `VoucherStatus`, `voucherBalance`
        FROM voucher WHERE DRSNO =?", array($THCNO));
    $data['drsdata1'] = $query->row();

    $query = $this->db->query("SELECT `id`, `THCNO`,`FreightCharge`, `drsdate`, `Uploaded`, `Verifytime` , `WebXUploaded`, `Place`,`BookingDate`,`vendorname`,`Delivered`,`DeliveryDate`,`DeliveryDT`, `CnoteUpdated`, `FreightCharge`, `Advance`, `BalanceFreight`,`PayScheduled`, `Paydate`, `vehicleno`, `freighttype`, `mreading`,`drskm`, `ToPay`, `Reason`,`Hamali`, `UpdatedToPay`, `TopayMOP`, `TopayTransID`, `LRHamali`,`UpdatedQty`, `StatementNo`,`StatementDate`, `VerifyUser`, `DeliverUser`, `DRSKMUser`,`Remark`,`StatementUser`, `TransactionID`,`MOP`,`HamaliType`,`DRSDT`, `Location`,`driver`, `mobileno`,`FTLType`,`licenseno`,`licexpdate`, `CloseTrip`, `CreatedBy`, `CancelReason`, `Canceluser`, `CancelDT`,`CEWBNo`, `FinalHamali`, `IMPSCharges`,`HaltingCharge`, `OverLoadingCharge`, `ExtraDeliveryCharge`, `Penalty`, `OtherCharges`,`FinalRemark`, `vehiclecapacitymodel`,`paymentschedule`,`dieselamt`,`statementimagestatus`, `Advancecashbank`, `Dieselvendorname`, `liter`,`Rate`,`Status1`, `Status2`
        FROM THC WHERE THCNO =?", array($THCNO));

    $data['drsdata'] = $query->row();

    if ($data['drsdata']) {

        $data['meta'] = array('title' => 'HOME | NSLINDIA', 'page_title' => 'DRS');

        $this->load->view('frontend/printthckmtimemarkeradd', $data);
    } else {
        echo "No data found for DRS Number: " . $DRSNO;
    }

}
public function printdrskmtimeroute(){
   $DRSNO = $_GET['DRSNO'];
   $query = $this->db->query("SELECT `VoucherNo`, `VoucherDate`, `DRSNO`, `VType`, `VAmount`, `Cancelled`, `CreatedBy`, `LaodingHamali`, `TotalExpenses`, `totalreceipts`, `TotalBalance`, `VoucherStatus`, `voucherBalance`
    FROM voucher WHERE DRSNO =?", array($DRSNO));
   $data['drsdata1'] = $query->row();

   $query = $this->db->query("SELECT `id`, `LRNO`, `DRSNO`,`Consignee`,`Consignor`,`FreightCharge`, `drsdate`, `Uploaded`, `Verifytime`, `Consignor`, `WebXUploaded`, `Place`,`InvoiceNo`, `Qty`, `Weight`,`Consignee`,`BookingDate`,`vendorname`,`Delivered`,`DeliveryDate`,`DeliveryDT`, `CnoteUpdated`, `FreightCharge`, `Advance`, `BalanceFreight`,`PayScheduled`, `Paydate`, `vehicleno`, `freighttype`, `mreading`,`drskm`, `ToPay`, `Reason`,`Hamali`, `UpdatedToPay`, `TopayMOP`, `TopayTransID`, `LRHamali`,`UpdatedQty`, `StatementNo`,`StatementDate`, `VerifyUser`, `DeliverUser`, `DRSKMUser`,`Remark`,`StatementUser`, `TransactionID`,`MOP`,`HamaliType`,`DRSDT`, `Location`,`driver`, `mobileno`,`FTLType`,`licenseno`,`licexpdate`, `CloseTrip`, `CreatedBy`, `CancelReason`, `Canceluser`, `CancelDT`,`CEWBNo`, `FinalHamali`, `IMPSCharges`,`HaltingCharge`, `OverLoadingCharge`, `ExtraDeliveryCharge`, `Penalty`, `OtherCharges`,`FinalRemark`, `vehiclecapacitymodel`,`paymentschedule`,`dieselamt`,`statementimagestatus`, `Advancecashbank`, `Dieselvendorname`, `liter`,`Rate`,`Status1`, `Status2`, `created_at`,`updated_at`
    FROM vtcpod1 WHERE DRSNO =?", array($DRSNO));

   $data['drsdata'] = $query->row();

   if ($data['drsdata']) {
    $data['meta'] = array('title' => 'HOME | NSLINDIA', 'page_title' => 'DRS');

    $this->load->view('frontend/printdrskmtimeroute', $data);
} else {
    echo "No data found for DRS Number: " . $DRSNO;
}

}


public function printthckmtimeroute(){
   $THCNO = $_GET['THCNO'];
   $query = $this->db->query("SELECT `VoucherNo`, `VoucherDate`, `DRSNO`, `VType`, `VAmount`, `Cancelled`, `CreatedBy`, `LaodingHamali`, `TotalExpenses`, `totalreceipts`, `TotalBalance`, `VoucherStatus`, `voucherBalance`
    FROM voucher WHERE DRSNO =?", array($THCNO));
   $data['drsdata1'] = $query->row();

   $query = $this->db->query("SELECT `id`,  `THCNO`,`FreightCharge`, `drsdate`, `Uploaded`, `Verifytime`,  `WebXUploaded`, `Place`,`BookingDate`,`vendorname`,`Delivered`,`DeliveryDate`,`DeliveryDT`, `CnoteUpdated`, `FreightCharge`, `Advance`, `BalanceFreight`,`PayScheduled`, `Paydate`, `vehicleno`, `freighttype`, `mreading`,`drskm`, `ToPay`, `Reason`,`Hamali`, `UpdatedToPay`, `TopayMOP`, `TopayTransID`, `LRHamali`,`UpdatedQty`, `StatementNo`,`StatementDate`, `VerifyUser`, `DeliverUser`, `DRSKMUser`,`Remark`,`StatementUser`, `TransactionID`,`MOP`,`HamaliType`,`DRSDT`, `Location`,`driver`, `mobileno`,`FTLType`,`licenseno`,`licexpdate`, `CloseTrip`, `CreatedBy`, `CancelReason`, `Canceluser`, `CancelDT`,`CEWBNo`, `FinalHamali`, `IMPSCharges`,`HaltingCharge`, `OverLoadingCharge`, `ExtraDeliveryCharge`, `Penalty`, `OtherCharges`,`FinalRemark`, `vehiclecapacitymodel`,`paymentschedule`,`dieselamt`,`statementimagestatus`, `Advancecashbank`, `Dieselvendorname`, `liter`,`Rate`,`Status1`, `Status2`
    FROM thc WHERE THCNO =?", array($THCNO));

   $data['drsdata'] = $query->row();

   if ($data['drsdata']) {
    $data['meta'] = array('title' => 'HOME | NSLINDIA', 'page_title' => 'THC');

    $this->load->view('frontend/printthckmtimeroute', $data);
} else {
    echo "No data found for THC Number: " . $THCNO;
}

}

public function verifypodvouchertest()
{
    $DRSNO = $this->input->get('DRSNO', TRUE);
    $query = $this->db->get_where('vtcpod1', array('DRSNO' => $DRSNO));

    if ($query->num_rows() > 0) {
        $data['drsdata'] = $query->result();
        $data['meta'] = array('title' => 'HOME | NSLINDIA', 'page_title' => 'DRS');

        $this->load->view('frontend/verifypodvouchertest', $data);
    } else {
        echo "No data found for DRS Number: " . htmlspecialchars($DRSNO, ENT_QUOTES, 'UTF-8');
    }
}



public function CPVOLUMETRICdata() {
    $this->load->model('Auth_model');
    $data['user']=$this->Auth_model->user_data($this->session->userdata('user_id'));
    $this->db->order_by("id", "desc");
    $query = $this->db->get('lr');
    $data['requestdata'] = $query->result();
    $data['header'] = 'frontend/header';
    $data['sidebar'] = 'frontend/sidebar';
    $data['body'] = 'frontend/LRTABLE_view';
    $this->load->view('frontend/backend_template', $data);

}
public function deleteLR() {
    $id = $this->input->post('id');
    $this->db->where('id', $id);
    if ($this->db->delete('lr')) {
        $response = array("status" => true, 'msg' => 'CPvolumetricLR deleted Successfully');
    } else {
        $response = array("status" => false, 'msg' => 'Failed to delete CPvolumetricLR');
    }
    echo json_encode($response);
    return;
}


public function Cp_lrgenerataion()
{
    $invoiceno = $this->input->post('invoiceno');
    $EDD = $this->input->post('eddate');
    $InvDate = $this->input->post('invoicedate');
    $LRDate = $this->input->post('LRDate');
    $LRDT = $this->input->post('LRDate');
    $ArriveDate = $this->input->post('LRDate');
    $pkgtype = $this->input->post('pkgtype');
    $prodtype = $this->input->post('prodtype');
    $declval = $this->input->post('declval');
    $PkgsNo = $this->input->post('pkgno');
    $length = $this->input->post('length');
    $width = $this->input->post('width');
    $height = $this->input->post('height');
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
    $FRTRate = $this->input->post('actwt');
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
        // $PickupDelType = $this->input->post('othercharge');
    $DoordelCharge = $this->input->post('DoordelCharge');
    $ExcesswtCharge = $this->input->post('ExcesswtCharge');
    $CSGSTRate = $this->input->post('CSGSTRate');
    $CSGSTAmount = $this->input->post('csgst');
    $PayBasis = $this->input->post('paytype');
    $ToPlace = $this->input->post('district');
    $ConsignorMob = $this->input->post('WIConsignormob');
    $Consignor = $this->input->post('WIConsignor');
    $ConsignorAdd = $this->input->post('WIConsignoradd');
    $ConsigneeMob = $this->input->post('WIConsigneemob');
    $FMConsignee = $this->input->post('FMConsignee');
    $Consignee = $this->input->post('WIConsignee');
    $ConsigneeMar = $this->input->post('WIConsigneeMar');
    $ConsigneeAdd = $this->input->post('WIConsigneeadd');
    $ConsigneeAddMar = $this->input->post('WIConsigneeaddMar');
    $FromPlace = $this->input->post('FromPlace');
    $Hamali = $this->input->post('hamalicharge');
    $DocCharge = $this->input->post('doccharge');
        // $OtherCharge = $this->input->post('OtherCharge');
    $FreightCharge = $this->input->post('freightotal');
    $FRTType = $this->input->post('freighttype');
    $PkgType = $this->input->post('pkgtype');
    $EWBNo = $this->input->post('EWBNOS');

    $user = $this->db->query("SELECT `EmpName`,`UserName`,`Designation`,`Depot` FROM employee WHERE EmpID = " . $this->session->userdata('user_id'));
    $user_data = $user->row();
    $Depot = $user_data->Depot;
    $EmpName = $user_data->EmpName;

    $coastcenterCode = "";
    if ($PayBasis == "TO PAY") {
        $coastcenterCode = "CCPTOP01";
    } elseif($PayBasis == "PAID"){
        $coastcenterCode = "CCPPAI01";
    }

    $data1 = array(
        "PayBasis" => $PayBasis,
        "CoastCenter" => $coastcenterCode,
        "ToPlace" => $ToPlace,
        "FromPlace" => $Depot,
        "LRDate" => $LRDate,
        "LRDT" => $LRDT,
        "ArriveDate" => $ArriveDate,
        "EDD" => $EDD,
        "ConsignorMob" => $ConsignorMob,
        "Consignor" => $Consignor,
        "ConsignorAdd" => $ConsignorAdd,
        "ConsigneeMob" => $ConsigneeMob,
        "Consignee" => $Consignee,
        "ConsigneeMar" => $ConsigneeMar,
        "ConsigneeAdd" => $ConsigneeAdd,
        "ConsigneeAddMar" => $ConsigneeAddMar,
        "PkgsNo" => $PkgsNo[0],
        "ActualWeight" => $actwt[0],
        "FRTRate" => $FRTRate[0],
        "InvoiceNo" => $invoiceno[0],
        "Destination" => $Depot,
        "DocketTotal" => $DocketTotal,
        "Hamali" => $Hamali,
        "DocCharge" => $DocCharge,
        // "OtherCharge" => $OtherCharge,
        "FreightCharge" => $FreightCharge,
        "FRTType" => $FRTType,
        "Status"=>1,
        "Origin"=>$Depot,
        "CurrentLocation"=>$Depot,
        "ConsignorId"=>8888,
        "ConsigneeId"=>8888,
        "CreatedBy"=>$EmpName,
        "CSGSTAmount"=>$CSGSTAmount,
        "EWBNo" => $EWBNo,
    );
    $this->db->insert('lr', $data1);
    $insert_id = $this->db->insert_id();

    $user = $this->db->query("SELECT `EmpName`,`UserName`,`Designation`,`Depot` FROM employee WHERE EmpID = " . $this->session->userdata('user_id'));
    $user_data = $user->row();
    $str_lr_no = $user_data->Depot . sprintf('%010d', $insert_id);

    $data2 = array(
        "LRNO" => $str_lr_no,
    );

    $this->db->where('id', $insert_id);
    $this->db->update('lr', $data2);

    for ($i = 0; $i < count($invoiceno); $i++) {
        $data = array(
            "LRNO" => $str_lr_no,
            "str_lr_no" => $str_lr_no,
            "LRDate"=>$LRDate,
            "PkgType"=>$PkgType[$i],
            "InvDate" => $InvDate,
            "InvoiceNo" => $invoiceno[$i],
            "ProductType" => $prodtype[$i],
            "Invoicevalue" => $declval[$i],
            "PkgsNo" => $PkgsNo[$i],
            "LENGTH" => $length[$i],
            "Width" => $width[$i],
            "Height" => $height[$i],
            "ActwtperPkg" => $actwtperpkg[$i],
            "ActualWeight" => $actwt[$i],
            "PerpkgsWeight" => $actwtperpkg_w[$i],
            "PkgsWeightA" => $actwt_w[$i],
            "ExcessRate" => $Exwtchrgs[$i],
            "EWBNo" => $EWBNo, 
        );

        $this->db->insert('cpvolumetricdetails', $data);
        $this->db->set('status', 1);
        $this->db->where('str_lr_no', $str_lr_no);
        $this->db->update('cpvolumetricdetails');

    }
    $dataewbill =array(
        "LRNO" => $str_lr_no,
        "EWBNo" => $EWBNo,
    );

    $this->db->insert('ewbill', $dataewbill);

    if ($this->db->affected_rows() > 0) {
        $query = $this->db->get('cpvolumetricdetails');
        $output = $query->result();
        $response = array('msg' => 'LR Generated Successfully', "status" => true, 'lr_no' => $str_lr_no);
    } else {
        $response = array('err' => 'LR Not Generated Successfully', "status" => false);
    }

    echo json_encode($response);
    return;
}

public function location()
{
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://103.39.135.146:47286/api/GetLocation',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    echo $response;
}

public  function printdrs()
{
    $this->load->model('Auth_model');
    $data['user']=$this->Auth_model->user_data($this->session->userdata('user_id'));
    $data['body']='frontend/printdrs';
    $data['meta'] = array('title'=>'HOME |NSLINDIA','page_title'=>'cpcontractmaster');
    $this->load->view('frontend/frontend-template', $data);

}

public function printarrival()
{
 $this->load->model('Auth_model');
 $data['user']=$this->Auth_model->user_data($this->session->userdata('user_id'));
 $this->load->view('frontend/printarrival', $data);
}

public  function printthc()
{
    $this->load->model('Auth_model');

    $data['user']=$this->Auth_model->user_data($this->session->userdata('user_id'));
        // $data['header'] = 'frontend/cpmenubar';
    $data['body']='frontend/printthc';
    $data['meta'] = array('title'=>'HOME |NSLINDIA','page_title'=>'cpcontractmaster');
    $this->load->view('frontend/frontend-template', $data);

}

public function Apiewaybill()
{
    $this->load->model('Auth_model');
    $authToken = $this->Auth_model->getAuthToken();

    if ($AuthToken == "") {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://gsp.adaequare.com/gsp/authenticate?grant_type=token",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "gspappid: 8E930C59455E478DA9341CA8E2FBC9D2",
                "gspappsecret: 7FC077F4G313BG40F6G93B3G709DA21F090D"
            )
        ));

        $response = curl_exec($curl);
        echo "Token response: " . $response;


        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $tokenobj = json_decode($response, true);
            $AuthToken = $tokenobj['access_token'];
            $Expires_In = $tokenobj['expires_in'];
            $currentdate = new DateTime();
            $datestr = $currentdate->format('Y-m-d H:i:s');

            $this->Auth_model->updateAuthToken($AuthToken, $Expires_In, $datestr);
        }
    }
}


public function Ewaybill()
{
    $this->load->model('Auth_model');
    $lastRequestId = $this->Auth_model->getLastRequestId();

    $EwbNos = $this->input->post('EwbNos'); 
    $ewbnos= array();
    foreach ($ewbnos as $EwbNo) {
        $validResponse = false;

        do {
            $id = (int)substr($lastRequestId, 3, 10) + 1;
            $requestId = "EWB" . str_pad($id, 10, 0, STR_PAD_LEFT);

            $response = $this->GetEwayBillInfo($EwbNo, $requestId);

            if ($response['success']) {
                $ewbInfo = $response['result'];

                $this->Auth_model->saveEwayBillInfo($ewbInfo, $requestId);

                $validResponse = true;
            } else {
                $this->Auth_model->updateLastRequestId($requestId);

                if ($response['message'] == "Request already exist with given requestid") {
                    $validResponse = false;
                } else {
                    $msg = "Error: Eway Bill No. $EwbNo, {$response['message']}";
                    exit(json_encode(array('success' => 0, 'msg' => $msg)));
                }
            }
        } while (!$validResponse);
    }

    exit(json_encode(array('success' => 1, 'msg' => "All Eway Bills are Verified.")));
}

public function GetEwayBillInfo()
{
    $this->load->model('Auth_model');

    $ewbNo = 'YourEwbNo'; 
    $requestId = 'YourRequestId'; 
    $url = "https://gsp.adaequare.com/enriched/ewb/ewayapi/GetEwayBill?ewbNo=$ewbNo";
    $authToken = $this->getAuthToken();

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "authorization: Bearer" . $authToken,
            "cache-control: no-cache",
            "content-type: application/json",
            "gstin: 27AAECV0781E1ZD",
            "password: vtc3plewb2020",
            "requestid: " . $requestId,
            "username: VTC@3PL_API_pda"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        return array('success' => 0, 'message' => "cURL Error: $err");
    } else {
        $ewbObj = json_decode($response, true);

        if ($ewbObj['success']) {
            return array('success' => 1, 'result' => $ewbObj['result']);
        } else {
            return array('success' => 0, 'message' => $ewbObj['message']);
        }
    }
}

public function generateCustomBarcode()
{
    $data = 'Hello, World!';

    $params['data'] = $data;
    $params['level'] = 'H';
    $params['size'] = 10;
    $params['savename'] = FCPATH . 'barcode.png';

    $this->qrcode->generate($params);

    $data['barcodeImage'] = base_url('barcode.png');
    $this->load->view('frontend/barcode', $data);
}

// public function lrgeneration() {
//   $this->load->model('Auth_model');
//   $data['user']=$this->Auth_model->user_data($this->session->userdata('user_id'));
//   $LRNO = $this->uri->segment(2);
//   $this->db->where('LRNO', $LRNO);
//   $query = $this->db->get('lr');
//   $data['requestdata'] = $query->row();
//   $data['header'] = 'frontend/header';
//   $data['sidebar'] = 'frontend/sidebar';
//   $data['body'] = 'frontend/lrgeneration';
//   $this->load->view('frontend/backend_template', $data);
// }


}


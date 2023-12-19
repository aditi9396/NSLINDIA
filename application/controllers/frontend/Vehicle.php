<?php

class Vehicle extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Vehicle_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function registration_form() {
        $data['ownership_list'] = $this->Vehicle_model->get_ownership_list();
        $this->load->view('frontend/registration_form', $data);
    }

    public function save() {
        $this->form_validation->set_rules('registration_date', 'Registration Date', 'required');
        $this->form_validation->set_rules('license_plate', 'License Plate', 'required|is_unique[tbl_vehicle.license_plate]');

        if ($this->form_validation->run() == FALSE) {
            $this->registration_form();
        } else {
            $vehicle_data = array(
                'registration_date' => $this->input->post('registration_date'),
                'license_plate' => $this->input->post('license_plate'),
                'make_model' => $this->input->post('make_model'),
                'owner_id' => $this->input->post('owner_id')
            );

            $vehicle_id = $this->Vehicle_model->save_vehicle($vehicle_data);

            $part_codes = $this->input->post('part_code');
            $part_names = $this->input->post('part_name');
            $uins = $this->input->post('uin');
            $part_dates = $this->input->post('part_date');

            for ($i = 0; $i < count($part_codes); $i++) {
                $part_data = array(
                    'vehicle_id' => $vehicle_id,
                    'part_code' => $part_codes[$i],
                    'part_name' => $part_names[$i],
                    'UIN' => $uins[$i],
                    'date' => $part_dates[$i]
                );
                $this->Vehicle_model->save_vehicle_part($part_data);
            }
            $this->session->set_flashdata('success', 'Vehicle registration saved successfully.');
            redirect(base_url('vehicle/vehicle_list')); 
        }
    }


    public function vehicle_list() {
        $data['ownership_list'] = $this->Vehicle_model->get_ownership_list();

        $query = $this->db->query('select v.`id`,v.`registration_date`, v.`license_plate`, v.`make_model`, v.`owner_id`, p.`vehicle_id`, p.`part_code`, p.`part_name`, p.`UIN`, p.`date` from tbl_vehicle as v RIGHT JOIN tbl_vehicle_part as p ON v.id = p.vehicle_id order by v.id desc ');
        $data['vehicles'] = $query->result();

        if ($data['vehicles'] === false) {
            $data['error'] = 'Failed to retrieve vehicle data.';
        }

        $this->load->view('frontend/frontend-template',$data);
        $this->load->view('frontend/vehicle_list', $data);
    }

    public function view($vehicle_id) {
        $data['vehicle'] = $this->Vehicle_model->get_vehicle($vehicle_id);
        $data['vehicle_parts'] = $this->Vehicle_model->get_vehicle_parts($vehicle_id);
        $this->load->view('frontend/vehicle_view', $data);
    }



    public function edit($vehicle_id) { 
        $data['vehicle'] = $this->Vehicle_model->get_vehicle($vehicle_id);
        $data['ownership_list'] = $this->Vehicle_model->get_ownership_list();
        $data['vehicle_parts'] = $this->Vehicle_model->get_vehicle_parts($vehicle_id);

        if ($this->input->post()) {

            $part_ids = $this->input->post('part_id');
            $part_codes = $this->input->post('part_code');
            $part_names = $this->input->post('part_name');
            $uins = $this->input->post('uin');
            $part_dates = $this->input->post('part_date');

            $this->Vehicle_model->delete_vehicle_parts($vehicle_id);

            $vehicle_parts_data = array();
            for ($i = 0; $i < count($part_codes); $i++) {
                $part_data = array(
                    'vehicle_id' => $vehicle_id,
                    'part_code' => $part_codes[$i],
                    'part_name' => $part_names[$i],
                    'uin' => $uins[$i],
                    'part_date' => $part_dates[$i]
                );
                $vehicle_parts_data[] = $part_data;
            }
            $this->Vehicle_model->insert_vehicle_parts($vehicle_parts_data);

            redirect('vehicle/details/'.$vehicle_id);
        }

        $this->load->view('frontend/vehicle_edit', $data);
    }


    public function update($vehicle_id) {

        $this->form_validation->set_rules('registration_date', 'Registration Date', 'required');
        $this->form_validation->set_rules('license_plate', 'License Plate', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->edit($vehicle_id);

        } else {
            $vehicle_data = array(
                'registration_date' => $this->input->post('registration_date'),
                'license_plate' => $this->input->post('license_plate'),
                'make_model' => $this->input->post('make_model'),
                'owner_id' => $this->input->post('ownership')
            );

            $this->Vehicle_model->update_vehicle($vehicle_id, $vehicle_data);

            $part_ids = $this->input->post('part_id');
            $part_codes = $this->input->post('part_code');
            $part_names = $this->input->post('part_name');
            $uins = $this->input->post('uin');
            $part_dates = $this->input->post('part_date');

            $this->Vehicle_model->delete_vehicle_parts($vehicle_id);

            $vehicle_parts_data = array();
            for ($i = 0; $i < count($part_codes); $i++) {
                $part_data = array(
                    'vehicle_id' => $vehicle_id,
                    'part_code' => $part_codes[$i],
                    'part_name' => $part_names[$i],
                    'UIN' => $uins[$i],
                    'date' => $part_dates[$i]
                );
                $vehicle_parts_data[] = $part_data;
                $this->Vehicle_model->save_vehicle_part($part_data);
            }

            $this->session->set_flashdata('success', 'Vehicle details updated successfully.');
            redirect('vehicle/vehicle_list');
        }
    }

    public function delete($vehicle_id) {
        $this->Vehicle_model->delete_vehicle($vehicle_id);
        $this->session->set_flashdata('success', 'Vehicle deleted successfully.');
        redirect('vehicle/vehicle_list');
    }

    public  function printsimplelr()
    {
        $arr_segment = $this->uri->segment_array();
        $last_segment = array_slice($arr_segment, 1);
        $str_segment = implode('/',$last_segment);

        $this->load->model('Auth_model');
        $data['user']=$this->Auth_model->user_data($this->session->userdata('user_id'));
        $data['header'] = 'frontend/header';
        $data['body']='frontend/printsimplelr';
        $data['sidebar']='frontend/sidebar';
        $data['meta'] = array('title'=>'HOME |NSLINDIA','page_title'=>'cpcontractmaster');
        $this->load->view('frontend/backend_template', $data);

    }

    public function simplelazervolumetric() 
    {
        $str_lr_no = $_GET['LRNO'];
        $barcode = generate_barcode($str_lr_no);
        $imagePath = FCPATH . 'barcode.png';
        file_put_contents($imagePath, $barcode);

        $this->load->helper('url');
        $imageURL = base_url('barcode.png');
        echo '<img src="'.$imageURL.'" alt="Barcode">';
        if ($str_lr_no) {
            $query = $this->db->query("SELECT lrdetails.id, lrdetails.InvDate,lrdetails.LRNO,lrdetails.InvoiceNo,lrdetails.PkgType,lrdetails.ProductType,lrdetails.Invoicevalue,lrdetails.PkgsNo,lrdetails.ActwtperPkg,lrdetails.ActualWeight, lrdetails.ExcessRate,lrdetails.EWBNo, lrdetails.EWBExpdate,lr.LRDate,lr.PayBasis,lr.ToPlace,lr.EDD,lr.ConsignorMob,lr.Consignor, lr.ConsignorAdd, lr.ConsigneeMob,lr.Consignee, lr.ConsigneeMar,lr.ConsigneeAdd,lr.ConsigneeAddMar FROM lrdetails LEFT JOIN lr ON lrdetails.LRNO = lr.LRNO 
                WHERE lrdetails.LRNO = ?", array($str_lr_no));

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
                $this->load->view('frontend/simplelazervolumetric', $data);
            } else {
                echo "No data found for LR Number: " . $str_lr_no;
            }
        } else {
            echo "LR Number is not provided.";
        }
    }

    public function LRstickerprint() 
    {
        $str_lr_no = $_GET['LRNO'];
        if ($str_lr_no) {
            $query = $this->db->query("SELECT lrdetails.id, lrdetails.InvDate, lrdetails.LRNO, lrdetails.LRNO, lrdetails.InvoiceNo, lrdetails.InvDate, lrdetails.PkgType, lrdetails.ProductType, lrdetails.Invoicevalue, lrdetails.PkgsNo, lrdetails.ActualWeight, lrdetails.ExcessRate, lrdetails.EWBNo, lrdetails.EWBExpdate, lr.LRDate, lr.PayBasis, lr.ToPlace,lr.EDD, lr.ConsignorMob, lr.Consignor, lr.ConsignorAdd, lr.ConsigneeMob, lr.Consignee, lr.Consignee, lr.ConsigneeMar, lr.ConsigneeAdd, lr.ConsigneeAddMar 
                FROM lrdetails 
                left JOIN lr ON lrdetails.LRNO = lr.LRNO 
                WHERE lrdetails.LRNO = ?", array($str_lr_no));

            $data['lrData'] = $query->row();

            if ($data['lrData']) {
                $data['meta'] = array('title' => 'HOME | NSLINDIA', 'page_title' => 'contractdetails');

                $qrCodeImageURL = $this->generateBarcode($str_lr_no);

                $data['qrCodeImage'] = $qrCodeImageURL;

                $this->load->view('frontend/LRstickerprint', $data);
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
        $query = $this->db->query("SELECT * FROM lrdetails WHERE LRNO = ?", array($str_lr_no));
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

// tripsheet drs search 
    public function DRSsearch() {
        $keyword = $this->input->get('drs');

        $this->load->model('Auth_model');

        $results = $this->Auth_model->drs($keyword);

        $html = '';
        foreach ($results as $vtcpod1) {
            $html .= '<option>' . $vtcpod1->DRSNO . '</option>';
        }

        echo $html;
    }

    public function DRSsearch1() {
        $keyword = $this->input->get('bothdrs');
        $this->load->model('Auth_model');
        $results = $this->Auth_model->drs($keyword);
        $html = '';
        foreach ($results as $vtcpod1) {
            $html .= '<option>' . $vtcpod1->DRSNO . '</option>';
        }
        echo $html;
    }

    public function THCsearch() {
        $keyword = $this->input->get('thc');

        $this->load->model('Auth_model');

        $results = $this->Auth_model->thc($keyword);

        $html = '';
        foreach ($results as $thc) {
            $html .= '<option>' . $thc->THCNO . '</option>';
        }

        echo $html;
    }

    public function THCsearch1() {
        $keyword = $this->input->get('boththc');
        $this->load->model('Auth_model');
        $results = $this->Auth_model->thc($keyword);
        $html = '';
        foreach ($results as $thc) {
            $html .= '<option>' . $thc->THCNO . '</option>';
        }
        echo $html;
    }


    // DASHBOARD CUSTOMER
    public function customer_form(){
       $this->load->model('Auth_model');
       $data['user'] = $this->Auth_model->user_data($this->session->userdata('user_id'));
       $data['header'] = 'frontend/header';
       $data['sidebar'] = 'frontend/sidebar';
       $data['body'] = 'frontend/customer';
       $data['meta'] = array('title' => 'NSLINDIA|VEHICLEMASTER', 'page_title' => '');
       $this->load->view('frontend/backend_template', $data);
   }

   public function savecust_data() {
    $GroupCode = $this->input->post('GroupCode');
    $CustCode = $this->input->post('CustCode');
    $CostCenter = $this->input->post('CostCenter');
    $CustName = $this->input->post('CustName');
    $Category = $this->input->post('Category');
    $MobileNo = $this->input->post('MobileNo');
    $PAN = $this->input->post('PAN');
    $City = $this->input->post('City');
    $Pincode = $this->input->post('Pincode');
    $Location = $this->input->post('Location');
    $TelNo = $this->input->post('TelNo');
    $Address = $this->input->post('Address');
    $AddressMar = $this->input->post('AddressMar');
    $CustNameMar = $this->input->post('CustNameMar');
    $BillAddressMar = $this->input->post('BillAddressMar');
    $EmailId = $this->input->post('EmailId');
    $BillingMail = $this->input->post('BillingMail');
    $Status = $this->input->post('Status');
    $U_BP_Category = $this->input->post('U_BP_Category');
    $DepotName = $this->input->post('DepotName');

    $data = array(
        'GroupCode' => $GroupCode,
        'CustCode' => $CustCode,
        'CostCenter' => $CostCenter,
        'CustName' => $CustName,
        'Category' => $Category,
        'MobileNo' => $MobileNo,
        'PAN' => $PAN,
        'City' => $City,
        'Pincode' => $Pincode,
        'Location' => $Location,
        'TelNo' => $TelNo,
        'Address' => $Address,
        'AddressMar' => $AddressMar,
        'CustNameMar' => $CustNameMar,
        'BillAddressMar' => $BillAddressMar,
        'EmailId' => $EmailId,
        'BillingMail' => $BillingMail,
        'Status' => $Status,
        'U_BP_Category' => $U_BP_Category,
        'DepotName' => $DepotName,
    );

    $id = $this->input->post('id'); 

    if (strlen($CustCode) > 0 && strlen($CostCenter) > 0) {
        if (isset($id)) {
            $this->db->where('id', $id);
            $this->db->update("cust_master", $data);
        } else {
            $this->db->insert('cust_master', $data);
            $id = $this->db->insert_id();
        }

        $response = array('msg' => 'Customer saved Successfully', "success" => true);
    } else {
        $response = array('msg' => 'Please enter proper input', "success" => false);
    }

    echo json_encode($response);
}

public function customer_listdata() {
    $this->load->model('Auth_model');
    $data['user'] = $this->Auth_model->user_data($this->session->userdata('user_id'));
    $this->db->order_by("id", "desc");
    $query = $this->db->get('cust_master');
    $data['requestdata'] = $query->result();
    $data['header'] = 'frontend/header';
    $data['sidebar'] = 'frontend/sidebar';
    $data['body'] = 'frontend/cust_list_view';
    $this->load->view('frontend/backend_template', $data);

}

public function updatecust() {
 $id = $this->input->post('id');
 $GroupCode = $this->input->post('GroupCode');
 $CustCode = $this->input->post('CustCode');
 $CostCenter = $this->input->post('CostCenter');
 $CustName = $this->input->post('CustName');
 $Category = $this->input->post('Category');
 $MobileNo = $this->input->post('MobileNo');
 $PAN = $this->input->post('PAN');
 $City = $this->input->post('City');
 $Pincode = $this->input->post('Pincode');
 $Location = $this->input->post('Location');
 $TelNo = $this->input->post('TelNo');
 $Address = $this->input->post('Address');
 $AddressMar = $this->input->post('AddressMar');
 $CustNameMar = $this->input->post('CustNameMar');
 $BillAddressMar = $this->input->post('BillAddressMar');
 $EmailId = $this->input->post('EmailId');
 $BillingMail = $this->input->post('BillingMail');
 $Status = $this->input->post('Status');
 $U_BP_Category = $this->input->post('U_BP_Category');
 $DepotName = $this->input->post('DepotName');
 $data = array(
   'GroupCode' => $GroupCode,
   'CustCode' => $CustCode,
   'CostCenter' => $CostCenter,
   'CustName' => $CustName,
   'Category' => $Category,
   'MobileNo' => $MobileNo,
   'PAN' => $PAN,
   'City' => $City,
   'Pincode' => $Pincode,
   'Location' => $Location,
   'TelNo' => $TelNo,
   'Address' => $Address,
   'AddressMar' => $AddressMar,
   'CustNameMar' => $CustNameMar,
   'BillAddressMar' => $BillAddressMar,
   'EmailId' => $EmailId,
   'BillingMail' => $BillingMail,
   'Status' => $Status,
   'U_BP_Category' => $U_BP_Category,
   'DepotName' => $DepotName,
);
 $this->db->where('id', $id);
 $this->db->update('cust_master', $data);
 $response = array('msg' => 'Customer Updated Successfully', "success" => true);
 echo json_encode($response);
 return;
}

public function editcustomer() {
    $this->load->model('Auth_model');
    $data['user'] = $this->Auth_model->user_data($this->session->userdata('user_id'));
    $id = $this->uri->segment(2);
    $this->db->where('id', $id);
    $query = $this->db->get('cust_master');
    $data['requestdata'] = $query->row();
    $data['header'] = 'frontend/header';
    $data['sidebar'] = 'frontend/sidebar';
    $data['body'] = 'frontend/customer';
    $this->load->view('frontend/backend_template', $data);
}
public function deletecustomer() {
    $id = $this->input->post('id');
    $this->db->where('id', $id);
    if ($this->db->delete('cust_master')) {
        $response = array("status" => true, 'msg' => 'Customer deleted Successfully');
    } else {
        $response = array("status" => false, 'msg' => 'Failed to delete Customer');
    }
    echo json_encode($response);
    return;
}

//DASHBOARD TRIPSHEET EXPANSES
public function tripsheet(){
   $this->load->model('Auth_model');
   $data['user'] = $this->Auth_model->user_data($this->session->userdata('user_id'));
   $data['header'] = 'frontend/header';
   $data['sidebar'] = 'frontend/sidebar';
   $data['body'] = 'frontend/tripsheet_from';
   $data['meta'] = array('title' => 'NSLINDIA|VEHICLEMASTER', 'page_title' => '');
   $this->load->view('frontend/backend_template', $data);
}

// DASHBOARD MASTER VENDOR
public function vendor_form(){
   $this->load->model('Auth_model');
   $data['user'] = $this->Auth_model->user_data($this->session->userdata('user_id'));
   $data['header'] = 'frontend/header';
   $data['sidebar'] = 'frontend/sidebar';
   $data['body'] = 'frontend/vendorform';
   $data['meta'] = array('title' => 'NSLINDIA|VEHICLEMASTER', 'page_title' => '');
   $this->load->view('frontend/backend_template', $data);
}

public function savevendor_data() {
    $VendorCode = $this->input->post('Code');
    $VendorName = $this->input->post('Name');
    $Type = $this->input->post('Type');
    $Address = $this->input->post('Address');
    $City = $this->input->post('Location');
    $City = $this->input->post('City');
    $Pincode = $this->input->post('PinCode');
    $Mobile_No = $this->input->post('MobileNo');
    $Email = $this->input->post('Email');
    $PAN_No = $this->input->post('PAN');
    $GSTNO = $this->input->post('GST');
    $U_Location = $this->input->post('Location');

    $data = array(
        'VendorCode' => $VendorCode,
        'VendorName' => $VendorName,
        'Type' => $Type,
        'Address' => $Address,
        'City' => $City,
        'City' => $City,
        'Pincode' => $Pincode,
        'Mobile_No' => $Mobile_No,
        'Email' => $Email,
        'PAN_No' => $PAN_No,
        'GSTNO' => $GSTNO,
        'U_Location' => $U_Location,
    );

    $id = $this->input->post('id'); 

    if (strlen($VendorCode) > 0 && strlen($VendorName) > 0) {
        if (isset($id)) {
            $this->db->where('ID', $ID);
            $this->db->update("vendormaster", $data);
        } else {
            $this->db->insert('vendormaster', $data);
            $id = $this->db->insert_id();
        }

        $response = array('msg' => 'Vendor saved Successfully', "success" => true);
    } else {
        $response = array('msg' => 'Please enter proper input', "success" => false);
    }

    echo json_encode($response);
}

public function vendor_listdata() {
   $this->load->model('Auth_model');
   $data['user'] = $this->Auth_model->user_data($this->session->userdata('user_id'));
   $this->db->order_by("ID", "desc");
   $query = $this->db->get('vendormaster');
   $data['requestdata'] = $query->result();
   $data['header'] = 'frontend/header';
   $data['sidebar'] = 'frontend/sidebar';
   $data['body'] = 'frontend/vendor_list_view';
   $this->load->view('frontend/backend_template', $data);

}

public function editvendor() {
    $this->load->model('Auth_model');
    $data['user'] = $this->Auth_model->user_data($this->session->userdata('user_id'));
    $id = $this->uri->segment(2);
    $this->db->where('id', $id);
    $query = $this->db->get('vendormaster');
    $data['requestdata'] = $query->row();
    $data['header'] = 'frontend/header';
    $data['sidebar'] = 'frontend/sidebar';
    $data['body'] = 'frontend/vendorform';
    $this->load->view('frontend/backend_template', $data);
}

public function updatevendor() {
 $id = $this->input->post('id');
 $VendorCode = $this->input->post('Code');
 $VendorName = $this->input->post('Name');
 $Type = $this->input->post('Type');
 $Address = $this->input->post('Address');
 $City = $this->input->post('Location');
 $City = $this->input->post('City');
 $Pincode = $this->input->post('PinCode');
 $Mobile_No = $this->input->post('MobileNo');
 $Email = $this->input->post('Email');
 $PAN_No = $this->input->post('PAN');
 $GSTNO = $this->input->post('GST');
 $U_Location = $this->input->post('Location');

 $data = array(
    'VendorCode' => $VendorCode,
    'VendorName' => $VendorName,
    'Type' => $Type,
    'Address' => $Address,
    'City' => $City,
    'City' => $City,
    'Pincode' => $Pincode,
    'Mobile_No' => $Mobile_No,
    'Email' => $Email,
    'PAN_No' => $PAN_No,
    'GSTNO' => $GSTNO,
    'U_Location' => $U_Location,
);

 $this->db->where('id', $id);
 $this->db->update('vendormaster', $data);
 $response = array('msg' => 'Vendor Updated Successfully', "success" => true);
 echo json_encode($response);
 return;
}
public function deletevendor() {
    $id = $this->input->post('id');
    $this->db->where('id', $id);
    
    if ($this->db->delete('vendormaster')) {
        $response = array("status" => true, 'msg' => 'Vendor deleted Successfully');
    } else {
        $response = array("status" => false, 'msg' => 'Failed to delete Vendor');
    }

    echo json_encode($response);
    return;
}

// DASHBORAD MASTER LOCATION
public function location_form(){
   $this->load->model('Auth_model');
   $data['user'] = $this->Auth_model->user_data($this->session->userdata('user_id'));
   $data['header'] = 'frontend/header';
   $data['sidebar'] = 'frontend/sidebar';
   $data['body'] = 'frontend/locationform';
   $data['meta'] = array('title' => 'NSLINDIA|VEHICLEMASTER', 'page_title' => '');
   $this->load->view('frontend/backend_template', $data);
}

public function savelocation_data(){
    $Hierarchy = $this->input->post('Hierarchy');
    $ReportingTo = $this->input->post('ReportingTo');
    $ReportingLocation = $this->input->post('ReportingLocation');
    $LocationCode = $this->input->post('LocationCode');
    $LocationName = $this->input->post('LocationName');
    $Branch = $this->input->post('Branch');
    $PinCode = $this->input->post('PinCode');
    $State = $this->input->post('State');
    $City = $this->input->post('tocity');
    $Address = $this->input->post('Address');
    $FaxNo = $this->input->post('FaxNo');
    $MobileNo = $this->input->post('MobileNo');
    $EmailId = $this->input->post('EmailId');
    $AccountLocation = $this->input->post('AccountLocation');
    $DataEntryLocation = $this->input->post('DataEntryLocation');
    $StartDate = $this->input->post('StartDate');
    $EndDate = $this->input->post('EndDate');
    $Comp = $this->input->post('Comp');
    $NextLocation = $this->input->post('NextLocation');
    $PreviousLocation = $this->input->post('PreviousLocation');
    $LocationOwnership = $this->input->post('LocationOwnership');
    $ControlLocation = $this->input->post('ControlLocation');
    $AdvanceLimit = $this->input->post('AdvanceLimit');
    $Octroi = $this->input->post('Octroi');
    $BilledAt = $this->input->post('BilledAt');

    $data = array(
        'Hierarchy' => $Hierarchy,
        'ReportingTo' => $ReportingTo,
        'ReportingLocation' => $ReportingLocation,
        'LocationCode' => $LocationCode,
        'LocationName' => $LocationName,
        'Branch' => $Branch,
        'PinCode' => $PinCode,
        'State' => $State,
        'City' => $City,
        'Address' => $Address,
        'FaxNo' => $FaxNo,
        'MobileNo' => $MobileNo,
        'EmailId' => $EmailId,
        'AccountLocation' => $AccountLocation,
        'DataEntryLocation' => $DataEntryLocation,
        'StartDate' => $StartDate,
        'EndDate' => $EndDate,
        'Comp' => $Comp,
        'NextLocation' => $NextLocation,
        'PreviousLocation' => $PreviousLocation,
        'LocationOwnership' => $LocationOwnership,
        'ControlLocation' => $ControlLocation,
        'AdvanceLimit' => $AdvanceLimit,
        'Octroi' => $Octroi,
        'BilledAt' => $BilledAt,
    );

    $id = $this->input->post('id'); 

    if (strlen($LocationCode) > 0 && strlen($LocationName) > 0) {
        if (isset($id)) {
            $this->db->where('id', $id);
            $this->db->update("locationmaster", $data);
        } else {
            $this->db->insert('locationmaster', $data);
            $id = $this->db->insert_id();
        }

        $response = array('msg' => 'Location saved Successfully', "success" => true);
    } else {
        $response = array('msg' => 'Please enter proper input', "success" => false);
    }

    echo json_encode($response);
}

public function location_listdata(){
 $this->load->model('Auth_model');
 $this->db->order_by("id", "desc");
 $query = $this->db->get('locationmaster');
 $data['user'] = $this->Auth_model->user_data($this->session->userdata('user_id'));
 $data['requestdata'] = $query->result();
 $data['header'] = 'frontend/header';
 $data['sidebar'] = 'frontend/sidebar';
 $data['body'] = 'frontend/locationlist';
 $this->load->view('frontend/backend_template', $data);

}

public function updatelocation(){
 $id = $this->input->post('id');
 $Hierarchy = $this->input->post('Hierarchy');
 $ReportingTo = $this->input->post('ReportingTo');
 $ReportingLocation = $this->input->post('ReportingLocation');
 $LocationCode = $this->input->post('LocationCode');
 $LocationName = $this->input->post('LocationName');
 $Branch = $this->input->post('Branch');
 $PinCode = $this->input->post('PinCode');
 $State = $this->input->post('State');
 $City = $this->input->post('tocity');
 $Address = $this->input->post('Address');
 $FaxNo = $this->input->post('FaxNo');
 $MobileNo = $this->input->post('MobileNo');
 $EmailId = $this->input->post('EmailId');
 $AccountLocation = $this->input->post('AccountLocation');
 $DataEntryLocation = $this->input->post('DataEntryLocation');
 $StartDate = $this->input->post('StartDate');
 $EndDate = $this->input->post('EndDate');
 $Comp = $this->input->post('Comp');
 $NextLocation = $this->input->post('NextLocation');
 $PreviousLocation = $this->input->post('PreviousLocation');
 $LocationOwnership = $this->input->post('LocationOwnership');
 $ControlLocation = $this->input->post('ControlLocation');
 $AdvanceLimit = $this->input->post('AdvanceLimit');
 $Octroi = $this->input->post('Octroi');
 $BilledAt = $this->input->post('BilledAt');

 $data = array(
    'Hierarchy' => $Hierarchy,
    'ReportingTo' => $ReportingTo,
    'ReportingLocation' => $ReportingLocation,
    'LocationCode' => $LocationCode,
    'LocationName' => $LocationName,
    'Branch' => $Branch,
    'PinCode' => $PinCode,
    'State' => $State,
    'City' => $City,
    'Address' => $Address,
    'FaxNo' => $FaxNo,
    'MobileNo' => $MobileNo,
    'EmailId' => $EmailId,
    'AccountLocation' => $AccountLocation,
    'DataEntryLocation' => $DataEntryLocation,
    'StartDate' => $StartDate,
    'EndDate' => $EndDate,
    'Comp' => $Comp,
    'NextLocation' => $NextLocation,
    'PreviousLocation' => $PreviousLocation,
    'LocationOwnership' => $LocationOwnership,
    'ControlLocation' => $ControlLocation,
    'AdvanceLimit' => $AdvanceLimit,
    'Octroi' => $Octroi,
    'BilledAt' => $BilledAt,
);

 $this->db->where('id', $id);
 $this->db->update('locationmaster', $data);
 $response = array('msg' => 'Location Updated Successfully', "success" => true);
 echo json_encode($response);
 return;

}

public function editlocation() {

 $id = $this->uri->segment(2);
 $this->db->where('id', $id);
 $query = $this->db->get('locationmaster');
 $data['requestdata'] = $query->row();
 $data['header'] = 'frontend/header';
 $data['sidebar'] = 'frontend/sidebar';
 $data['body'] = 'frontend/locationform';
 $this->load->view('frontend/backend_template', $data);
}

public function deletelocation() {
    $id = $this->input->post('id');
    $this->db->where('id', $id);
    
    if ($this->db->delete('locationmaster')) {
        $response = array("status" => true, 'msg' => 'Location deleted Successfully');
    } else {
        $response = array("status" => false, 'msg' => 'Failed to delete Location');
    }

    echo json_encode($response);
    return;
}


   // DASHBOARD CITY MASTER
   public function city_form(){
    $this->load->model('Auth_model');
   $data['user'] = $this->Auth_model->user_data($this->session->userdata('user_id'));
   $data['header'] = 'frontend/header';
   $data['sidebar'] = 'frontend/sidebar';
   $data['body'] = 'frontend/city_form';
   $data['meta'] = array('title' => 'NSLINDIA|VEHICLEMASTER', 'page_title' => '');
   $this->load->view('frontend/backend_template', $data);
   }

    // DASHBOARD MASTER VEHICLE

public function vehicle_form(){
   $this->load->model('Auth_model');
   $data['user'] = $this->Auth_model->user_data($this->session->userdata('user_id'));
   $data['header'] = 'frontend/header';
   $data['sidebar'] = 'frontend/sidebar';
   $data['body'] = 'frontend/vehicle_form';
   $data['meta'] = array('title' => 'NSLINDIA|VEHICLEMASTER', 'page_title' => '');
   $this->load->view('frontend/backend_template', $data);
}

public function savedata(){
 $VehicleType = $this->input->post('VehicleType');
 $ControllingBranch = $this->input->post('ControllingBranch');
 $Vehicle_No = $this->input->post('VehicleNo');
 $AssetType = $this->input->post('AssetType');
 $VendorType = $this->input->post('VendorType');
 $VendorName = $this->input->post('VendorName');
 $NoOfTyres = $this->input->post('NoOfTyres');
 $PermitStates = $this->input->post('PermitStates');
 $FTLType = $this->input->post('FTLType');
 $RCBookNo = $this->input->post('RCBookNo');
 $RegDate = $this->input->post('RegistrationDate');
 $InsuranceCompany = $this->input->post('InsuranceCompany');
 $Insurance_Validity = $this->input->post('VehicleInsuranceDate');
 $Fitness_Validity = $this->input->post('FitnessCertificateDate');
 $AttachedDate = $this->input->post('DateOfAttaching');
 $Permit_validity = $this->input->post('VehiclePermitDate');
 $Chassis_No = $this->input->post('ChasisNo');
 $Engine_No = $this->input->post('EngineNo');
 $CertNo = $this->input->post('CertificateNo');
 $InsuranceNo = $this->input->post('InsuranceNo');
 $RTONo = $this->input->post('RTONo');
 $RateKm = $this->input->post('RateKm');
 $PerKmRate1 = $this->input->post('PerKmRate1');
 $Milage = $this->input->post('Milage');
 $FuelTankCapacity = $this->input->post('FuelTankCapacity');
 $CFT = $this->input->post('CFT');
 $GVW = $this->input->post('GVW');
 $UnloadedWeight = $this->input->post('Unladen');
 $Capacity = $this->input->post('Capacity');
 $Length = $this->input->post('Length');
 $Width = $this->input->post('Width');
 $Height = $this->input->post('Height');

 $data = array(
    'VehicleType' => $VehicleType,
    'ControllingBranch' => $ControllingBranch,
    'Vehicle_No' => $Vehicle_No,
    'AssetType' => $AssetType,
    'VendorType' => $VendorType,
    'VendorName' => $VendorName,
    'NoOfTyres' => $NoOfTyres,
    'PermitStates' => $PermitStates,
    'FTLType' => $FTLType,
    'RCBookNo' => $RCBookNo,
    'RegDate' => $RegDate,
    'InsuranceCompany' => $InsuranceCompany,
    'Insurance_Validity' => $Insurance_Validity,
    'Chassis_No' => $Chassis_No,
    'Engine_No' => $Engine_No,
    'CertNo' => $CertNo,
    'InsuranceNo' => $InsuranceNo,
    'RTONo' => $RTONo,
    'RateKm' => $RateKm,
    'PerKmRate1' => $PerKmRate1,
    'Milage' => $Milage,
    'FuelTankCapacity' => $FuelTankCapacity,
    'CFT' => $CFT,
    'GVW' => $GVW,
    'UnloadedWeight' => $UnloadedWeight,
    'Capacity' => $Capacity,
    'Length' => $Length,
    'Width' => $Width,
    'Height' => $Height,
);
 if (strlen($VehicleType) > 0 && strlen($Vehicle_No) > 0) {
    if (isset($id)) {
        $this->db->where('id', $id);
        $this->db->update("vehiclemaster", $data);
    } else {
        $this->db->insert('vehiclemaster', $data);

        $id = $this->db->insert_id();
    }

    $response = array('msg' => 'Vehicle save Successfully', "success" => true);

} else {
    $response = array('msg' => 'Please enter proper input', "success" => false);

}
echo json_encode($response);
}



public function vehicle_listdata() {
 $this->load->model('Auth_model');
 $data['user'] = $this->Auth_model->user_data($this->session->userdata('user_id'));
 $this->db->order_by("id", "desc");
 $query = $this->db->get('vehiclemaster');
 $data['requestdata'] = $query->result();
 $data['header'] = 'frontend/header';
 $data['sidebar'] = 'frontend/sidebar';
 $data['body'] = 'frontend/vehicle_list_view';
 $this->load->view('frontend/backend_template', $data);

}

public function editvehicle() {
    $this->load->model('Auth_model');
    $data['user'] = $this->Auth_model->user_data($this->session->userdata('user_id'));
    $id = $this->uri->segment(2);
    $this->db->where('id', $id);
    $query = $this->db->get('vehiclemaster');
    $data['requestdata'] = $query->row();
    $data['header'] = 'frontend/header';
    $data['sidebar'] = 'frontend/sidebar';
    $data['body'] = 'frontend/vehicle_form';
    $this->load->view('frontend/backend_template', $data);
}

public function updatevehicle() {
 $id = $this->input->post('id');
 $VehicleType = $this->input->post('VehicleType');
 $ControllingBranch = $this->input->post('ControllingBranch');
 $Vehicle_No = $this->input->post('VehicleNo');
 $AssetType = $this->input->post('AssetType');
 $VendorType = $this->input->post('VehicleNo');
 $VendorName = $this->input->post('VehicleNo');
 $NoOfTyres = $this->input->post('VehicleNo');
 $PermitStates = $this->input->post('VehicleNo');
 $FTLType = $this->input->post('VehicleNo');
 $RCBookNo = $this->input->post('VehicleNo');
 $RegDate = $this->input->post('VehicleNo');
 $InsuranceCompany = $this->input->post('InsuranceCompany');
 $Insurance_Validity = $this->input->post('VehicleInsuranceDate');
 $Fitness_Validity = $this->input->post('FitnessCertificateDate');
 $AttachedDate = $this->input->post('DateOfAttaching');
 $Permit_validity = $this->input->post('VehiclePermitDate');
 $Chassis_No = $this->input->post('ChasisNo');
 $Engine_No = $this->input->post('EngineNo');
 $CertNo = $this->input->post('CertificateNo');
 $InsuranceNo = $this->input->post('InsuranceNo');
 $RTONo = $this->input->post('RTONo');
 $RateKm = $this->input->post('RateKm');
 $PerKmRate1 = $this->input->post('PerKmRate1');
 $Milage = $this->input->post('Milage');
 $FuelTankCapacity = $this->input->post('FuelTankCapacity');
 $CFT = $this->input->post('CFT');
 $GVW = $this->input->post('GVW');
 $UnloadedWeight = $this->input->post('Unladen');
 $Capacity = $this->input->post('Capacity');
 $Length = $this->input->post('Length');
 $Width = $this->input->post('Width');
 $Height = $this->input->post('Height');

 $data = array(
    'VehicleType' => $VehicleType,
    'ControllingBranch' => $ControllingBranch,
    'Vehicle_No' => $Vehicle_No,
    'AssetType' => $AssetType,
    'VendorType' => $VendorType,
    'VendorName' => $VendorName,
    'NoOfTyres' => $NoOfTyres,
    'PermitStates' => $PermitStates,
    'FTLType' => $FTLType,
    'RCBookNo' => $RCBookNo,
    'RegDate' => $RegDate,
    'InsuranceCompany' => $InsuranceCompany,
    'Insurance_Validity' => $Insurance_Validity,
    'Chassis_No' => $Chassis_No,
    'Engine_No' => $Engine_No,
    'CertNo' => $CertNo,
    'InsuranceNo' => $InsuranceNo,
    'RTONo' => $RTONo,
    'RateKm' => $RateKm,
    'PerKmRate1' => $PerKmRate1,
    'Milage' => $Milage,
    'FuelTankCapacity' => $FuelTankCapacity,
    'CFT' => $CFT,
    'GVW' => $GVW,
    'UnloadedWeight' => $UnloadedWeight,
    'Capacity' => $Capacity,
    'Length' => $Length,
    'Width' => $Width,
    'Height' => $Height,
);
 $this->db->where('id', $id);
 $this->db->update('vehiclemaster', $data);
 $response = array('msg' => 'Vehicle Updated Successfully', "success" => true);
 echo json_encode($response);
 return;
}

public function deletevehicle() {
    $id = $this->input->post('id');
    $this->db->where('id', $id);
    
    if ($this->db->delete('vehiclemaster')) {
        $response = array("status" => true, 'msg' => 'Vehicle deleted Successfully');
    } else {
        $response = array("status" => false, 'msg' => 'Failed to delete vehicle');
    }

    echo json_encode($response);
    return;
}
public function Submittripsheet() {
    $DRSNO = $this->input->post('drsdepo');
    $Place = $this->input->post('dplace');
    $PPName = $this->input->post('dppname');
    $BillNo = $this->input->post('dbillno');
    $BillDate = $this->input->post('dbilldate');
    $Amount = $this->input->post('damount');
    $Remark = $this->input->post('dremark');
    $DLitre = $this->input->post('dtltr');
    $DRate = $this->input->post('drate');
    $dtamount = $this->input->post('dtamount');
    $Paymenttype = $this->input->post('dpaytype');

    $user = $this->db->query("SELECT `EmpName`, `UserName`, `Designation`, `Depot` FROM employee WHERE EmpID = " . $this->session->userdata('user_id'));
    $user_data = $user->row();
    $Depot = $user_data->Depot;
    $EmpName = $user_data->EmpName;

    $status = true; 

    foreach ($Place as $key => $value) {
        $data1 = array(
            'DRSNO' => $DRSNO,
            'DLitre' => $DLitre,
            'BillNo'=>$BillNo[$key],
            'Place'=>$Place[$key],
            'DRate'=>$DRate[$key],
            'user'=>$EmpName,
            'PPName'=>$PPName[$key],
            'Amount'=>$Amount[$key],
            'DieselType'=>'Depot',
        );

        $this->db->insert('dieselexp', $data1);
        $insert_id = $this->db->insert_id();

        $customDate = date('Y-m-d', strtotime('2324-01-01'));
        $year = date('Y', strtotime($customDate));
        $id_format = sprintf('%05d', $insert_id);
        $TripsheetNo = "TS/{$Depot}/{$year}/{$id_format}";

        $data2 = array(
            "TripsheetNo" => $TripsheetNo,
        );

        $this->db->where('id', $insert_id);
        $this->db->update('dieselexp', $data2);

        $data3 = array(
            'DRSNO' => $DRSNO,
            'TripSheetNo' => $TripsheetNo,
            'TSDate' => $BillDate[$key],
            'Tripsheetuser' => $EmpName,
            'Remark' => $Remark[$key],
            'Paymenttype' => $Paymenttype[$key],
            'TripSheetStatus' => 1,
        );

        $this->db->insert('tripsheet', $data3);

        if ($this->db->affected_rows() <= 0) {
            $status = false;
            break;
        }
    }

    $response = array('status' => $status);
    echo json_encode($response);
}

public function Submittripsheet1() {
    $THCNO = $this->input->post('thcdepo');
    $Place = $this->input->post('dplace');
    $PPName = $this->input->post('dppname');
    $BillNo = $this->input->post('dbillno');
    $BillDate = $this->input->post('dbilldate');
    $Amount = $this->input->post('damount');
    $Remark = $this->input->post('dremark');
    $DLitre = $this->input->post('dtltr');
    $DRate = $this->input->post('drate');
    $dtamount = $this->input->post('dtamount');
    $Paymenttype = $this->input->post('dpaytype');

    $user = $this->db->query("SELECT `EmpName`, `UserName`, `Designation`, `Depot` FROM employee WHERE EmpID = " . $this->session->userdata('user_id'));
    $user_data = $user->row();
    $Depot = $user_data->Depot;
    $EmpName = $user_data->EmpName;

    $status = true; 

    foreach ($Place as $key => $value) {
        $data1 = array(
            'THCNO' => $THCNO,
            'DLitre' => $DLitre,
            'BillNo'=>$BillNo[$key],
            'Place'=>$Place[$key],
            'DRate'=>$DRate[$key],
            'user'=>$EmpName,
            'PPName'=>$PPName[$key],
            'Amount'=>$Amount[$key],
            'DieselType'=>'Depot',
        );

        $this->db->insert('dieselexp', $data1);
        $insert_id = $this->db->insert_id();

        $customDate = date('Y-m-d', strtotime('2324-01-01'));
        $year = date('Y', strtotime($customDate));
        $id_format = sprintf('%05d', $insert_id);
        $TripsheetNo = "TS/{$Depot}/{$year}/{$id_format}";

        $data2 = array(
            "TripsheetNo" => $TripsheetNo,
        );

        $this->db->where('id', $insert_id);
        $this->db->update('dieselexp', $data2);

        $data3 = array(
            'THCNO' => $THCNO,
            'TripSheetNo' => $TripsheetNo,
            'TSDate' => $BillDate[$key],
            'Tripsheetuser' => $EmpName,
            'Remark' => $Remark[$key],
            'Paymenttype' => $Paymenttype[$key],
            'TripSheetStatus' => 1,
        );

        $this->db->insert('tripsheet', $data3);

        if ($this->db->affected_rows() <= 0) {
            $status = false;
            break;
        }
    }

    $response = array('status' => $status);
    echo json_encode($response);
}

public function Submittripsheet2() {
    $DRSNO = $this->input->post('drsNo');
    $THCNO = $this->input->post('thcNo');
    $Place = $this->input->post('dplace');
    $PPName = $this->input->post('dppname');
    $BillNo = $this->input->post('dbillno');
    $BillDate = $this->input->post('dbilldate');
    $Amount = $this->input->post('damount');
    $Remark = $this->input->post('dremark');
    $DLitre = $this->input->post('dtltr');
    $DRate = $this->input->post('drate');
    $dtamount = $this->input->post('dtamount');
    $Paymenttype = $this->input->post('dpaytype');

    $user = $this->db->query("SELECT `EmpName`, `UserName`, `Designation`, `Depot` FROM employee WHERE EmpID = " . $this->session->userdata('user_id'));
    $user_data = $user->row();
    $Depot = $user_data->Depot;
    $EmpName = $user_data->EmpName;

    $status = true; 

    foreach ($Place as $key => $value) {
        $data1 = array(
            'DRSNO'=>$DRSNO,
            'THCNO' => $THCNO,
            'DLitre' => $DLitre,
            'BillNo'=>$BillNo[$key],
            'Place'=>$Place[$key],
            'DRate'=>$DRate[$key],
            'user'=>$EmpName,
            'PPName'=>$PPName[$key],
            'Amount'=>$Amount[$key],
            'DieselType'=>'Depot',
        );

        $this->db->insert('dieselexp', $data1);
        $insert_id = $this->db->insert_id();

        $customDate = date('Y-m-d', strtotime('2324-01-01'));
        $year = date('Y', strtotime($customDate));
        $id_format = sprintf('%05d', $insert_id);
        $TripsheetNo = "TS/{$Depot}/{$year}/{$id_format}";

        $data2 = array(
            "TripsheetNo" => $TripsheetNo,
        );

        $this->db->where('id', $insert_id);
        $this->db->update('dieselexp', $data2);

        $data3 = array(
            'DRSNO'=>$DRSNO,
            'THCNO' => $THCNO,
            'TripSheetNo' => $TripsheetNo,
            'TSDate' => $BillDate[$key],
            'Tripsheetuser' => $EmpName,
            'Remark' => $Remark[$key],
            'Paymenttype' => $Paymenttype[$key],
            'TripSheetStatus' => 1,
        );

        $this->db->insert('tripsheet', $data3);

        if ($this->db->affected_rows() <= 0) {
            $status = false;
            break;
        }
    }

    $response = array('status' => $status);
    echo json_encode($response);
}


public function Submitnaturexp() {
    $DRSNO = $this->input->post('drsdepo1');

    $data1 = $this->db->query("SELECT * FROM dieselexp WHERE DRSNO = '$DRSNO'");
    $data_drs = $data1->row();

    if (!$data_drs) {
        $response = array('status' => false, 'message' => 'Data not found for DRSNO: ' . $DRSNO);
        echo json_encode($response);
        return;
    }

    $TripsheetNo = $data_drs->TripsheetNo;
    $Id = $data_drs->Id;

    $ExpenseNature = $this->input->post('expnature');
    $BillNo = $this->input->post('billno');
    $BillDate = $this->input->post('billdate');
    $expremark = $this->input->post('expremark');
    $dtltr = $this->input->post('dtltr');
    $Amount = $this->input->post('expamount');
    $Paymenttype = $this->input->post('dpaytype');

    $user = $this->db->query("SELECT `EmpName`, `UserName`, `Designation`, `Depot` FROM employee WHERE EmpID = " . $this->session->userdata('user_id'));
    $user_data = $user->row();
    $Depot = $user_data->Depot;
    $EmpName = $user_data->EmpName;

    $status = true;

    $insert_id = $this->db->insert_id();
    $insert_id=$Id;
    for ($i = 0; $i < count($ExpenseNature); $i++) {
        $data = array(
            'ExpenseNature' => $ExpenseNature[$i],
            'TripsheetNo' => $TripsheetNo,
            'DRSNO' => $DRSNO,
            'BillNo' => $BillNo[$i],
            'BillDate' => $BillDate[$i],
            'Remark' => $expremark[$i],
            'Amount' => $Amount[$i],
            'CreatedDateTime' => $BillDate[$i],
            'TripSheetStatus' => 1,
            'user' => $EmpName,
        );

        $this->db->insert('fintripsheet', $data);

        if ($this->db->affected_rows() <= 0) {
            $status = false;
            break;
        }
    }

    $response = array('status' => $status);
    echo json_encode($response);
}


public function Submitnaturexp1() {
    $THCNO = $this->input->post('thcdepo1');

    $data1 = $this->db->query("SELECT * FROM dieselexp WHERE THCNO = '$THCNO'");
    $data_thc = $data1->row();

    if (!$data_thc) {
        $response = array('status' => false, 'message' => 'Data not found for THCNO: ' . $THCNO);
        echo json_encode($response);
        return;
    }

    $TripsheetNo = $data_thc->TripsheetNo;
    $Id = $data_thc->Id;

    $ExpenseNature = $this->input->post('expnature');
    $BillNo = $this->input->post('billno');
    $BillDate = $this->input->post('billdate');
    $expremark = $this->input->post('expremark');
    $dtltr = $this->input->post('dtltr');
    $Amount = $this->input->post('expamount');
    $Paymenttype = $this->input->post('dpaytype');

    $user = $this->db->query("SELECT `EmpName`, `UserName`, `Designation`, `Depot` FROM employee WHERE EmpID = " . $this->session->userdata('user_id'));
    $user_data = $user->row();
    $Depot = $user_data->Depot;
    $EmpName = $user_data->EmpName;

    $status = true;

    $insert_id = $this->db->insert_id();
    $insert_id=$Id;
    for ($i = 0; $i < count($ExpenseNature); $i++) {
        $data = array(
            'ExpenseNature' => $ExpenseNature[$i],
            'TripsheetNo' => $TripsheetNo,
            'THCNO' => $THCNO,
            'BillNo' => $BillNo[$i],
            'BillDate' => $BillDate[$i],
            'Remark' => $expremark[$i],
            'Amount' => $Amount[$i],
            'CreatedDateTime' => $BillDate[$i],
            'TripSheetStatus' => 1,
            'user' => $EmpName,
        );

        $this->db->insert('fintripsheet', $data);

        if ($this->db->affected_rows() <= 0) {
            $status = false;
            break;
        }
    }

    $response = array('status' => $status);
    echo json_encode($response);
}


public function Submitnaturexp2() {
    $DRSNO = $this->input->post('drsdeponew');
    $THCNO = $this->input->post('thcdeponew');

    $data1 = $this->db->query("SELECT * FROM dieselexp WHERE THCNO = '$THCNO'");
    $data_thc = $data1->row();

    if (!$data_thc) {
        $response = array('status' => false, 'message' => 'Data not found for THCNO: ' . $THCNO);
        echo json_encode($response);
        return;
    }

    $TripsheetNo = $data_thc->TripsheetNo;
    $Id = $data_thc->Id;

    $ExpenseNature = $this->input->post('expnature');
    $BillNo = $this->input->post('billno');
    $BillDate = $this->input->post('billdate');
    $expremark = $this->input->post('expremark');
    $dtltr = $this->input->post('dtltr');
    $Amount = $this->input->post('expamount');
    $Paymenttype = $this->input->post('dpaytype');

    $user = $this->db->query("SELECT `EmpName`, `UserName`, `Designation`, `Depot` FROM employee WHERE EmpID = " . $this->session->userdata('user_id'));
    $user_data = $user->row();
    $Depot = $user_data->Depot;
    $EmpName = $user_data->EmpName;

    $status = true;

    $insert_id = $this->db->insert_id();
    $insert_id=$Id;
    for ($i = 0; $i < count($ExpenseNature); $i++) {
        $data = array(
            'ExpenseNature' => $ExpenseNature[$i],
            'TripsheetNo' => $TripsheetNo,
            'THCNO' => $THCNO,
            'DRSNO' => $DRSNO,
            'BillNo' => $BillNo[$i],
            'BillDate' => $BillDate[$i],
            'Remark' => $expremark[$i],
            'Amount' => $Amount[$i],
            'CreatedDateTime' => $BillDate[$i],
            'TripSheetStatus' => 1,
            'user' => $EmpName,
        );

        $this->db->insert('fintripsheet', $data);

        if ($this->db->affected_rows() <= 0) {
            $status = false;
            break;
        }
    }

    $response = array('status' => $status);
    echo json_encode($response);
}
public function Submitplace(){
    $DRSNO = $this->input->post('drsdepo2');
    $data1 = $this->db->query("SELECT * FROM dieselexp WHERE DRSNO = '$DRSNO'");
    $data_drs = $data1->row();

    if (!$data_drs) {
        $response = array('status' => false, 'message' => 'Data not found for DRSNO: ' . $DRSNO);
        echo json_encode($response);
        return;
    }

    $TripsheetNo = $data_drs->TripsheetNo;

    $Place = $this->input->post('dplace');
    $PPName = $this->input->post('dppname');
    $BillNo = $this->input->post('dbillno');
    $BillDate = $this->input->post('dbilldate');
    $DRate = $this->input->post('drate');
    $DLitre = $this->input->post('dqty2');
    $Amount = $this->input->post('damount1');
    $PayMode = $this->input->post('dpaytype');
    $Remark = $this->input->post('dremark');
    $user = $this->db->query("SELECT `EmpName`, `UserName`, `Designation`, `Depot` FROM employee WHERE EmpID = " . $this->session->userdata('user_id'));
    $user_data = $user->row();
    $Depot = $user_data->Depot;
    $EmpName = $user_data->EmpName;
    $status = true;

    foreach ($Place as $key => $value) {
        $data1 = array(
            'DRSNO' => $DRSNO,
            'TripsheetNo'=>$TripsheetNo,
            'PPName' => $PPName[$key],
            'BillNo'=>$BillNo[$key],
            'BillDate'=>$BillDate[$key],
            'DRate'=>$DRate[$key],
            'DLitre'=>$DLitre[$key],
            'Place'=>$Place[$key],
            'user'=>$EmpName,
            'PPName'=>$PPName[$key],
            'Amount'=>$Amount[$key],
            'PayMode'=>$PayMode[$key],
            'Remark'=>$Remark[$key],
            'DieselType'=>'inroute',
        );

        $this->db->insert('dieselexp', $data1);
        if ($this->db->affected_rows() <= 0) {
            $status = false;
            break;
        }
    }
    $response = array('status' => $status);
    echo json_encode($response);

}

public function Submitplace1(){
    $THCNO = $this->input->post('thcdepo2');
    $data1 = $this->db->query("SELECT * FROM dieselexp WHERE THCNO = '$THCNO'");
    $data_drs = $data1->row();

    if (!$data_drs) {
        $response = array('status' => false, 'message' => 'Data not found for THCNO: ' . $THCNO);
        echo json_encode($response);
        return;
    }

    $TripsheetNo = $data_drs->TripsheetNo;

    $Place = $this->input->post('dplace');
    $PPName = $this->input->post('dppname');
    $BillNo = $this->input->post('dbillno');
    $BillDate = $this->input->post('dbilldate');
    $DRate = $this->input->post('drate');
    $DLitre = $this->input->post('dqty2');
    $Amount = $this->input->post('damount1');
    $PayMode = $this->input->post('dpaytype');
    $Remark = $this->input->post('dremark');
    $user = $this->db->query("SELECT `EmpName`, `UserName`, `Designation`, `Depot` FROM employee WHERE EmpID = " . $this->session->userdata('user_id'));
    $user_data = $user->row();
    $Depot = $user_data->Depot;
    $EmpName = $user_data->EmpName;
    $status = true;

    foreach ($Place as $key => $value) {
        $data1 = array(
            'THCNO' => $THCNO,
            'TripsheetNo'=>$TripsheetNo,
            'PPName' => $PPName[$key],
            'BillNo'=>$BillNo[$key],
            'BillDate'=>$BillDate[$key],
            'DRate'=>$DRate[$key],
            'DLitre'=>$DLitre[$key],
            'Place'=>$Place[$key],
            'user'=>$EmpName,
            'PPName'=>$PPName[$key],
            'Amount'=>$Amount[$key],
            'PayMode'=>$PayMode[$key],
            'Remark'=>$Remark[$key],
            'DieselType'=>'inroute',
        );

        $this->db->insert('dieselexp', $data1);
        if ($this->db->affected_rows() <= 0) {
            $status = false;
            break;
        }
    }
    $response = array('status' => $status);
    echo json_encode($response);

}

public function Submitplace2(){
    $DRSNO = $this->input->post('drsdept');
    $THCNO = $this->input->post('thcdept');
    $data1 = $this->db->query("SELECT * FROM dieselexp WHERE THCNO = '$THCNO'");
    $data_drs = $data1->row();

    if (!$data_drs) {
        $response = array('status' => false, 'message' => 'Data not found for THCNO: ' . $THCNO);
        echo json_encode($response);
        return;
    }

    $TripsheetNo = $data_drs->TripsheetNo;

    $Place = $this->input->post('dplace');
    $PPName = $this->input->post('dppname');
    $BillNo = $this->input->post('dbillno');
    $BillDate = $this->input->post('dbilldate');
    $DRate = $this->input->post('drate');
    $DLitre = $this->input->post('dqty2');
    $Amount = $this->input->post('damount1');
    $PayMode = $this->input->post('dpaytype');
    $Remark = $this->input->post('dremark');
    $user = $this->db->query("SELECT `EmpName`, `UserName`, `Designation`, `Depot` FROM employee WHERE EmpID = " . $this->session->userdata('user_id'));
    $user_data = $user->row();
    $Depot = $user_data->Depot;
    $EmpName = $user_data->EmpName;
    $status = true;

    foreach ($Place as $key => $value) {
        $data1 = array(
            'THCNO' => $THCNO,
            'DRSNO' => $DRSNO,
            'TripsheetNo'=>$TripsheetNo,
            'PPName' => $PPName[$key],
            'BillNo'=>$BillNo[$key],
            'BillDate'=>$BillDate[$key],
            'DRate'=>$DRate[$key],
            'DLitre'=>$DLitre[$key],
            'Place'=>$Place[$key],
            'user'=>$EmpName,
            'PPName'=>$PPName[$key],
            'Amount'=>$Amount[$key],
            'PayMode'=>$PayMode[$key],
            'Remark'=>$Remark[$key],
            'DieselType'=>'inroute',
        );

        $this->db->insert('dieselexp', $data1);
        if ($this->db->affected_rows() <= 0) {
            $status = false;
            break;
        }
    }
    $response = array('status' => $status);
    echo json_encode($response);

}
public function Submitdriverdata() {
    $DRSNO = $this->input->post('drsdepo3');
    $data1 = $this->db->query("SELECT * FROM dieselexp WHERE DRSNO = '$DRSNO'");
    $data_drs = $data1->row();

    if (!$data_drs) {
        $response = array('status' => false, 'message' => 'Data not found for DRSNO: ' . $DRSNO);
        echo json_encode($response);
        return;
    }

    $TripsheetNo = $data_drs->TripsheetNo;
    $MeterReading = $this->input->post('mreading');
    $DriverRating = $this->input->post('driver');
    $Driverid = $this->input->post('driverid');
    $Drivername = $this->input->post('drivername');
    $Adate = $this->input->post('dbilldate');
    $Status = $this->input->post('status');
    $Penalty = $this->input->post('Penalty');
    $Remark = $this->input->post('Remark');

    $user = $this->db->query("SELECT `EmpName`, `UserName`, `Designation`, `Depot` FROM employee WHERE EmpID = " . $this->session->userdata('user_id'));
    $user_data = $user->row();
    $Depot = $user_data->Depot;
    $EmpName = $user_data->EmpName;
    $status = true;

    $data1 = array(
        "TripshhetNo" => $TripsheetNo,
        "Driverid" => $Driverid,
        "Drivername" => $Drivername,
        "Adate" => $Adate,
        "Status" => $Status,
    );
    $this->db->insert('tripsheetdriverattendance', $data1);

    $data2 = array(
        "MeterReading" => $MeterReading,
        "DriverRating" => $DriverRating,
        "Penalty"=>$Penalty,
    );
    $this->db->where('TripSheetNo', $TripsheetNo);
    $this->db->update('tripsheet', $data2);

    $data3 = array(
        "MeterReading" => $MeterReading,
    );
    $this->db->where('TripsheetNo', $TripsheetNo);
    $this->db->update('dieselexp', $data3);

    $response = array('status' => $status);
    echo json_encode($response);
}

public function Submitdriverdata1() {
    $THCNO = $this->input->post('thcdepo3');
    $data1 = $this->db->query("SELECT * FROM dieselexp WHERE THCNO = '$THCNO'");
    $data_drs = $data1->row();

    if (!$data_drs) {
        $response = array('status' => false, 'message' => 'Data not found for THCNO: ' . $THCNO);
        echo json_encode($response);
        return;
    }

    $TripsheetNo = $data_drs->TripsheetNo;
    $MeterReading = $this->input->post('mreading');
    $DriverRating = $this->input->post('driver');
    $Driverid = $this->input->post('driverid');
    $Drivername = $this->input->post('drivername');
    $Adate = $this->input->post('dbilldate');
    $Status = $this->input->post('status');
    $Penalty = $this->input->post('Penalty');
    $Remark = $this->input->post('Remark');

    $user = $this->db->query("SELECT `EmpName`, `UserName`, `Designation`, `Depot` FROM employee WHERE EmpID = " . $this->session->userdata('user_id'));
    $user_data = $user->row();
    $Depot = $user_data->Depot;
    $EmpName = $user_data->EmpName;
    $status = true;

    $data1 = array(
        "TripshhetNo" => $TripsheetNo,
        "Driverid" => $Driverid,
        "Drivername" => $Drivername,
        "Adate" => $Adate,
        "Status" => $Status,
    );
    $this->db->insert('tripsheetdriverattendance', $data1);

    $data2 = array(
        "MeterReading" => $MeterReading,
        "DriverRating" => $DriverRating,
        "Penalty"=>$Penalty,
    );
    $this->db->where('TripSheetNo', $TripsheetNo);
    $this->db->update('tripsheet', $data2);

    $data3 = array(
        "MeterReading" => $MeterReading,
    );
    $this->db->where('TripsheetNo', $TripsheetNo);
    $this->db->update('dieselexp', $data3);

    $response = array('status' => $status);
    echo json_encode($response);
}

public function Submitdriverdata2() {
    $THCNO = $this->input->post('thcdepo3');
    $DRSNO = $this->input->post('thcdepo3');
    $data1 = $this->db->query("SELECT * FROM dieselexp WHERE THCNO = '$THCNO'");
    $data_drs = $data1->row();

    if (!$data_drs) {
        $response = array('status' => false, 'message' => 'Data not found for THCNO: ' . $THCNO);
        echo json_encode($response);
        return;
    }

    $TripsheetNo = $data_drs->TripsheetNo;
    $MeterReading = $this->input->post('mreading');
    $DriverRating = $this->input->post('driver');
    $Driverid = $this->input->post('driverid');
    $Drivername = $this->input->post('drivername');
    $Adate = $this->input->post('dbilldate');
    $Status = $this->input->post('status');
    $Penalty = $this->input->post('Penalty');
    $Remark = $this->input->post('Remark');

    $user = $this->db->query("SELECT `EmpName`, `UserName`, `Designation`, `Depot` FROM employee WHERE EmpID = " . $this->session->userdata('user_id'));
    $user_data = $user->row();
    $Depot = $user_data->Depot;
    $EmpName = $user_data->EmpName;
    $status = true;

    $data1 = array(
        "TripshhetNo" => $TripsheetNo,
        "Driverid" => $Driverid,
        "Drivername" => $Drivername,
        "Adate" => $Adate,
        "Status" => $Status,
    );
    $this->db->insert('tripsheetdriverattendance', $data1);

    $data2 = array(
        "MeterReading" => $MeterReading,
        "DriverRating" => $DriverRating,
        "Penalty"=>$Penalty,
    );
    $this->db->where('TripSheetNo', $TripsheetNo);
    $this->db->update('tripsheet', $data2);

    $data3 = array(
        "MeterReading" => $MeterReading,
    );
    $this->db->where('TripsheetNo', $TripsheetNo);
    $this->db->update('dieselexp', $data3);

    $response = array('status' => $status);
    echo json_encode($response);
}

public function DRSNext() {
    $DRSNO = $this->input->post('drs');

    if (!empty($DRSNO)) {
        $sanitizedDRSNO = $this->security->xss_clean($DRSNO);
        $query = $this->db->get_where('vtcpod1', array('DRSNO' => $sanitizedDRSNO));
        
        if ($query->num_rows() > 0) {
            $row = $query->row_array();
            $response = array(
                'data' => $row,
                'error' => null
            );
            header('Content-Type: application/json');
            echo json_encode($response);
        } else {
            $response = array(
                'data' => null,
                'error' => 'DRSNO not found'
            );

            header('Content-Type: application/json');
            echo json_encode($response);
        }
    } else {
        $response = array(
            'data' => null,
            'error' => 'DRSNO is empty'
        );
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}


public function THCNext() {
    $THCNO = $this->input->post('thc');

    if (!empty($THCNO)) {
        $sanitizedTHCNO = $this->security->xss_clean($THCNO);
        $query = $this->db->get_where('thc', array('THCNO' => $sanitizedTHCNO));
        
        if ($query->num_rows() > 0) {
            $row = $query->row_array();
            $response = array(
                'data' => $row,
                'error' => null
            );
            header('Content-Type: application/json');
            echo json_encode($response);
        } else {
            $response = array(
                'data' => null,
                'error' => 'THCNO not found'
            );

            header('Content-Type: application/json');
            echo json_encode($response);
        }
    } else {
        $response = array(
            'data' => null,
            'error' => 'THCNO is empty'
        );
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}

public function showDRSTHCTables() {
    $DRSNO = $this->input->post('bothdrs');
    $THCNO = $this->input->post('boththc');
    $date = $this->input->post('dbilldate');

    $data_drs = $this->db->query("SELECT DRSNO, drsdate FROM `vtcpod1` WHERE `DRSNO` = '$DRSNO' AND `drsdate` = '$date'");
    $datadrs = $data_drs->row();

    if (!$datadrs) {
        $response['error'] = true;
        $response['message'] = "Data for DRS not found";
        echo json_encode($response);
        return;
    }

    $drsno = $datadrs->DRSNO;
    $Date = $datadrs->drsdate;

    $data_thc = $this->db->query("SELECT THCNO, drsdate FROM `thc` WHERE `THCNO` = '$THCNO' AND `drsdate` = '$date'");
    $datathc = $data_thc->row();

    if (!$datathc) {
        $response['error'] = true;
        $response['message'] = "Data for THC not found";
        echo json_encode($response);
        return;
    }

    $thcno = $datathc->THCNO;
    $Date1 = $datathc->drsdate;

    if ($Date1 == $Date) {
        $datadrsnew = $this->db->query("SELECT ToPay, LRHamali, FreightCharge, Advance, ExtraDeliveryCharge, OtherCharges FROM `vtcpod1` WHERE `DRSNO` = '$DRSNO' AND `drsdate` = '$date'")->row();
        $datathcnew = $this->db->query("SELECT OtherCharges, ExtraDeliveryCharge, Advance, FreightCharge, THCArrivalHvendor, LRHamali, ToPay FROM `thc` WHERE `THCNO` = '$THCNO' AND `drsdate` = '$date'")->row();
        
        $response = array('ToPay' => $datadrsnew->ToPay, 'LRHamali' => $datadrsnew->LRHamali, 'FreightCharge' => $datadrsnew->FreightCharge, 'Advance' => $datadrsnew->Advance, 'ExtraDeliveryCharge' => $datadrsnew->ExtraDeliveryCharge, 'OtherCharges' => $datadrsnew->OtherCharges, 'THCArrivalHvendor' => $datathcnew->THCArrivalHvendor);
        
        echo json_encode($response);
        return;
    } else {
        $response['error'] = true;
        $response['message'] = "Date mismatch between DRS and THC";
        echo json_encode($response);
        return;
    }
}

public function podstatement(){
    $this->load->model('Auth_model');
    $keyword = $this->input->post('keyword');
    $user = $this->db->query("SELECT `EmpName`,`UserName`,`Designation`,`Depot` FROM employee WHERE EmpID = " . $this->session->userdata('user_id'));
    $user_data = $user->row();
    $Depot = $user_data->Depot;
    $data['user']=$this->Auth_model->user_data($this->session->userdata('user_id'));
    $data['country1']=$this->Auth_model->customerspod();
    $data['country']=$this->Auth_model->get_data($this->session->userdata('user_id'));
    $data['header']='frontend/header';
    $data['body'] = 'frontend/podstatement';
    $data['sidebar']='frontend/sidebar';
    $data['footer']='frontend/footer';
    $data['meta'] = array('title'=>'HOME |NSLINDIA','page_title'=>'lrgeneration');
    $this->load->view('frontend/backend_template', $data);
}

public function podsearch()
{
    $date1 = $this->input->post('d1');
    $date2 = $this->input->post('d2');
    $depo = $this->input->post('poddepo');
    $Consigner = $this->input->post('Consigner');
    $whereClause = array();

    if (!empty($date1)) {
        $whereClause[] = "drsdate >= '$date1'";
    }

    if (!empty($date2)) {
        $whereClause[] = "drsdate <= '$date2'";
    }

    if (!empty($depo)) {
        $whereClause[] = "Place = '$depo'";
    }

    if (!empty($Consigner)) {
        $whereClause[] = "Consignor = '$Consigner'";
    }

    $whereCondition = implode(' AND ', $whereClause);

    $query = $this->db->query("SELECT LRNO, DRSNO, drsdate, Consignor FROM `vtcpod1` WHERE $whereCondition");
    $datavtc = $query->result_array();

    $response = array(
        'data' => $datavtc,
    );

    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}








}

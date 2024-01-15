<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as excel;

class ExcelController extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function excellr(){
        $this->load->model('Auth_model');
        $data['user'] = $this->Auth_model->user_data($this->session->userdata('user_id'));
        $data['header'] = 'frontend/header';
        $data['body'] = 'frontend/exceluploadlr';
        $data['sidebar'] = 'frontend/sidebar';
        $data['footer'] = 'frontend/footer';
        $data['meta'] = array('title' => 'HOME |NSLINDIA', 'page_title' => 'lrgeneration');
        $this->load->view('frontend/backend_template', $data);
    }

    public function exceldownload(){
        $this->load->helper('download');

        $file_path = FCPATH . 'uploads/Book1.xlsx';

        if (file_exists($file_path)) {
            $data = file_get_contents($file_path);
            $name = 'Book1.xlsx';
            force_download($name, $data);
        } else {
            show_error("File not found");
        }
    }

    public function Excelforminsert()
    {
        $LRDate = $this->input->post('pt2');
        $ConsignorId = $this->input->post('pt4');
        $PayBasis = $this->input->post('pt');
        $Consignor = $this->input->post('pt5');
        $mot = $this->input->post('mot');
        $servicetype = $this->input->post('servicetype');
        $pickdeli = $this->input->post('pickdeli');
        $fromcity = $this->input->post('fromcity');
        $contractxl = $this->input->post('excel_file');
        $user = $this->db->query("SELECT `EmpName`,`UserName`,`Designation`,`Depot` FROM employee WHERE EmpID = " . $this->session->userdata('user_id'));
        $user_data = $user->row();
        $Depot = $user_data->Depot;
        $EmpName = $user_data->EmpName;

        $dataslab = $this->fetchDataFromModel($ConsignorId);
        $dataslab1 = $this->fetchdatafrommodelnew($ConsignorId);

        $query = $this->db->query("SELECT `CustCode`, `CustName`, `Address`, `MobileNo` FROM Customers WHERE CustCode = ?", array($Consignor));
        $data['customerparty'] = $query->result_array();

        $coastcenterCode = "";

        if ($PayBasis == "TO PAY") {
            $coastcenterCode = "CCPTOP01";
        } elseif ($PayBasis == "PAID") {
            $coastcenterCode = "CCPPAI01";
        }

        $ConsignorAdd = "";
        $ConsignorMob = "";
        $ConsignorId = "";
        $ConsigneeId = "";

        if ($PayBasis == "TO PAY") {
            $Consignor = $this->input->post('FMConsignor');
            $ConsignorAdd = $this->input->post('WIConsignoradd');
            $ConsignorMob = $this->input->post('WIConsignormob');
            $ConsignorId = 8888;
            $ConsigneeId = 8888;
        } elseif ($PayBasis == "TBB") {
            $query = $this->db->query("SELECT `CustCode`,`CostCenter`, `CustName`, `Address`, `MobileNo` FROM Customers WHERE CustCode = ?", array($Consignor));
            $result = $query->row();

            if ($result) {
                $ConsignorAdd = $result->Address;
                $ConsignorMob = $result->MobileNo;
                $coastcenterCode = $result->CostCenter;
                $ConsignorId = $result->CustCode;
                $ConsigneeId = 8888;
                $Consignor = $result->CustName;
            } else {
                $ConsignorAdd = "Address not found";
                $ConsignorMob = "MobileNo not found";
                $coastcenterCode = "Default Value";
                $ConsignorId = "Default Value";
                $ConsigneeId = "Default Value or Error Message";
                $Consignor = "Default Value or Error Message";
            }
        }

        if (!empty($_FILES["excel_file"]["name"])) {
            $excelFileName = basename($_FILES["excel_file"]["name"]);
            $excelFileType = pathinfo($excelFileName, PATHINFO_EXTENSION);
            $allowExcelTypes = array('xlsx', 'xls');

            if (in_array($excelFileType, $allowExcelTypes)) {
                $excelFileName = $_FILES['excel_file']['name'];
                $excelTmpName = $_FILES['excel_file']['tmp_name'];
                $excelPath = "uploads/" . $excelFileName;

                if (move_uploaded_file($excelTmpName, $excelPath)) {
                    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($excelPath);
                    $worksheet = $spreadsheet->getActiveSheet();

                    $excel_data = $worksheet->toArray(null, true, true, true);

                    if (!empty($excel_data)) {
                        $allData = [];
                        $invoiceNumbers = array();

                        foreach ($excel_data as $key => $row) {
                            $data = [
                                'InvoiceNo' => isset($row['B']) ? $row['B'] : null,
                                'Consignee' => isset($row['C']) ? $row['C'] : null,
                                'ToPlace' => isset($row['D']) ? $row['D'] : null,
                                'PkgsNo' => isset($row['G']) ? $row['G'] : null,
                                'EDD' => isset($row['J']) ? $row['J'] : null,
                                'ConsigneeMob' => isset($row['K']) ? $row['K'] : null,
                                'CSGSTAmount' => isset($row['L']) ? $row['L'] : null,
                                'EWBNo' => isset($row['M']) ? $row['M'] : null,
                                'ConsigneeAdd' => isset($row['N']) ? $row['N'] : null,
                            ];

                            $allData[] = $data;

                            if (!in_array($data['InvoiceNo'], $invoiceNumbers)) {
                                $invoiceNumbers[] = $data['InvoiceNo'];
                                $next_lr = '';
                                $data_merged = array(
                                    "Destination" => $Depot,
                                    "LRDate" => $LRDate,
                                    "Status" => 1,
                                    "Origin" => $Depot,
                                    "CurrentLocation" => $Depot,
                                    "CreatedBy" => $EmpName,
                                    "FromPlace" => $Depot,
                                    // "ConsignorMob" => $ConsignorMob,
                                    "CoastCenter" => $coastcenterCode,
                                    "ConsigneeId" => $ConsigneeId,
                                    // "ConsignorAdd" => $ConsignorAdd,
                                    "PayBasis" => $PayBasis,
                                    "Consignor" => $Consignor,
                                    "ConsignorId" => $ConsignorId,
                                    "mot" => $mot,
                                    "servicetype" => $servicetype,
                                ) + $data;

                                $this->db->insert('lr', $data_merged);
                                $insert_id = $this->db->insert_id();

                                $this->updateLRNO($insert_id, $next_lr);

                                if (isset($dataslab[$data['InvoiceNo']]['ContractId'])) {
                                    $contractId = $dataslab[$data['InvoiceNo']]['ContractId'];
                                }

                                if (isset($dataslab1[$data['InvoiceNo']]['PkgsNo'])) {
                                    $pkgsNo = $dataslab1[$data['InvoiceNo']]['PkgsNo'];

                                    if ($pkgsNo > 1 && $pkgsNo <= 100) {
                                        $freightRate = $item['Slab1'];
                                        $freightType = "perkg";
                                        $freightTotal = $freightRate * $item['ActwtperPkg'];

                                        $insertFreightData = array(
                                            'freightRate' => $freightRate,
                                            'freightType' => $freightType,
                                            'freightTotal' => $freightTotal,
                                        );

                                        $this->db->insert('your_freight_table_name', $insertFreightData);
                                    }
                                }

                                $existingLRNO = $this->getLRNOByInvoiceNoInExcel($excel_data, $data['InvoiceNo']);

                                $lrdetails_data = array(
                                    "LRNO" => $next_lr,
                                    'PkgType' => isset($row['H']) ? $row['H'] : null,
                                    'InvDate' => isset($row['A']) ? $row['A'] : null,
                                    'InvoiceNo' => isset($row['B']) ? $row['B'] : null,
                                    'PkgsNo' => isset($row['G']) ? $row['G'] : null,
                                    'ActwtperPkg' => isset($row['F']) ? $row['F'] : null,
                                );

                                $pkg = $lrdetails_data['PkgsNo'];
                                $actwtperPkg = $lrdetails_data['ActwtperPkg'];

                                $this->db->insert('lrdetails', $lrdetails_data);
                                $insert_id = $this->db->insert_id();

                                $this->updateLRNO($insert_id, $next_lr);
                            } else {
                                $response = array('msg' => 'Error uploading Excel file', 'status' => false);
                                echo json_encode($response);
                                return;
                            }
                        }
                    } else {
                        $response = array('msg' => 'Error uploading Excel file', 'status' => false);
                        echo json_encode($response);
                        return;
                    }
                } else {
                    $response = array('msg' => 'Invalid Excel file format', 'status' => false);
                    echo json_encode($response);
                    return;
                }
            } else {
                $response = array('msg' => 'Excel file not provided', 'status' => false);
                echo json_encode($response);
                return;
            }
        }
    }




    private function updateLRNO($insert_id, $next_lr)
    {
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

        $data1 = array(
            "LRNO" => $next_lr,
        );
        $this->db->where('id', $insert_id);
        $this->db->update('lr', $data1);

        $data2 = array(
            "LRNO" => $next_lr,
        );
        $this->db->where('id', $insert_id); 
        $this->db->update('lrdetails', $data2);
    }

    private function getLRNOByInvoiceNoInExcel($excel_data, $invoiceNo)
    {
        foreach ($excel_data as $row) {
            if (isset($row['InvoiceNo']) && $row['InvoiceNo'] == $invoiceNo && isset($row['LRNO'])) {
                return $row['LRNO'];
            }
        }
        return null;
    }



    private function fetchDataFromModel($ConsignorId) {
        $query = "SELECT `Id`, `ContractID`, `CustCode`, `CustName`, `FromPlace`, `ToPlace`, `TransitDay`, `Slab1`, `Slab2`, `Slab3`, `Slab4`, `Slab5`, `Slab6`, `Slab7`, `Slab8`, `Zone` 
        FROM `ltlslab` 
        WHERE `ContractID` = ?";
        $result = $this->db->query($query, array($ConsignorId));
        $dataslab = $result->result_array();

        return $dataslab; 
    }

    private function fetchdatafrommodelnew($ConsignorId)
    {
     $query1= "SELECT `id`, `ContractID`, `ConsignorCode`, `ConsignorName`, `ContractType`, `Product`, `ServiceType`, `RateTypesAllowed`, `MatricesAllowed`, `PickupDelivery`, `FreightDiscountAllowed`, `DiscountRate`, `DiscountRateType`, `Discount`, `DeliveryReattempt`, `DeliveryReattemptRate`, `ExcessWeight`, `DemuBillGen`, `DemuBillGenType`, `FreeStorageDays`, `MinDemuCharge`, `DemurrageRate`, `DemurrageRateType`, `MaxDemuCharge`, `FuelSurcharges`, `OctroiSurcharges`, `SKUWise`, `TaxPayer`, `DocumentCharges`, `Doordeliverycharge`, `SlabRangeType` FROM `serviceselection` WHERE `ContractID` = ?";
     $result1 = $this->db->query($query1, array($ConsignorId));
     $dataslab1 = $result1->result_array();
     return $dataslab1; 
 }




}

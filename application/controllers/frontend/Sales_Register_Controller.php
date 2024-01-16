<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Sales_Register_Controller extends CI_Controller {

    public function sales_register() {
        $this->load->model('Auth_model');
        $data['user'] = $this->Auth_model->user_data($this->session->userdata('user_id'));
        $this->load->view('frontend/sales_register', $data);
    }

    public function search()
    {
        $searchTerm = $this->input->get('term');
        $data = $this->getAutocompleteData($searchTerm);

        $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
    }

    private function getAutocompleteData($searchTerm)
    {
        $this->load->database(); 
        $query = $this->db
        ->select('CustCode, CustName')
        ->group_start()
        ->like('CustName', $searchTerm)
        ->or_like('CustCode', $searchTerm)
        ->group_end()
        ->where('Status', '1')
        ->limit(10)
        ->get('customers');

        $data = $query->result_array();
        return $data;
    }

    public function searchdata()
    {
        $this->load->model('Auth_model');
        $Consignor = $this->input->post('CustName');
        $from = $this->input->post('from');
        $to = $this->input->post('to');
        $data['user'] = $this->Auth_model->user_data($this->session->userdata('user_id'));
        $this->load->model('Sales_Register_Model');
        $data['lr'] = $this->Sales_Register_Model->get_lr_data1($Consignor, $from, $to);
        $this->load->view('frontend/date_vi_lr', $data);

    }

    public function xlsxdata()
    {
        try {
            $Consignor = $this->input->post('CustName');
            $from = $this->input->post('from');
            $to = $this->input->post('to');
            $selectedColumns = $this->input->post('check'); 

            $this->load->model('Sales_Register_Model');
            $data['lr'] = $this->Sales_Register_Model->get_lr_data2($Consignor, $from, $to);

            $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            $sheet->getColumnDimension('A')->setWidth(15);
            $sheet->getColumnDimension('B')->setWidth(15);

            $columnIndex = 1;
            foreach ($selectedColumns as $columnName) {
                $sheet->setCellValueByColumnAndRow($columnIndex, 1, $columnName);
                $columnIndex++;
            }

            $row = 2;
            foreach ($data['lr'] as $item) {
                $columnIndex = 1;
                foreach ($selectedColumns as $columnName) {
                    $cellValue = property_exists($item, $columnName) ? $item->$columnName : '';
                    $sheet->setCellValueByColumnAndRow($columnIndex, $row, $cellValue);
                    $columnIndex++;
                }
                $row++;
            }

            $filename = 'exported_data.xlsx';

            ob_clean();

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            header('Cache-Control: max-age=0');

            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
            $writer->save('php://output');
            exit;
        } catch (\Exception $e) {
            echo 'Error: ' . $e->getMessage() . '<br>';
            echo 'Trace: ' . $e->getTraceAsString();
        }
    }


    public function allStickerPrint()
    {
        if ($this->input->post('submit')) {
            $selectedLRNOs = $this->input->post('LRNO');
            $this->load->model('Sales_Register_Model');
            $barcodeImages = $this->Sales_Register_Model->generateMultipleBarcodes($selectedLRNOs);
            $filteredBarcodeImages = array_intersect_key($barcodeImages, array_flip($selectedLRNOs));
            $lrData = array_map([$this->Sales_Register_Model, 'getSelectedLRData'], $selectedLRNOs);
            $data['barcodeImages'] = $filteredBarcodeImages;
            $data['lrData'] = is_array($lrData) ? $lrData : array();
            $this->load->view('frontend/print_sticker_view', $data);
        }
    }

public function cp_sales_register() {
        $this->load->model('Auth_model');
        $data['user'] = $this->Auth_model->user_data($this->session->userdata('user_id'));
        $this->load->view('frontend/cp_sales_register', $data);
    }


public function searchdata1()
    {
        $this->load->model('Auth_model');
        $Consignor = $this->input->post('CustName');
        $from = $this->input->post('from');
        $to = $this->input->post('to');
        $data['user'] = $this->Auth_model->user_data($this->session->userdata('user_id'));
        $this->load->model('Sales_Register_Model');
        $data['lr'] = $this->Sales_Register_Model->get_lr_data11($Consignor, $from, $to);
        $this->load->view('frontend/cp_date_vi_lr', $data);

    }

public function allStickerPrintcp()
{
    if ($this->input->post('submit')) {
        $selectedLRNOs = $this->input->post('LRNO');
        $this->load->model('Sales_Register_Model');

        $barcodeImages1 = $this->Sales_Register_Model->generateMultipleBarcodescp($selectedLRNOs);
        $filteredBarcodeImages1 = array_intersect_key($barcodeImages1, array_flip($selectedLRNOs));
        $lrData1 = array_map([$this->Sales_Register_Model, 'getSelectedLRDatacp'], $selectedLRNOs);

        $data['barcodeImages1'] = $filteredBarcodeImages1;
        // print_r($filteredBarcodeImages1);
        // exit();
        $data['lrData1'] = is_array($lrData1) ? $lrData1 : array();
        //  print_r($data['lrData1']);
        // exit();

        $this->load->view('frontend/print_sticker_view_cp', $data);
    }
}
 public function xlsxdata1() {
        try {
            $Consignor = $this->input->post('CustName');
            $from = $this->input->post('from');
            $to = $this->input->post('to');
            $selectedColumns = $this->input->post('check');

            $this->load->model('Sales_Register_Model');
            $data['lr'] = $this->Sales_Register_Model->get_lr_data22($Consignor, $from, $to);

            // Load the PhpSpreadsheet library
            require 'vendor/autoload.php';

            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            $sheet->getColumnDimension('A')->setWidth(15);
            $sheet->getColumnDimension('B')->setWidth(15);

            $columnIndex = 1;
            foreach ($selectedColumns as $columnName) {
                $sheet->setCellValueByColumnAndRow($columnIndex, 1, $columnName);
                $columnIndex++;
            }

            $row = 2;
            foreach ($data['lr'] as $item) {
                $columnIndex = 1;
                foreach ($selectedColumns as $columnName) {
                    $cellValue = property_exists($item, $columnName) ? $item->$columnName : '';
                    $sheet->setCellValueByColumnAndRow($columnIndex, $row, $cellValue);
                    $columnIndex++;
                }
                $row++;
            }

            $filename = 'exported_data.xlsx';

            ob_clean();

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            header('Cache-Control: max-age=0');

            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
            exit;
        } catch (\Exception $e) {
            echo 'Error: ' . $e->getMessage() . '<br>';
            echo 'Trace: ' . $e->getTraceAsString();
        }
    }
// =======================================================

    public function DRS_sales_register() {
        $this->load->model('Auth_model');
        $data['user'] = $this->Auth_model->user_data($this->session->userdata('user_id'));
        $this->load->view('frontend/DRS_sales_register', $data);
    }


   public function xlsxdata2() {
    try {
        $Consignor = $this->input->post('CustName');
        $from = $this->input->post('from');
        $to = $this->input->post('to');
        $selectedColumns = $this->input->post('check');

        $this->load->model('Sales_Register_Model');
        $data['lr'] = $this->Sales_Register_Model->get_lr_data23($Consignor, $from, $to);

        // Load the PhpSpreadsheet library
        require 'vendor/autoload.php';

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->getColumnDimension('A')->setWidth(15);
        $sheet->getColumnDimension('B')->setWidth(15);

        $columnIndex = 1;
        foreach ($selectedColumns as $columnName) {
            $sheet->setCellValueByColumnAndRow($columnIndex, 1, $columnName);
            $columnIndex++;
        }

        $row = 2;
        foreach ($data['lr'] as $item) {
            $columnIndex = 1;
            foreach ($selectedColumns as $columnName) {
                if ($columnName === 'Verified') {
                    $cellValue = $item->$columnName == 1 ? 'uploaded' : 'pending';
                } else if ($columnName === 'Status') {
                    switch ($item->Status) {
                        case 1:
                            $cellValue = "Stock and Available for DRS/THC at";
                            break;
                        case 2:
                            $cellValue = "Cancelled";
                            break;
                        case 3:
                            $cellValue = "Gone For Delivery vide DRS No. ";
                            break;
                        case 4:
                            $cellValue = "In Transit";
                            break;
                        case 5:
                            $cellValue = "Delivered At Rec. By Customer";
                            break;
                        case 6:
                            $cellValue = "UnDelivered vide DRS No. Stock and Available for DRS at";
                            break;
                        case 7:
                            $cellValue = "Stock and Available for DRS/THC at .UNDER PRN";
                            break;
                        case 8:
                            $cellValue = "Stock and Available for DRS at .UNDER LOADINGSHEET ";
                            break;
                        case 9:
                            $cellValue = "Stock and Available for THC at UNDER LOADINGSHEET ";
                            break;
                        default:
                            $cellValue = ""; // Default case if none of the above conditions match
                            break;
                    }
                } else {
                    $cellValue = property_exists($item, $columnName) ? $item->$columnName : '';
                }

                $sheet->setCellValueByColumnAndRow($columnIndex, $row, $cellValue);
                $columnIndex++;
            }
            $row++;
        }

        $filename = 'exported_data.xlsx';

        ob_clean();

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    } catch (\Exception $e) {
        echo 'Error: ' . $e->getMessage() . '<br>';
        echo 'Trace: ' . $e->getTraceAsString();
    }
}
// ====================================
 public function THC_sales_register() {
        $this->load->model('Auth_model');
        $data['user'] = $this->Auth_model->user_data($this->session->userdata('user_id'));
        $this->load->view('frontend/THC_sales_register', $data);
    }

 public function xlsxdata3() {
        try {
            $Consignor = $this->input->post('CustName');
            $from = $this->input->post('from');
            $to = $this->input->post('to');
            $selectedColumns = $this->input->post('check');

            $this->load->model('Sales_Register_Model');
            $data['lr'] = $this->Sales_Register_Model->get_lr_data24($Consignor, $from, $to);

            // Load the PhpSpreadsheet library
            require 'vendor/autoload.php';

            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            $sheet->getColumnDimension('A')->setWidth(15);
            $sheet->getColumnDimension('B')->setWidth(15);

            $columnIndex = 1;
            foreach ($selectedColumns as $columnName) {
                $sheet->setCellValueByColumnAndRow($columnIndex, 1, $columnName);
                $columnIndex++;
            }

            $row = 2;
            foreach ($data['lr'] as $item) {
                $columnIndex = 1;
                foreach ($selectedColumns as $columnName) {
                    $cellValue = property_exists($item, $columnName) ? $item->$columnName : '';
                    $sheet->setCellValueByColumnAndRow($columnIndex, $row, $cellValue);
                    $columnIndex++;
                }
                $row++;
            }

            $filename = 'exported_data.xlsx';

            ob_clean();

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            header('Cache-Control: max-age=0');

            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
            exit;
        } catch (\Exception $e) {
            echo 'Error: ' . $e->getMessage() . '<br>';
            echo 'Trace: ' . $e->getTraceAsString();
        }
    }
}
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






}
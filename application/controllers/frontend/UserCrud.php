<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class UserCrud extends CI_Controller {

    public function user_view() {
        $this->load->model('Auth_model');
        $data['user'] = $this->Auth_model->user_data($this->session->userdata('user_id'));
        $this->load->model('UserModel');
        $data['sparepart'] = $this->UserModel->get_all(); 
        $this->load->view('frontend/user_view', $data);
    }
// =============================    =======
    public function create()
{
     $this->load->model('Auth_model');
      $data['user']=$this->Auth_model->user_data($this->session->userdata('user_id'));
    $this->load->view('frontend/add_user',$data);
}
// ==================================
public function Store()
    {
$this->load->model('Auth_model');
      $data['user']=$this->Auth_model->user_data($this->session->userdata('user_id'));
        $this->load->model('UserModel');
        $userModel = new UserModel();
        $data = [
            'pname' => $this->input->post('pname'),  
            'pdesc' => $this->input->post('pdesc'),
        ];
        $userModel->insert($data);
        return redirect ('user_view'); 
    }
// ================================
    public function singleUser($id = null)
{
    $this->load->model('Auth_model');
      $data['user']=$this->Auth_model->user_data($this->session->userdata('user_id'));
    $this->load->model('UserModel');
    $userModel = new UserModel();
    $data['user_obj'] = $userModel->getSingleUser($id); 
    $this->load->view('frontend/edit_view', $data);
}
// =====================================
public function update()
{

    $this->load->model('UserModel');
    $userModel = new UserModel();
    $id = $this->input->post('id');
    $data = [
        'pname' => $this->input->post('pname'),
        'pdesc' => $this->input->post('pdesc'),
    ];
    $update_result = $userModel->update_data($id, $data);
    if ($update_result) {
        return redirect('user_view'); 
    } else {
        echo "Update failed!";
    }
}
// ========================================
     public function delete1($id = null) {
        $this->load->model('UserModel');
        $this->UserModel->delete_user($id); 
        return redirect('user_view'); 

    }
// ===========================================================================================================
     public function VehicleIncidentTracker_view() {
        echo 'jsgfjgha';
        $this->load->model('Auth_model');
        $data['user'] = $this->Auth_model->user_data($this->session->userdata('user_id'));
        $this->load->model('VehicleIncidentTrackerModel');
        $data['sparepart'] = $this->VehicleIncidentTrackerModel->get_all(); 
        $this->load->view('frontend/VehicleIncidentTracker_view', $data);
    }
// ====================================
    public function create1()
{
     $this->load->model('Auth_model');
      $data['user']=$this->Auth_model->user_data($this->session->userdata('user_id'));
    $this->load->view('frontend/VehicleIncidentTracker_add',$data);
}
// // ==================================
public function Store1()
    {
$this->load->model('Auth_model');
      $data['user']=$this->Auth_model->user_data($this->session->userdata('user_id'));
        $this->load->model('VehicleIncidentTrackerModel');
        $VehicleIncidentTrackerModel = new VehicleIncidentTrackerModel();
        $data = [
            'IncidentType' => $this->input->post('IncidentType'),  
            'IncidentLocation' => $this->input->post('IncidentLocation'),
            'incidenttime' => $this->input->post('incidenttime'),  
            'AffectedPart' => $this->input->post('AffectedPart'),
            'Vehicleno' => $this->input->post('Vehicleno'),  
            'DriverName' => $this->input->post('DriverName'),
            'Assignedperson' => $this->input->post('Assignedperson'),  
            'CosttoIncident' => $this->input->post('CosttoIncident'),
            'Correctiveaction' => $this->input->post('Correctiveaction'),  
            'WorkCompletedateandtime' => $this->input->post('WorkCompletedateandtime'),
            'Remarkindetails' => $this->input->post('Remarkindetails'),  
             'Status' => 1,      
            ];
        $VehicleIncidentTrackerModel->insert($data);
        return redirect ('VehicleIncidentTracker_view'); 
    }
// // ================================
    public function singleUser1($id = null)
{
    $this->load->model('Auth_model');
      $data['user']=$this->Auth_model->user_data($this->session->userdata('user_id'));
    $this->load->model('VehicleIncidentTrackerModel');
    $VehicleIncidentTrackerModel = new VehicleIncidentTrackerModel();
    $data['user_obj'] = $VehicleIncidentTrackerModel->getSingleUser1($id); 
    $this->load->view('frontend/VehicleIncidentTracker_edit', $data);
}
// // =====================================
public function update1()
{
    $this->load->model('VehicleIncidentTrackerModel');
    $VehicleIncidentTrackerModel = new VehicleIncidentTrackerModel(); // Corrected variable name
    $id = $this->input->post('id');
    $data = [
        'IncidentType' => $this->input->post('IncidentType'),
        'IncidentLocation' => $this->input->post('IncidentLocation'),
        // 'incidenttime' => $this->input->post('incidenttime'),
        'AffectedPart' => $this->input->post('AffectedPart'),
        'Vehicleno' => $this->input->post('Vehicleno'),
        'DriverName' => $this->input->post('DriverName'),
        'Assignedperson' => $this->input->post('Assignedperson'),
        'CosttoIncident' => $this->input->post('CosttoIncident'),
        'Correctiveaction' => $this->input->post('Correctiveaction'),
        // 'WorkCompletedateandtime' => $this->input->post('WorkCompletedateandtime'),
        'Remarkindetails' => $this->input->post('Remarkindetails'),
    ];
    $update_result = $VehicleIncidentTrackerModel->update_data1($id, $data);
    if ($update_result) {
        return redirect('VehicleIncidentTracker_view');
    } else {
        echo "Update failed!";
    }
}

// // ========================================
     public function delete2($id = null) {
        $this->load->model('VehicleIncidentTrackerModel');
        $this->VehicleIncidentTrackerModel->delete_user2($id); 
        return redirect('VehicleIncidentTracker_view'); 

    }

// ============================================
public function xlsxdata1()
{
    try {
        $this->load->model('VehicleIncidentTrackerModel');
        $data['IncidentTracker'] = $this->VehicleIncidentTrackerModel->get_lr_data3();


        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();


        $sheet->getColumnDimension('A')->setWidth(15);
        $sheet->getColumnDimension('B')->setWidth(15);
        $sheet->getColumnDimension('C')->setWidth(15);
        $sheet->getColumnDimension('D')->setWidth(15);
        $sheet->getColumnDimension('E')->setWidth(15);
        $sheet->getColumnDimension('F')->setWidth(15);
        $sheet->getColumnDimension('G')->setWidth(15);
        $sheet->getColumnDimension('H')->setWidth(15);
        $sheet->getColumnDimension('I')->setWidth(15);
        $sheet->getColumnDimension('J')->setWidth(15);
        $sheet->getColumnDimension('K')->setWidth(15);


        $sheet->setCellValue('A1', 'IncidentType');
         $sheet->setCellValue('B1', 'IncidentLocation');
          $sheet->setCellValue('C1', 'incidenttime');
         $sheet->setCellValue('D1', 'AffectedPart');
          $sheet->setCellValue('E1', 'Vehicleno');
         $sheet->setCellValue('F1', 'DriverName');
          $sheet->setCellValue('G1', 'Assignedperson');
         $sheet->setCellValue('H1', 'CosttoIncident');
          $sheet->setCellValue('I1', 'Correctiveaction');
         $sheet->setCellValue('J1', 'WorkCompletedateandtime');
          $sheet->setCellValue('K1', 'Remarkindetails');


        $row = 2;
        foreach ($data['IncidentTracker'] as $item) {
            $sheet->setCellValue('A' . $row, $item->IncidentType);
             $sheet->setCellValue('B' . $row, $item->IncidentLocation);
             $sheet->setCellValue('C' . $row, $item->incidenttime);
             $sheet->setCellValue('D' . $row, $item->AffectedPart);
             $sheet->setCellValue('E' . $row, $item->Vehicleno);
             $sheet->setCellValue('F' . $row, $item->DriverName);
             $sheet->setCellValue('G' . $row, $item->Assignedperson);
             $sheet->setCellValue('H' . $row, $item->CosttoIncident);
             $sheet->setCellValue('I' . $row, $item->Correctiveaction);
             $sheet->setCellValue('J' . $row, $item->WorkCompletedateandtime);
             $sheet->setCellValue('K' . $row, $item->Remarkindetails);


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


 }

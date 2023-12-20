<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class InsertController extends CI_Controller
{

public function spare_view(){
            $this->load->model('Auth_model');

       $data['user']=$this->Auth_model->user_data($this->session->userdata('user_id'));
       $data['header']='frontend/header';
       $data['body']='frontend/spare_view';
       $data['sidebar']='frontend/sidebar';
       $data['footer']='frontend/footer';
       $data['meta'] = array('title'=>'HOME |NSLINDIA','page_title'=>'cpcontractmaster');
       $this->load->view('frontend/backend_template', $data);
}

        public function part()
    {
                    $this->load->model('Auth_model');
               $data['user']=$this->Auth_model->user_data($this->session->userdata('user_id'));
        $this->load->model('SpareDetailsModel');
        $data['sparepart'] = $this->SpareDetailsModel->getSpareParts();
        $this->load->view('frontend/spare_view', $data);
    }

    private function updateUpdatedQtyInSparePart($pname, $qty)
    {
        $this->load->model('SpareDetailsModel');
        $updatedQty = $this->SpareDetailsModel->getUpdatedQty($pname) + $qty;
        $this->SpareDetailsModel->updateUpdatedQty($pname, $updatedQty);
    }

    public function submitpart()
    {
        $this->load->model('SpareDetailsModel');
        $pname = $this->input->post('pname');
        $BillNo = $this->input->post('billno');
        $BillDate = $this->input->post('bdt');
        $Rate = $this->input->post('rate');
        $Amount = $this->input->post('amount');
        $VendorName = $this->input->post('vname');
        $Qty = $this->input->post('Qty');
        $dtltr = $this->input->post('dtltr');

        $response = ['status' => true, 'message' => 'Data inserted successfully'];

        try {
            for ($i = 0; $i < count($pname); $i++) {
                $data = [
                    'pname' => $pname[$i],
                    'BillNo' => $BillNo[$i],
                    'BillDate' => $BillDate[$i],
                    'Rate' => $Rate[$i],
                    'Amount' => $Amount[$i],
                    'VendorName' => $VendorName[$i],
                    'Qty' => $Qty[$i],
                ];

                $this->SpareDetailsModel->insert($data);
                $updatedQty = $dtltr;
                $this->SpareDetailsModel->updateUpdatedQty($pname[$i], $updatedQty);
            }
        } catch (\Exception $e) {
            $response = ['status' => false, 'message' => 'Data insertion failed: ' . $e->getMessage()];
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    public function filterByDate()
    {
        $this->load->model('SpareDetailsModel');
        $startDate = $this->input->post('startdt');
        $endDate = $this->input->post('enddt');
        $data['SpareDetails'] = $this->SpareDetailsModel->getByDateRange($startDate, $endDate);
        return $this->load->view('filtered_spare_view', $data);
    }
}

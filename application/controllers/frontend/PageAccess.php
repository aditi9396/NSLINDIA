<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PageAccess extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Auth_model');
		$this->load->model('Transport_model');
	}

	public function pageaccess()
	{
		$user_id = $this->session->userdata('user_id');
		$data['user'] = $this->Auth_model->user_data($user_id);

		$this->load->view('frontend/pageaccess', $data);
	}

	public function userautosearch()
	{
		$keyword = $this->input->get('keyword');
		$results = $this->Transport_model->UserAutosearch($keyword);

		$html = '';
		foreach ($results as $employee) {
			$html .= '<option value="' . $employee->EmpName . '">' . $employee->EmpName . '</option>';
		}

		echo $html;
	}

	public function fetchEmployeeData()
	{
		$username = $this->input->get('username');
		$result = $this->Transport_model->UserAutosearch1($username);
		if ($result) {
			echo json_encode($result);
		} else {
			echo json_encode(array('error' => 'No employee data found.'));
		}
	}

	public function access() {
    $username = $this->input->post('at');
    $page = $this->input->post('Page');
    
    $pageList = implode(',', $page);

    $this->db->where('EmpName', $username);
    $this->db->update('users', array('PageAccess' => $pageList));

    if ($this->db->affected_rows() > 0) {
        echo "PageAccess updated successfully!";
    } else {
        echo "User not found or no changes made to PageAccess.";
    }
}




	
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function login()
    {
        // $data['header']='frontend/home-header';
        $data['body'] ='frontend/login';
        $data['meta'] = array('title'=>'HOME |NSLINDIA','page_title'=>'');
        $this->load->view('frontend/backend_template', $data);
    }

    public function cpall_depo()
    {
        $this->load->model('Auth_model');
        $data['country']=$this->Auth_model->get_data($this->session->userdata('user_id'));
        $data['user']=$this->Auth_model->user_data($this->session->userdata('user_id'));
        $data['header'] = 'frontend/header';
        $data['sidebar'] = 'frontend/sidebar';
        $data['body'] ='frontend/lr';
        $data['meta'] = array('title'=>'HOME |NSLINDIA','page_title'=>'');
        $this->load->view('frontend/backend_template', $data);
    }


    public function register()
    {
        $this->load->model('Auth_model');
        $data['user']=$this->Auth_model->user_data($this->session->userdata('user_id'));
        $query = $this->db->query('select max(EmpID) as num from employee');
        $output = $query->row();

        $new_emp_id = $output->num;

        $data['new_emp_id'] = $new_emp_id + 1;

        $data['header'] = 'frontend/header';
        $data['sidebar'] = 'frontend/sidebar';
        $data['body'] = 'frontend/register';
        $data['meta'] = array('title'=>'HOME |NSLINDIA','page_title'=>'');
        $this->load->view('frontend/backend_template', $data);
    }


    public function auth_login()
    {

        $UserName=$this->input->post('UserName');
        $Password=$this->input->post('password');

        $data = array(
            "UserName"=> $UserName,
            "Password"=> $Password,
        );

        $this->db->where('UserName',$UserName);
        $this->db->where('Password',$Password);
        $query = $this->db->get('employee');

        $output = $query->result();


        if(!empty($output))
        {
            $this->session->set_userdata('user_id', $output[0]->EmpID);
            $response = array('msg' => 'Login Successfully', "status" => true);

        }
        else{
            $response = array('err' => 'Username or Password Does Not Match', "status" => false);
        }

        echo json_encode($response);
        return;
    }


    public function virtual_login()
    {
        $depot = $this->input->post('depot');
        $user_id = $this->session->userdata('user_id');

        $this->load->model('Auth_model');
        $response = array();

        if ($this->Auth_model->updateUserDepot($user_id, $depot)) {
            $response['depot'] = $depot;
        } else {
            $response['error'] = 'Failed to update depot.';
        }
        
        echo json_encode($response);
    }



    public function auth_register()
    {
        $EmpID = $this->input->post('EmpID');
        $Depot = $this->input->post('Depot');
        $EmpName = $this->input->post('EmpName');
        $ShiftType = $this->input->post('ShiftType');
        $Intime = $this->input->post('Intime');
        $Outtime = $this->input->post('Outtime');
        $Dept = $this->input->post('Dept');
        $PassportNo = $this->input->post('PassportNo');
        $PassBookNo = $this->input->post('PassBookNo');
        $VoterIdNo = $this->input->post('VoterIdNo');
        $Gender = $this->input->post('Gender');
        $UAN = $this->input->post('UAN');
        $Designation = $this->input->post('Designation');
        $Phone = $this->input->post('Phone');
        $DOB = $this->input->post('DOB');
        $DOJ = $this->input->post('DOJ');
        $Email = $this->input->post('Email');
        $EmpAdd = $this->input->post('EmpAdd');
        $EmpPerAdd = $this->input->post('EmpPerAdd');
        $ESINO = $this->input->post('ESINO');
        $AadharNo = $this->input->post('AadharNo');
        $PAN = $this->input->post('PAN');
        $Salary = $this->input->post('Salary');
        $Empcompanyname = $this->input->post('Empcompanyname');
        $Division = $this->input->post('Division');
        $ESICsubcode = $this->input->post('ESICsubcode');
        $PFno = $this->input->post('PFno');
        $BusinessHead = $this->input->post('BusinessHead');

        $emp_username = $Depot . $EmpID;

        $data = array(
            "EmpName" => $EmpName,
            "UserName" => $emp_username,
            "Password" => $emp_username,
            "ShiftType" => $ShiftType,
            "Intime" => $Intime,
            "Outtime" => $Outtime,
            "Dept" => $Dept,
            "PassportNo" => $PassportNo,
            "PassBookNo" => $PassBookNo,
            "VoterIdNo" => $VoterIdNo,
            "Gender" => $Gender,
            "UAN" => $UAN,
            "Designation" => $Designation,
            "Phone" => $Phone,
            "DOB" => $DOB,
            "DOJ" => $DOJ,
            "Email" => $Email,
            "EmpAdd" => $EmpAdd,
            "EmpPerAdd" => $EmpPerAdd,
            "ESINO" => $ESINO,
            "AadharNo" => $AadharNo,
            "PAN" => $PAN,
            "Depot" => $Depot,
            "Salary" => $Salary,
        );

        $this->db->insert('employee', $data);

        $user_data = array(
            "EmpID" => $EmpID,
            "UserName" => $emp_username,
            "Password" => $emp_username,
            "EmpName" => $EmpName,
            "Depot" => $Depot,
            "Dept" => $Dept,
            "Gender" => $Gender,
            "DOB" => $DOB,
            "Phone" => $Phone,
            "DOJ" => $DOJ,
            "Designation" => $Designation,
        );

        $this->db->insert('users', $user_data);

        $query = $this->db->get_where('users', array('EmpID' => $EmpID));
        $output = $query->result();

        if (empty($output)) {
            $response = array('msg' => 'Register Successfully', "status" => true);
        } else {
            $response = array('msg' => 'Username already registered', "status" => true);
        }

        echo json_encode($response);
        return;
    }


    public function logout()
    {
        redirect(base_url().'login'); 
    }

} 

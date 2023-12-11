<?php
defined('BASEPATH') or exit('No direct script access allowed');

class reword extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function reword()
    {

        $query = $this->db->get('reward_distribution');
        $data['output'] = $query->result();
        $data['header'] = 'frontend/header';
        $data['sidebar'] = 'frontend/sidebar';
        $data['body'] = 'frontend/add-reword';
        // $data['footer'] = 'frontend/footer';
        $data['meta'] = array('title' => 'Librium Tech | Reword', 'page_title' => '');
        $this->load->view('frontend/backend_template', $data);
    }

    public function createreward()
    {

        $query = $this->db->get('reward_distribution');
        $output = $query->result();
        $data['requestdata'] = $output;
        $data['header'] = 'frontend/header';
        $data['sidebar'] = 'frontend\sidebar';
        $data['body'] = 'frontend\reward';
        $data['footer'] = 'frontend\footer';
        $data['meta'] = array('title' => 'Librium Tech |AddReward', 'page_title' => '');
        $this->load->view('frontend/backend_template', $data);
    }

    public function addreward_view($id = 0)
    {
        if ($id) {
            $this->db->select("*");
            $this->db->from('reward_distribution');
            $this->db->where("id", $id);
            $query = $this->db->get();
            $data['reward_distribution'] = $query->result_array()[0];
        }

        $data['header'] = 'frontend/header';
        $data['sidebar'] = 'frontend/sidebar';
        $data['body'] = 'frontend/reward';
        // $data['footer'] = 'frontend/footer';
        $data['meta'] = array('title' => 'Librium Tech |AddReward', 'page_title' => '');
        $this->load->view('frontend/backend_template', $data);
    }

    public function saveReword()
    {
        $reword_amt = $this->input->post('reword_amt');
        $title = $this->input->post('title');
        $valid_till = $this->input->post('valid_till');
        $data = array(
            'reward_amount' => $reword_amt,
            'title' => $title,
            'til_datetime' => $valid_till
        );

        if (strlen($reword_amt) > 0 && strlen($title) > 0) {
            if (isset($id)) {
                $this->db->where('id', $id);
                $this->db->update("reward_distribution", $data);
            } else {
                $this->db->insert('reward_distribution', $data);

                $id = $this->db->insert_id();
            }

            $response = array('msg' => 'Reward save Successfully', "success" => true);

        } else {
            $response = array('msg' => 'Please enter proper input', "success" => false);

        }
        echo json_encode($response);
    }

    public function listReward()
    {
        $this->db->order_by("id", "desc");
        $query = $this->db->get('reward_distribution');
        $data['requestdata'] = $query->result();
        $data['header'] = 'frontend/header';
        $data['sidebar'] = 'frontend/sidebar';
        $data['body'] = 'frontend/reward';
        $data['footer'] = 'frontend/footer';
        $data['meta'] = array('title' => 'Librium Tech |AddReward', 'page_title' => '');
        $this->load->view('frontend/backend_template', $data);
    }

    public function editReward()
    {
        $id = $this->uri->segment(2);
        $this->db->where('id', $id);
        $query = $this->db->get('reward_distribution');
        $data['requestdata'] = $query->row();
        $data['header'] = 'frontend/header';
        $data['sidebar'] = 'frontend/sidebar';
        $data['body'] = 'frontend/add-reword';
        $data['footer'] = 'frontend/footer';
        $data['meta'] = array('title' => 'Librium Tech |AddReward', 'page_title' => '');
        $this->load->view('frontend/backend_template', $data);
    }
    public function updatereword()
    {
        $id = $this->input->post('id');
        $reword_amt = $this->input->post('reword_amt');
        $title = $this->input->post('title');
        $valid_till = $this->input->post('valid_till');
        $data = array(
            'reward_amount' => $reword_amt,
            'title' => $title,
            'til_datetime' => $valid_till,
        );
        $this->db->where('id', $id);
        $this->db->update('reward_distribution', $data);
        $response = array('msg' => 'Reward Updated Successfully', "success" => true);
        echo json_encode($response);
        return;
    }
    public function deletereward()
    {
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $this->db->delete('reward_distribution');
        $response = array("status" => true, 'msg' => 'Reward deleted Successfully');

        echo json_encode($response);
        return;
    }



}
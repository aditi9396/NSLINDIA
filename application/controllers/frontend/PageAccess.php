<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PageAccess extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	public function pageaccess(){
		$this->load->model('Auth_model');
		$data['user']=$this->Auth_model->user_data($this->session->userdata('user_id'));
		$data['header']='frontend/header';
		$data['body'] = 'frontend/pageaccess';
		$data['sidebar']='frontend/sidebar';
		$data['footer']='frontend/footer';
		$data['meta'] = array('title'=>'HOME |NSLINDIA','page_title'=>'lrgeneration');
		$this->load->view('frontend/backend_template', $data);

	}
}

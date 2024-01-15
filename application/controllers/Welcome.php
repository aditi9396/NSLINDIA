<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

  /**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
  
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Welcome_model','welcome'); 
  }
  public function index()
  {
   $this->data['view_data']= $this->welcome->view_data();
   $this->load->view('welcome_message', $this->data, FALSE);
 }

 public function add_data()
 {
  $this->load->view('add');
}


public function submit_data()
{
  $data = array('username'                   => $this->input->post('username'),
    'email'                      => $this->input->post('email'),
    'sex'                        => $this->input->post('sex'),
    'address'                    => $this->input->post('address'),
    'created_date'               => date("m/d/y h:i:s"),
    'status'                     => 'Y');
  
  $insert = $this->welcome->insert_data($data);
  $this->session->set_flashdata('message', 'Your data inserted Successfully..');
  redirect('welcome/index');
}


public function view_data()
{
  $this->data['view_data']= $this->welcome->view_data();
  $this->load->view('welcome_message', $this->data, FALSE);
}


public function edit_data($id)
{
  $this->data['edit_data']= $this->welcome->edit_data($id);
  $this->load->view('edit', $this->data, FALSE);
}


public function update_data($id)
{
  $data = array('username'                   => $this->input->post('username'),
    'email'                      => $this->input->post('email'),
    'sex'                        => $this->input->post('sex'),
    'address'                    => $this->input->post('address'),
    'created_date'               => date("m/d/y h:i:s"),
    'status'                     => 'Y');
  $this->db->where('id', $id);
  $this->db->update('user_data', $data);
  $this->session->set_flashdata('message', 'Your data updated Successfully..');
  redirect('welcome/index');
}


public function delete_data($id)
{  
  $this->db->where('id', $id);
  $this->db->delete('user_data');
  $this->session->set_flashdata('message', 'Your data deleted Successfully..');
  redirect('welcome/index');
}

}

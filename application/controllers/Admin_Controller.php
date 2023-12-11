<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Controller extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }
    public function check_login(){
        if(!empty($this->session->userdata('logged'))){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}
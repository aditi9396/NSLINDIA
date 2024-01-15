<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MessageController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('email');
    }

    public function sendEmail() {
        // Set email configuration
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'suyash.kore@swatpro.co';
        $config['smtp_port'] = 465; 
        $config['smtp_user'] = 'suyash.kore@swatpro.co';
        $config['smtp_pass'] = 'User123#'; 
        $config['mailtype'] = 'text';
        $config['charset'] = 'utf-8';

        $this->email->initialize($config);

        $this->email->from('suyash.kore@swatpro.co', 'suyash kore');
        $this->email->to('aditi.pawar@swatpro.co');
        $this->email->subject('Subject of the email');
        $this->email->message('This is the text message content.');

        if ($this->email->send()) {
             var_dump($errno, $errstr);
            echo 'Email sent successfully.';
        } else {
            show_error($this->email->print_debugger());
        }
    }
}

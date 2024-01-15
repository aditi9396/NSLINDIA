<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class DailyReport extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Report_model');
    }

    private function send_Email($to, $subject, $message) {
        $this->load->library('email');

        $config = array(
    'protocol' => 'smtp',
    'smtp_host' => 'smtp.gmail.com',
    'smtp_port' => 465,  
    'smtp_user' => 'suyash.kore@swatpro.co',
    'smtp_pass' => 'User123#',
    'mailtype' => 'html',
    'charset' => 'utf-8',
    'wordwrap' => TRUE,
    'smtp_crypto' => 'tls',  
    'smtp_timeout' => 60,

        );

        $this->email->initialize($config);

        $this->email->from("suyash.kore@swatpro.co", "sk"); 
        $this->email->to($to);
        $this->email->cc("suyash.kore@swatpro.co"); 
        $this->email->subject($subject);
        $this->email->message($message);

        if ($this->email->send1()) {
            return true;
        } else {
            log_message('error', 'Email sending failed: ' . $this->email->print_debugger());
            return false;
        }
    }

    
    public function send_daily_report() {
        try {
            $to = "suyash.kore@swatpro.co";
            $subject = "Daily Call Report";
            $data['today'] = date("Y-m-d");
            $data['reports'] = $this->Report_model->get_daily_reports($data['today']);
            $message = $this->load->view('frontend/email_template', $data, true);
            $result = $this->send1($to, $subject, $message);
                print_r($result);
        exit();

            if ($result) {
                echo 'Email successfully sent.';
            } else {
                echo 'Email sending failed. Please check your logs for more details.';
            }
        } catch (Exception $e) {
            log_message('error', 'Error in send_daily_report: ' . $e->getMessage());
            show_error('An internal server error occurred. Please try again later.');
        }
    }







}

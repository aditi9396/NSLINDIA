<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_model extends CI_Model {

    public function get_daily_reports($today) {
        $this->db->select('t1.LRNO, Date, PersonName, PersonMobile, Problem, Responce, Feedback, t2.Consignor, t2.LRDate, t2.ToPlace, t2.PkgsNo, t2.DRS_THCNO');
        $this->db->from('custfeedback t1');
        $this->db->join('lr t2', 't1.LRNO = t2.LRNO');
        $this->db->where('t1.Date', $today);
        $query = $this->db->get();
       
        
        return $query->result_array();
    }
}

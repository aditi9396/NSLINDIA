<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

   public function searchVehicles($keyword)
   {
    $this->db->like('Vehicle_No', $keyword);
    $query = $this->db->get('vehicle');

    return $query->result();
}


}

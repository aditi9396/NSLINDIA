 <?php

 class Transport_model extends CI_Model
 {
   public function getCityByCustomerName($custName) {
    $this->db->select('City');
    $this->db->from('customers');
    $this->db->where('custName', $custName);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
      $row = $query->row();
      return $row->City;
    }

    return null;
  }

  public function user_data()
  {
   $this->load->database();
   $User=$this->db->query("SELECT `Depot`FROM employee");
   return $User->row_array();
 }

 public function customers($keyword, $Depot) {
  $this->db->select('CustCode, CustName,Location,Category');
  $this->db->from('Customers');
  $this->db->like('Location', $Depot);
  $this->db->group_start();
  $this->db->like('CustName', $keyword);
  $this->db->or_like('CustCode', $keyword);
  $this->db->group_end();
  $this->db->limit(10);
  return $this->db->get()->result();
}


public function checkCityExists($searchTerm) {
  $this->db->select('CityNameEng');
  $this->db->from('CityMaster');
  $this->db->where('Active', 1);
  $this->db->where('CityNameEng', $searchTerm);
  $query = $this->db->get();

  if($query->num_rows() > 0) {
    return true; 
  } else {
    return false; 
  }
}

}


?>
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

public function UserAutosearch($keyword)
    {
        $this->db->like('EmpName', $keyword);
        $query = $this->db->get('employee');
        return $query->result();
    }

  public function UserAutosearch1($keyword1)
{
    $this->db->select('EmpName, UserName');
    $this->db->like('EmpName', $keyword1);
    $query = $this->db->get('employee');
    return $query->row();
}


}



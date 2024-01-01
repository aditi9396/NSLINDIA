<?php

class VehicleIncidentTrackerModel extends CI_Model {


     protected $table = 'IncidentTracker';
    protected $primaryKey = 'id';
    
    protected $allowedFields = ['IncidentType', 'IncidentLocation', 'incidenttime', 'AffectedPart', 'Vehicleno', 'DriverName', 'Assignedperson', 'CosttoIncident', 'Correctiveaction', 'WorkCompletedateandtime', 'Remarkindetails'];

  public function get_all() {
    $query = $this->db->query("SELECT `id`, `IncidentType`, `IncidentLocation`, `incidenttime`, `AffectedPart`, `Vehicleno`, `DriverName`, `Assignedperson`, `CosttoIncident`, `Correctiveaction`, `WorkCompletedateandtime`, `Remarkindetails`, `Status` FROM `IncidentTracker` WHERE `Status`='1'");
    return $query->result_array();
}

//  public function get_all1() {
//     $query = $this->db->query("SELECT `id`, `IncidentType`, `IncidentLocation`, `incidenttime`, `AffectedPart`, `Vehicleno`, `DriverName`, `Assignedperson`, `CosttoIncident`, `Correctiveaction`, `WorkCompletedateandtime`, `Remarkindetails`, `Status` FROM `IncidentTracker` WHERE `Status`='1'");
//     return $query->result_array();
// }

    public function insert($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    public function getSingleUser1($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }
   public function update_data1($id, $data) {
    $this->db->where($this->primaryKey, $id);
    return $this->db->update($this->table, $data);
}

    public function delete_user2($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }



public function get_lr_data3()
{
    // $query = $this->db->query("SELECT * FROM lr WHERE `Consignor`='SUMITOMO CHEMICAL INDIA LIMITED(SPL)' and `LRDate` BETWEEN '2023-12-16' and '2023-12-25'");
      $query = $this->db->query('SELECT * FROM IncidentTracker WHERE Status = 1');
    return $query->result();
}



}

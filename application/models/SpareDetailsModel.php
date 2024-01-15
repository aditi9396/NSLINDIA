<?php

class SpareDetailsModel extends CI_Model
{
    protected $table = 'sparedetails';
    protected $primaryKey = 'id';
    protected $allowedFields = ['pname', 'BillNo', 'BillDate', 'Rate', 'Amount', 'VendorName', 'Qty'];

    public function getSpareParts()
    {
        $query = $this->db->query('SELECT `pname`,`UpdatedQty` FROM sparepart');
        return $query->result_array();
    }

    public function updateUpdatedQty($pname, $updatedQty)
    {
        $this->db->set('UpdatedQty', $updatedQty)
            ->where('pname', $pname)
            ->update('sparepart');
    }

    public function getByDateRange($startDate, $endDate)
    {
        $query = $this->db->query('SELECT * FROM sparedetails WHERE BillDate BETWEEN ? AND ?', array($startDate, $endDate));
        return $query->result();
    }

    // Add the insert() method here
    public function insert($data)
    {
        $this->db->insert($this->table, $data);
    }
}

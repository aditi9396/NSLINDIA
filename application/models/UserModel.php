<?php

class UserModel extends CI_Model {


     protected $table = 'sparepart';
    protected $primaryKey = 'id';
    
    protected $allowedFields = ['pname', 'pdesc'];

    public function get_all() {
        $query = $this->db->query('SELECT `id`,`pname`,`pdesc` FROM sparepart');
        return $query->result_array();
    }

    public function insert($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    public function getSingleUser($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }
   public function update_data($id, $data) {
    $this->db->where($this->primaryKey, $id);
    return $this->db->update($this->table, $data);
}

    public function delete_user($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }
}

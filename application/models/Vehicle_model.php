<?php
class Vehicle_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_ownership_list() {
        $query = $this->db->get('tbl_ownership');
        return $query->result();
    }

    public function save_vehicle($vehicle_data) {
        $this->db->insert('tbl_vehicle', $vehicle_data);
        return $this->db->insert_id();
    }

    public function save_vehicle_part($part_data) {
        $this->db->insert('tbl_vehicle_part', $part_data);
    }

    public function get_vehicle_list() {
        $this->db->select('v.*, o.title AS ownership_title');
        $this->db->from('tbl_vehicle v');
        $this->db->join('tbl_ownership o', 'v.owner_id = o.id');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_vehicle($vehicle_id) {
        $this->db->select('v.*, o.title AS ownership_title');
        $this->db->from('tbl_vehicle v');
        $this->db->join('tbl_ownership o', 'v.owner_id = o.id');
        $this->db->where('v.id', $vehicle_id);
        $query = $this->db->get();
        return $query->row();
    }

    public function update_vehicle_parts($vehicle_id, $vehicle_parts_data) {
        $this->db->where('vehicle_id', $vehicle_id);
        $this->db->insert('vehicle_parts');

        $this->db->insert_batch('vehicle_parts', $vehicle_parts_data);
    }

    public function delete_vehicle_parts($vehicle_id) {
        $this->db->where('vehicle_id', $vehicle_id);
        $this->db->delete('tbl_vehicle_part');
    }


    public function get_vehicle_parts($vehicle_id) {
        $this->db->where('vehicle_id', $vehicle_id);
        $query = $this->db->get('tbl_vehicle_part');
        return $query->result();
    }

    public function update_vehicle($vehicle_id, $vehicle_data) {
        $this->db->where('id', $vehicle_id);
        $this->db->update('tbl_vehicle', $vehicle_data);
    }

    public function update_vehicle_part($part_id, $part_data) {
        $this->db->where('id', $part_id);
        $this->db->update('tbl_vehicle_part', $part_data);
    }

    public function delete_vehicle($vehicle_id) {
        $this->db->where('id', $vehicle_id);
        $this->db->delete('tbl_vehicle');
        $this->db->where('vehicle_id', $vehicle_id);
        $this->db->delete('tbl_vehicle_part');
    }

}


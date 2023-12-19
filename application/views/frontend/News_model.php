 <?php

 class News_model extends CI_Model
 {
     function saverecoards($data){
        $this->db->insert('student',$data);
        return true;
    }
    function fetch($data){
        $this->load->database();
        $stud=$this->db->query("SELECT `id`,`student_name`,`student_address`,`mobile_no` from students") ;
        return $stud->result_array();
        return true;
    }

    function updaterecoards($data,$id){
        $this->db->where('id',$id);
        $this->db->update('student',$depot);
    }

    function deleterecoards($id){
        $this->db->where('id',$id);
        $this->db->delete('student',$id);
    }

    function getinfo(){
        $this->load->database();
        $result = $this->db->query("select * from student");
        $query = $this->db->get('student');
        if($result->num_rows()>0){
            return $result->result();
        }else{
            return false;
        }
        
    }



    function news($params=array(),$condition=array()){

    if(!empty($condition['where']))
    {
        
        $params['where'] = $condition['where'];
    }
    if(!empty($condition['like']))
    {
        $params['like'] = $condition['like'];
    }
    if (!empty($condition['sort_by'])) {
        $params['sort_by_column'] = $condition['sort_by']['sort_by_column'];
        $params['sort_by_val'] = $condition['sort_by']['sort_by_val'];
    }
    $docMenuList = $this->getDocMenuRows($params);
    return $docMenuList;
}
public function get_data($table,$params,$select = "*",$return = "array")
{
    $this->db->select($select);
    $this->db->from($table);

    if(isset($params['where']) && is_array($params['where'])){
        $this->db->where($params['where']);
    }
    if(isset($params['orderby']) && is_array($params['orderby'])){
        $this->db->order_by($params['orderby']['order_column'], $params['orderby']['order']);
    }
    if(isset($params['limit']) && is_array($params['limit'])){
        $this->db->limit($params['limit']['limit'], $params['limit']['start']);
    }
    if(isset($params['groupby']) && is_array($params['groupby'])){
        $this->db->group_by($params['groupby']);
    }

    $query = $this->db->get();

    if($return == 'array'){
        return $query->result_array();
    }else if($return == 'row'){
        return $query->row();
    }else{
        return $query->num_rows();
    }

}

}





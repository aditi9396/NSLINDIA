<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('News_model');

    }
    public function savedata()
    {
        $this->load->view('frontend/insert');

        if($this->input->post('save')){
            $data['student_name']=$this->input->post('student_name');
            $data['student_address']=$this->input->post('student_address');
            $data['mobile_no']=$this->input->post('mobile_no');
            $response=$this->News_model->saverecoards($data);
            if($response==true){
                echo "Recoard save sucessfully";
            }
            else{
             echo "Insert error!";
         }
     }
 }


 public function display_records()
 {
    $result['data']=$this->News_model->display_records();
  $this->load->view('frontend/display_records',$result);
}




public function delete()
{
    $this->load->view('table',$data);
    $this->db->where('id', $id);
    $this->db->delete('user_data');
    $this->session->set_flashdata('message', 'Your data deleted Successfully..');
    redirect('welcome/index');
}

public function news()
{

    $this->db->order_by("create_at", "desc");
    $query = $this->db->get('news');
    $output = $query->result();
    $data['requestdata'] = $output;
    $data['body'] = 'frontend/datatable';
    $data['meta'] = array('title'=>'NEWS | Librium Tech','page_title'=>'NEWS');
    $this->load->view('frontend/frontend-template', $data);

}


public function createnews()
{

    $query = $this->db->get('news');

    $output = $query->result();

    $data['requestdata'] = $output;
    $data['body'] = 'frontend/add-news';
    $this->load->view('frontend/frontend-template', $data);
}

public function addNews_view($id=0)
{   

    if($id){
        $this->db->select("*");
        $this->db->from('news');
        $this->db->where("id", $id);
        $query = $this->db->get();
        $data['news']= $query->result_array()[0];

        $arr_filename = explode('_',$data['news']['thumbnail']);

        if(count($arr_filename) == 3)
            $data['news']['original_name'] = $arr_filename[1].".png";
        else
            $data['news']['original_name'] = $arr_filename[1];
    }

    $data['body'] = 'frontend/addnews';
    $data['meta'] = array('title'=>'NEWS | Librium Tech','page_title'=>'NEWS');
    $this->load->view('frontend/frontend-template', $data);
}

public function saveNews()
{
    extract($_POST);

    $news_title = $this->input->post('news_title');
    $description = $this->input->post('description');
    $Email = $this->input->post('email');
    $City = $this->input->post('City');
    $Designation = $this->input->post('Designation');
    $Password = $this->input->post('Password');

    $status = $this->input->post('status');



    $data = array(
        'news_title'=>$news_title,
        'description'=>$description,
        'Email'=>$Email,
        'Designation'=>$Designation,
        'City'=>$City,
        'Password'=>$Password,
        'status'=>$status,
        'action'=>$status,
    );

    if (strlen($news_title)>0 &&  strlen($description)>0) {
        if($this->input->post('id') != ""){
            $this->db->where('id', $this->input->post('id'));
            $this->db->update("news", $data);
            $response = array('msg' => 'News Updated Successfully', "success" => true);
        }else{
            $this->db->insert('news',$data);
            $id = $this->db->insert_id();
            $response = array('msg' => 'News Saved Successfully', "success" => true);
        }
        $filename = pathinfo($_FILES['thumbnail']['name'], PATHINFO_FILENAME);
        $upload_filename = $filename."_".time();
        $uploadPath = "uploads/";
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, TRUE);
        }

        if(!empty($_FILES['thumbnail']['name'])){
            if(move_uploaded_file($_FILES['thumbnail']['tmp_name'], 'uploads/news_'.$upload_filename.'.png')){ $res['thumbnail']=1;

            $this->db->where('id', $id);
            $this->db->update("news", array('thumbnail' => 'uploads/news_'.$upload_filename.'.png'));
        }
    }

}else{
    $response = array('msg' => 'Please Fill Title/Description', "success" => false);
}
echo json_encode($response);
}

public function editNews()
{
    $id = $this->uri->segment(2);

    $this->db->select("*");
    $this->db->from('news');
    $this->db->where("id", $id);
    $query = $this->db->get();
    $data['news'] = $query->result_array()[0];
    $data['body'] = 'frontend/addnews';
    $data['meta'] = array('title'=>'NEWS | Librium Tech','page_title'=>'NEWS');
    $this->load->view('frontend/frontend-template', $data);
}

public function updateNews()
{
    $id= $this->input->post('id');
    $news_title = $this->input->post('news_title');
    $thumbnail = $this->input->post('thumbnail');              
    $description = $this->input->post('description');
    $Email = $this->input->post('email');
    $City = $this->input->post('City');
    $Designation = $this->input->post('Designation');
    $Password = $this->input->post('Password');
    $status = $this->input->post('status');
    $action = $this->input->post('action');

    $this->db->where('id' , $id);
    $query = $this->db->get('news');

    $output = $query->result();

    $thumbnail = $output[0]->thumbnail;

    if( !empty($_FILES['thumbnail']['name']) )
    {
        $upload_path = 'uploads/news/'.$id;
        if (!is_dir($upload_path)) 
        {
            mkdir($upload_path, 0777, TRUE);
        }

        if(!empty($_FILES['thumbnail']['name']))
        {
            $ext = pathinfo($_FILES['thumbnail']['tmp_name'], PATHINFO_EXTENSION);
            $fileName = 'thumbnail'.time().rand(10,1000).'.'.$ext;
            $result = file_upload($_FILES['thumbnail'],$upload_path,$fileName);
            if($result['status'])
            {
                $thumbnail = $upload_path.'/'.$tmp_name;
            }
        }
    }

    $data = array(
       'news_title'=>$news_title,
       'description'=>$description,
       'Email'=>$Email,
       'Designation'=>$Designation,
       'City'=>$City,
       'Password'=>$Password,
       'status'=>$status,
       'action'=>$status,

   );

    $this->db->where('id',$id);
    $this->db->update('news',$data);

    $response = array('msg' => 'News Updated Successfully', "success" => true);

    echo json_encode($response);
    return;
}

public function deleteNews()
{
    $id = $this->input->post('id');

    $this->db->where('id',$id);
    $this->db->delete('news');     

    $response = array( "status" => true,'msg' => 'News deleted Successfully');

    echo json_encode($response);
}

public function Reward(){


    extract($_POST);

    $news_title = $this->input->post('news_title');
    $description = $this->input->post('description');
    $status = $this->input->post('status');
    $action = $this->input->post('action');

    $data = array(
      'news_title'=>$news_title,
      'description'=>$description,
      'Email'=>$Email,
      'Designation'=>$Designation,
      'City'=>$City,
      'Password'=>$Password,
      'status'=>$status,
      'action'=>$status,

  );
    if(isset($id)){
        $this->db->where('id', $id);
        $this->db->update("news", $data);
    }else{
        $this->db->insert('news',$data);

        $id = $this->db->insert_id();
    }

    $uploadPath = "uploads/";
    if (!is_dir($uploadPath)) {
        mkdir($uploadPath, 0777, TRUE);
    }

    if(!empty($_FILES['thumbnail']['name'])){
        if(move_uploaded_file($_FILES['thumbnail']['tmp_name'], 'uploads/news_'.$id.'.png')){ $res['thumbnail']=1;

        $this->db->where('id', $id);
        $this->db->update("news", array('thumbnail' => 'uploads/news_'.$id.'.png'));
    }
}


$response = array('msg' => 'News data save Successfully', "success" => true);

echo json_encode($response);

}


public function news_mark_toggle()
{
    $id = $this->input->post('id');
    $value = $this->input->post('value');

    $data = array(
        'action'=>$value      
    );

    $this->db->where('id',$id);
    $this->db->update('news',$data); 

    $response = array( "status" => true,'msg' => 'taggle changed Successfully');

    echo json_encode($response);
    return;
}
}

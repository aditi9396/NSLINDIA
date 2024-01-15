<?php  

function hashPass($string)
{
   return hash('sha512', $string . config_item('encryption_key'));
}

function isFileExists($image_path='') {

   if ( is_file($image_path) && !empty($image_path) && file_exists(FCPATH. $image_path)) {
      return base_url($image_path);
   }else {
      return base_url('assets_old/frontend/images/touch-icon-ipad.png');
   }
   
}function isProfImgExists($image_path='') {

   if ( is_file($image_path) && !empty($image_path) && file_exists(FCPATH. $image_path)) {
      return base_url($image_path);
   }else {
      return base_url('assets/frontend/images/avatar.png');
   }
   
}





function send1($to, $subject, $message)
{
    $CI = get_instance();

    $config = array(
        'protocol' => 'smtp',
        'smtp_host' => 'smtp.gmail.com',
        'smtp_port' => '465',
        'smtp_crypto' => 'ssl', 
        'smtp_user' => 'suyash.kore@swatpro.co',
        'smtp_pass' => 'User123#',
        'mailtype' => 'html',
        'starttls' => true,
        'newline' => "\r\n",
    );

    $CI->load->library('email', $config);
    $CI->email->initialize($config);

    $CI->email->from($from['email'], $from['name']);
    $CI->email->subject($subject);
    $CI->email->to($to);
    $CI->email->message($message);

    if ($attach != '') {
        $CI->email->attach($attach);
    }

    error_reporting(0);
    if ($CI->email->send()) {
        return true;
    } else {
        return $CI->email->print_debugger();
    }
    error_reporting(E_ALL);
}




function get_column_data($table,$column,$where)
{
      $CI =& get_instance();

      $query = $CI->db->query('select '.$column.' from '.$table.' where '.$where.'');
      $output = $query->row();

      if(!empty($output))
      {
            return $output->$column;
      }
      else{
            return "";
      }
}
?>


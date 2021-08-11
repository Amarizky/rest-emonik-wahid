<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_api extends CI_Model {

    //-------------------------------------- LOGIN ---------------------------------------------------   
    function logged_id()
    {
        return $this->session->user_login('id');
    }
    public function proses_login($name, $password)
    {
        return $this->db->query("SELECT id, name FROM users WHERE name = '$name' AND password = '$password'");
        
    }
    
 public function get($id = null, $limit = 5, $offset = 0)
    {
        if($id===null){
        // from a data store e.g. database
        return $this->db->get('users',$limit, $offset)->result();
        }
        else
        {
            return $this->db->get_where('users',['name'=>$name])->result_array();
        }
    }
}
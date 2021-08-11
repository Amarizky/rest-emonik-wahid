<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {

   public function __construct()
    {
        // Construct the parent class
        parent::__construct();
    }

    public function get($id = null, $limit = 5, $offset = 0)
    {
        if($id===null){
        // Users from a data store e.g. database
        return $this->db->get('users',$limit, $offset)->result();
        }
        else
        {
            return $this->db->get_where('users',['id'=>$id])->result_array();
        }
    }

  
    public function count()
    {
        return $this->db->get('users')->num_rows();
    }
    public function add($data)
    {
        try{
            $this->db->insert('users',$data);
            $error = $this->db->error();
            if(!empty($error['code'])){
                throw new Exception('terjadi kesalahan :'.$error['message']);
                return false;
            }
            return ['status'=>true,'data'=>$this->db->affected_rows()];
        } catch (Exception $ex) {
            return ['status' => false, 'msg' => $ex->getMessage()];
        }
    }

   

    

    public function delete($id)
    {
        try{
            $this->db->delete('users',['id'=>$id]);
            $error = $this->db->error();
            if(!empty($error['code'])){
                throw new Exception('terjadi kesalahan :'.$error['message']);
                return false;
            }
            return ['status'=>true,'data'=>$this->db->affected_rows()];
        } catch (Exception $ex) {
            return ['status' => false, 'msg' => $ex->getMessage()];
        }
    }
    
    function LoginApi($id = null, $limit = 5, $offset = 0)
    {
        if($id===null){
        // Users from a data store e.g. database
        return $this->db->get('users',$limit, $offset)->result();
        }
        else
        {
            return $this->db->get_where('users',['id'=>$id])->result_array();
        }
    }

}
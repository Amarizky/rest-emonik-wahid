<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class produk_model extends CI_Model {

   public function __construct()
    {
        // Construct the parent class
        parent::__construct();
    }

    public function get($id = null, $limit = 5, $offset = 0)
    {
        if($id===null){
        // Users from a data store e.g. database
        return $this->db->get('produk',$limit, $offset)->result();
        }
        else
        {
            return $this->db->get_where('produk',['kode_produk'=>$id])->result_array();
        }
    }

    public function listget($id = null, $limit = 5, $offset = 0)
    {
        if($id===null){
            // from a data store e.g. database
            $this->db->select('kode_produk');
            return $this->db->get('produk',$limit, $offset)->result();
            }
            else
            {
                return $this->db->get_where('produk',['kode_produk'=>$id])->result_array();
            }
        }


        public function listbahan($id = null, $limit = 5, $offset = 0)
    {
        if($id===null){
            // from a data store e.g. database
            $this->db->select('bahan1,bahan2,bahan3');
            return $this->db->get('produk',$limit, $offset)->result();
            }
            else
            {
                $this->db->select('bahan1,bahan2,bahan3');
                return $this->db->get_where('produk',['kode_produk'=>$id])->result_array();
            }
        }
  
    public function count()
    {
        return $this->db->get('produk')->num_rows();
    }
    public function add($data)
    {
        try{
            $this->db->insert('produk',$data);
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

}
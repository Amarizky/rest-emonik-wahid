<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembelian_model extends CI_Model {

   public function __construct()
    {
        // Construct the parent class
        parent::__construct();
    }

    public function get($id = null, $limit = 5, $offset = 0)
    {
        if($id===null){
        // from a data store e.g. database
        return $this->db->get('pembelian',$limit, $offset)->result();
        }
        else
        {
            return $this->db->get_where('pembelian',['kode_material'=>$id])->result_array();
        }
    }

    public function listget($id = null, $limit = 5, $offset = 0)
    {
        if($id===null){
            // from a data store e.g. database
            $this->db->select('kode_material');
            return $this->db->get('pembelian',$limit, $offset)->result();
            }
            else
            {
                $this->db->select('kode_material');
                return $this->db->get_where('pembelian',['kode_material'=>$id])->result_array();
            }
        }

    public function count()
    {
        return $this->db->get('pembelian')->num_rows();
    }
    public function add($data)
    {
        try{
            $this->db->insert('pembelian',$data);
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
    public function update($id, $data)
    {
        try{
            $this->db->update('pembelian',$data,['kode_material'=>$id]);
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
            $this->db->delete('pembelian',['kode_material'=>$id]);
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
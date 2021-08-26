<?php
defined('BASEPATH') or exit('No direct script access allowed');

class bahanbaku_model extends CI_Model
{

    public function __construct()
    {
        // Construct the parent class
        parent::__construct();
    }

    public function get($id = null, $limit = 5, $offset = 0)
    {
        if ($id === null) {
            // Users from a data store e.g. database
            return $this->db->get('bahanbaku', $limit, $offset)->result();
        } else {
            return $this->db->get_where('bahanbaku', ['mitra' => $id])->result_array();
        }
    }



    public function count()
    {
        return $this->db->get('bahanbaku')->num_rows();
    }
    public function add($data)
    { {
            try {

                // memasukkan data ke tabel produksi
                $this->db->insert('bahanbaku', $data);

                $error = $this->db->error();
                if (!empty($error['code'])) {
                    throw new Exception('terjadi kesalahan :' . $error['message']);
                    return false;
                }

                return ['status' => true, 'msg' => 'bahanbaku berhasil diproduksi'];
            } catch (Exception $ex) {
                return ['status' => false, 'msg' => $ex->getMessage()];
            }
        } 
        
    }

    public function delete($id)
    {
        try{
            $this->db->delete('bahanbaku',['mitra'=>$id]);
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
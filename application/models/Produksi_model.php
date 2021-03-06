<?php
defined('BASEPATH') or exit('No direct script access allowed');

class produksi_model extends CI_Model
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
            return $this->db->get('produksi', $limit, $offset)->result();
        } else {
            return $this->db->get_where('produksi', ['kode_produksi' => $id])->result_array();
        }
    }



    public function count()
    {
        return $this->db->get('produksi')->num_rows();
    }
    public function add($data)
    { {
            try {

                // memasukkan data ke tabel produksi
                $this->db->insert('produksi', $data);

                $error = $this->db->error();
                if (!empty($error['code'])) {
                    throw new Exception('terjadi kesalahan :' . $error['message']);
                    return false;
                }

                return ['status' => true, 'msg' => 'produk berhasil diproduksi'];
            } catch (Exception $ex) {
                return ['status' => false, 'msg' => $ex->getMessage()];
            }
        } 
        
    }
}
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
        // mencari apakah kode_produksi ada di tabel produk
        if (($bahanbaku = $this->db->where(['mitra' => $data['mitra']])->get('bahanbaku'))->num_rows() > 0) {
            try {
                // mengurangi stok bahan dari tabel produk
                $bahanbaku = $bahanbaku->result()[0];

                $update = [
                    'stokbahan1' => $bahanbaku->stokbahan1 - $data['presentase_bahan_baku1'],
                    'stokbahan2' => $bahanbaku->stokbahan2 - $data['presentase_bahan_baku2'],
                    'stokbahan3' => $bahanbaku->stokbahan3 - $data['presentase_bahan_baku3'],
                    'stokbahan4'=> $bahanbaku->stokbahan4 - $data['presentase_bahan_baku4'],
                    'stokbahan5'=> $bahanbaku->stokbahan5 - $data['presentase_bahan_baku5'],
                    'stokbahan6'=> $bahanbaku->stokbahan6 - $data['presentase_bahan_baku6'],
                    'stokbahan7'=> $bahanbaku->stokbahan7 - $data['presentase_bahan_baku7'],
                ];

                $this->db->set($update)->where('mitra', $bahanbaku->mitra)->update('bahanbaku');

                // memasukkan data ke tabel produks
                $this->db->insert('produk', $data);

                $error = $this->db->error();
                if (!empty($error['code'])) {
                    throw new Exception('terjadi kesalahan :' . $error['message']);
                    return false;
                }

                return ['status' => true, 'msg' => 'produk berhasil diproduksi'];
            } catch (Exception $ex) {
                return ['status' => false, 'msg' => $ex->getMessage()];
            }
        } else {
            return ['status' => false, 'msg' => 'kode produksi tidak ditemukan'];
        }
    }
}


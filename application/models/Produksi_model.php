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
    {
        // mencari apakah kode_produksi ada di tabel produk
        if (($produk = $this->db->where(['kode_produk' => $data['kode_produksi']])->get('produk'))->num_rows() > 0) {
            try {
                // mengurangi stok bahan dari tabel produk
                $produk = $produk->result()[0];

                $update = [
                    'presentase_bahan_baku1' => $produk->presentase_bahan_baku1 - $data['jumlah_produksi'],
                    'presentase_bahan_baku2' => $produk->presentase_bahan_baku2 - $data['jumlah_produksi'],
                    'presentase_bahan_baku3' => $produk->presentase_bahan_baku3 - $data['jumlah_produksi'],
    'presentase_bahan_baku4'=> $produk->presentase_bahan_baku4 - $data['jumlah_produksi'],
    'presentase_bahan_baku5'=> $produk->presentase_bahan_baku5 - $data['jumlah_produksi'],
     'presentase_bahan_baku6'=> $produk->presentase_bahan_baku6 - $data['jumlah_produksi'],
     'presentase_bahan_baku7'=> $produk->presentase_bahan_baku7 - $data['jumlah_produksi'],
     'presentase_bahan_baku8'=> $produk->presentase_bahan_baku8 - $data['jumlah_produksi'],
     'presentase_bahan_baku9'=> $produk->presentase_bahan_baku9 - $data['jumlah_produksi'],
     'presentase_bahan_baku10'=> $produk->presentase_bahan_baku10 - $data['jumlah_produksi'],
     'presentase_bahan_baku11'=> $produk->presentase_bahan_baku11 - $data['jumlah_produksi'],
     'presentase_bahan_baku12'=> $produk->presentase_bahan_baku12- $data['jumlah_produksi'],
     'presentase_bahan_baku13'=> $produk->presentase_bahan_baku13 - $data['jumlah_produksi'],
     'presentase_bahan_baku14'=> $produk->presentase_bahan_baku14 - $data['jumlah_produksi'],
     'presentase_bahan_baku15'=> $produk->presentase_bahan_baku15 - $data['jumlah_produksi'],
     'presentase_bahan_baku16'=> $produk->presentase_bahan_baku16 - $data['jumlah_produksi'],
     'presentase_bahan_baku17'=> $produk->presentase_bahan_baku17 - $data['jumlah_produksi'],
     'presentase_bahan_baku18'=> $produk->presentase_bahan_baku18 - $data['jumlah_produksi'],
     'presentase_bahan_baku19'=> $produk->presentase_bahan_baku19 - $data['jumlah_produksi'],
     'presentase_bahan_baku20'=> $produk->presentase_bahan_baku20 - $data['jumlah_produksi'],
                    'total_percentage' => $produk->total_percentage - ($data['jumlah_produksi'] * 3)
                ];

                $this->db->set($update)->where('kode_produk', $produk->kode_produk)->update('produk');

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
        } else {
            return ['status' => false, 'msg' => 'kode produksi tidak ditemukan'];
        }
    }
}
<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Apipembelian extends RestController
{

    public function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('pembelian_model', 'm_beli');
    }

    public function index_get()
    {
        $id = $this->get('id');
        if ($id === null) {
            //p = pages
            $p = $this->get('page');
            $p = (empty($p) ? 1 : $p);
            $total_data = $this->m_beli->count();
            $total_pages = ceil($total_data / 5);
            $start = ($p - 1) * 5;
            $list = $this->m_beli->get(null, 5, $start);
            if ($list) {
                // Users from a data store database
                $data = [
                    'status' => true,
                    'page' => $p,
                    'total_data' => $total_data,
                    'total_page' => $total_pages,
                    'data' => $list
                ];
            } else {
                $data = [
                    'status' => false,
                    'notif' => 'data tidak ditemukan'
                ];
            }
            $this->response($data, RestController::HTTP_OK);
        } else {
            $data = $this->m_beli->get($id);
            if ($data) {
                $this->response(['status' => true, 'data user' => $data], RestController::HTTP_OK);
            } else {
                $this->response(['status' => false, 'id =' => $id, 'atau data tidak ada'], RestController::HTTP_NOT_FOUND);
            }
        }
    }

    public function index_post()
    {
        $tmpName    = $_FILES["gambar"]["tmp_name"];
        $fileName   = 'uploads/' . basename($_FILES["gambar"]["name"]);
        
        if (move_uploaded_file($tmpName, $fileName)) {
            $data = [
                'kode_material' => $this->post('kode_material'),
                'quantity' => $this->post('quantity'),
                'satuan' => $this->post('satuan'),
                'nama_suplier' => $this->post('nama_suplier'),
                'gambar' => basename($_FILES["gambar"]["name"])
            ];
            $simpan = $this->m_beli->add($data);
            if ($simpan['status']) {
                $this->response(['status' => true, 'msg' => $simpan['data'] . ' data telah ditambahkan'], RestController::HTTP_CREATED);
            } else {
                $this->response(['status' => false, 'msg' => ['msg']], RestController::HTTP_INTERNAL_ERROR);
            }
        } else {
            echo('gagal');
        }

    }
    public function index_put()
    {
        $data = [
            'kode_material' => $this->put('kode_material'),
            'id' => $this->put('id'),
            'quantity' => $this->put('quantity'),
            'satuan' => $this->put('satuan'),
            'nama_suplier' => $this->put('nama_suplier'),
            'gambar' => $this->post('gambar'),
        ];
        $id = $this->put('id');
        if ($id === null) {
            $this->response(['status' => false, 'msg' => 'masukkan id user yang akan dirubah'], RestController::HTTP_BAD_REQUEST);
        }
        $simpan = $this->m_beli->update($id, $data);
        if ($simpan['status']) {
            $status = (int)$simpan['data'];
            if ($status > 0)
                $this->response(['status' => true, 'msg' => $simpan['data'] . ' data telah di rubah'], RestController::HTTP_OK);
            else
                $this->response(['status' => false, 'msg' => 'tidak ada data yang dirubah'], RestController::HTTP_BAD_REQUEST);
        } else {
            $this->response(['status' => false, 'msg' => $simpan['msg']], RestController::HTTP_INTERNAL_ERROR);
        }
    }
    public function index_delete()
    {
        $id = $this->delete('id');
        if ($id === null) {
            $this->response(['status' => false, 'msg' => 'masukkan id user yang akan hapus'], RestController::HTTP_BAD_REQUEST);
        }
        $delete = $this->m_beli->delete($id);
        if ($delete['status']) {
            $status = (int)$delete['data'];
            if ($status > 0)
                $this->response(['status' => true, 'msg' => $id . ' data telah di hapus'], RestController::HTTP_OK);
            else
                $this->response(['status' => false, 'msg' => 'tidak ada data yang dirubah'], RestController::HTTP_BAD_REQUEST);
        } else {
            $this->response(['status' => false, 'msg' => $delete['msg']], RestController::HTTP_INTERNAL_ERROR);
        }
    }

    public function listpembelian_get()
    {
        $id = $this->get('id');
        if ($id === null) {
            $list = $this->m_beli->listget($id, 5, null);
            if ($list) {
                // Users from a data store database
                $data = [
                    'status' => true,
                    'data' => $list
                ];
            } else {
                $data = [
                    'status' => false,
                    'notif' => 'data tidak ditemukan'
                ];
            }
            $this->response($data, RestController::HTTP_OK);
        } else {
            $data = $this->m_beli->listget($id);
            if ($data) {
                $this->response(['status' => true, 'data user' => $data], RestController::HTTP_OK);
            } else {
                $this->response(['status' => false, 'id =' => $id, 'atau data tidak ada'], RestController::HTTP_NOT_FOUND);
            }
        }
    }
}
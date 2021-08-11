<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Apiproduksi extends RestController {

   public function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('produksi_model','m_produksi');
    }

    public function index_get()
    {
      $id = $this->get('kode_produk');
      if($id===null)
      {
          //p = pages
          $p=$this->get('page');
          $p=(empty($p)?1:$p);
          $total_data = $this->m_produksi->count();
          $total_pages = ceil($total_data/5);
          $start = ($p-1)*5;
        $list = $this->m_produksi->get(null,5,$start);
        if($list) {
        // Users from a data store database
        $data=[
            'status'=>true,
            'page'=>$p,
            'total_data'=>$total_data,
            'total_page'=>$total_pages,
            'data'=> $list
        ];
        }
        else {
            $data=['status'=>false,
            'notif'=>'data tidak ditemukan'];
        }
      $this->response($data,RestController::HTTP_OK);
      } else {
          $data= $this->m_produksi->get($id);
          if($data){
            $this->response(['status'=>true,'data user'=>$data],RestController::HTTP_OK);
                   }
                else
                  {
          $this->response(['status'=>false,'id ='=>$id,'atau data tidak ada'],RestController::HTTP_NOT_FOUND);   
      }
    }
 }


  
 public function index_post()
 {
   $data =[
     'kode_produksi' =>$this->post('kode_produksi'),
     'jumlah_produksi' =>$this->post('jumlah_produksi'),
     'tanggal_produksi' =>$this->post('tanggal_produksi'),
     'createby' =>$this->post('createby'),
   ];
   $simpan=$this->m_produksi->add($data);
   if($simpan['status']){
   $this->response(['status'=>true, 'msg'=>$simpan['msg'].' data telah ditambahkan'], RestController::HTTP_CREATED);

 }else{
   $this->response(['status'=>false, 'msg'=>['msg']],RestController::HTTP_INTERNAL_ERROR);
 }
}

}
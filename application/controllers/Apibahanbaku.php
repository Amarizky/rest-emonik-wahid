<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Apibahanbaku extends RestController {

   public function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('bahanbaku_model','m_bahan');
    }

    public function index_get()
    {
      $id = $this->get('mitra');
      if($id===null)
      {
          //p = pages
          $p=$this->get('page');
          $p=(empty($p)?1:$p);
          $total_data = $this->m_bahan->count();
          $total_pages = ceil($total_data/5);
          $start = ($p-1)*5;
        $list = $this->m_bahan->get(null,5,$start);
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
          $data= $this->m_bahan->get($id);
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
     'bahan1' =>$this->post('bahan1'),
     'bahan2' =>$this->post('bahan2'),
     'bahan3' =>$this->post('bahan3'),
     'bahan4' =>$this->post('bahan4'),
     'bahan5' =>$this->post('bahan5'),
     'bahan6' =>$this->post('bahan6'),
     'bahan7' =>$this->post('bahan7'),
     
     'stokbahan1' =>$this->post('stokbahan1'),
     'stokbahan2' =>$this->post('stokbahan2'),
     'stokbahan3' =>$this->post('stokbahan3'),
     'stokbahan4' =>$this->post('stokbahan4'),
     'stokbahan5' =>$this->post('stokbahan5'),
     'stokbahan6' =>$this->post('stokbahan6'),
     'stokbahan7' =>$this->post('stokbahan7'),


   ];
   $simpan=$this->m_bahan->add($data);
   if($simpan['status']){
   $this->response(['status'=>true, 'msg'=>$simpan['msg'].' data telah ditambahkan'], RestController::HTTP_CREATED);

 }else{
   $this->response(['status'=>false, 'msg'=>['msg']],RestController::HTTP_INTERNAL_ERROR);
 }
}


public function index_put()
 {
   $data =[
    'bahan1' =>$this->put('bahan1'),
    'bahan2' =>$this->put('bahan2'),
    'bahan3' =>$this->put('bahan3'),
    'bahan4' =>$this->put('bahan4'),
    'bahan5' =>$this->put('bahan5'),
    'bahan6' =>$this->put('bahan6'),
    'bahan7' =>$this->put('bahan7'),
    
    'stokbahan1' =>$this->put('stokbahan1'),
    'stokbahan2' =>$this->put('stokbahan2'),
    'stokbahan3' =>$this->put('stokbahan3'),
    'stokbahan4' =>$this->put('stokbahan4'),
    'stokbahan5' =>$this->put('stokbahan5'),
    'stokbahan6' =>$this->put('stokbahan6'),
    'stokbahan7' =>$this->put('stokbahan7'),
   ];
   $id=$this->put('mitra');
   if ($id=== null){
    $this->response(['status'=>false, 'msg'=>'masukkan mitra yang akan dirubah'],RestController::HTTP_BAD_REQUEST);
   }
   $simpan=$this->m_bahan->update($id, $data);
   if($simpan['status']){
   $status = (int)$simpan['data'];
   if ($status>0)
   $this->response(['status'=>true, 'msg'=>$simpan['data'].' data telah di rubah'], RestController::HTTP_OK);
   else
   $this->response(['status'=>false, 'msg'=>'tidak ada data yang dirubah'],RestController::HTTP_BAD_REQUEST);
  }else{
   $this->response(['status'=>false, 'msg'=>$simpan['msg']],RestController::HTTP_INTERNAL_ERROR);
 }
}
public function index_delete()
 {
   $id=$this->delete('mitra');
   if ($id=== null){
    $this->response(['status'=>false, 'msg'=>'masukkan id user yang akan hapus'],RestController::HTTP_BAD_REQUEST);
   }
   $delete=$this->m_bahan->delete($id);
   if($delete['status']){
   $status = (int)$delete['data'];
   if ($status>0)
   $this->response(['status'=>true, 'msg'=>$id.' data telah di hapus'], RestController::HTTP_OK);
   else
   $this->response(['status'=>false, 'msg'=>'tidak ada data yang dirubah'],RestController::HTTP_BAD_REQUEST);
  }else{
   $this->response(['status'=>false, 'msg'=>$delete['msg']],RestController::HTTP_INTERNAL_ERROR);
 }
}

}
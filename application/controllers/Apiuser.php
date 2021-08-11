<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Apiuser extends RestController {

   public function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('users_model','m_user');
    }

    public function index_get()
    {
      $id = $this->get('id');
      if($id===null)
      {
          //p = pages
          $p=$this->get('page');
          $p=(empty($p)?1:$p);
          $total_data = $this->m_user->count();
          $total_pages = ceil($total_data/5);
          $start = ($p-1)*5;
        $list = $this->m_user->get(null,5,$start);
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
          $data= $this->m_user->get($id);
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
     'email' =>$this->post('email'),
     'id'=>$this->post('id'),
     'name'=>$this->post('nama'),
     'password'=>$this->post('password'),
     'level'=>$this->post('level'),
   ];
   $simpan=$this->m_user->add($data);
   if($simpan['status']){
   $this->response(['status'=>true, 'msg'=>$simpan['data'].' data telah ditambahkan'], RestController::HTTP_CREATED);

 }else{
   $this->response(['status'=>false, 'msg'=>['msg']],RestController::HTTP_INTERNAL_ERROR);
 }
}


public function index_put()
 {
   $data =[
     'email' =>$this->put('email'),
     'id'=>$this->put('id'),
     'name'=>$this->put('nama'),
     'password'=>$this->put('password'),
     'level'=>$this->put('level'),
   ];
   $id=$this->put('id');
   if ($id=== null){
    $this->response(['status'=>false, 'msg'=>'masukkan id user yang akan dirubah'],RestController::HTTP_BAD_REQUEST);
   }
   $simpan=$this->m_user->update($id, $data);
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
   $id=$this->delete('id');
   if ($id=== null){
    $this->response(['status'=>false, 'msg'=>'masukkan id user yang akan hapus'],RestController::HTTP_BAD_REQUEST);
   }
   $delete=$this->m_user->delete($id);
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
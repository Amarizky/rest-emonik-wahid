<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Apikomposisiproduk extends RestController {

   public function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('produk_model','m_produk');
    }

    public function index_get()
    {
      $id = $this->get('kode_produk');
      if($id===null)
      {
          //p = pages
          $p=$this->get('page');
          $p=(empty($p)?1:$p);
          $total_data = $this->m_produk->count();
          $total_pages = ceil($total_data/5);
          $start = ($p-1)*5;
        $list = $this->m_produk->get(null,5,$start);
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
          $data= $this->m_produk->get($id);
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
     'kode_produk' =>$this->post('kode_produk'),
     'nama_produk' =>$this->post('nama_produk'),
     'bahan1' =>$this->post('bahan1'),
     'bahan2' =>$this->post('bahan2'),
     'bahan3' =>$this->post('bahan3'),
     'bahan4' =>$this->post('bahan4'),
     'bahan5' =>$this->post('bahan5'),
     'bahan6' =>$this->post('bahan6'),
     'bahan7' =>$this->post('bahan7'),
     'bahan8' =>$this->post('bahan8'),
     'bahan9' =>$this->post('bahan9'),
     'bahan10' =>$this->post('bahan10'),
     'bahan11' =>$this->post('bahan11'),
     'bahan12' =>$this->post('bahan12'),
     'bahan13' =>$this->post('bahan13'),
     'bahan14' =>$this->post('bahan14'),
     'bahan15' =>$this->post('bahan15'),
     'bahan16' =>$this->post('bahan16'),
     'bahan17' =>$this->post('bahan17'),
     'bahan18' =>$this->post('bahan18'),
     'bahan19' =>$this->post('bahan19'),
     'bahan20' =>$this->post('bahan20'),
     'presentase_bahan_baku1'=>$this->post('presentase_bahan_baku1'),
     'presentase_bahan_baku2'=>$this->post('presentase_bahan_baku2'),
     'presentase_bahan_baku3'=>$this->post('presentase_bahan_baku3'),
     'presentase_bahan_baku4'=>$this->post('presentase_bahan_baku4'),
     'presentase_bahan_baku5'=>$this->post('presentase_bahan_baku5'),
     'presentase_bahan_baku6'=>$this->post('presentase_bahan_baku6'),
     'presentase_bahan_baku7'=>$this->post('presentase_bahan_baku7'),
     'presentase_bahan_baku8'=>$this->post('presentase_bahan_baku8'),
     'presentase_bahan_baku9'=>$this->post('presentase_bahan_baku9'),
     'presentase_bahan_baku10'=>$this->post('presentase_bahan_baku10'),
     'presentase_bahan_baku11'=>$this->post('presentase_bahan_baku11'),
     'presentase_bahan_baku12'=>$this->post('presentase_bahan_baku12'),
     'presentase_bahan_baku13'=>$this->post('presentase_bahan_baku13'),
     'presentase_bahan_baku14'=>$this->post('presentase_bahan_baku14'),
     'presentase_bahan_baku15'=>$this->post('presentase_bahan_baku15'),
     'presentase_bahan_baku16'=>$this->post('presentase_bahan_baku16'),
     'presentase_bahan_baku17'=>$this->post('presentase_bahan_baku17'),
     'presentase_bahan_baku18'=>$this->post('presentase_bahan_baku18'),
     'presentase_bahan_baku19'=>$this->post('presentase_bahan_baku19'),
     'presentase_bahan_baku20'=>$this->post('presentase_bahan_baku20'),
     'total_percentage'=>$this->post('total_percentage'),
   ];
   $simpan=$this->m_produk->add($data);
   if($simpan['status']){
   $this->response(['status'=>true, 'msg'=>$simpan['data'].' data telah ditambahkan'], RestController::HTTP_CREATED);

 }else{
   $this->response(['status'=>false, 'msg'=>['msg']],RestController::HTTP_INTERNAL_ERROR);
 }
}

public function listproduk_get()
{
    $id = $this->get('id');
    if ($id === null) {
        $list = $this->m_produk->listget($id, 5, null);
        if ($list) {
            // Users from a data store database
            $data = [
                'status' => true,
                'data' => $list
              ];
            }
            else {
                $data=['status'=>false,
                'notif'=>'data tidak ditemukan'];
            }
          $this->response($data,RestController::HTTP_OK);
          } else {
              $data= $this->m_produk->listget($id);
              if($data){
                $this->response(['status'=>true,'data list produk'=>$data],RestController::HTTP_OK);
                       }
                    else
                      {
              $this->response(['status'=>false,'id ='=>$id,'atau data tidak ada'],RestController::HTTP_NOT_FOUND);   
          }
        }
     }

     public function listbahan_get()
     {
         $id = $this->get('id');
         if ($id === null) {
             $list = $this->m_produk->listbahan($id, 5, null);
             if ($list) {
                 // Users from a data store database
                 $data = [
                     'status' => true,
                     'data' => $list
                   ];
                 }
                 else {
                     $data=['status'=>false,
                     'notif'=>'data tidak ditemukan'];
                 }
               $this->response($data,RestController::HTTP_OK);
               } else {
                   $data= $this->m_produk->listbahan($id);
                   if($data){
                     $this->response(['status'=>true,'data list bahan'=>$data],RestController::HTTP_OK);
                            }
                         else
                           {
                   $this->response(['status'=>false,'id ='=>$id,'atau data tidak ada'],RestController::HTTP_NOT_FOUND);   
               }
             }
          }

}
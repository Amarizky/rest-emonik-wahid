<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Apilistbahan extends RestController {

   public function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('listbahan_model','m_lbahan');
    }



     public function index_get()
     {
         $id = $this->get('id');
         if ($id === null) {
             $list = $this->m_lbahan->get($id, 5, null);
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
                   $data= $this->m_lbahan->get($id);
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
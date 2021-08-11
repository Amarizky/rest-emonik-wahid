<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class listbahan_model extends CI_Model {

   public function __construct()
    {
        // Construct the parent class
        parent::__construct();
    }

    public function get($id = null, $limit = 5, $offset = 0)
    {
        if($id===null){
        // Users from a data store e.g. database
        return $this->db->get('listbahan',$limit, $offset)->result();
        }
        else
        {
            return $this->db->get_where('idbahan',['idbahan'=>$id])->result_array();
        }
    }


}
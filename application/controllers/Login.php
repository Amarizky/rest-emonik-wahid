<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
class Login extends REST_Controller {


    public function __construct()
	{
		parent::__construct();
        $this->load->model('M_api');
        $this->load->library('session');
    }

    //-------------------------------------- LOGIN ---------------------------------------------------  

    public function index_post()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['name']) && isset($_POST['password'])) {
                
                $user_login = $this->M_api->proses_login($_POST['name'], $_POST['password']);
                $result['id']   = null;
                

                if ($user_login->num_rows() == 1) {
                    
        $this->load->library('session');
                    $this->session->set_userdata('name', $user_login->result()->name);
                    print_r($_SESSION['name']);
                    die();
                    $result['value'] = "1";
                    $result['id']   = $user_login->row()->id;
                    $result['pesan'] = "sukses login";
                    $tokenData = array();
                    $tokenData['id'] = 1; //TODO: Replace with data for token
                    $result['token'] = AUTHORIZATION::generateToken($tokenData);
                } else {
                    $result['value'] = "0";
                    $result['pesan'] = "username / password salah!";
                }
            } else {
                $result['value'] = "0";
                $result['pesan'] = "beberapa inputan masih kosong!";
            }
        } else {
            $result['value'] = "0";
            $result['pesan'] = "invalid request method!";
        }

        echo json_encode($result);
    }


    public function token_post()
    {
        $headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
                $this->set_response($decodedToken, REST_Controller::HTTP_OK);
                return;
            }
        }

        $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
    }
    public function logout_post()
 {
     $this->load->library('session');
     $this->session->sess_destroy();
     $result['value'] = "0";
     $result['pesan'] = "log out sukses";
 }
}

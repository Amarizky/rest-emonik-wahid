<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
class Apilogin extends REST_Controller
{

    public function check_login_post()
    {
        // get data from database based on user input
        $input = $this->input->post(null, true);
        $username = $input['username'];
        $password = $input['password'];

        $data = $this->crud->get_where('users', '*', array('username' => $username, 'is_active' => '1'))->row();

        //check username 
        if (isset($data->username)) {
            if (password_verify($password, $data->password)) {
                $role = $this->crud->get_where('roles', '*', array('roleid' => $data->roleid))->row();
                // set session
                $session = array(
                    'logged_in' => 'true',
                    'id' => $data->id,
                    'email' => $data->email,
                    'username' => $data->username,
                    'is_active' => $data->is_active,
                    'name' => $data->name,
                    'avatar' => $data->avatar,
                    'roleid' => $data->roleid,
                    'rolename' => $role->rolename,
                    'roledesc' => $role->desc,
                );
                $this->crud->update('users', ['last_login' => date('Y-m-d H:i:s')], ['username' => $data->username]);

                print(json_encode($session));
            } else {
                // login failed
                print_r(json_encode(array('logged_in' => 'false')));
            }
        } else {
            print_r(json_encode(array('logged_in' => 'false')));
        }
    }
}

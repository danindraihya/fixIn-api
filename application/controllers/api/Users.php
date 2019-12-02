<?php 
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Users extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', 'user');
    }

    public function index_get()
    {
        $id = $this->get('id');
        // var_dump($id); die();

        if($id === null) {
            $user = $this->user->getUser();
        } else {
            $user = $this->user->getUser($id);
        }
        
        if($user) {
            $this->response([
                'status' => true,
                'Data' => $user
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data not Found !'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_delete()
    {
        $id = $this->delete('id');
        
        if($id === null) {
            $this->response([
                'status' => false,
                'message' => 'Provide an id'
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {
            if($this->user->deleteUser($id) > 0) {
                $this->response([
                    'status' => true,
                    'id' => $id,
                    'message' => 'Data has been deleted !'
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'failed to delete data'
                ], REST_Controller::HTTP_NOT_FOUND);       
            }
        }
    }

    public function index_post()
    {
        $data = [
            'idbengkel' => $this->post('idbengkel'),
            'jenisuser' => $this->post('jenisuser'),
            'username' => $this->post('username'),
            'password' => $this->post('password'),
            'email' => $this->post('email')
        ];

        if($this->user->createUser($data) > 0) {
            $this->response([
                'status' => true,
                'message' => 'New user has been created !'
            ], REST_Controller::HTTP_CREATED);
        } else {
            $this->response([
                'status' => false,
                'message' => 'failed to create new user'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function index_put()
    {
        $id = $this->put('id');
        $data = [
            'idbengkel' => $this->put('idbengkel'),
            'jenisuser' => $this->put('jenisuser'),
            'username' => $this->put('username'),
            'password' => $this->put('password'),
            'email' => $this->put('email')
        ];

        if($this->user->updateUser($data, $id) > 0) {
            $this->response([
                'status' => true,
                'id' => $id,
                'message' => 'Data has been updated'
            ], REST_Controller::HTTP_CREATED);
        } else {
            $this->response([
                'status' => false,
                'message' => 'failed to update data'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
?>
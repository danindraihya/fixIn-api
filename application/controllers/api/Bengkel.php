<?php 
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Bengkel extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Bengkel_model', 'bengkel');
    }

    public function index_get()
    {
        $id = $this->get('id');
        if($id === null) {
            $bengkel = $this->bengkel->getBengkel();
        } else {
            $bengkel = $this->bengkel->getBengkel($id);
        }

        if($bengkel) {
            $this->response([
                'status' => true,
                'data' => $bengkel
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data not found'
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
            if($this->bengkel->deleteBengkel($id) > 0) {
                $this->response([
                    'status' => true,
                    'id' => $id,
                    'message' => 'Data has been deleted !'
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Failed to delete data'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }

    public function index_post()
    {
        $data = [
            'jenisUser' => $this->post('jenisUser'),
            'userName' => $this->post('userName'),
            'password' => $this->post('password'),
            'alamat' => $this->post('alamat'),
            'latitude' => $this->post('latitude'),
            'longitude' => $this->post('longitude'),
        ];

        if($this->bengkel->createBengkel($data) > 0) {
            $this->response([
                'status' => true,
                'message' => 'Data has been created'
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Failed to create data'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function index_put()
    {
        $id = $this->put('id');
        $data = [
            'jenisUser' => $this->put('jenisUser'),
            'userName' => $this->put('userName'),
            'password' => $this->put('password'),
            'alamat' => $this->put('alamat'),
            'latitude' => $this->put('latitude'),
            'longitude' => $this->put('longitude'),
        ];

        if($this->bengkel->updateBengkel($data, $id) > 0) {
            $this->response([
                'status' => true,
                'message' => 'Data has been update'
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Failed to update data'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}

?>
<?php 
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Kendaraan extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Kendaraan_model', 'kendaraan');
    }

    public function index_get()
    {
        $noStnk = $this->get('noStnk');
        if($noStnk === null) {
            $kendaraan = $this->kendaraan->getKendaraan();
        } else {
            $kendaraan = $this->kendaraan->getKendaraan($noStnk);
        }

        if($kendaraan) {
            $this->response([
                'status' => true,
                'data' => $kendaraan
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
        $noStnk = $this->delete('noStnk');
        if($noStnk === null) {
            $this->response([
                'status' => false,
                'message' => 'Provide an id'
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {
            if($this->kendaraan->deleteKendaraan($noStnk) > 0) {
                $this->response([
                    'status' => true,
                    'id' => $noStnk,
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
            'noStnk' => $this->post('noStnk'),
            'idUser' => $this->post('idUser'),
            'tipeKendaraan' => $this->post('tipeKendaraan'),
            'tahunKendaraan' => $this->post('tahunKendaraan'),
            'nomorPolisi' => $this->post('nomorPolisi'),
            'seri' => $this->post('seri')
        ];

        if($this->kendaraan->createKendaraan($data) > 0) {
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
        $noStnk = $this->put('noStnk');
        $data = [
            'idUser' => $this->put('idUser'),
            'tipeKendaraan' => $this->put('tipeKendaraan'),
            'tahunKendaraan' => $this->put('tahunKendaraan'),
            'nomorPolisi' => $this->put('nomorPolisi'),
            'seri' => $this->put('seri')
        ];

        if($this->kendaraan->updateKendaraan($data, $noStnk) > 0) {
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
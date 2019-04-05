<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');


require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Profil extends REST_Controller
{
    function __construct()
    {

        parent::__construct();
        $this->load->model('Model_Profil');
    }

    //mengirim parameter lewat id
    public function index_get()
    {
        $id = $this->get('id');
        if ($id === null) {
            //dt itu variable
            $dt = $this->Model_Profil->get_data();
        } else {
            $dt = $this->Model_Profil->get_data($id);
        }
        if ($dt) {
            // Set the response and exit
            $this->response([
                'status' => true,
                'data' => $dt
            ], REST_Controller::HTTP_OK);
        } else {
            // Set the response and exit
            $this->response([
                'status' => false,
                'message' => 'No users were found'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
    public function index_delete()
    {
        $id = $this->delete('id');
        if ($id === null) {
            $this->response([
                'status' => false,
                'message' => 'you need ID to delete'
            ], REST_Controller::HTTP_NOT_FOUND);
        } else {
            if ($this->Model_Profil->delete_data($id) > 0) {
                $this->response([
                    'status' => true,
                    'data' => $id,
                    'message' => 'data berhasil di hapus'
                ], REST_Controller::HTTP_OK);
            } else {
                // Set the response and exit
                $this->response([
                    'status' => false,
                    'message' => 'data gagal di hapus,id tidak ditemukan'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }
    public function index_post()
    {
        $id = $this->post('id');
        $dt = [

            'id_bengkel' => $this->post('id_bengkel'),
            'nama_bengkel' => $this->post('nama_bengkel'),
            'alamat' => $this->post('alamat'),
            'pemilik' => $this->post('pemilik'),
            'foto' => $this->post('foto'),
        ];
        if ($this->Model_Profil->tambah_data($dt) > 0) {
            $this->response([
                'status' => true,
                'message' => 'data berhasil di tambah'
            ], REST_Controller::HTTP_CREATED);
        } else {
            // Set the response and exit
            $this->response([
                'status' => false,
                'message' => 'data gagal ditambahkan'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    public function index_put()
    {
        $id = $this->put('id');
        $dt = [
            'nama_bengkel' => $this->put('nama_bengkel'),
            'alamat' => $this->put('alamat'),
            'pemilik' => $this->put('pemilik'),
            'foto' => $this->put('foto'),
        ];
        if ($this->Model_Profil->edit_data($dt, $id) > 0) {
            $this->response([
                'status' => true,
                'message' => 'data berhasil di rubah'
            ], REST_Controller::HTTP_CREATED);
        } else {
            // Set the response and exit
            $this->response([
                'status' => false,
                'message' => 'data gagal di rubah'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}

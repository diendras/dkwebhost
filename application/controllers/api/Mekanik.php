<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Mekanik extends REST_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('mekanik_model');
    }

    Public function index_get()
    {
        $id=$this->get('id');
            if($id===null)
            {
                $mekanik=$this->mekanik_model->getmekanik();
            }else 
            {
                $mekanik=$this->mekanik_model->getmekanik($id);
            }
                if($mekanik)
                {
                    $this->response([
                        'status'=>true,
                        'data'=>$mekanik
                        
                    ], REST_Controller::HTTP_OK);
                }else
                {
                    // Set the response and exit
                    $this->response([
                        'status' => FALSE,
                        'message' => 'ID Tidak Ditemukan'
                    ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
                }
        

    }
    Public function index_delete()
    {
        $id=$this->delete('id');
            if($id===null)
            {
                $this->response([
                    'status' => FALSE,
                    'message' => 'Perintah Ini Membutuhkan ID'
                ], REST_Controller::HTTP_NOT_FOUND);
            }else
            {
               if($this->mekanik_model->deletemekanik($id) > 0);
               $this->response([
                'status'=>true,
                'data'=>$id,
                'message'=>'Data Berhasil Dihapus'
                
                ], REST_Controller::HTTP_OK);
            }
            {
                $this->response([
                    'status' => FALSE,
                    'message' => 'ID Tidak Ditemukan'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }

    }

    Public function index_post()
    {
        $data=[
            'id_mekanik'=>$this->post('id_m'),
            'nama_mekanik'=>$this->post('nama'),
            'alamat'=>$this->post('alamat'),
            'telp'=>$this->post('telp'),
            'status'=>$this->post('status')
        ];

        if($this->mekanik_model->tambahmekanik($data) > 0)
        {
            $this->response([
                'status'=>true,
                'message'=>'Data Berhasil Ditambah'
            ], REST_Controller::HTTP_CREATED);

        }else
        {
            $this->response([
                'status' => FALSE,
                'message' => 'Data Gagal Untuk Ditambahkan'
            ], REST_Controller::HTTP_BAD_REQUEST); // NOT_FOUND (404) being the HTTP response code

        }
    }

    Public function index_put()
    {
        $id = $this->put('id_m');
        $data=[
            'nama_mekanik'=>$this->put('nama'),
            'alamat'=>$this->put('alamat'),
            'telp'=>$this->put('telp'),
            'status'=>$this->put('status')
        ];

        if($this->mekanik_model->rubahmekanik($data,$id) > 0)
        {
            $this->response([
                'status'=>true,
                'message'=>'Data Berhasil Dirubah'
            ], REST_Controller::HTTP_CREATED);
        }else
        {
            $this->response([
                'status' => FALSE,
                'message' => 'Data Gagal Untuk Dirubah'
            ], REST_Controller::HTTP_BAD_REQUEST); // NOT_FOUND (404) being the HTTP response code

        }

    }
}

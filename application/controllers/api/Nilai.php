<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');


require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Nilai extends REST_Controller
{

    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->database();
    }

    function index_get()
    {
        $id = $this->get('nim');
        if ($id == '') {
            $nilai = $this->db->get('nilai')->result();
        } else {
            $this->db->where('nim', $id);
            $nilai = $this->db->get('nilai')->result();
        }
        $this->response($nilai, 200);
    }

    function index_post()
    {
        $data = array(
            'nim'           => $this->post('nim'),
            'kdmk'          => $this->post('kdmk'),
            'nilai'    => $this->post('nilai'),
            'thakd'    => $this->post('thakd')
        );
        $insert = $this->db->insert('nilai', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_put()
    {
        $id = $this->put('nim');
        $data = array(
            'nim'       => $this->put('nim'),
            'kdmk'          => $this->put('kdmk'),

            'thakd'    => $this->put('thakd'),
            'nilai'    => $this->put('nilai')
        );
        $this->db->where('nim', $id);
        $update = $this->db->update('nilai', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_delete()
    {
        $id = $this->delete('nim');
        $this->db->where('nim', $id);
        $delete = $this->db->delete('nilai');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}

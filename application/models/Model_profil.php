<?php 

class Model_Profil extends CI_Model
{



    //menerima parameerid dari controler
    public function get_data($id = null)
    {
        if ($id === null) {
            return $this->db->get('tb_profil')->result_array();
        } else {
            //selet di ci diganti get jadi get where 
            //                        ini parameter ini index indeks itu kotak kotak
            return $this->db->get_where('tb_profil', ['id_bengkel' => $id])->result_array();
        }
    }
    public function delete_data($id)
    {
        $this->db->delete('tb_profil', ['id_bengkel' => $id]);
        return $this->db->affected_rows();
    }
    public function tambah_data($dt)
    {
        $this->db->insert('tb_profil', $dt);
        return $this->db->affected_rows();
    }
    public function edit_data($dt, $id)
    {
        $this->db->update('tb_profil', $dt, ['id_bengkel' => $id]);
        return $this->db->affected_rows();
    }
}

<?php
class Mekanik_model extends CI_Model
{
    public function getmekanik($id=null)
    {
        if($id===null)
        {
            return $this->db->get('tb_mekanik')->result_array();
        }else 
        {
            return $this->db->get_where('tb_mekanik',['id_mekanik'=>$id])->result_array();
        } 
        
    }
    public function deletemekanik($id)
    {
        $this->db->delete('tb_mekanik',['id_mekanik'=>$id]);
        return $this->db->affected_rows();
        
    }
    public function tambahmekanik($data)
    {
        $this->db->insert('tb_mekanik',$data);
        return $this->db->affected_rows();
    }

    public function rubahmekanik($data,$id)
    {
        $this->db->update('tb_mekanik',$data,['id_mekanik'=>$id]);
        return $this->db->affected_rows();

    }

}
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_crud extends CI_Model
{

    public function menambah($tabel, $data)
    {
        if ($this->db->insert($tabel, $data)) {
            return array(
                'status' => 200,
                'nilai'  => $this->db->insert_id(),
            );
        } else {
            return array(
                'status' => 404,
            );
        }
    }

    public function mengubah($tabel, $where, $data)
    {
        $this->db->where($where);
        if ($this->db->update($tabel, $data)) {
            return array(
                'status' => 200,
            );
        } else {
            return array(
                'status' => 404,
            );
        }
    }

    public function menghapus($tabel, $where)
    {
        $this->db->where($where);
        if ($this->db->delete($tabel)) {
            return array(
                'status' => 200,
            );
        } else {
            return array(
                'status' => 404,
            );
        }
    }

    public function mengambil($tabel, $where = null)
    {
        if ($where != null) {
            $this->db->where($where);
        }
        $q = $this->db->get($tabel);
        return array(
            'num_rows' => $q->num_rows(),
            'data'     => $q,
        );
    }
}

/* End of file Mod_crud.php */
/* Location: ./application/models/Mod_crud.php */
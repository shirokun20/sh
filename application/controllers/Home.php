<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function index($id = null)
    {
    	if ($id != null) {
	        $q          = $this->mod_crud->mengambil('contact', array('id'=>$id));
    	}else{
	        $q          = $this->mod_crud->mengambil('contact');
    	}
        if ($q['num_rows'] == true) {
            $status = 200;
        } else {
            $status = 404;
        }

        echo $this->li->to_json(array(
            'status' => $status,
            'data'   => $q['data']->result(),
        ));
    }

    public function tambah()
    {
        $rawData = file_get_contents('php://input');
        $datanya = json_decode($rawData, true);

        if (count($datanya) > 0) {
            $cek = $this->mod_crud->mengambil('contact', array('phone' => $datanya['phone']));
            if ($cek['num_rows'] == true) {
                $status = 404;
                $pesan  = 'No telepon sudah digunakan.';
            } else {
                $data = array(
                    'name'        => $datanya['name'],
                    'phone'       => $datanya['phone'],
                    'description' => $datanya['description'],
                    'created'     => date('Y-m-d H:i:s'),
                    'updated'     => date('Y-m-d H:i:s'),
                );
                $hasil  = $this->mod_crud->menambah('contact', $data);
                $status = $hasil['status'];
                if ($status == 200) {
                    $awal = 'Berhasil';
                } else {
                    $awal = 'Gagal';
                }
                $pesan = $awal . ' menambah data.';

            }
        } else {
            $status = 404;
            $pesan  = 'Tidak ada data yang di request.';
        }

        echo $this->li->to_json(array(
            'status' => $status,
            'pesan'  => $pesan,
        ));
    }

    public function ubah($id = null)
    {
        $rawData = file_get_contents('php://input');
        $datanya = json_decode($rawData, true);

        if (count($datanya) > 0) {
            $cek = $this->mod_crud->mengambil('contact', array('id' => $id));
            if ($cek['num_rows'] == false) {
                $status = 404;
                $pesan  = 'Contact Tidak Ditemukan';
            } else {
                $data = array(
                    'name'        => $datanya['name'],
                    'phone'       => $datanya['phone'],
                    'description' => $datanya['description'],
                    'updated'     => date('Y-m-d H:i:s'),
                );
                $hasil  = $this->mod_crud->mengubah('contact', array('id' => $id), $data);
                $status = $hasil['status'];
                if ($status == 200) {
                    $awal = 'Berhasil';
                } else {
                    $awal = 'Gagal';
                }
                $pesan = $awal . ' mengubah data.';

            }
        } else {
            $status = 404;
            $pesan  = 'Tidak ada data yang di request.';
        }

        echo $this->li->to_json(array(
            'status' => $status,
            'pesan'  => $pesan,
        ));
    }

    public function hapus($id = null)
    {
        $cek = $this->mod_crud->mengambil('contact', array('id' => $id));
        if ($cek['num_rows'] == false) {
            $status = 404;
            $pesan  = 'Contact Tidak Ditemukan.';
        } else {
            $hasil  = $this->mod_crud->menghapus('contact', array('id' => $id));
            $status = $hasil['status'];
            if ($status == 200) {
                $awal = 'Berhasil';
            } else {
                $awal = 'Gagal';
            }
            $pesan = $awal . ' menghapus data.';
        }

        echo $this->li->to_json(array(
            'status' => $status,
            'pesan'  => $pesan,
        ));
    }

    public function error()
    {
        echo $this->li->to_json(array(
            'status'  => 404,
            'message' => 'Halaman Tidak Ditemukan',
        ));
    }
}
/* End of file Home.php */
/* Location: ./application/controllers/Home.php */
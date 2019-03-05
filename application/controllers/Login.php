<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		$rawData = $this->input->raw_input_stream;
        $datanya = json_decode($rawData, true);
        $json = array();
        if (count($datanya) > 0) {
            $cek = $this->mod_crud->mengambil('user', array(
            	'email' => $datanya['email'],
            	'password' => md5($datanya['password'])
            ));
            if ($cek['num_rows'] == true) {
                $status = 200;
                $pesan  = 'Berhasil masuk ke aplikasi.';
                $json[] = $cek['data']->row();
            } else {
                $status = 404;
                $pesan  = 'Username dan password tidak ditemukan.';
            }
        } else {
            $status = 404;
            $pesan  = 'Tidak ada data yang di request.';
        }

        echo $this->li->to_json(array(
            'status' => $status,
            'pesan'  => $pesan,
            'data'	 => $json
        ));
	}

	// private function _upload()
 //    {
 //        $nmfile                  = "produkImg_" . time();
 //        $config['upload_path']   = './uploads/';
 //        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|GIF|JPG|PNG|JPEG|BMP|';
 //        $config['max_size']      = '10000';
 //        $config['max_width']     = '100000';
 //        $config['max_height']    = '100000';
 //        $config['file_name']     = $nmfile;
 //        $this->load->library('upload', $config);
 //    }

	// public function test($id)
	// {
	// 	$this->_upload();
	// 	$rawData = $this->input->raw_input_stream;
 //        $data = json_decode($rawData, true);
	// 	$data['Authorization'] = $this->input->get_request_header('Authorization');
	// 	$data['coba'] = $this->input->get_post('coba');
	// 	$data['id'] = $id;

	// 	if ($this->upload->do_upload('test')) {
 //            $upload               = $this->upload->data();
 //            $data['gambarproduk'] = $upload['file_name'];
 //        }

 //        echo json_encode($data);

	// }
}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */

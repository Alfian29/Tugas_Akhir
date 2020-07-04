<?php 
        
defined('BASEPATH') OR exit('No direct script access allowed');
        
class Produk extends CI_Controller {
 
public function __construct()
{
    parent::__construct();
    $this->load->model('M_Produk');
}


public function index()
{
    if($this->session->userdata('logged_in')== TRUE){
        $data['content']="v_produk";
        $data['list'] = $this->M_Produk->get_list_produk();
		$this->load->view('v_template', $data);
        }
}
public function form_add_produk()
{
    if($this->session->userdata('logged_in')== TRUE){
        $data['content']="v_form_add_produk";
		$this->load->view('v_template', $data);
        }
}
public function add_produk(){
    $config['upload_path'] = './assets/images/products-img';
	$config['allowed_types'] = 'jpg|png';

		if ($_FILES['gambar']['name'] != "") {
			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('gambar')) {
				$this->session->set_flashdata('pesan', $this->upload->display_errors());
				redirect('Produk/index');
			} else {
				if($this->M_Produk->tambah_produk($this->upload->data('file_name'))){
					$this->session->set_flashdata('pesan', 'berhasil menambah data');
				} else {
					$this->session->set_flashdata('pesan', 'gagal menambah data');
				}
				redirect('Produk/index');
			}
				
		} else {
			if ($this->M_Produk->tambah_produk('')) {
				$this->session->set_flashdata('pesan', 'berhasil menambah data');
			} else {
				$this->session->set_flashdata('pesan', 'gagal menambah data');
			}
			redirect('Produk/index');
		}	
}
public function update_produk(){
	$config['upload_path'] = './assets/images/products-img';
	$config['allowed_types'] = 'jpg|png';

		if ($_FILES['gambar']['name'] != "") {
			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('gambar')) {
				$this->session->set_flashdata('pesan', $this->upload->display_errors());
				redirect('Produk/index');
			} else {
				if($this->M_Produk->update_produk($this->upload->data('file_name'))){
					$this->session->set_flashdata('pesan', 'berhasil mengubah data');
				} else {
					$this->session->set_flashdata('pesan', 'gagal mengubah data');
				}
				redirect('Produk/index');
			}
				
		} else {
			if ($this->M_Produk->update_produk('')) {
				$this->session->set_flashdata('pesan', 'berhasil mengubah data');
			} else {
				$this->session->set_flashdata('pesan', 'gagal mengubah data');
			}
			redirect('Produk/index');
		}	
	}
public function get_detail_produk($id_produk=''){
	$data_detail=$this->M_Produk->detail_produk($id_produk);
	echo json_encode($data_detail);
}
public function hapus_produk($id_produk){
	$hapus = $this->M_Produk->hapus_produk($id_produk);
	if($hapus == TRUE){
		$this->session->set_flashdata('pesan', 'Hapus produk berhasil');
	} else {
		$this->session->set_flashdata('gagal', 'Hapus produk gagal');
	}
	redirect(base_url('index.php/Produk'), 'refresh');
}
        
}
        
    /* End of file  Produk.php */
        
                            
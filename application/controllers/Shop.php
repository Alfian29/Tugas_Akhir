<?php 
        
defined('BASEPATH') OR exit('No direct script access allowed');
        
class Shop extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
        $this->load->model('M_Shop');
        date_default_timezone_set("Asia/Bangkok");

	}
public function index()
{
    $data['content'] = 'v_shop';
    $data['produk'] = $this->M_Shop->get_produk();
    $this->load->view('v_template', $data);
}
public function cart(){
    $data['isi_keranjang'] = $this->M_Shop->isi_keranjang();
    $data['sumharga']= $this->M_Shop->sumharga();
    $data['content'] = 'v_cart';
    $this->load->view('v_template', $data);
}

public function search_product(){
    $search = $this->input->post('search');
    $min = $this->input->post('hmin');
    $max = $this->input->post('hmax');
    $data['products']=$this->M_Shop->get_product_result($search,$min, $max);
    $data['content'] = 'v_result';
	$this->load->view('v_template',$data);
}
// CART // 
public function add_to_cart(){
    $tambah=$this->M_Shop->add_to_cart();
    if($tambah == TRUE){
		$this->session->set_flashdata('pesan', 'Produk telah ditambahkan ke keranjang');
	} else {
		$this->session->set_flashdata('gagal', 'Produk gagal dimasukkan ke keranjang');
	}
	redirect(base_url('index.php/Shop'), 'refresh');
}

public function hapus_isi_cart($id_cart){
    $hapus=$this->M_Shop->hapus_isi_cart($id_cart);
    if($hapus == TRUE){
		$this->session->set_flashdata('pesan', 'Produk telah dihapus dari keranjang');
	} else {
		$this->session->set_flashdata('gagal', 'Produk gagal dihapus dari keranjang');
	}
	redirect(base_url('index.php/Shop/cart'), 'refresh');
}
public function get_detail_cart($id_cart=''){
	$data_detail=$this->M_Shop->detail_cart($id_cart);
	echo json_encode($data_detail);
}
public function edit_cart(){
        $proses_update=$this->M_Shop->edit_cart();
        if($proses_update){
           $this->session->set_flashdata('pesan', 'Update cart berhasil');
        }
        else{
            $this->session->set_flashdata('gagal', 'Update cart gagal');
        }
        redirect(base_url('index.php/Shop/cart'), 'refresh');
}

//CHECKOUT
public function form_checkout()
{
    if($this->session->userdata('logged_in')== TRUE){
        $data['content']="v_form_checkout";
        $data['dropdown_bank']=$this->M_Shop->dropdown_bank();
		$this->load->view('v_template', $data);
        }
}
public function checkout(){
    $tambah=$this->M_Shop->add_transaksi();
	redirect(base_url('index.php/Shop/activity'), 'refresh');
}

// ACTIVITY
public function activity(){
    if($this->session->userdata('logged_in')==TRUE){
        $data['content']="v_activity";
        $data['activities']=$this->M_Shop->get_activities();
        $this->load->view("v_template", $data);
    }
}
public function upload_bukti(){
    $config['upload_path'] = './assets/images/upload_bukti';
	$config['allowed_types'] = 'jpg|png';

		if ($_FILES['foto_bukti']['name'] != "") {
			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('foto_bukti')) {
				$this->session->set_flashdata('pesan', $this->upload->display_errors());
				redirect('Shop/activity');
			} else {
				if($this->M_Shop->upload_bukti($this->upload->data('file_name'))){
					$this->session->set_flashdata('pesan', 'Bukti pembayaran telah diunggah. Pembayaran akan segera kami konfirmasi');
				} else {
					$this->session->set_flashdata('pesan', 'Bukti pembayaran gagal diunggah');
				}
				redirect('Shop/activity');
			}
				
		} else {
			if ($this->M_Shop->upload_bukti('')) {
				$this->session->set_flashdata('pesan', 'Bukti pembayaran telah diunggah. Pembayaran akan segera kami konfirmasi');
			} else {
				$this->session->set_flashdata('pesan', 'Bukti pembayaran gagal diunggah');
			}
			redirect('Shop/activity');
		}	
}
public function get_detail_transaksi($id_transaksi=''){
	$data_detail=$this->M_Shop->detail_transaksi($id_transaksi);
	echo json_encode($data_detail);
}

// ADMIN PAGE //
public function transaksi_admin_page(){
    if($this->session->userdata('logged_in')==TRUE){
        $data['content']="v_transaksi_admin";
        $data['all_transaksi']=$this->M_Shop->get_all_transaksi();
        $this->load->view("v_template", $data);
    }
}
public function pesanan_penjual(){
    if($this->session->userdata('logged_in')==TRUE){
        $data['content']="v_pesanan_penjual";
        $data['pesanan']=$this->M_Shop->pesanan_penjual();
        $this->load->view("v_template", $data);
    }
}


// STATUS 

public function status_dikemas($id_transaksi){
    $ambil=$this->M_Shop->status_dikemas($id_transaksi);
    redirect(base_url('index.php/Shop/transaksi_admin_page'));
}
public function status_diantar(){
    $ambil=$this->M_Shop->status_diantar();
    redirect(base_url('index.php/Shop/pesanan_penjual'));
}
public function status_selesai($id_transaksi){
    $ambil=$this->M_Shop->status_selesai($id_transaksi);
    redirect(base_url('index.php/Shop/history_pembeli'));
}

// HISTORY
public function history_pembeli(){
    if($this->session->userdata('logged_in')==TRUE){
        $data['content']="v_history_pembeli";
        $data['activities']=$this->M_Shop->get_history_activities();
        $this->load->view("v_template", $data);
    }
}
public function history_penjual(){
    if($this->session->userdata('logged_in')==TRUE){
       $data['content']="v_history_penjual";
       $data['activities']=$this->M_Shop->history_penjual();
       $this->load->view("v_template", $data);
        }
}
}
        
    /* End of file  Shop.php */
        
                            
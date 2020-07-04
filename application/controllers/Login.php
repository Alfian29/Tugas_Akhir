<?php 
        
defined('BASEPATH') OR exit('No direct script access allowed');
        
class Login extends CI_Controller {

    public function __construct()
	{
        parent::__construct();
        $this->load->model('M_login');
    }
    public function index(){
        if($this->session->userdata('logged_in')==TRUE){
            redirect('Home/index');
        }else{
            $this->load->view('v_login');
        }
    }
    public function cek_login(){
		if($this->session->userdata('logged_in') == FALSE){

			$this->form_validation->set_rules('email', 'email', 'trim|required',
            array('required' => 'email belum terisi'));
            $this->form_validation->set_rules('password', 'password', 'trim|required',
			array('required' => 'Password belum terisi'));

			if ($this->form_validation->run() == TRUE) {
				if($this->M_login->cek_user() == TRUE){
					redirect('Home/index');
				} else {
					$this->session->set_flashdata('gagal', 'Login gagal! Pastikan data yang anda masukkan benar');
					redirect('login/index');
				}
			} else {
				$this->session->set_flashdata('gagal', validation_errors());
					redirect('login/index');
			}

		} else {
			redirect('Home/index');
		}
	}
	public function form_register()
	{
		$this->load->view('v_register');
	}
	public function register(){
		
		$this->form_validation->set_rules('nama_user', 'nama_user', 'trim|required',
        array('required' => 'nama belum terisi'));
		$this->form_validation->set_rules('email', 'email', 'trim|required',
        array('required' => 'email belum terisi'));
        $this->form_validation->set_rules('password', 'password', 'trim|required',
		array('required' => 'Password belum terisi'));
		$this->form_validation->set_rules('alamat', 'alamat', 'trim|required',
		array('required' => 'alamat belum terisi'));
		$this->form_validation->set_rules('level', 'level', 'trim|required',
		array('required' => 'level belum terisi'));
		$this->form_validation->set_rules('no_tlp', 'no_tlp', 'trim|required',
		array('required' => 'Password belum terisi'));
		
		if ($this->form_validation->run() == TRUE ) {
	    	$masuk=$this->M_login->tambah_user();
				if($masuk==true){
		    		$this->session->set_flashdata('pesan', 'Daftar Akun berhasil');
    				} else{
		    		$this->session->set_flashdata('gagal', 'Daftar Akun gagal');
				}
		    redirect(base_url('index.php/Login/register'), 'refresh');
		} else{
		    $this->session->set_flashdata('pesan', validation_errors());
		    redirect(base_url('index.php/Login/index'), 'refresh');
	    }

		}
	
	public function logout(){
		$this->session->sess_destroy();
		redirect('login');
	}
        
}
        
    /* End of file  Login.php */
        
                            
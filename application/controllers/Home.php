<?php 
        
defined('BASEPATH') OR exit('No direct script access allowed');
        
class Home extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Shop');
    }
    
    public function index(){
        if($this->session->userdata('logged_in')== TRUE){
        $data['content']="v_home";
        $data['isi_keranjang'] = $this->M_Shop->isi_keranjang();
        $data['sumharga']= $this->M_Shop->sumharga();
        $data['keranjang'] = 'v_cart';
		$this->load->view('v_template', $data);
        }
    }
        
}
        
    /* End of file  Home.php */
        
                            
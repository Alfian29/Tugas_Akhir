<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
                        
class M_Shop extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Bangkok");
    }
    
                        
public function get_produk(){
    $this->db->select('*');
    $this->db->from('produk');
    $this->db->join('user','user.id_user=produk.id_penjual');
    $this->db->where('stok > 0');
    $query = $this->db->get()->result();
    return $query;
}
public function get_product_result($search, $min, $max){
    $this->db->select('*')
             ->from('produk')
             ->join('user','user.id_user=produk.id_penjual')
             ->like('nama_produk',$search)
             ->where('harga >=', $min)
             ->where('harga <=', $max)
             ->where('stok > 0');
    $query = $this->db->get();
    if($query->num_rows()>0){
        return $query->result();
      }
      
}
public function dropdown_bank(){
    $query = $this->db->query('SELECT * FROM bank ORDER BY nama_bank ASC ');
    return $query->result();
}
public function isi_keranjang(){
    $this->db->select('*');
    $this->db->from('cart');
    $this->db->join('produk','produk.id_produk=cart.id_produk');
    $this->db->where('id_pembeli',$this->session->userdata('id_user'));
    $query = $this->db->get()->result();
    return $query;
}
public function sumharga(){
    $query = $this->db->select('SUM(total_harga) as sumharga')->from('cart')->where('id_pembeli', $this->session->userdata('id_user'))->get();
    return $query->row()->sumharga;
}
public function add_to_cart(){
    $tambah = array(
        'id_produk' =>$this->input->post('id_produk'),
        'qty'=>$this->input->post('jumlah'),
        'total_harga' =>$this->input->post('total'),
        'id_penjual' =>$this->input->post('id_penjual'),
        'id_pembeli' =>$this->session->userdata('id_user')
    );
    $getproduk = $this->db->get_where('produk', array('id_produk' => $this->input->post('id_produk')));
    $data_produk = array(
      'stok' => (int)$getproduk->result()[0]->stok - (int)$this->input->post('jumlah')
    );
    $this->db->where('id_produk', $this->input->post('id_produk'))->update('produk', $data_produk);
    return $this->db->insert('cart', $tambah);
}
public function hapus_isi_cart($id_cart){
    $this->db->where('id_cart', $id_cart);
    return $this->db->delete('cart');
}
public function detail_cart($id_cart=''){
    return $this->db->join('produk','produk.id_produk=cart.id_produk')->where('id_cart', $id_cart)->get('cart')->row();
}
public function edit_cart(){
    $dt_up_produk=array(
        'id_cart'=>$this->input->post('id_cart'),
        'qty'=>$this->input->post('jumlah'),
        'total_harga'=>$this->input->post('total')
    );
    return $this->db->where('id_cart', $this->input->post('id_cart'))->update('cart', $dt_up_produk);
}
public function id_produk_to_detail(){
    $query = $this->db->select('id_produk')->from('cart')->where('id_pembeli', $this->session->userdata('id_user'))->get();
    return $query->row()->id_produk;
}

// TRANSAKSI //

public function add_transaksi(){
    $sumharga = $this->sumharga();
    $data_transaksi = array(
        'id_pembeli'=>$this->session->userdata('id_user'),
        'id_bank'=>$this->input->post('id_bank'),
        'status'=>"Menunggu Pembayaran",
        'tgl_transaksi'=>date("Y-m-d H:i:s"),
        'total_harga'=> $sumharga,
        'alamat_pengiriman'=>$this->input->post('alamat')
    );
    
    $this->db->insert('transaksi',$data_transaksi);
    $id_transaksi = $this->db->insert_id();
    $this->add_detail_transaksi($id_transaksi);
    $this->remove_cart_checkout($id_transaksi);
    return $id_transaksi;
}


public function add_detail_transaksi($id_transaksi){
    $q = $this->db->get('cart')->result(); 
    foreach($q as $r) {
        $data_detail_transaksi = array(
            'id_transaksi'=>$id_transaksi,
            'id_produk'=>$r->id_produk,
            'qty'=>$r->qty,
            'total_harga'=>$r->total_harga,
            'id_penjual'=>$r->id_penjual,
            'id_pembeli'=>$this->session->userdata('id_user')
        );
        $this->db->insert('detail_transaksi', $data_detail_transaksi); 
    }
}
public function remove_cart_checkout(){
    $this->db->where('id_pembeli', $this->session->userdata('id_user'));
    return $this->db->delete('cart');
}

//ACTIVITY//
public function get_activities(){
    $this->db->select('*');
    $this->db->select('DATE_FORMAT(tgl_transaksi, "%W %e %M %Y %k:%i WIB") as tgl_transaksi', FALSE);
    $this->db->from('transaksi');
    $this->db->join('bank','bank.id_bank=transaksi.id_bank');
    $this->db->where('id_pembeli',$this->session->userdata('id_user'));
    $this->db->where_not_in('status', 'Pesanan Diterima');
    $query = $this->db->get()->result();
    return $query;
}
public function get_history_activities(){
    $this->db->select('*');
    $this->db->select('DATE_FORMAT(tgl_transaksi, "%W %e %M %Y %k:%i WIB") as tgl_transaksi', FALSE);
    $this->db->from('transaksi');
    $this->db->join('bank','bank.id_bank=transaksi.id_bank');
    $this->db->where('id_pembeli',$this->session->userdata('id_user'));
    $this->db->where('status','Pesanan Diterima');
    $query = $this->db->get()->result();
    return $query;
}
public function upload_bukti($nama_file){
    if ($nama_file == "") {
        $tambah = array(
            'id_transaksi'=>$this->input->post('id_transaksi')
        );
    } else {
        $tambah = array(
            'id_transaksi'=>$this->input->post('id_transaksi'),
            'foto_bukti'=>$nama_file
        );
    }
    return $this->db->insert('bukti_pembayaran', $tambah);
}
public function detail_transaksi($id_transaksi=''){
    return $this->db->join('bank','bank.id_bank=transaksi.id_bank')->where('id_transaksi', $id_transaksi)->get('transaksi')->row();
}
public function get_all_transaksi(){
    $this->db->select('*');
    $this->db->select('DATE_FORMAT(tgl_transaksi, "%W %e %M %Y %k:%i WIB") as tgl_transaksi', FALSE);
    $this->db->from('transaksi');
    $this->db->join('user','user.id_user=transaksi.id_pembeli');
    $this->db->join('bukti_pembayaran','bukti_pembayaran.id_transaksi=transaksi.id_transaksi');
    $query = $this->db->get()->result();
    return $query;
}
public function pesanan_penjual(){
    $this->db->select('DISTINCT(transaksi.id_transaksi)');
    $this->db->select('user.nama_user, transaksi.tgl_transaksi, transaksi.total_harga, transaksi.status, transaksi.no_resi');
    $this->db->select('DATE_FORMAT(tgl_transaksi, "%W %e %M %Y %k:%i WIB") as tgl_transaksi', FALSE);
    $this->db->from('transaksi');
    $this->db->join('user','user.id_user=transaksi.id_pembeli');
    $this->db->join('detail_transaksi','detail_transaksi.id_transaksi=transaksi.id_transaksi');
    $this->db->join('bukti_pembayaran','bukti_pembayaran.id_transaksi=transaksi.id_transaksi');
    $this->db->where('id_penjual',$this->session->userdata('id_user'));
    $this->db->where_not_in('status', 'Pesanan Diterima');
    $query = $this->db->get()->result();
    return $query;
}
public function history_penjual(){
    $this->db->select('DISTINCT(transaksi.id_transaksi)');
    $this->db->select('user.nama_user, transaksi.tgl_transaksi, transaksi.total_harga, transaksi.status, transaksi.no_resi');
    $this->db->select('DATE_FORMAT(tgl_transaksi, "%W %e %M %Y %k:%i WIB") as tgl_transaksi', FALSE);
    $this->db->from('transaksi');
    $this->db->join('user','user.id_user=transaksi.id_pembeli');
    $this->db->join('detail_transaksi','detail_transaksi.id_transaksi=transaksi.id_transaksi');
    $this->db->join('bukti_pembayaran','bukti_pembayaran.id_transaksi=transaksi.id_transaksi');
    $this->db->where('id_penjual',$this->session->userdata('id_user'));
    $this->db->where('status', 'Pesanan Diterima');
    $query = $this->db->get()->result();
    return $query;
}
public function status_dikemas($id_transaksi){
    $data_update=array(
        'status'=>'Sedang Dikemas'
    );
    $this->db->where('id_transaksi',$id_transaksi);
    $this->db->update('transaksi',$data_update );
}
public function status_diantar(){
    $data_update=array(
        'status'=>'Sedang Diantar',
        'no_resi'=>$this->input->post('no_resi')
    );
    $this->db->where('id_transaksi',$this->input->post('id_transaksi'));
    $this->db->update('transaksi',$data_update );
}
public function status_selesai($id_transaksi){
    $data_update=array(
        'status'=>'Pesanan Diterima'
    );
    $this->db->where('id_transaksi',$id_transaksi);
    $this->db->update('transaksi',$data_update );
}
                            
                        
}
                        
    
                        
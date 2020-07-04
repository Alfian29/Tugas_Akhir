<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Produk extends CI_Model {
    function construct(){

    }
    public function get_list_produk(){
        return $this->db->where('id_penjual',$this->session->userdata('id_user'))
                        ->get('produk')->result();
    }
    public function tambah_produk($nama_file){
        if ($nama_file == "") {
            $tambah = array(
                'nama_produk' =>$this->input->post('nama_produk'),
                'harga' =>$this->input->post('harga'),
                'stok' =>$this->input->post('stok'),
                'id_penjual' =>$this->session->userdata('id_user')
            );
        } else {
            $tambah = array(
                'nama_produk' =>$this->input->post('nama_produk'),
                'gambar_produk'=>$nama_file,
                'harga' =>$this->input->post('harga'),
                'stok' =>$this->input->post('stok'),
                'id_penjual' =>$this->session->userdata('id_user')
            );
        }
        return $this->db->insert('produk', $tambah);
    }
    public function detail_produk($id_produk=''){
        return $this->db->where('id_produk', $id_produk)->get('produk')->row();
    }
    public function update_produk($nama_file){
        if ($nama_file == "") {
            $update = array(
                'id_produk'=>$this->input->post('id_produk'),
                'nama_produk' =>$this->input->post('nama_produk'),
                'harga' =>$this->input->post('harga'),
                'stok' =>$this->input->post('stok')
            );
        } else {
            $update = array(
                'id_produk'=>$this->input->post('id_produk'),
                'nama_produk' =>$this->input->post('nama_produk'),
                'gambar_produk'=>$nama_file,
                'harga' =>$this->input->post('harga'),
                'stok' =>$this->input->post('stok'),
            );
        }
        return $this->db->where('id_produk',$this->input->post('id_produk'))->update('produk', $update);
    }
    public function hapus_produk($id_produk){
        $this->db->where('id_produk', $id_produk);
        return $this->db->delete('produk');
    }
    
}
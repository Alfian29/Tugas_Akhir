<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Login extends CI_Model {
    function construct(){
    }
    public function cek_user(){
        $email    = $this->input->post('email');
        $password = $this->input->post('password');

        $query = $this->db->where('email',$email)
                          ->where('password',$password)
                          ->get('user');
        

        if($this->db->affected_rows() > 0){

            $data_login = $query->row();

            $data_session = array(
                                'email'=> $data_login->email,
                                'password'=> $data_login->password,
                                'logged_in'=> TRUE,
                                'nama_user'=> $data_login->nama_user,
                                'level'=>$data_login->level,
                                'id_user'=>$data_login->id_user
            );
            $this->session->set_userdata($data_session);

            return TRUE;
        }else{
            return FALSE;
        }
    }
    public function tambah_user(){
        // $scrt = "P3djaten";
        $data_user=array(
            'nama_user'=>$this->input->post('nama_user'),
            'email'=>$this->input->post('email'),
            'password'=>$this->input->post('password'),
            'alamat'=>$this->input->post('alamat'),
            'no_tlp'=>$this->input->post('no_tlp'),
            'level'=>$this->input->post('level')
            
        );
        $masuk=$this->db->insert('user', $data_user);
        return $masuk;
    }
    }

?>
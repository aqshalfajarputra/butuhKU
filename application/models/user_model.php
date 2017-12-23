<?php
/**
 * Created by PhpStorm.
 * User: Aqshal-kun
 * Date: 12/8/2017
 * Time: 6:16 AM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        //Codeigniter : Write Less Do More
    }

    function cek_login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $query = $this->db->select('*')->where('username', $username)->where('password', $password)->get('user');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data = $row;
            }
            $data_session = array(
                'id_user' => $data->id_user,
                'nama' => $data->username,
                'status' => TRUE,
                'jabatan' => $data->role
            );

            $this->session->set_userdata($data_session);

            return TRUE;
        } else {
            return FALSE;
        }
    }


    public function get_data_users()
    {
        return $this->db->select('*')->from('user')->order_by('id_user', 'desc')->get();

    }

    public function delete($id_user)
    {
        $this->db->where('id_user', $id_user)->delete('user');
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function update($id, $arr)
    {
        $this->db->where('id_user', $id)->update('user', $arr);
    }

    public function get_dropdown_barang()
    {
        $data = array();
        $this->db->select('*');
        $this->db->from('barang');
        $this->db->join('kategori', 'barang.id_kategori=kategori.id_kategori');
        $this->db->order_by('id_barang', 'ASC');
        $hasil = $this->db->get();

        if ($hasil->num_rows() > 0) {
            $data = $hasil->result();
        }
        $hasil->free_result();
        return $data;
    }

    public function get_id_kategori()
    {
        $data = array();
        $this->db->select('*');
        $this->db->from('kategori');
        $this->db->order_by('id_kategori', 'ASC');
        $hasil = $this->db->get();

        if ($hasil->num_rows() > 0) {
            $data = $hasil->result();
        }
        $hasil->free_result();
        return $data;
    }

    public function get_data_obat()
    {
        $data = array();
        $this->db->select('*');
        $this->db->from('obat');
        $this->db->order_by('id_obat', 'ASC');
        $hasil = $this->db->get();

        if ($hasil->num_rows() > 0) {
            $data = $hasil->result();
        }
        $hasil->free_result();
        return $data;
    }

    public function peminjaman_detail($id, $barang)
    {


        for ($i = 0; $i < count($barang); $i++) {
            $id_barang = $barang[$i][0];
            $jumlah = $barang[$i][1];
            $kurangi = "UPDATE barang SET stok_barang = stok_barang - " . $jumlah . " WHERE ";

            $detil = "INSERT INTO detil_peminjaman (id_peminjaman, id_barang, jumlah) VALUES ";
            $detil .= "('$id','$id_barang','$jumlah')";
            $this->db->query($detil);
            $this->db->query($kurangi . "id_barang = '$id_barang'");
        }

        if ($this->db->affected_rows() > 0) {
            echo "true";
        } else {
            echo "false";
        }
    }


}

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

    public function getDetail($id)
    {
        $data = array();
        $this->db->select('*');
        $this->db->from('peminjaman');
//        $this->db->join('peminjaman', 'detil_peminjaman.id_peminjaman=peminjaman.id_peminjaman');
        $this->db->join('user', 'peminjaman.id_user=user.id_user');
        $this->db->where('id_peminjaman', $id);
//        $this->db->join('barang', 'detil_peminjaman.id_barang=barang.id_barang');
        $this->db->order_by('peminjaman.id_peminjaman', 'ASC');
        $hasil = $this->db->get();
        if ($hasil->num_rows() > 0) {
            $data = $hasil->row();
        }
        $hasil->free_result();
        return $data;
    }

    public function getBarangId($id)
    {
        $this->db->select('id_peminjaman, id_barang, jumlah');
        $this->db->from('detil_peminjaman');
        $this->db->where('id_peminjaman', $id);
        $this->db->order_by('id_barang', 'ASC');
        $hasil = $this->db->get()->result();
        $events_array = array();
        foreach ($hasil as $row) {
            $events_array[] = array(
                'id_barang' => $row->id_barang,
                'jumlah' => $row->jumlah,
            );

        }
        return $events_array;
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

    }

    public function getDataPeminjaman($id)
    {
        return $this->db->select('*')->from('peminjaman')
            ->join('user', 'peminjaman.id_user=user.id_user')
            ->where('peminjaman.id_user', $id)->get();
    }

    public function getDataBarang()
    {
        return $this->db->select('*')->from('peminjaman')
            ->join('detil_peminjaman', 'peminjaman.id_peminjaman=detil_peminjaman.id_peminjaman')
            ->join('barang', 'detil_peminjaman.id_barang=barang.id_barang')
            ->get();
    }

    public function getDataPeminjamanDetail($id_peminjaman, $id_user)
    {
        return $this->db->select('*')->from('peminjaman')
            ->join('user', 'peminjaman.id_user=user.id_user')
            ->where('peminjaman.id_peminjaman', $id_peminjaman)
            ->where('peminjaman.id_user', $id_user)
            ->order_by('id_peminjaman', 'desc')->get()->row();
    }

    public function getDataBarangDetail($id)
    {
        return $this->db->select('*')->from('detil_peminjaman')
            ->join('barang', 'detil_peminjaman.id_barang=barang.id_barang')
            ->where('detil_peminjaman.id_peminjaman', $id)
            ->get()->result();
    }


}

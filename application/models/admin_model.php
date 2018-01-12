<?php
/**
 * Created by PhpStorm.
 * User: Aqshal-kun
 * Date: 12/8/2017
 * Time: 6:16 AM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        //Codeigniter : Write Less Do More
    }

    public function getDataPeminjaman()
    {
        return $this->db->select('*')->from('peminjaman')
            ->join('user', 'peminjaman.id_user=user.id_user')
            ->where('peminjaman.status_peminjaman != ', "selesai")
            ->order_by('id_peminjaman', 'desc')->get();
    }

    public function getDataLaporan()
    {
        return $this->db->select('*')->from('peminjaman')
            ->join('user', 'peminjaman.id_user=user.id_user')
            ->where('peminjaman.status_peminjaman != ', "selesai")
            ->order_by('id_peminjaman', 'desc')->get();
    }

    public function getHistoryPeminjaman()
    {
        return $this->db->select('*')->from('peminjaman')
            ->join('user', 'peminjaman.id_user=user.id_user')
            ->where('peminjaman.status_peminjaman', "selesai")
            ->order_by('id_peminjaman', 'desc')->get();
    }

    public function getHistoryPelaporan()
    {
        return $this->db->select('*')->from('peminjaman')
            ->join('user', 'peminjaman.id_user=user.id_user')
            ->where('peminjaman.status_peminjaman', "selesai")
            ->order_by('id_peminjaman', 'desc')->get();
    }



    public function getDataBarang()
    {
        return $this->db->select('*')->from('peminjaman')
            ->join('detil_peminjaman', 'peminjaman.id_peminjaman=detil_peminjaman.id_peminjaman')
            ->join('barang', 'detil_peminjaman.id_barang=barang.id_barang')
            ->get();
    }

    public function getBarang()
    {
        return $this->db->select('*')->from('barang')
            ->join('kategori', 'barang.id_kategori=kategori.id_kategori')
            ->get();
    }

    public function getKategori()
    {
        return $this->db->select('id_kategori, nama_kategori')
            ->get('kategori');
    }

    public function getFoto()
    {
        return $this->db->select('foto_barang')
            ->where('id_barang', 12)
            ->get('barang');
    }

    public function getDataPeminjamanDetail($id_peminjaman)
    {
        return $this->db->select('*')->from('peminjaman')
            ->join('user', 'peminjaman.id_user=user.id_user')
            ->where('peminjaman.id_peminjaman', $id_peminjaman)
            ->order_by('id_peminjaman', 'desc')->get()->row();
    }

    public function getDetailBarang($id_barang)
    {
        return $this->db->select('*')->from('barang')
            ->join('kategori', 'barang.id_kategori=kategori.id_kategori')
            ->where('barang.id_barang', $id_barang)
            ->order_by('id_barang', 'asc')->get()->row();
    }

    public function getDataBarangDetail($id)
    {
        return $this->db->select('*')->from('detil_peminjaman')
            ->join('barang', 'detil_peminjaman.id_barang=barang.id_barang')
            ->where('detil_peminjaman.id_peminjaman', $id)
            ->get()->result();
    }

    public function dropdown_stok()
    {
        return $this->db->select('id_supplier, nama_sp')
            ->get('supplier')
            ->result();
    }

    function update($id, $status)
    {
        $this->db->where('id_peminjaman', $id)->update('peminjaman', $status);
    }

    public function delete_barang($id)
    {
        $this->db->where('id_barang', $id)->delete('barang');
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function delete_kategori($id)
    {
        $this->db->where('id_kategori', $id)->delete('kategori');
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function updateDataBarang($id, $arr)
    {
        $this->db->where('id_barang', $id)->update('barang', $arr);
    }


}

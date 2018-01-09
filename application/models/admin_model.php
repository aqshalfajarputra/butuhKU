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
            ->order_by('id_peminjaman', 'desc')->get();
    }

    public function getDataBarang()
    {
        return $this->db->select('*')->from('peminjaman')
            ->join('detil_peminjaman', 'peminjaman.id_peminjaman=detil_peminjaman.id_peminjaman')
            ->join('barang', 'detil_peminjaman.id_barang=barang.id_barang')
            ->get();
    }

    public function getDataPeminjamanDetail($id_peminjaman)
    {
        return $this->db->select('*')->from('peminjaman')
            ->join('user', 'peminjaman.id_user=user.id_user')
            ->where('peminjaman.id_peminjaman', $id_peminjaman)
            ->order_by('id_peminjaman', 'desc')->get()->row();
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


}

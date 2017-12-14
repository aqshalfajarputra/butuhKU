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
                'nama' => $username,
                'status' => TRUE,
                'jabatan' => $data->role
            );

            $this->session->set_userdata($data_session);

            return TRUE;
        } else {
            return FALSE;
        }
    }


    function kurang($id_obat, $kurangi)
    {
        $object = array('stok' => $kurangi);
        $this->db->where('id_obat', $id_obat)->update('obat', $object);
    }


    function tambah($ido, $tambah)
    {
        $sip = array('stok' => $tambah);
        $this->db->where('id_obat', $ido)->update('obat', $sip);
    }

    function getStokObat($id_obat)
    {
        $this->db->select('stok')->from('obat')->where('id_obat', $id_obat);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $sql = $query->row();
            return $sql->stok;
        }
    }

    function getJumlahJual($id_jual)
    {
        $this->db->select('qty')->from('penjualan')->where('id_jual', $id_jual);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            $sql = $query->row();
            return $sql->qty;
        }
    }


    public function dropdown_obat()
    {
        return $this->db->select('id_obat, nama_obat')
            ->get('obat')
            ->result();
    }

    public function dropdown_stok()
    {
        return $this->db->select('id_supplier, nama_sp')
            ->get('supplier')
            ->result();
    }

    public function save_penjualan()
    {
        $id = $this->input->post('id_penjualan');
        $tgl = date("Y-m-d");
        $ket = $this->input->post('keterangan');
        $qty = $this->input->post('qty');
        $ido = $this->input->post('obat');

        $data = array('id_jual' => $id,
            'tanggal_jual' => $tgl,
            'keterangan' => $ket,
            'qty' => $qty,
            'id_obat' => $ido
        );
        //prose insert data
        $this->db->insert('penjualan', $data);

        if ($this->db->affected_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function save_obat($file)
    {
        $nama = $this->input->post('nama_obat');
        $qty = $this->input->post('qty');
        $sup = $this->input->post('suplier');
        $pro = $this->input->post('produsen');
        $har = $this->input->post('harga');


        $data = array('id_obat' => '',
            'nama_obat' => $nama,
            'harga_obat' => $har,
            'stok' => $qty,
            'produsen' => $pro,
            'foto_obat' => $file['file_name'],
            'id_supplier' => $sup
        );
        //prose insert data
        $this->db->insert('obat', $data);

        if ($this->db->affected_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function get_data_transaksi()
    {
        return $this->db->select('*')
            ->join('obat', 'penjualan.id_obat=obat.id_obat')
            ->order_by('id_jual', 'ASC')
            ->get('penjualan')
            ->result();

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

    public function get_data_user()
    {
        $data = array();
        $this->db->select('*');
        $this->db->from('user');
        $this->db->order_by('id_obat', 'ASC');
        $hasil = $this->db->get();

        if ($hasil->num_rows() > 0) {
            $data = $hasil->result();
        }
        $hasil->free_result();
        return $data;
    }

    public function delete($id_jual)
    {
        $this->db->where('id_jual', $id_jual)->delete('penjualan');
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }


    public function delete_o($id_obat)
    {
        $this->db->where('id_obat', $id_obat)->delete('obat');
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function add_stock($id_obat)
    {
        return $this->db->where('id_obat', $id_obat)
            ->get('obat')
            ->row();

    }


}

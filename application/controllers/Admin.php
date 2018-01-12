<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class Admin extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->helper('url');

        $this->load->library(array('form_validation', 'session'));
    }

    function index()
    {
        if ($this->session->userdata('status') == TRUE) {
            $data ['jabatan'] = $this->session->userdata('jabatan');
            $data['main_view'] = 'dashboard_admin_view';
            $this->load->view('template', $data);
        } else {
            $this->load->view('login_view');
        }
    }

    public function logout()
    {
        $data_session = array(
            'username' => '',
            'jabatan' => '',
            'status' => FALSE
        );
        $this->session->sess_destroy();
        redirect(base_url('/admin'));
    }

    function laporan()
    {
        if ($this->session->userdata('status') == TRUE) {
            $data['main_view'] = 'laporan_view';
            $data['transaksi'] = $this->admin_model->get_data_transaksi();
            $data['obat'] = $this->admin_model->get_data_obat();
            $this->load->view('template', $data);
        } else {
            $this->load->view('login_view');
        }

    }

    function peminjaman()
    {
        if ($this->session->userdata('status') == TRUE) {
            $data['main_view'] = 'peminjaman_view';
            $data['peminjaman'] = $this->admin_model->getDataPeminjaman();
            $data['barang'] = $this->admin_model->getDataBarang();
            $this->load->view('template', $data);
        } else {
            $this->load->view('login_view');
        }

    }

    function barang()
    {
        if ($this->session->userdata('status') == TRUE) {
            $data['main_view'] = 'barang_view';
            $data['foto'] = $this->admin_model->getFoto();
            $data['barang'] = $this->admin_model->getBarang();
            $data['kategori'] = $this->admin_model->getKategori();
            $this->load->view('template', $data);
        } else {
            $this->load->view('login_view');
        }

    }

    public function add_barang()
    {
        $arr['nama_barang'] = $this->input->post('nama_barang');
        $arr['stok_barang'] = $this->input->post('stok_barang');
        $arr['id_kategori'] = $this->input->post('id_kategori');
        $base64Image = $this->input->post('foto_barang');
        $img = explode(',', $base64Image);
        $ini = substr($img[0], 11);
        $type = explode(';', $ini);
        $exploded = explode(',', $base64Image, 2); // limit to 2 parts, i.e: find the first comma
        $encoded = $exploded[1]; // pick up the 2nd part
        $decoded = base64_decode($encoded);
        $source = imagecreatefromstring($decoded);
        if ($type[0] == "png") {
            imagepng($source, "upload/" . date("d-m-Y-h-m-s") . ".png");
        } else if ($type[0] == "jpeg" || "jpg") {
            imagejpeg($source, "upload/" . date("d-m-Y-h-m-s") . ".jpeg");
        }

        $arr['foto_barang'] = date("d-m-Y-h-m-s") . "." . $type[0];

        $this->db->insert('barang', $arr);
        $detail = $this->db->select('*')->from('barang')->where('id_barang', $this->db->insert_id())->get()->row();
        $arr['id_barang'] = $detail->id_barang;
        $arr['nama_barang'] = $detail->nama_barang;
        $arr['stok_barang'] = $detail->stok_barang;
        $arr['id_kategori'] = $detail->id_kategori;
        $arr['foto_barang'] = $detail->foto_barang;
        $arr['success'] = true;

        echo json_encode($arr);
    }


    public function add_kategori()
    {
        $arr['nama_kategori'] = $this->input->post('nama_kategori');
        $this->db->insert('kategori', $arr);
        $detail = $this->db->select('*')->from('kategori')->where('id_kategori', $this->db->insert_id())->get()->row();
        $arr['id_kategori'] = $detail->id_kategori;
        $arr['success'] = true;

        echo json_encode($arr);
    }

    public function hapus_barang()
    {
        if ($this->session->userdata('status') == TRUE) {
            $id_barang = $this->uri->segment(3);

            if ($this->admin_model->delete_barang($id_barang) == TRUE) {
                redirect('admin/barang');
            } else {
                redirect('admin/');
            }
        } else {
            redirect('admin/');
        }
    }

    public function hapus_kategori()
    {
        if ($this->session->userdata('status') == TRUE) {
            $id_kategori = $this->uri->segment(3);

            if ($this->admin_model->delete_kategori($id_kategori) == TRUE) {
                redirect('admin/barang');
            } else {
                redirect('admin/');
            }
        } else {
            redirect('admin/');
        }
    }

    public function edit_barang()
    {
        $arr['nama_barang'] = $this->input->post('nama_barang');
        $arr['stok_barang'] = $this->input->post('stok_barang');
        $arr['id_kategori'] = $this->input->post('id_kategori');
        $base64Image = $this->input->post('foto_barang');
        $img = explode(',', $base64Image);
        $ini = substr($img[0], 11);
        $type = explode(';', $ini);
        $exploded = explode(',', $base64Image, 2); // limit to 2 parts, i.e: find the first comma
        $encoded = $exploded[1]; // pick up the 2nd part
        $decoded = base64_decode($encoded);
        $source = imagecreatefromstring($decoded);
        if ($type[0] == "png") {
            imagepng($source, "upload/" . date("d-m-Y-h-m-s") . ".png");
        } else if ($type[0] == "jpeg" || "jpg") {
            imagejpeg($source, "upload/" . date("d-m-Y-h-m-s") . ".jpeg");
        }

        $arr['foto_barang'] = date("d-m-Y-h-m-s") . "." . $type[0];

        $this->admin_model->updateDataBarang($this->input->post('id_barang'), $arr);
        $detail = $this->db->select('*')->from('barang')->where('id_barang', $this->input->post('id_barang'))->get()->row();
        $arr['id_barang'] = $detail->id_barang;
        $arr['nama_barang'] = $detail->nama_barang;
        $arr['stok_barang'] = $detail->stok_barang;
        $arr['id_kategori'] = $detail->id_kategori;
        $arr['foto_barang'] = $detail->foto_barang;
        $arr['success'] = true;

        echo json_encode($arr);
    }


    public function detail_peminjaman()
    {
        $hasil = $this->admin_model->getDataPeminjamanDetail($this->input->post('id'));
        $hasilku = $this->admin_model->getDataBarangDetail($hasil->id_peminjaman);
        if ($hasil) {
            $arr['id_peminjaman'] = $hasil->id_peminjaman;
            $arr['nama_user'] = $hasil->nama_user;
            $arr['waktu_peminjaman'] = $hasil->waktu_peminjaman;
            $arr['waktu_pengembalian'] = $hasil->waktu_pengembalian;
            $arr['status_peminjaman'] = $hasil->status_peminjaman;
            $arr['barang'] = $hasilku;
            $arr['success'] = true;

        } else {

            $arr['success'] = false;
        }


        echo json_encode($arr);
//        echo json_encode($arr);
    }

    public function detail_barang()
    {
        $hasil = $this->admin_model->getDetailBarang($this->input->post('id_barang'));
        if ($hasil) {
            $arr['id_barang'] = $hasil->id_barang;
            $arr['nama_barang'] = $hasil->nama_barang;
            $arr['stok_barang'] = $hasil->stok_barang;
            $arr['nama_kategori'] = $hasil->nama_kategori;
            $arr['foto_barang'] = $hasil->foto_barang;
            $arr['success'] = true;

        } else {

            $arr['success'] = false;
        }


        echo json_encode($arr);
    }

    function history()
    {
        if ($this->session->userdata('status') == TRUE) {
            $data['main_view'] = 'history_view';
            $data['peminjaman'] = $this->admin_model->getHistoryPeminjaman();
            $data['laporan'] = $this->admin_model->getHistoryPelaporan();
            $this->load->view('template', $data);
        } else {
            $this->load->view('login_view');
        }

    }

    function edit_status()
    {
        $ha['status_peminjaman'] = $this->input->post('status_peminjaman');
        $this->admin_model->update($this->input->post('id_peminjaman'), $ha);

        $detail = $this->db->select('status_peminjaman')->from('peminjaman')->where('id_peminjaman', $this->input->post('id_peminjaman'))->get()->row();
        $arr['status'] = $detail;
        $arr['success'] = true;

        echo json_encode($arr);
    }



}

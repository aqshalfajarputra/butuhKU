<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->helper('url');
        $this->load->library(array('form_validation', 'session'));
    }

    public function index()
    {
        if ($this->session->userdata('status') == TRUE && $this->session->userdata('jabatan') == 'admin') {
            redirect('/admin');
        } elseif ($this->session->userdata('status') == TRUE && $this->session->userdata('jabatan') == 's_admin') {
            redirect('/s_admin/user');
        } elseif ($this->session->userdata('status') == TRUE && $this->session->userdata('jabatan') == 'user') {
            $data ['jabatan'] = $this->session->userdata('jabatan');
            $data['notification'] = $this->user_model->getNotifikasi();
            $data['main_view'] = 'dashboard_user_view';
            $this->load->view('template', $data);
        } else {
            $this->load->view('login_view');
        }
    }

    function do_login()
    {
        if ($this->input->post('submit')) {
            #_______________  ________  _____  _____   ______________
            # $this->form_validation->set_rules('nama','Nama','trim|required');
            $this->form_validation->set_rules('username', 'Username', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');

            if ($this->form_validation->run() == TRUE) {

                if ($this->user_model->cek_login() == TRUE) {
                    redirect('/user/index');
                } else {
                    $data['notif'] = 'Useraname atau password salah';
                    $this->load->view('login_view', $data);
                }
            } else {
                $data['notif'] = validation_errors();
                $this->load->view('login_view', $data);
            }

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
        redirect('/user');
    }


    public function pinjam()
    {
        if ($this->session->userdata('status') == TRUE) {
            $data['kategori'] = $this->user_model->get_id_kategori();
            $data['barang'] = $this->user_model->get_dropdown_barang();
            $data['telp'] = $this->db->select('*')->from('user')->where('id_user', $this->session->userdata('id_user'))->get()->row();
            $data['guru'] = $this->db->select('nama')->from('user')->where('telp_user !=', '')->get()->result();
            $data['main_view'] = 'pinjam_view';
            $this->load->view('template', $data);
        } else {
            $this->load->view('login_view');
        }
    }

    public function lapor()
    {
        if ($this->session->userdata('status') == TRUE) {
            $data['main_view'] = 'lapor_view';
            $this->load->view('template', $data);
        } else {
            $this->load->view('login_view');
        }
    }

    public function add_peminjaman()
    {
        $arr['id_peminjaman'] = '';
        $arr['id_user'] = $this->input->post('id_user');
        $arr['nama_user'] = $this->input->post('nama_user');
        $arr['waktu_peminjaman'] = $this->input->post('waktu_peminjaman');
        $arr['waktu_pengembalian'] = $this->input->post('waktu_pengembalian');
        $arr['penanggung'] = $this->input->post('penanggung');
        $arr['status_peminjaman'] = $this->input->post('status_peminjaman');
        $arr['telp_peminjam'] = $this->input->post('telp_peminjam');
        $arr['keterangan'] = $this->input->post('keterangan');
        $barang = $this->input->post('barang');

        $this->form_validation->set_rules('nama_user', '<b>Nama</b>', 'trim|required|max_length[100]');
        $this->form_validation->set_rules('telp_peminjam', '<b>No Telp</b>', 'trim|required|max_length[100]');
        $this->form_validation->set_rules('penanggung', '<b>Nama Guru</b>', 'trim|required|max_length[100]');
        $this->form_validation->set_rules('waktu_pengembalian', '<b>Waktu Peminjaman</b>', 'required');
        $this->form_validation->set_rules('keterangan', '<b>Keterangan</b>', 'trim|required|max_length[100]');

        if ($this->form_validation->run() == FALSE) {

            $arr['success'] = false;
            $arr['notif'] = '<div class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 alert alert-danger alert-dismissable"><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' . validation_errors() . '</div>';

        } else {

            $this->db->insert('peminjaman', $arr);
            $id = $this->db->insert_id();
            $this->user_model->peminjaman_detail($id, $barang);
            $array['id_peminjaman'] = $id;
            $this->db->insert('transaksi', $array);
            $detail = $this->user_model->getDetail($id);
            $detail_x = $this->user_model->getBarangId($detail->id_peminjaman);
            $arr['id_peminjaman'] = $detail->id_peminjaman;
            $arr['id_user'] = $detail->id_user;
            $arr['nama_user'] = $detail->nama_user;
            $arr['waktu_peminjaman'] = $detail->waktu_peminjaman;
            $arr['waktu_pengembalian'] = $detail->waktu_pengembalian;
            $arr['penanggung'] = $detail->penanggung;
            $arr['status_peminjaman'] = $detail->status_peminjaman;
            $arr['telp_peminjam'] = $detail->telp_peminjam;
            $arr['keterangan'] = $detail->keterangan;
            $arr['barang'] = $detail_x;
            $arr['count_notif'] = $this->db->where('read_status', 0)->count_all_results('transaksi');
            $arr['success'] = true;
            $arr['notif'] = '<div class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 alert alert-success alert-dismissable"><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data Sukses Terkirim</div>';

        }

        echo json_encode($arr);
    }

    public function add_laporan()
    {
        $arr['id_laporan'] = '';
        $arr['id_user'] = $this->input->post('id_user');
        $arr['judul_laporan'] = $this->input->post('judul_laporan');
        $arr['waktu_laporan'] = $this->input->post('waktu_laporan');
        $arr['deskripsi'] = $this->input->post('deskripsi');
        $arr['status_laporan'] = $this->input->post('status_laporan');
        $base64Image = $this->input->post('foto_laporan');
        $img = explode(',', $base64Image);
        $ini = substr($img[0], 11);
        $type = explode(';', $ini);
        $exploded = explode(',', $base64Image, 2); // limit to 2 parts, i.e: find the first comma
        $encoded = $exploded[1]; // pick up the 2nd part
        $decoded = base64_decode($encoded);
        $source = imagecreatefromstring($decoded);
        if ($type[0] == "png") {
            imagepng($source, "upload/user/" . date("d-m-Y-h-m-s") . ".png");
        } else if ($type[0] == "jpeg" || "jpg") {
            imagejpeg($source, "upload/user/" . date("d-m-Y-h-m-s") . ".jpeg");
        }

        $arr['foto_laporan'] = date("d-m-Y-h-m-s") . "." . $type[0];

        $this->form_validation->set_rules('judul_laporan', '<b>Judul Laporan</b>', 'trim|required');
        $this->form_validation->set_rules('deskripsi', '<b>Deskripsi</b>', 'trim|required');
        $this->form_validation->set_rules('foto_laporan', '<b>Foto Laporan</b>', 'trim|required');

        if ($this->form_validation->run() == FALSE) {

            $arr['success'] = false;
            $arr['notif'] = '<div class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 alert alert-danger alert-dismissable"><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' . validation_errors() . '</div>';

        } else {

            $this->db->insert('laporan', $arr);
            $id = $this->db->insert_id();
            $array['id_laporan'] = $id;
            $this->db->insert('transaksi', $array);
            $detail = $this->user_model->getDetailLaporan($id);
            $arr['id_laporan'] = $detail->id_laporan;
            $arr['id_user'] = $detail->id_user;
            $arr['judul_laporan'] = $detail->judul_laporan;
            $arr['waktu_laporan'] = $detail->waktu_laporan;
            $arr['deskripsi'] = $detail->deskripsi;
            $arr['status_laporan'] = $detail->status_laporan;
            $arr['count_notif_peminjaman'] = $this->db->where('read_status', 0)->count_all_results('transaksi');
            $arr['success'] = true;
            $arr['notif'] = '<div class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 alert alert-success alert-dismissable"><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data Sukses Terkirim</div>';

        }

        echo json_encode($arr);
    }

    public function aktivitas()
    {
        if ($this->session->userdata('status') == TRUE) {
            $data['peminjaman'] = $this->user_model->getDataPeminjaman($this->session->userdata('id_user'));
            $data['barang'] = $this->user_model->getDataBarang();
            $data['laporan'] = $this->user_model->getDataLaporan($this->session->userdata('id_user'));
            $data['main_view'] = 'aktivitas_view';
            $this->load->view('template', $data);
        } else {
            $this->load->view('login_view');
        }
    }

    public function detail_peminjaman()
    {
        //karena id user
        $hasil = $this->user_model->getDataPeminjamanDetail($this->input->post('id'), $this->session->userdata('id_user'));
        $hasilku = $this->user_model->getDataBarangDetail($hasil->id_peminjaman);
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

    public function detail_laporan()
    {
        $hasil = $this->user_model->getDataLaporanDetail($this->input->post('id'), $this->session->userdata('id_user'));
        if ($hasil) {
            $arr['id_laporan'] = $hasil->id_laporan;
            $arr['id_user'] = $hasil->id_user;
            $arr['judul_laporan'] = $hasil->judul_laporan;
            $arr['foto_laporan'] = $hasil->foto_laporan;
            $arr['waktu_laporan'] = $hasil->waktu_laporan;
            $arr['waktu_perbaikan'] = $hasil->waktu_perbaikan;
            $arr['deskripsi'] = $hasil->deskripsi;
            $arr['tanggapan'] = $hasil->tanggapan;
            $arr['status_laporan'] = $hasil->status_laporan;
            $arr['success'] = true;

        } else {

            $arr['success'] = false;
        }


        echo json_encode($arr);
//        echo json_encode($arr);
    }



}

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
        if ($this->session->userdata('status') == TRUE) {
            redirect('/admin/dashboard');
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

    public function detail()
    {

        $detail = $this->db->select('*')->from('s_admin')->where('id', $this->input->post('id'))->get()->row();

        if ($detail) {

            $this->db->where('id', $this->input->post('id'))->update('message', array('read_status' => 1));

            $arr['name'] = $detail->name;
            $arr['email'] = $detail->email;
            $arr['subject'] = $detail->subject;
            $arr['message'] = $detail->message;
            $arr['created_at'] = $detail->created_at;
            $arr['update_count_message'] = $this->db->where('read_status', 0)->count_all_results('message');
            $arr['success'] = true;

        } else {

            $arr['success'] = false;
        }


        echo json_encode($arr);

    }

    public function pinjam()
    {
        if ($this->session->userdata('status') == TRUE) {
            $data['kategori'] = $this->user_model->get_id_kategori();
            $data['barang'] = $this->user_model->get_dropdown_barang();
            $data['main_view'] = 'pinjam_view';
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
        $this->form_validation->set_rules('waktu_peminjaman', '<b>Waktu Peminjaman</b>', 'required');
        $this->form_validation->set_rules('keterangan', '<b>Keterangan</b>', 'trim|required|max_length[100]');

        if ($this->form_validation->run() == FALSE) {

            $arr['success'] = false;
            $arr['notif'] = '<div class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 alert alert-danger alert-dismissable"><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' . validation_errors() . '</div>';

        } else {

            $this->db->insert('peminjaman', $arr);
            $this->user_model->peminjaman_detail($this->db->insert_id(), $barang);
            $detail = $this->db->select('*')->from('user')->where('id_user', $this->db->insert_id())->get()->row();
            $arr['success'] = true;
            $arr['notif'] = count($barang);

        }


        echo json_encode($arr);
    }

}
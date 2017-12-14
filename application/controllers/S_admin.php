<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class S_admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->model('s_admin_model');
        $this->load->helper('url');

        $this->load->library(array('form_validation', 'session'));
    }

    public function index()
    {
        if ($this->session->userdata('status') == TRUE) {
            $data ['jabatan'] = $this->session->userdata('jabatan');
            $data['main_view'] = 'dashboard_view';
            $this->load->view('template', $data);
        } else {
            $this->load->view('login_view');
        }
    }

    public function user()
    {
        if ($this->session->userdata('status') == TRUE) {
            $data['main_view'] = 'users_view';
            $data['users'] = $this->s_admin_model->get_data_users();
            $data['role'] = $this->s_admin_model->get_dropdown_role();
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
        redirect('/');
    }

    public function hapus_user()
    {
        if ($this->session->userdata('status') == TRUE) {
            $id_user = $this->uri->segment(3);

            if ($this->s_admin_model->delete($id_user) == TRUE) {
                redirect('s_admin/index');
            } else {
                redirect('admin/penjualan');
            }
        } else {
            redirect('admin/penjualan');
        }
    }


    public function add_user()
    {

        $this->form_validation->set_rules('name', '<b>Name</b>', 'trim|required|max_length[100]');
        $this->form_validation->set_rules('username', '<b>username</b>', 'trim|required|max_length[100]');
        $this->form_validation->set_rules('password', '<b>password</b>', 'trim|required|max_length[100]');
        $this->form_validation->set_rules('role', '<b>message</b>', 'trim|required');

        $arr['nama'] = $this->input->post('name');
        $arr['username'] = $this->input->post('username');
        $arr['password'] = $this->input->post('password');
        $arr['role'] = $this->input->post('role');

        if ($this->form_validation->run() == FALSE) {

            $arr['success'] = false;
            $arr['notif'] = '<div class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 alert alert-danger alert-dismissable"><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' . validation_errors() . '</div>';

        } else {

            $this->db->insert('user', $arr);
            $detail = $this->db->select('*')->from('user')->where('id_user', $this->db->insert_id())->get()->row();
            $arr['name'] = $detail->nama;
            $arr['username'] = $detail->username;
            $arr['password'] = $detail->password;
            $arr['role'] = $detail->role;
            $arr['id_user'] = $detail->id_user;
            $arr['success'] = true;
            $arr['notif'] = '<div class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 alert alert-success" role="alert"> <i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Message sent ...</div>';

        }

        echo json_encode($arr);
    }

    public function detail()
    {

        $hasil = $this->db->select('*')->from('user')->where('id_user', $this->input->post('id_user'))->get()->row();

        if ($hasil) {
            $arr['id_user'] = $hasil->id_user;
            $arr['nama'] = $hasil->nama;
            $arr['username'] = $hasil->username;
            $arr['password'] = $hasil->password;
            $arr['role'] = $hasil->role;
            $arr['success'] = true;

        } else {

            $arr['success'] = false;
        }


        echo json_encode($arr);

    }

    function edit_user()
    {
        $this->form_validation->set_rules('name', '<b>Name</b>', 'trim|required|max_length[100]');
        $this->form_validation->set_rules('username', '<b>username</b>', 'trim|required|max_length[100]');
        $this->form_validation->set_rules('password', '<b>password</b>', 'trim|required|max_length[100]');
        $this->form_validation->set_rules('role', '<b>message</b>', 'trim|required');

        $ha['nama'] = $this->input->post('name');
        $ha['username'] = $this->input->post('username');
        $ha['password'] = $this->input->post('password');
        $ha['role'] = $this->input->post('role');

        if ($this->form_validation->run() == FALSE) {

            $arr['success'] = false;
            $arr['notif'] = '<div class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 alert alert-danger alert-dismissable"><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' . validation_errors() . '</div>';

        } else {

            $this->s_admin_model->update($this->input->post('id_user'), $ha);


            $detail = $this->db->select('*')->from('user')->where('id_user', $this->input->post('id_user'))->get()->row();
            $arr['name'] = $detail->nama;
            $arr['username'] = $detail->username;
            $arr['password'] = $detail->password;
            $arr['role'] = $detail->role;
            $arr['id_user'] = $detail->id_user;
            $arr['success'] = true;
            $arr['notif'] = '<div class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 alert alert-success" role="alert"> <i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Message sent ...</div>';

        }

        echo json_encode($arr);
    }


}
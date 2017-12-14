<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
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

                if ($this->admin_model->cek_login() == TRUE) {
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

        $detail = $this->db->select('*')->from('message')->where('id', $this->input->post('id'))->get()->row();

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

    public function lapor()
    {
    }

}
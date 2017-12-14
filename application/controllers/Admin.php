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
            redirect(base_url('index.php/admin/dashboard'));
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

    function penjualan()
    {
        if ($this->session->userdata('status') == TRUE) {
            $data['main_view'] = 'penjualan_view';
            $data['transaksi'] = $this->admin_model->get_data_transaksi();
            $data['obat'] = $this->admin_model->get_data_obat();
            $this->load->view('template', $data);
        } else {
            $this->load->view('login_view');
        }

    }

# MENAMBAH TRANSAKSI
    public function save_transaksi()
    {
        if ($this->input->post('submit')) {
            #_______________  ________  _____  _____   ______________
            # $this->form_validation->set_rules('nama','Nama','trim|required');
            $this->form_validation->set_rules('qty', 'Jumlah Obat', 'trim|required');
            $this->form_validation->set_rules('obat', 'Pilih Obat', 'trim|required');
            $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');

            if ($this->form_validation->run() == TRUE) {

                $oo = $this->input->post('obat');
                $aa = $this->input->post('qty');
                $bb = $this->admin_model->getStokObat($oo);

                // Validasi Jika stok kurang
                if ($aa > $bb || $aa == 0) {
                    $this->session->set_flashdata('hasil', 'kurang');
                    redirect(base_url() . 'index.php/admin/penjualan');
                }

                if ($this->admin_model->save_penjualan() == TRUE) {
                    // Untuk Kurangi Stok
                    $id_obat = $this->input->post('obat');
                    $minta = $this->input->post('qty');
                    $stok = $this->admin_model->getStokObat($id_obat);
                    $kurangi = (int)$stok - $minta;
                    $this->admin_model->kurang($id_obat, $kurangi);

                    //pengiriman variable ke function penjualan jika benar
                    $this->session->set_flashdata('hasil', 'berhasil');
                    redirect(base_url() . 'index.php/admin/penjualan');
                } else {

                    //pengiriman variable ke function penjualan jika salah
                    $this->session->set_flashdata('hasil', 'gagal');
                    redirect(base_url() . 'index.php/admin/penjualan');
                }


            } else {
                $data['notif'] = validation_errors();
                $data ['sip'] = 'Akan dialihkan ke halaman sebelumnya setelah 5 detik';
                $data['main_view'] = 'penjualan_view';
                $this->load->view('template', $data);
                header('Refresh: 5; URL=penjualan');
            }
        }

    }


    public function bayar()
    {
        if ($this->session->userdata('status') == TRUE) {
            $data['main_view'] = 'struk_view';
            $data ['jabatan'] = $this->session->userdata('jabatan');
            //get data dropdown
            $data['obat'] = $this->admin_model->dropdown_obat();
            $data['transaksi'] = $this->admin_model->get_data_transaksi();

            // validasi inputan
            $hasil = $this->session->flashdata('hasil');
            if ($hasil == 'berhasil') {
                $data['notif'] = 'Transaksi sukses!!';
            } else if ($hasil == 'kurang') {
                $data['notif'] = 'Stok Kurang!!';
            } else if ($hasil == 'gagal') {
                $data['notif'] = 'Transaksi Gagal!!';
            }


            $this->load->view('template', $data);
        } else {
            $this->load->view('login_view');
        }
    }

    public function save_obat()
    {
        if ($this->input->post('submit')) {
            #_______________  ________  _____  _____   ______________
            # $this->form_validation->set_rules('nama','Nama','trim|required');
            $this->form_validation->set_rules('id_obat', 'ID Obat', 'trim|required');
            $this->form_validation->set_rules('nama_obat', 'Nama Obat', 'trim|required');
            $this->form_validation->set_rules('qty', 'Jumlah Obat', 'trim|required');
            $this->form_validation->set_rules('suplier', 'Suplier', 'trim|required');
            $this->form_validation->set_rules('produsen', 'Produsen', 'trim|required');
            $this->form_validation->set_rules('harga', 'Harga', 'trim|required');

            if ($this->form_validation->run() == TRUE) {
                $config['upload_path'] = './upload/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '25000000';

                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('foto')) {
                    if ($this->admin_model->save_obat($this->upload->data()) == TRUE) {
                        //pengiriman variable ke function penjualan jika benar
                        $this->session->set_flashdata('hasil', 'berhasil');
                        redirect(base_url() . 'index.php/admin/obat');
                    } else {
                        //pengiriman variable ke function penjualan jika salah
                        $this->session->set_flashdata('hasil', 'gagal');
                        redirect(base_url() . 'index.php/admin/obat');
                    }

                } else {
                    //jika pendaftaran gagal
                    $data['notif'] = $this->upload->display_errors();
                    $data['main_view'] = 'obat_view';
                    $this->load->view('template', $data);
                }
            } else {
                $data['notif'] = validation_errors();
                $data['main_view'] = 'penjualan_view';
                $this->load->view('template', $data);
                header('Refresh: 5; URL=penjualan');
            }
        }

    }

    public function add_new_obat()
    {
        if ($this->session->userdata('status') == TRUE) {
            $data ['jabatan'] = $this->session->userdata('jabatan');
            $data['stok'] = $this->admin_model->dropdown_stok();
            $data['main_view'] = 'tambah_obat_view';
            $this->load->view('template', $data);
        } else {
            $this->load->view('login_view');
        }
    }

    public function hapus_transaksi()
    {
        if ($this->session->userdata('status') == TRUE) {
            $id_jual = $this->uri->segment(3);

            if ($this->admin_model->delete($id_jual) == TRUE) {
                redirect('admin/penjualan');
            } else {
                redirect('admin/penjualan');
            }
        } else {
            redirect('admin/penjualan');
        }
    }

    function hapus_obat()
    {
        if ($this->session->userdata('status') == TRUE) {
            $id_obat = $this->uri->segment(3);

            if ($this->admin_model->delete_o($id_obat) == TRUE) {
                redirect('admin/obat');
            } else {
                redirect('admin/obat');
            }
        } else {
            redirect('admin/obat');
        }

    }

    function tambah_stok()
    {

        $data['stok'] = $this->admin_model->dropdown_stok();
        $data['detil'] = $this->admin_model->add_stock($this->uri->segment(3));
        $data ['jabatan'] = $this->session->userdata('jabatan');


        $data['main_view'] = 'add_stock_view';
        //load view
        $this->load->view('template', $data);

    }

    function update_stok()
    {
        if ($this->input->post('submit')) {
            $ido = $this->input->post('id_obat');
            $quan = $this->input->post('qty');
            $stok = $this->admin_model->getStokObat($ido);
            $tambah = (int)$quan + $stok;
            $this->admin_model->tambah($ido, $tambah);

            redirect(base_url() . 'index.php/admin/obat');
        }
    }


    function dashboard()
    {
        if ($this->session->userdata('status') == TRUE) {
            $data ['jabatan'] = $this->session->userdata('jabatan');
            $data['main_view'] = 'dashboard_view';
            $this->load->view('template', $data);
        } else {
            $this->load->view('login_view');
        }

    }

    function users()
    {
        if ($this->session->userdata('status') == TRUE) {
            $data ['jabatan'] = $this->session->userdata('jabatan');
            $data['user'] = $this->admin_model->get_data_user();
            $data['main_view'] = 'user_view';
            $this->load->view('template', $data);
        } else {
            $this->load->view('login_view');
        }
    }

    function obat()
    {
        if ($this->session->userdata('status') == TRUE) {
            $data ['jabatan'] = $this->session->userdata('jabatan');
            $data['stok'] = $this->admin_model->dropdown_stok();
            $data['obat'] = $this->admin_model->get_data_obat();
            $data['main_view'] = 'obat_view';
            $this->load->view('template', $data);
        } else {
            $this->load->view('login_view');
        }
    }

    function suplier()
    {
        if ($this->session->userdata('status') == TRUE) {
            $data ['jabatan'] = $this->session->userdata('jabatan');
            $data['main_view'] = 'suplier_view';
            $this->load->view('template', $data);
        } else {
            $this->load->view('login_view');
        }
    }


}

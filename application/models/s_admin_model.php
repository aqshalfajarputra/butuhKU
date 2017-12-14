<?php
/**
 * Created by PhpStorm.
 * User: Aqshal-kun
 * Date: 12/8/2017
 * Time: 6:16 AM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class S_admin_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        //Codeigniter : Write Less Do More
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

    public function get_dropdown_role()
    {
        return $this->db->select('id_user, role')
            ->get('user')
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


}

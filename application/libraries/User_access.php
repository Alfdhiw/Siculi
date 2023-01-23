<?php
defined('BASEPATH') or exit('No direct script access allowed');
/*
* User_Access Class
* Class ini digunakan untuk proteksi akses halaman
*/
class User_access
{
    // SET SUPER GLOBAL
    var $CI = NULL;
    /**
     * Class constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->CI = &get_instance();
    }

    public function cek_login()
    {
        //cek session username
        if ($this->CI->session->userdata('email') == '') {
            //set notifikasi
            $this->CI->session->set_flashdata('message', '<div class="alert alert-danger" style="color:red;" role="alert">Anda belum login!</div>');
            //alihkan ke halaman login
            redirect(site_url('login'));
        }
    }

    public function cek_akses()
    {
        //cek session username
        if ($this->CI->session->userdata('email') == '') {
            //set notifikasi
            $this->CI->session->set_flashdata('message', '<div class="alert alert-danger" style="color:red;" role="alert">Anda belum login!</div>');
            //alihkan ke halaman login
            redirect(site_url('login'));
        } else if ($this->CI->session->userdata('role_id') == 2) {
            $role_id = $this->CI->session->userdata('role_id');
            $menu = $this->CI->uri->segment(1) && $this->CI->uri->segment(2);

            $queryMenu = $this->CI->db->get_where('menu', ['menu' => $menu])->row_array();
            $menu_id = $queryMenu['menuid'];

            $userAccess = $this->CI->db->get_where('user_access_menu', [
                'roleid' => $role_id,
                'menuid' => $menu_id
            ]);

            if ($userAccess->num_rows() < 1) {
                redirect('blocked');
            }
        }
    }

    public function cek_aksesmagang()
    {
        if (!$this->CI->session->userdata('logged_in')) {
            $this->CI->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Anda belum login!</div>');
            redirect(site_url('login'));
        } else if ($this->CI->session->userdata('role_id') == 4 || $this->CI->session->userdata('role_id') == 5) {
            redirect('blocked');
        }
    }

    public function cek_aksesadmin()
    {
        if (!$this->CI->session->userdata('logged_in')) {
            $this->CI->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Anda belum login!</div>');
            redirect(site_url('login'));
        } else if ($this->CI->session->userdata('role_id') == 2) {
            redirect('blocked');
        }
    }
}

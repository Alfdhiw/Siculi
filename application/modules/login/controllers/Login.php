<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper(array('url', 'form'));
        $this->load->model('auth/Auth_model', 'auth');
        $this->CI = &get_instance();
    }

    public function index()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('login/header.php');
            $this->load->view('login');
            $this->load->view('login/footer.php');
        } else {
        }
    }

    public function loginuser()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('login/header.php');
            $this->load->view('login');
            $this->load->view('login/footer.php');
        } else {

            // cek email
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $user = $this->auth->getUsernameUsers($email);
            // $user_id = $user->kode;
            // if ($query->num_rows() > 0) {

            if ($user) {
                // var_dump($this->db->last_query());
                // die;
                if ($password == $user->password) {
                    $query = $this->auth->getUserPassUsers($email, $password);
                    $data = $query->row();

                    if ($data->id_role == 1) {
                        if ($data->status == 'Tidak Aktif') {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger" style="color:red;" role="alert">' . 'Akun anda belum aktif. Silahkan menunggu' . '</div>');
                            redirect('login');
                        } elseif ($data->status == 'Aktif') {

                            $this->CI->session->set_userdata('userid', $data->kode);
                            $this->CI->session->set_userdata('nama', $data->nama);
                            $this->CI->session->set_userdata('foto', $data->foto);
                            $this->CI->session->set_userdata('email', $data->email);
                            $this->CI->session->set_userdata('role_id', 2);
                            $this->CI->session->set_userdata('logged_in', true);
                            redirect('ketua');
                        } else {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger" style="color:red;" role="alert">' . 'Akun anda diblokir. Silahkan Hubungi Admin' . '</div>');
                            redirect('login');
                        }
                    } elseif ($data->id_role == 2) {
                        if ($data->status == 'Tidak Aktif') {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger" style="color:red;" role="alert">' . 'Akun anda belum aktif. Silahkan menunggu' . '</div>');
                            redirect('login');
                        } elseif ($data->status == 'Aktif') {

                            $this->CI->session->set_userdata('userid', $data->kode);
                            $this->CI->session->set_userdata('nama', $data->nama);
                            $this->CI->session->set_userdata('foto', $data->foto);
                            $this->CI->session->set_userdata('email', $data->email);
                            $this->CI->session->set_userdata('role_id', 2);
                            $this->CI->session->set_userdata('logged_in', true);
                            redirect('kepegawaian');
                        } else {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger" style="color:red;" role="alert">' . 'Akun anda diblokir. Silahkan Hubungi Admin' . '</div>');
                            redirect('login');
                        }
                    } elseif ($data->id_role == 3) {
                        if ($data->status == 'Tidak Aktif') {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger" style="color:red;" role="alert">' . 'Akun anda terkena blokir. Silahkan hubungi Admin!' . '</div>');
                            redirect('login');
                        } elseif ($data->status == 'Aktif') {
                            $this->CI->session->set_userdata('userid', $data->kode);
                            $this->CI->session->set_userdata('nik', $data->nik);
                            $this->CI->session->set_userdata('nama', $data->nama);
                            $this->CI->session->set_userdata('foto', $data->foto);
                            $this->CI->session->set_userdata('email', $data->email);
                            $this->CI->session->set_userdata('role_id', 3);
                            $this->CI->session->set_userdata('logged_in', true);
                            redirect('user');
                        } else {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger" style="color:red;" role="alert">' . 'Akun anda diblokir. Silahkan Hubungi Admin' . '</div>');
                            redirect('login');
                        }
                    } elseif ($data->id_role == 4) {

                        if ($data->status == 'Tidak Aktif') {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger" style="color:red;" role="alert">' . 'Akun anda belum aktif. Silahkan menunggu' . '</div>');
                            redirect('login');
                        } elseif ($data->status == 'Aktif') {

                            $this->CI->session->set_userdata('userid', $data->kode);
                            $this->CI->session->set_userdata('nama', $data->nama);
                            $this->CI->session->set_userdata('foto', $data->foto);
                            $this->CI->session->set_userdata('email', $data->email);
                            $this->CI->session->set_userdata('role_id', 4);
                            $this->CI->session->set_userdata('logged_in', true);
                            redirect('admin');
                        } else {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger" style="color:red;" role="alert">' . 'Akun anda diblokir. Silahkan Hubungi Admin' . '</div>');
                            redirect('login');
                        }
                    } elseif ($data->id_role == 5) {

                        if ($data->status == 'Tidak Aktif') {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger" style="color:red;" role="alert">' . 'Akun anda belum aktif. Silahkan menunggu' . '</div>');
                            redirect('login');
                        } elseif ($data->status == 'Aktif') {

                            $this->CI->session->set_userdata('userid', $data->kode);
                            $this->CI->session->set_userdata('nama', $data->nama);
                            $this->CI->session->set_userdata('foto', $data->foto);
                            $this->CI->session->set_userdata('email', $data->email);
                            $this->CI->session->set_userdata('role_id', 5);
                            $this->CI->session->set_userdata('logged_in', true);
                            redirect('atasan');
                        } else {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger" style="color:red;" role="alert">' . 'Akun anda diblokir. Silahkan Hubungi Admin' . '</div>');
                            redirect('login');
                        }
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" style="color:red;" role="alert">Akun Login Salah</div>');
                    redirect('login');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" style="color:red;" role="alert">' . 'Akun belum terdaftar.' . '</div>');
                redirect('login');
            }
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        $this->session->set_flashdata('message', '<div class="alert alert-success" style="color:green;" role="alert">Logout berhasil!</div>');
        redirect('login');
    }
}

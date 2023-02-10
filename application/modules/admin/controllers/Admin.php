<?php

use FontLib\Table\Type\post;

defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->CI = &get_instance();
        $this->load->library('form_validation');
        $this->load->helper(array('url', 'form'));
        $this->load->model('admin/Dashboard_model', 'dashboard');
        $this->load->model('admin/Detail_model', 'detail');
        $this->load->library('dompdfgenerator');
    }

    public function index()
    {
        $data['title'] = 'Dashboard Admin';
        $data['role'] = $this->session->userdata('role_id');
        $data['userid'] = $this->session->userdata('userid');
        $id = $data['userid'];
        $data['session'] = $this->session->userdata('nama');
        $data['foto'] = $this->dashboard->getFotoUser($id);
        $data['cuti'] = $this->dashboard->countAllCuti();
        $data['ijin'] = $this->dashboard->countAllIjin();
        $data['approved'] = $this->dashboard->countAllApproved();
        $data['approved_cuti'] = $this->dashboard->countAllApprovedCuti();
        $data['reject'] = $this->dashboard->countAllReject();
        $data['reject_cuti'] = $this->dashboard->countAllRejectCuti();
        $data['process'] = $this->dashboard->countAllProcess();
        $data['tangguh'] = $this->dashboard->countAllTangguh();
        $data['process_cuti'] = $this->dashboard->countAllProcessCuti();
        $data['datacuti'] = $this->dashboard->getAllCuti();
        $data['dataijin'] = $this->dashboard->getAllIjin();
        $this->load->view('admin/header.php', $data);
        $this->load->view('admin/sidebar.php', $data);
        $this->load->view('admin/topbar.php', $data);
        $this->load->view('admin', $data);
        $this->load->view('admin/footer.php', $data);
    }

    public function detail_karyawan()
    {
        $kode_id = $this->uri->segment(3);
        $data['title'] = 'Detail Data Karyawan';
        $data['role'] = $this->session->userdata('role_id');
        $data['userid'] = $this->session->userdata('userid');
        $id = $data['userid'];
        $data['session'] = $this->session->userdata('nama');
        $data['foto'] = $this->dashboard->getFotoUser($id);
        $data['pegawai'] = $this->detail->getDataPegawai($kode_id);
        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/topbar', $data);
        $this->load->view('admin/detail_pegawai', $data);
        $this->load->view('admin/footer', $data);
    }

    public function detail_kepegawaian()
    {
        $kode_id = $this->uri->segment(3);
        $data['title'] = 'Detail Data Kepegawaian';
        $data['role'] = $this->session->userdata('role_id');
        $data['userid'] = $this->session->userdata('userid');
        $id = $data['userid'];
        $data['session'] = $this->session->userdata('nama');
        $data['foto'] = $this->dashboard->getFotoUser($id);
        $data['kepegawaian'] = $this->detail->getDataKepegawaian($kode_id);
        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/topbar', $data);
        $this->load->view('admin/detail_kepegawaian', $data);
        $this->load->view('admin/footer', $data);
    }

    public function detail_atasan()
    {
        $kode_id = $this->uri->segment(3);
        $data['title'] = 'Detail Data Atasan';
        $data['role'] = $this->session->userdata('role_id');
        $data['userid'] = $this->session->userdata('userid');
        $id = $data['userid'];
        $data['session'] = $this->session->userdata('nama');
        $data['foto'] = $this->dashboard->getFotoUser($id);
        $data['atasan'] = $this->detail->getDataAtasan($kode_id);
        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/topbar', $data);
        $this->load->view('admin/detail_atasan', $data);
        $this->load->view('admin/footer', $data);
    }

    public function pegawai()
    {
        $data['title'] = 'Data Karyawan';
        $data['role'] = $this->session->userdata('role_id');
        $data['userid'] = $this->session->userdata('userid');
        $id = $data['userid'];
        $data['session'] = $this->session->userdata('nama');
        $data['foto'] = $this->dashboard->getFotoUser($id);
        $data['karyawan'] = $this->detail->getPegawai();
        $data['atasan'] = $this->detail->getAtasan();
        $data['kepegawaian'] = $this->detail->getKepegawaian();
        $data['golongan'] = $this->detail->getDept();
        $data['jabatan'] = $this->detail->getJabatan();
        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/topbar', $data);
        $this->load->view('admin/karyawan', $data);
        $this->load->view('admin/footer', $data);
    }

    public function tambah_karyawan()
    {
        $data['title'] = 'Tambah Data Karyawan';
        $data['role'] = $this->session->userdata('role_id');
        $data['userid'] = $this->session->userdata('userid');
        $id = $data['userid'];
        $data['session'] = $this->session->userdata('nama');
        $data['foto'] = $this->dashboard->getFotoUser($id);
        $data['atasan'] = $this->detail->getAtasan();
        $data['jabatan'] = $this->detail->getJabatan();
        $data['golongan'] = $this->detail->getDept();

        //form validation
        $this->form_validation->set_rules('nama', 'nama', 'required');
        $this->form_validation->set_rules('nik', 'nik', 'required');
        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
        $this->form_validation->set_rules('masuk', 'tanggal masuk', 'required');
        $this->form_validation->set_rules('jeniskel', 'jenis kelamin', 'required');
        $this->form_validation->set_rules('telp', 'telepon', 'required');
        $this->form_validation->set_rules('alamat', 'alamat', 'required');
        $this->form_validation->set_rules('sisa', 'sisa', 'required');
        $this->form_validation->set_rules('foto', 'foto', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('admin/header', $data);
            $this->load->view('admin/sidebar', $data);
            $this->load->view('admin/topbar', $data);
            $this->load->view('admin/tambah_karyawan', $data);
            $this->load->view('admin/footer', $data);
        } else {
            $data = [
                'nama' => $this->input->post('nama'),
                'nik' => $this->input->post('nik'),
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password'),
                'masuk_kerja' => $this->input->post('masuk'),
                'jenis_kelamin' => $this->input->post('jeniskel'),
                'telp' => $this->input->post('telp'),
                'alamat' => $this->input->post('alamat'),
                'atasan' => $this->input->post('atasan'),
                'jabatan' => $this->input->post('jabatan'),
                'golongan' => $this->input->post('golongan'),
                'sisa_cuti' => $this->input->post('sisa'),
                'id_role' => $this->input->post('id_role'),
                'status' => 'Aktif',
                'foto' => $this->input->post('foto')
            ];
            $this->db->insert('tbl_karyawan', $data);
            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Data Karyawan Berhasil Di Tambah</div>');
            redirect('admin/pegawai');
        }
    }

    public function edit_karyawan($id)
    {
        $data = [
            'atasan' => $this->input->post('atasan'),
            'jabatan' => $this->input->post('jabatan'),
            'golongan' => $this->input->post('golongan'),
            'sisa_cuti' => $this->input->post('sisa'),
            'status' => $this->input->post('status')
        ];
        $this->db->where('id', $id);
        $this->db->update('tbl_karyawan', $data);
        $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Data Karyawan Berhasil Di Edit</div>');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function delete_karyawan($id)
    {
        $this->detail->deleteKaryawan($id);
        $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">Data Karyawan Terhapus!</div>');
        redirect('admin/pegawai');
    }

    public function delete_kepegawaian($id)
    {
        $this->detail->deleteKepegawaian($id);
        $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">Data Kepegawaian Terhapus!</div>');
        redirect('admin/kepegawaian');
    }

    public function delete_atasan($id)
    {
        $this->detail->deleteAtasan($id);
        $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">Data Atasan Terhapus!</div>');
        redirect('admin/atasan');
    }

    public function kepegawaian()
    {
        $data['title'] = 'Data Kepegawaian';
        $data['role'] = $this->session->userdata('role_id');
        $data['userid'] = $this->session->userdata('userid');
        $id = $data['userid'];
        $data['session'] = $this->session->userdata('nama');
        $data['foto'] = $this->dashboard->getFotoUser($id);
        $data['kepegawaian'] = $this->detail->getKepegawaian();
        $data['jabatan'] = $this->detail->getJabatan();
        $data['dept'] = $this->detail->getDept();
        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/topbar', $data);
        $this->load->view('admin/kepegawaian', $data);
        $this->load->view('admin/footer', $data);
    }

    public function atasan()
    {
        $data['title'] = 'Data Atasan';
        $data['role'] = $this->session->userdata('role_id');
        $data['userid'] = $this->session->userdata('userid');
        $id = $data['userid'];
        $data['session'] = $this->session->userdata('nama');
        $data['foto'] = $this->dashboard->getFotoUser($id);
        $data['atasan'] = $this->detail->getAtasan();
        $data['atasanx'] = $this->detail->getAtasan();
        $data['jabatan'] = $this->detail->getJabatan();
        $data['dept'] = $this->detail->getDept();
        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/topbar', $data);
        $this->load->view('admin/atasan', $data);
        $this->load->view('admin/footer', $data);
    }

    public function edit_kepegawaian($id)
    {
        $data = [
            'golongan' => $this->input->post('departement'),
            'jabatan' => $this->input->post('jabatan'),
            'status' => $this->input->post('status')
        ];
        $this->db->where('kd_kepegawaian', $id);
        $this->db->update('tbl_kepegawaian', $data);
        $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Data Kepegawaian Berhasil Di Edit</div>');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function edit_atasan($id)
    {
        $data = [
            'golongan' => $this->input->post('departement'),
            'atasan' => $this->input->post('atasan'),
            'jabatan' => $this->input->post('jabatan'),
            'status' => $this->input->post('status')
        ];
        $this->db->where('kd_atasan', $id);
        $this->db->update('tbl_atasan', $data);
        $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Data Atasan Berhasil Di Edit</div>');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function tambah_kepegawaian()
    {
        $data['title'] = 'Tambah Data Kepegawaian';
        $data['role'] = $this->session->userdata('role_id');
        $data['userid'] = $this->session->userdata('userid');
        $id = $data['userid'];
        $data['session'] = $this->session->userdata('nama');
        $data['foto'] = $this->dashboard->getFotoUser($id);
        $data['jabatan'] = $this->detail->getJabatan();
        $data['dept'] = $this->detail->getDept();

        //form validation
        $this->form_validation->set_rules('nama', 'nama', 'required');
        $this->form_validation->set_rules('nik', 'nik', 'required');
        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
        $this->form_validation->set_rules('jeniskel', 'jenis kelamin', 'required');
        $this->form_validation->set_rules('jabatan', 'jabatan', 'required');
        $this->form_validation->set_rules('departement', 'departement', 'required');
        $this->form_validation->set_rules('foto', 'foto', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('admin/header', $data);
            $this->load->view('admin/sidebar', $data);
            $this->load->view('admin/topbar', $data);
            $this->load->view('admin/tambah_kepegawaian', $data);
            $this->load->view('admin/footer', $data);
        } else {
            $data = [
                'nama' => $this->input->post('nama'),
                'nik' => $this->input->post('nik'),
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password'),
                'jeniskel' => $this->input->post('jeniskel'),
                'jabatan' => $this->input->post('jabatan'),
                'golongan' => $this->input->post('departement'),
                'id_role' => $this->input->post('id_role'),
                'status' => 'Aktif',
                'foto' => $this->input->post('foto')
            ];
            $this->db->insert('tbl_kepegawaian', $data);
            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Data Kepegawian Berhasil Di Tambah</div>');
            redirect('admin/kepegawaian');
        }
    }

    public function tambah_atasan()
    {
        $data['title'] = 'Tambah Data Atasan';
        $data['role'] = $this->session->userdata('role_id');
        $data['userid'] = $this->session->userdata('userid');
        $id = $data['userid'];
        $data['session'] = $this->session->userdata('nama');
        $data['foto'] = $this->dashboard->getFotoUser($id);
        $data['jabatan'] = $this->detail->getJabatan();
        $data['atasanx'] = $this->detail->getAtasan();
        $data['kepegawaian'] = $this->detail->getKepegawaian();
        $data['dept'] = $this->detail->getDept();

        //form validation
        $this->form_validation->set_rules('nama', 'nama', 'required');
        $this->form_validation->set_rules('nik', 'nik', 'required');
        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
        $this->form_validation->set_rules('jeniskel', 'jenis kelamin', 'required');
        $this->form_validation->set_rules('jabatan', 'jabatan', 'required');
        $this->form_validation->set_rules('departement', 'departement', 'required');
        $this->form_validation->set_rules('foto', 'foto', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('admin/header', $data);
            $this->load->view('admin/sidebar', $data);
            $this->load->view('admin/topbar', $data);
            $this->load->view('admin/tambah_atasan', $data);
            $this->load->view('admin/footer', $data);
        } else {
            $data = [
                'nama' => $this->input->post('nama'),
                'nik' => $this->input->post('nik'),
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password'),
                'atasan' => $this->input->post('atasan'),
                'telp' => $this->input->post('telp'),
                'masuk_kerja' => $this->input->post('masuk'),
                'jeniskel' => $this->input->post('jeniskel'),
                'jabatan' => $this->input->post('jabatan'),
                'golongan' => $this->input->post('departement'),
                'id_role' => $this->input->post('id_role'),
                'sisa_cuti' => $this->input->post('sisa'),
                'status' => 'Aktif',
                'foto' => $this->input->post('foto')
            ];
            $this->db->insert('tbl_atasan', $data);
            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Data Atasan Berhasil Di Tambah</div>');
            redirect('admin/atasan');
        }
    }

    public function ketua()
    {
        $data['title'] = 'Data Ketua';
        $data['role'] = $this->session->userdata('role_id');
        $data['userid'] = $this->session->userdata('userid');
        $id = $data['userid'];
        $data['session'] = $this->session->userdata('nama');
        $data['foto'] = $this->dashboard->getFotoUser($id);
        $data['ketua'] = $this->detail->getKetua();
        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/topbar', $data);
        $this->load->view('admin/ketua', $data);
        $this->load->view('admin/footer', $data);
    }

    public function edit_profil()
    {
        $data['title'] = 'Edit Profil';
        $data['role'] = $this->session->userdata('role_id');
        $data['userid'] = $this->session->userdata('userid');
        $data['session'] = $this->session->userdata('nama');
        $id = $data['userid'];
        $data['foto'] = $this->dashboard->getFotoUser($id);
        $data['profil'] = $this->dashboard->getProfile();
        $data['golongan'] = $this->dashboard->getDept();
        // $data['pesertaall'] = $this->home->getProfileAll();
        $this->form_validation->set_rules('kd_admin', 'kd_admin', 'required');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('nik', 'NIP', 'required');
        $this->form_validation->set_rules('golongan', 'Golongan', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('jeniskel', 'jeniskel', 'required');
        if ($this->form_validation->run()) {
            $this->dashboard->update();
            $this->session->set_flashdata('success', 'Data Profil Berhasil Diperbarui');
            redirect('login/logout');
        } else {
            $this->session->set_flashdata('Error', 'Data Profil Gagal Diperbarui');
            $this->load->view('admin/header', $data);
            $this->load->view('admin/sidebar', $data);
            $this->load->view('admin/topbar', $data);
            $this->load->view('admin/edit_profil', $data);
            $this->load->view('admin/footer', $data);
        }
    }

    public function departement()
    {
        $data['title'] = 'Data Golongan';
        $data['role'] = $this->session->userdata('role_id');
        $data['userid'] = $this->session->userdata('userid');
        $id = $data['userid'];
        $data['session'] = $this->session->userdata('nama');
        $data['foto'] = $this->dashboard->getFotoUser($id);
        $data['dept'] = $this->detail->getDept();
        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/topbar', $data);
        $this->load->view('admin/departement', $data);
        $this->load->view('admin/footer', $data);
    }

    public function edit_dept($id)
    {
        $data = [
            'dept' => $this->input->post('dept')
        ];
        $this->db->where('id', $id);
        $this->db->update('tbl_departement', $data);
        $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Data Departement Berhasil Di Edit</div>');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function delete_dept($id)
    {
        $this->dashboard->deleteDept($id);
        $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">Data Departement Terhapus!</div>');
        redirect('admin/departement');
    }

    public function tambah_dept()
    {
        $data['title'] = 'Tambah Data Karyawan';
        $data['role'] = $this->session->userdata('role_id');
        $data['userid'] = $this->session->userdata('userid');
        $id = $data['userid'];
        $data['session'] = $this->session->userdata('nama');
        $data['foto'] = $this->dashboard->getFotoUser($id);
        $data['jabatan'] = $this->detail->getJabatan();
        $data['dept'] = $this->detail->getDept();

        //form validation
        $this->form_validation->set_rules('dept', 'dept', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('admin/header', $data);
            $this->load->view('admin/sidebar', $data);
            $this->load->view('admin/topbar', $data);
            $this->load->view('admin/departement', $data);
            $this->load->view('admin/footer', $data);
        } else {
            $data = [
                'dept' => $this->input->post('dept'),

            ];
            $this->db->insert('tbl_departement', $data);
            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Data Departement Berhasil Di Tambah</div>');
            redirect('admin/departement');
        }
    }

    public function jabatan()
    {
        $data['title'] = 'Data Jabatan';
        $data['role'] = $this->session->userdata('role_id');
        $data['userid'] = $this->session->userdata('userid');
        $id = $data['userid'];
        $data['session'] = $this->session->userdata('nama');
        $data['foto'] = $this->dashboard->getFotoUser($id);
        $data['jabatan'] = $this->detail->getJabatan();
        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/topbar', $data);
        $this->load->view('admin/jabatan', $data);
        $this->load->view('admin/footer', $data);
    }

    public function edit_jabatan($id)
    {
        $data = [
            'jabatan' => $this->input->post('jabatan')
        ];
        $this->db->where('id', $id);
        $this->db->update('tbl_jabatan', $data);
        $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Data Jabatan Berhasil Di Edit</div>');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function tambah_jabatan()
    {
        $data['title'] = 'Tambah Data Karyawan';
        $data['role'] = $this->session->userdata('role_id');
        $data['userid'] = $this->session->userdata('userid');
        $id = $data['userid'];
        $data['session'] = $this->session->userdata('nama');
        $data['foto'] = $this->dashboard->getFotoUser($id);
        $data['jabatan'] = $this->detail->getJabatan();
        $data['dept'] = $this->detail->getDept();

        //form validation
        $this->form_validation->set_rules('jabatan', 'jabatan', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('admin/header', $data);
            $this->load->view('admin/sidebar', $data);
            $this->load->view('admin/topbar', $data);
            $this->load->view('admin/jabatan', $data);
            $this->load->view('admin/footer', $data);
        } else {
            $data = [
                'jabatan' => $this->input->post('jabatan'),

            ];
            $this->db->insert('tbl_jabatan', $data);
            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Data Jabatan Berhasil Di Tambah</div>');
            redirect('admin/jabatan');
        }
    }

    public function delete_jabatan($id)
    {
        $this->dashboard->deleteJabatan($id);
        $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">Data jabatan Terhapus!</div>');
        redirect('admin/jabatan');
    }

    public function cuti()
    {
        $data['title'] = 'Data Cuti';
        $data['role'] = $this->session->userdata('role_id');
        $data['userid'] = $this->session->userdata('userid');
        $id = $data['userid'];
        $data['session'] = $this->session->userdata('nama');
        $data['foto'] = $this->dashboard->getFotoUser($id);
        $data['datacuti'] = $this->dashboard->getAllCuti();
        $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/topbar', $data);
        $this->load->view('admin/cuti', $data);
        $this->load->view('admin/footer', $data);
    }

    public function delete_cuti($id)
    {
        $this->dashboard->deleteCuti($id);
        $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">Data Cuti Terhapus!</div>');
        redirect('admin/cuti');
    }

    public function delete_ijin($id)
    {
        $this->dashboard->deleteIjin($id);
        $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">Data Ijin Terhapus!</div>');
        redirect('admin/cuti');
    }

    public function persetujuan_cuti()
    {
        $data['title'] = 'Data Persetujuan Cuti';
        $data['role'] = $this->session->userdata('role_id');
        $data['userid'] = $this->session->userdata('userid');
        $id = $data['userid'];
        $data['session'] = $this->session->userdata('nama');
        $data['foto'] = $this->dashboard->getFotoUser($id);
        $data['jumlah'] = $this->dashboard->countAllProcess();
        $data['datacuti'] = $this->dashboard->getAllCutiByProses();
        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/topbar', $data);
        $this->load->view('admin/persetujuan_cuti', $data);
        $this->load->view('admin/footer', $data);
    }

    public function ijin()
    {
        $data['title'] = 'Data Persetujuan Ijin';
        $data['role'] = $this->session->userdata('role_id');
        $data['userid'] = $this->session->userdata('userid');
        $id = $data['userid'];
        $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
        $data['session'] = $this->session->userdata('nama');
        $data['foto'] = $this->dashboard->getFotoUser($id);
        $data['jumlah'] = $this->dashboard->countAllProcess();
        $data['dataijin'] = $this->dashboard->getSangkarBurung();
        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/topbar', $data);
        $this->load->view('admin/ijin', $data);
        $this->load->view('admin/footer', $data);
    }

    public function edit_persetujuan($id)
    {
        $nik = $this->input->post('nik');
        $data = [
            'status' => $this->input->post('status')
        ];
        $this->db->where('id', $id);
        $this->db->update('tbl_cuti', $data);
        $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Data Telah Berhasil Di Edit</div>');
        $this->editprofilstatus($nik);
    }

    public function edit_ijin($id)
    {
        $data = [
            'status' => $this->input->post('status')
        ];
        $this->db->where('id', $id);
        $this->db->update('tbl_ijin', $data);
        $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Data Telah Berhasil Di Edit</div>');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function editprofilstatus($nik)
    {
        $data = [
            'status' => $this->input->post('status_profil'),
            'tgl_masuk' => $this->input->post('tgl_masuk')
        ];
        $this->db->where('nik', $nik);
        $this->db->update('tbl_karyawan', $data);
        $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Data Telah Berhasil Di Edit</div>');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function laporan_karyawan()
    {
        $kode_dept = $this->uri->segment(3);
        $data['kode_dept'] = $kode_dept;
        // $id = $this->session->userdata('userid');
        $data['karyawan'] = $this->detail->getPegawaiByDept($kode_dept);
        $data['title'] = 'Laporan Data Karyawan';
        // filename dari pdf ketika didownload
        // $file_pdf = 'Laporan Penilaian Magang';
        // setting paper
        // $paper = 'A4';
        //orientasi paper potrait / landscape
        // $orientation = "portrait";
        $data['date'] = date('d F Y H:i:s');
        // $html = $this->load->view('admin/laporan_karyawan', $data, true);
        // $this->load->view('invoice', $data);
        // $this->dompdfgenerator->generate($html, $file_pdf, $paper, $orientation);
        $this->load->view('admin/laporan_karyawan', $data);
    }

    public function cetak_laporan()
    {
        $data['cuti'] = $this->dashboard->getAllCuti();

        $data['title'] = 'Laporan Cuti';
        // filename dari pdf ketika didownload
        $file_pdf = 'Laporan Cuti';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "landscape";
        $data['date'] = date('d F Y');
        $html = $this->load->view('admin/cetak_laporan', $data, true);
        // $this->load->view('admin/cetak_laporan', $data);
        $this->dompdfgenerator->generate($html, $file_pdf, $paper, $orientation);
        // $this->load->view('invoice', $data);
    }

    public function cetak_ijin()
    {
        $data['ijin'] = $this->dashboard->getAllIjin();

        $data['title'] = 'Laporan ijin';
        // filename dari pdf ketika didownload
        $file_pdf = 'Laporan Ijin';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "landscape";
        $data['date'] = date('d F Y');
        $html = $this->load->view('admin/cetak_ijin', $data, true);
        // $this->load->view('admin/cetak_ijin', $data);
        $this->dompdfgenerator->generate($html, $file_pdf, $paper, $orientation);
        // $this->load->view('invoice', $data);
    }
}

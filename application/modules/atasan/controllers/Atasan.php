<?php

use FontLib\Table\Type\post;

defined('BASEPATH') or exit('No direct script access allowed');

class Atasan extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->CI = &get_instance();
        $this->load->library('form_validation');
        $this->load->helper(array('url', 'form'));
        $this->load->model('atasan/Dashboard_model', 'dashboard');
        $this->load->model('user/User_model', 'user');
        $this->load->model('atasan/Detail_model', 'detail');
        $this->load->library('dompdfgenerator');
    }

    public function index()
    {
        $data['title'] = 'Dashboard Atasan';
        $data['role'] = $this->session->userdata('role_id');
        $data['userid'] = $this->session->userdata('userid');
        $data['golongan'] = $this->session->userdata('golongan');
        $id = $data['userid'];
        $data['session'] = $this->session->userdata('nama');
        $data['foto'] = $this->dashboard->getFotoUser($id);
        $data['ijin'] = $this->dashboard->countAllIjin($id);
        $data['cuti'] = $this->dashboard->countAllCuti($id);
        $data['approved'] = $this->dashboard->countAllApproved($id);
        $data['approved_cuti'] = $this->dashboard->countAllApprovedCuti($id);
        $data['reject'] = $this->dashboard->countAllReject($id);
        $data['reject_cuti'] = $this->dashboard->countAllRejectCuti($id);
        $data['process'] = $this->dashboard->countAllProcess($id);
        $data['tangguh'] = $this->dashboard->countAllTangguh($id);
        $data['dataijin'] = $this->dashboard->getAllIjinHome($id);
        $data['dataijinatasan'] = $this->dashboard->getAllIjinHomeAtasan($id);
        $data['dataijindewe'] = $this->dashboard->getAllIjinHomeDewe($id);
        $data['datacuti'] = $this->dashboard->getAllCutiHome($id);
        $data['datacutiatas'] = $this->dashboard->getAllCutiHomeAtas($id);
        $data['datacutiatasdewe'] = $this->dashboard->getAllCutiHomeAtasDewe($id);
        $this->load->view('atasan/header.php', $data);
        $this->load->view('atasan/sidebar.php', $data);
        $this->load->view('atasan/topbar.php', $data);
        $this->load->view('atasan', $data);
        $this->load->view('atasan/footer.php', $data);
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
        $this->load->view('atasan/header', $data);
        $this->load->view('atasan/sidebar', $data);
        $this->load->view('atasan/topbar', $data);
        $this->load->view('atasan/detail_pegawai', $data);
        $this->load->view('atasan/footer', $data);
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
        $id_atasan = $data['atasan']['atasan'];
        $data['nama_atasan'] = $this->detail->getAllAtasanById($id_atasan);
        $this->load->view('atasan/header', $data);
        $this->load->view('atasan/sidebar', $data);
        $this->load->view('atasan/topbar', $data);
        $this->load->view('atasan/detail_atasan', $data);
        $this->load->view('atasan/footer', $data);
    }

    public function pegawai()
    {
        $data['title'] = 'Data Karyawan';
        $data['role'] = $this->session->userdata('role_id');
        $data['userid'] = $this->session->userdata('userid');
        $data['golongan'] = $this->session->userdata('golongan');
        $id = $data['userid'];
        $data['session'] = $this->session->userdata('nama');
        $data['foto'] = $this->dashboard->getFotoUser($id);
        $data['karyawan'] = $this->detail->getPegawai($id);
        $data['karyawanatas'] = $this->detail->getPegawaiAtas($id);
        $data['jabatan'] = $this->detail->getJabatan();
        $data['dept'] = $this->detail->getDept();
        $this->load->view('atasan/header', $data);
        $this->load->view('atasan/sidebar', $data);
        $this->load->view('atasan/topbar', $data);
        $this->load->view('atasan/karyawan', $data);
        $this->load->view('atasan/footer', $data);
    }

    public function tambah_karyawan()
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
        $this->form_validation->set_rules('nama', 'nama', 'required');
        $this->form_validation->set_rules('nik', 'nik', 'required');
        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
        $this->form_validation->set_rules('masuk', 'tanggal masuk', 'required');
        $this->form_validation->set_rules('jeniskel', 'jenis kelamin', 'required');
        $this->form_validation->set_rules('telp', 'telepon', 'required');
        $this->form_validation->set_rules('alamat', 'alamat', 'required');
        $this->form_validation->set_rules('jabatan', 'jabatan', 'required');
        $this->form_validation->set_rules('departement', 'departement', 'required');
        $this->form_validation->set_rules('sisa', 'sisa', 'required');
        $this->form_validation->set_rules('foto', 'foto', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('atasan/header', $data);
            $this->load->view('atasan/sidebar', $data);
            $this->load->view('atasan/topbar', $data);
            $this->load->view('atasan/tambah_karyawan', $data);
            $this->load->view('atasan/footer', $data);
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
                'jabatan' => $this->input->post('jabatan'),
                'departement' => $this->input->post('departement'),
                'sisa_cuti' => $this->input->post('sisa'),
                'id_role' => $this->input->post('id_role'),
                'foto' => $this->input->post('foto')
            ];
            $this->db->insert('tbl_karyawan', $data);
            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Data Karyawan Berhasil Di Tambah</div>');
            redirect('atasan/pegawai');
        }
    }

    public function edit_karyawan($id)
    {
        $data = [
            'departement' => $this->input->post('departement'),
            'jabatan' => $this->input->post('jabatan'),
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
        redirect('atasan/pegawai');
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
        $this->load->view('atasan/header', $data);
        $this->load->view('atasan/sidebar', $data);
        $this->load->view('atasan/topbar', $data);
        $this->load->view('atasan/ketua', $data);
        $this->load->view('atasan/footer', $data);
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
        // $data['pesertaall'] = $this->home->getProfileAll();
        $this->form_validation->set_rules('kd_atasan', 'kd_atasan', 'required');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('jeniskel', 'jeniskel', 'required');
        $this->form_validation->set_rules('nik', 'nik', 'required');
        if ($this->form_validation->run()) {
            $this->dashboard->update();
            $this->session->set_flashdata('success', 'Data Profil Berhasil Diperbarui');
            redirect('login/logout');
        } else {
            $this->session->set_flashdata('Error', 'Data Profil Gagal Diperbarui');
            $this->load->view('atasan/header', $data);
            $this->load->view('atasan/sidebar', $data);
            $this->load->view('atasan/topbar', $data);
            $this->load->view('atasan/edit_profil', $data);
            $this->load->view('atasan/footer', $data);
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
        $this->load->view('atasan/header', $data);
        $this->load->view('atasan/sidebar', $data);
        $this->load->view('atasan/topbar', $data);
        $this->load->view('atasan/departement', $data);
        $this->load->view('atasan/footer', $data);
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
        redirect('atasan/departement');
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
            $this->load->view('atasan/header', $data);
            $this->load->view('atasan/sidebar', $data);
            $this->load->view('atasan/topbar', $data);
            $this->load->view('atasan/departement', $data);
            $this->load->view('atasan/footer', $data);
        } else {
            $data = [
                'dept' => $this->input->post('dept'),

            ];
            $this->db->insert('tbl_departement', $data);
            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Data Departement Berhasil Di Tambah</div>');
            redirect('atasan/departement');
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
        $this->load->view('atasan/header', $data);
        $this->load->view('atasan/sidebar', $data);
        $this->load->view('atasan/topbar', $data);
        $this->load->view('atasan/jabatan', $data);
        $this->load->view('atasan/footer', $data);
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
            $this->load->view('atasan/header', $data);
            $this->load->view('atasan/sidebar', $data);
            $this->load->view('atasan/topbar', $data);
            $this->load->view('atasan/jabatan', $data);
            $this->load->view('atasan/footer', $data);
        } else {
            $data = [
                'jabatan' => $this->input->post('jabatan'),

            ];
            $this->db->insert('tbl_jabatan', $data);
            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Data Jabatan Berhasil Di Tambah</div>');
            redirect('atasan/jabatan');
        }
    }

    public function delete_jabatan($id)
    {
        $this->dashboard->deleteJabatan($id);
        $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">Data jabatan Terhapus!</div>');
        redirect('atasan/jabatan');
    }

    public function cuti()
    {
        $data['title'] = 'Data Cuti';
        $data['role'] = $this->session->userdata('role_id');
        $data['userid'] = $this->session->userdata('userid');
        $id = $data['userid'];
        $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
        $data['session'] = $this->session->userdata('nama');
        $data['foto'] = $this->dashboard->getFotoUser($id);
        $data['datacuti'] = $this->dashboard->getAllCuti($id);
        $this->load->view('atasan/header', $data);
        $this->load->view('atasan/sidebar', $data);
        $this->load->view('atasan/topbar', $data);
        $this->load->view('atasan/cuti', $data);
        $this->load->view('atasan/footer', $data);
    }

    public function ijin()
    {
        $data['title'] = 'Data Ijin';
        $data['role'] = $this->session->userdata('role_id');
        $data['userid'] = $this->session->userdata('userid');
        $id = $data['userid'];
        $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
        $data['session'] = $this->session->userdata('nama');
        $data['foto'] = $this->dashboard->getFotoUser($id);
        $data['dataijin'] = $this->dashboard->getAllIjin($id);
        $this->load->view('atasan/header', $data);
        $this->load->view('atasan/sidebar', $data);
        $this->load->view('atasan/topbar', $data);
        $this->load->view('atasan/ijin', $data);
        $this->load->view('atasan/footer', $data);
    }

    public function delete_cuti($id)
    {
        $this->dashboard->deleteCuti($id);
        $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">Data Cuti Terhapus!</div>');
        redirect('atasan/cuti');
    }

    public function persetujuan_cuti()
    {
        $data['title'] = 'Data Persetujuan Cuti';
        $data['role'] = $this->session->userdata('role_id');
        $data['userid'] = $this->session->userdata('userid');
        $id = $data['userid'];
        $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
        $data['session'] = $this->session->userdata('nama');
        $data['foto'] = $this->dashboard->getFotoUser($id);
        $data['jumlah'] = $this->dashboard->countAllProcess();
        $data['datacuti'] = $this->dashboard->getAllCutiByProses($id);
        $this->load->view('atasan/header', $data);
        $this->load->view('atasan/sidebar', $data);
        $this->load->view('atasan/topbar', $data);
        $this->load->view('atasan/persetujuan_cuti', $data);
        $this->load->view('atasan/footer', $data);
    }

    public function persetujuan_ijin()
    {
        $data['title'] = 'Data Persetujuan Ijin';
        $data['role'] = $this->session->userdata('role_id');
        $data['userid'] = $this->session->userdata('userid');
        $id = $data['userid'];
        $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
        $data['session'] = $this->session->userdata('nama');
        $data['foto'] = $this->dashboard->getFotoUser($id);
        $data['jumlah'] = $this->dashboard->countAllProcess();
        $data['datacuti'] = $this->dashboard->getSangkarBurung($id);
        $this->load->view('atasan/header', $data);
        $this->load->view('atasan/sidebar', $data);
        $this->load->view('atasan/topbar', $data);
        $this->load->view('atasan/persetujuan_ijin', $data);
        $this->load->view('atasan/footer', $data);
    }

    public function edit_persetujuan($id)
    {
        $nik = $this->input->post('nik');
        $sisa = $this->input->post('sisa');
        $tgl_masuk = $this->input->post('masuk');
        $status_profil = $this->input->post('status_profil');
        $data = [
            'status' => $this->input->post('status'),
            'tgl_cuti' => $this->input->post('cuti'),
            'tgl_masuk' => $this->input->post('masuk')
        ];
        $this->db->where('id', $id);
        $this->db->update('tbl_cuti', $data);
        $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Data Telah Berhasil Di Edit</div>');
        $this->editprofilstatus($nik, $sisa, $tgl_masuk, $status_profil);
    }

    public function edit_persetujuanatas($id)
    {
        $nikatas = $this->input->post('nikatas');
        $sisaatas = $this->input->post('sisaatas');
        $tgl_masukatas = $this->input->post('masuk');
        $status_profilatas = $this->input->post('status_profilatas');
        $data = [
            'status' => $this->input->post('statusx'),
            'tgl_cuti' => $this->input->post('cuti'),
            'tgl_masuk' => $this->input->post('masuk')
        ];
        $this->db->where('id', $id);
        $this->db->update('tbl_cuti', $data);
        $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Data Telah Berhasil Di Edit</div>');
        $this->editprofilstatusatas($nikatas, $sisaatas, $tgl_masukatas, $status_profilatas);
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

    public function editprofilstatus($nik, $sisa, $tgl_masuk, $status_profil)
    {
        $data = [
            'sisa_cuti' => $sisa,
            'status' => $status_profil,
            'tgl_masuk' => $tgl_masuk
        ];
        $this->db->where('nik', $nik);
        $this->db->update('tbl_karyawan', $data);
        $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Data Telah Berhasil Di Edit</div>');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function editprofilstatusatas($nikatas, $sisaatas, $tgl_masukatas, $status_profilatas)
    {
        $data = [
            'sisa_cuti' => $sisaatas,
            'status' => $status_profilatas,
            'tgl_masuk' => $tgl_masukatas
        ];
        $this->db->where('nik', $nikatas);
        $this->db->update('tbl_atasan', $data);
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
        // $html = $this->load->view('atasan/laporan_karyawan', $data, true);
        // $this->load->view('invoice', $data);
        // $this->dompdfgenerator->generate($html, $file_pdf, $paper, $orientation);
        $this->load->view('atasan/laporan_karyawan', $data);
    }

    public function cetak_laporan()
    {
        $from = $this->input->post('from');
        $to = $this->input->post('to');
        $id = $this->session->userdata('userid');
        $data['from'] = $from;
        $data['to'] = $to;
        $data['datacuti'] = $this->dashboard->getAllCuti($id, $from, $to);
        $data['title'] = 'Laporan Cuti';
        // filename dari pdf ketika didownload
        $file_pdf = 'Laporan Cuti';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "potrait";
        $data['date_id'] = date('j / n / y');
        $data['date'] = date('d F Y');
        $html = $this->load->view('atasan/cetak_laporan', $data, true);
        // $this->load->view('atasan/cetak_laporan', $data);
        $this->dompdfgenerator->generate($html, $file_pdf, $paper, $orientation);
        // $this->load->view('invoice', $data);
    }

    public function cetak_laporanatasan()
    {
        $from = $this->input->post('from');
        $to = $this->input->post('to');
        $id = $this->session->userdata('userid');
        $data['from'] = $from;
        $data['to'] = $to;
        $data['datacuti'] = $this->dashboard->getAllCutiAtasan($id, $from, $to);
        $data['title'] = 'Laporan Cuti Atasan';
        // filename dari pdf ketika didownload
        $file_pdf = 'Laporan Cuti Atasan';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "potrait";
        $data['date_id'] = date('j / n / y');
        $data['date'] = date('d F Y');
        $html = $this->load->view('atasan/cetak_laporan', $data, true);
        // $this->load->view('atasan/cetak_laporan', $data);
        $this->dompdfgenerator->generate($html, $file_pdf, $paper, $orientation);
        // $this->load->view('invoice', $data);
    }

    public function cetak_laporandewe()
    {
        $from = $this->input->post('from');
        $to = $this->input->post('to');
        $id = $this->session->userdata('userid');
        $data['from'] = $from;
        $data['to'] = $to;
        $data['datacuti'] = $this->dashboard->getAllCutiAtasanDewe($id, $from, $to);
        $data['title'] = 'Laporan Cuti';
        // filename dari pdf ketika didownload
        $file_pdf = 'Laporan Cuti';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "potrait";
        $data['date_id'] = date('j / n / y');
        $data['date'] = date('d F Y');
        $html = $this->load->view('atasan/cetak_laporan', $data, true);
        // $this->load->view('atasan/cetak_laporan', $data);
        $this->dompdfgenerator->generate($html, $file_pdf, $paper, $orientation);
        // $this->load->view('invoice', $data);
    }

    public function cetak_cuti()
    {
        $kode_nilai = $this->uri->segment(3);
        $nik = $this->session->userdata('nik');
        $id = $this->session->userdata('userid');
        $data['cuti'] = $this->user->getFotoUser($id);
        $data['datacuti'] = $this->detail->getAllCutiById($kode_nilai);
        $id_atasan = $data['datacuti']['atasan'];
        $data['atasan'] = $this->detail->getAllAtasanById($id_atasan);
        $data['ketua'] = $this->user->getKetua();

        $data['title'] = 'Surat Cuti';
        // filename dari pdf ketika didownload
        $file_pdf = 'Surat Cuti';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "portrait";
        $data['date'] = date('d F Y');
        $data['tahun'] = date('Y');
        $data['tahun_data'] = date('Y', strtotime($data['datacuti']['masuk_kerja']));
        $data['bulan'] = date('n');
        $data['bulan_data'] = date('n', strtotime($data['datacuti']['masuk_kerja']));
        $data['day'] = date('d');
        $data['day_data'] =  date('d', strtotime($data['datacuti']['tgl_cuti']));
        $data['day_datax'] =  date('d', strtotime($data['datacuti']['tgl_masuk']));
        $data['hasil'] = $data['tahun'] - $data['tahun_data'];
        $data['hasilx'] = $data['bulan_data'] - $data['bulan'];
        $data['hasily'] = $data['day_datax'] - $data['day_data'];
        $data['date_id'] = date('j / n / y');
        $html = $this->load->view('atasan/cetak_cuti', $data, true);
        // $this->load->view('user/cetak_cuti', $data);
        $this->dompdfgenerator->generate($html, $file_pdf, $paper, $orientation);
        // $this->load->view('invoice', $data);
    }

    public function cetak_ijin()
    {
        $from = $this->input->post('from');
        $to = $this->input->post('to');
        $id = $this->session->userdata('userid');
        $data['from'] = $from;
        $data['to'] = $to;
        $data['dataijin'] = $this->dashboard->getAllIjin($id, $from, $to);
        $data['title'] = 'Laporan Ijin';
        // filename dari pdf ketika didownload
        $file_pdf = 'Laporan Ijin';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "potrait";
        $data['date_id'] = date('j / n / y');
        $data['date'] = date('d F Y');
        $html = $this->load->view('atasan/cetak_laporanijin', $data, true);
        // $this->load->view('atasan/cetak_ijin', $data);
        $this->dompdfgenerator->generate($html, $file_pdf, $paper, $orientation);
        // $this->load->view('invoice', $data);
    }

    public function cetak_ijinatasan()
    {
        $from = $this->input->post('from');
        $to = $this->input->post('to');
        $id = $this->session->userdata('userid');
        $data['from'] = $from;
        $data['to'] = $to;
        $data['dataijin'] = $this->dashboard->getAllIjinAtasan($id, $from, $to);
        $data['title'] = 'Laporan Ijin';
        // filename dari pdf ketika didownload
        $file_pdf = 'Laporan Ijin';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "potrait";
        $data['date_id'] = date('j / n / y');
        $data['date'] = date('d F Y');
        $html = $this->load->view('atasan/cetak_laporanijin', $data, true);
        // $this->load->view('atasan/cetak_ijin', $data);
        $this->dompdfgenerator->generate($html, $file_pdf, $paper, $orientation);
        // $this->load->view('invoice', $data);
    }

    public function cetak_ijindewe()
    {
        $from = $this->input->post('from');
        $to = $this->input->post('to');
        $id = $this->session->userdata('userid');
        $data['from'] = $from;
        $data['to'] = $to;
        $data['dataijin'] = $this->dashboard->getAllIjinDewe($id, $from, $to);
        $data['title'] = 'Laporan Ijin';
        // filename dari pdf ketika didownload
        $file_pdf = 'Laporan Ijin';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "potrait";
        $data['date_id'] = date('j / n / y');
        $data['date'] = date('d F Y');
        $html = $this->load->view('atasan/cetak_laporanijin', $data, true);
        // $this->load->view('atasan/cetak_ijin', $data);
        $this->dompdfgenerator->generate($html, $file_pdf, $paper, $orientation);
        // $this->load->view('invoice', $data);
    }

    public function cetak_surat()
    {
        $kode_nilai = $this->uri->segment(3);
        $nik = $this->session->userdata('nik');
        $id = $this->session->userdata('userid');
        $data['cuti'] = $this->user->getFotoUser($id);
        $data['dataijin'] = $this->detail->getAllIjinById($kode_nilai);
        $data['ketua'] = $this->user->getKetua();
        $data['title'] = 'Surat Ijin Cepat';
        // filename dari pdf ketika didownload
        $file_pdf = 'Surat Cuti';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "portrait";
        $data['date'] = date('d F Y');
        $data['tahun'] = date('Y');
        $data['tahun_data'] = date('Y', strtotime($data['dataijin']['masuk_kerja']));
        $data['bulan'] = date('n');
        $data['bulan_data'] = date('n', strtotime($data['dataijin']['masuk_kerja']));
        $data['day'] = date('d');
        $data['day_data'] =  date('d F Y', strtotime($data['dataijin']['tgl_ijin']));
        $data['hari_data'] =  date('l', strtotime($data['dataijin']['tgl_ijin']));
        $data['pergi'] = date('H.i', strtotime($data['dataijin']['waktu_pergi']));
        $data['masuk'] = date('H.i', strtotime($data['dataijin']['waktu_pulang']));
        $data['date_id'] = date('j / n / y');
        $html = $this->load->view('atasan/cetak_ijin', $data, true);
        // $this->load->view('user/cetak_ijin', $data);
        $this->dompdfgenerator->generate($html, $file_pdf, $paper, $orientation);
        // $this->load->view('invoice', $data);
    }

    public function cetak_suratatasan()
    {
        $kode_nilai = $this->uri->segment(3);
        $nik = $this->session->userdata('nik');
        $id = $this->session->userdata('userid');
        $data['cuti'] = $this->user->getFotoUser($id);
        $data['dataijin'] = $this->detail->getAllIjinByIdAtasan($kode_nilai);
        $id_atasan = $data['dataijin']['atasan'];
        $data['atasan'] = $this->detail->getAllAtasanById($id_atasan);
        $data['ketua'] = $this->user->getKetua();
        $data['title'] = 'Surat Ijin Cepat';
        // filename dari pdf ketika didownload
        $file_pdf = 'Surat Cuti';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "portrait";
        $data['date'] = date('d F Y');
        $data['tahun'] = date('Y');
        $data['tahun_data'] = date('Y', strtotime($data['dataijin']['masuk_kerja']));
        $data['bulan'] = date('n');
        $data['bulan_data'] = date('n', strtotime($data['dataijin']['masuk_kerja']));
        $data['day'] = date('d');
        $data['day_data'] =  date('d F Y', strtotime($data['dataijin']['tgl_ijin']));
        $data['hari_data'] =  date('l', strtotime($data['dataijin']['tgl_ijin']));
        $data['pergi'] = date('H.i', strtotime($data['dataijin']['waktu_pergi']));
        $data['masuk'] = date('H.i', strtotime($data['dataijin']['waktu_pulang']));
        $data['date_id'] = date('j / n / y');
        $html = $this->load->view('atasan/cetak_ijinatasan', $data, true);
        // $this->load->view('user/cetak_ijin', $data);
        $this->dompdfgenerator->generate($html, $file_pdf, $paper, $orientation);
        // $this->load->view('invoice', $data);
    }

    public function cetak_suratdewe()
    {
        $kode_nilai = $this->uri->segment(3);
        $nik = $this->session->userdata('nik');
        $id = $this->session->userdata('userid');
        $data['cuti'] = $this->user->getFotoUser($id);
        $data['dataijin'] = $this->detail->getAllIjinByIdDewe($kode_nilai);
        $id_atasan = $data['dataijin']['atasan'];
        $data['atasan'] = $this->detail->getAllAtasanById($id_atasan);
        $data['ketua'] = $this->user->getKetua();

        $data['title'] = 'Surat Ijin Cepat';
        // filename dari pdf ketika didownload
        $file_pdf = 'Surat Cuti';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "portrait";
        $data['date'] = date('d F Y');
        $data['tahun'] = date('Y');
        $data['tahun_data'] = date('Y', strtotime($data['dataijin']['masuk_kerja']));
        $data['bulan'] = date('n');
        $data['bulan_data'] = date('n', strtotime($data['dataijin']['masuk_kerja']));
        $data['day'] = date('d');
        $data['day_data'] =  date('d F Y', strtotime($data['dataijin']['tgl_ijin']));
        $data['hari_data'] =  date('l', strtotime($data['dataijin']['tgl_ijin']));
        $data['pergi'] = date('H.i', strtotime($data['dataijin']['waktu_pergi']));
        $data['masuk'] = date('H.i', strtotime($data['dataijin']['waktu_pulang']));
        $data['date_id'] = date('j / n / y');
        $html = $this->load->view('atasan/cetak_ijinatasan', $data, true);
        // $this->load->view('user/cetak_ijin', $data);
        $this->dompdfgenerator->generate($html, $file_pdf, $paper, $orientation);
        // $this->load->view('invoice', $data);
    }

    public function cetak_cepat()
    {
        $kode_nilai = $this->uri->segment(3);
        $nik = $this->session->userdata('nik');
        $id = $this->session->userdata('userid');
        $data['cuti'] = $this->user->getFotoUser($id);
        $data['dataijin'] = $this->detail->getAllIjinById($kode_nilai);
        $data['ketua'] = $this->user->getKetua();
        $data['title'] = 'Surat Ijin Cepat';
        // filename dari pdf ketika didownload
        $file_pdf = 'Surat Cuti';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "portrait";
        $data['date'] = date('d F Y');
        $data['tahun'] = date('Y');
        $data['tahun_data'] = date('Y', strtotime($data['dataijin']['masuk_kerja']));
        $data['bulan'] = date('n');
        $data['bulan_data'] = date('n', strtotime($data['dataijin']['masuk_kerja']));
        $data['day'] = date('d');
        $data['day_data'] =  date('d F Y', strtotime($data['dataijin']['tgl_ijin']));
        $data['hari_data'] =  date('l', strtotime($data['dataijin']['tgl_ijin']));
        $data['pergi'] = date('H.i', strtotime($data['dataijin']['waktu_pergi']));
        $data['masuk'] = date('H.i', strtotime($data['dataijin']['waktu_pulang']));
        $data['date_id'] = date('j / n / y');
        $html = $this->load->view('atasan/cetak_cepat', $data, true);
        // $this->load->view('user/cetak_ijin', $data);
        $this->dompdfgenerator->generate($html, $file_pdf, $paper, $orientation);
        // $this->load->view('invoice', $data);
    }

    public function cetak_cepatatasan()
    {
        $kode_nilai = $this->uri->segment(3);
        $nik = $this->session->userdata('nik');
        $id = $this->session->userdata('userid');
        $data['cuti'] = $this->user->getFotoUser($id);
        $data['dataijin'] = $this->detail->getAllIjinByIdAtasan($kode_nilai);
        $id_atasan = $data['dataijin']['atasan'];
        $data['atasan'] = $this->detail->getAllAtasanById($id_atasan);
        $data['ketua'] = $this->user->getKetua();

        $data['title'] = 'Surat Ijin Cepat';
        // filename dari pdf ketika didownload
        $file_pdf = 'Surat Cuti';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "portrait";
        $data['date'] = date('d F Y');
        $data['tahun'] = date('Y');
        $data['tahun_data'] = date('Y', strtotime($data['dataijin']['masuk_kerja']));
        $data['bulan'] = date('n');
        $data['bulan_data'] = date('n', strtotime($data['dataijin']['masuk_kerja']));
        $data['day'] = date('d');
        $data['day_data'] =  date('d F Y', strtotime($data['dataijin']['tgl_ijin']));
        $data['hari_data'] =  date('l', strtotime($data['dataijin']['tgl_ijin']));
        $data['pergi'] = date('H.i', strtotime($data['dataijin']['waktu_pergi']));
        $data['masuk'] = date('H.i', strtotime($data['dataijin']['waktu_pulang']));
        $data['date_id'] = date('j / n / y');
        $html = $this->load->view('atasan/cetak_cepatatasan', $data, true);
        // $this->load->view('user/cetak_ijin', $data);
        $this->dompdfgenerator->generate($html, $file_pdf, $paper, $orientation);
        // $this->load->view('invoice', $data);
    }

    public function cetak_cepatdewe()
    {
        $kode_nilai = $this->uri->segment(3);
        $nik = $this->session->userdata('nik');
        $id = $this->session->userdata('userid');
        $data['cuti'] = $this->user->getFotoUser($id);
        $data['dataijin'] = $this->detail->getAllIjinByIdDewe($kode_nilai);
        $id_atasan = $data['dataijin']['atasan'];
        $data['atasan'] = $this->detail->getAllAtasanById($id_atasan);
        $data['ketua'] = $this->user->getKetua();

        $data['title'] = 'Surat Ijin Cepat';
        // filename dari pdf ketika didownload
        $file_pdf = 'Surat Cuti';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "portrait";
        $data['date'] = date('d F Y');
        $data['tahun'] = date('Y');
        $data['tahun_data'] = date('Y', strtotime($data['dataijin']['masuk_kerja']));
        $data['bulan'] = date('n');
        $data['bulan_data'] = date('n', strtotime($data['dataijin']['masuk_kerja']));
        $data['day'] = date('d');
        $data['day_data'] =  date('d F Y', strtotime($data['dataijin']['tgl_ijin']));
        $data['hari_data'] =  date('l', strtotime($data['dataijin']['tgl_ijin']));
        $data['pergi'] = date('H.i', strtotime($data['dataijin']['waktu_pergi']));
        $data['masuk'] = date('H.i', strtotime($data['dataijin']['waktu_pulang']));
        $data['date_id'] = date('j / n / y');
        $html = $this->load->view('atasan/cetak_cepatatasan', $data, true);
        // $this->load->view('user/cetak_ijin', $data);
        $this->dompdfgenerator->generate($html, $file_pdf, $paper, $orientation);
        // $this->load->view('invoice', $data);
    }

    public function editconfirm()
    {
        $id = $this->session->userdata('userid');
        $this->db->set('status', $this->input->post('status'));
        $this->db->set('tgl_masuk', $this->input->post('tgl_masuk'));
        $this->db->where('kd_atasan', $id);
        $this->db->update('tbl_atasan');
        $this->session->set_flashdata('success', 'Anda telah aktif kembali');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function pengajuan_cuti()
    {
        $data['title'] = 'Form Pengajuan Cuti';
        $data['role'] = $this->session->userdata('role_id');
        $id_karyawan = $this->input->post('id');
        $proses = $this->input->post('proses');
        $data['userid'] = $this->session->userdata('userid');
        $id = $data['userid'];
        $data['session'] = $this->session->userdata('nama');
        $data['foto'] = $this->detail->getFotoUser($id);
        $data['jeniscuti'] = $this->user->getJenisCuti();
        $data['user'] = $this->detail->getProfile($id);

        //Form Validation
        $this->form_validation->set_rules('jenis_cuti', 'Jenis Cuti', 'required');
        $this->form_validation->set_rules('tgl_cuti', 'tgl_cuti Peserta', 'required');
        $this->form_validation->set_rules('tgl_masuk', 'tgl_masuk', 'required');
        $this->form_validation->set_rules('keperluan', 'keperluan', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('atasan/header.php', $data);
            $this->load->view('atasan/sidebar.php', $data);
            $this->load->view('atasan/topbar.php', $data);
            $this->load->view('atasan/pengajuan_cuti', $data);
            $this->load->view('atasan/footer.php', $data);
        } else {
            if (!empty($_FILES["surat"]["name"])) {
                $date = substr(date('Ymd'), 2, 8);
                $config = array();
                $config['upload_path'] = './assets/data/atasan/surat';
                $config['allowed_types'] = 'pdf';
                $config['file_name']    = $date . '-' . $_FILES['surat']['name'];

                $this->load->library('upload', $config, 'surat');
                $this->surat->initialize($config);
                $upload_surat = $this->surat->do_upload('surat');

                if ($upload_surat) {
                    $data =  array(
                        'id_karyawan' => $this->input->post('id_karyawan'),
                        'tgl_cuti' => $this->input->post('tgl_cuti'),
                        'tgl_masuk' => $this->input->post('tgl_masuk'),
                        'jenis_cuti' => $this->input->post('jenis_cuti'),
                        'keperluan' => $this->input->post('keperluan'),
                        'alamat' => $this->input->post('alamat'),
                        'status' => $this->input->post('status'),
                        'atasan' => $this->input->post('atasan'),
                        'jumlah_cuti' => $this->input->post('sisa'),
                        'sisa_cuti' => $this->input->post('sisa_cuti'),
                        'keterangan_sisa' => $this->input->post('keterangan_sisa'),
                        'surat' => $this->surat->data("file_name"),
                        'tgl_upload' => $this->input->post('date'),
                    );

                    $this->db->insert('tbl_cuti', $data);
                    $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Pengajuan Cuti Telah Dikirim, Silahkan Menunggu!</div>');
                    $this->kurangcuti($id_karyawan, $proses);
                    redirect($_SERVER['HTTP_REFERER']);
                } else {
                    $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">Pengajuan Cuti Gagal, silahkan ulangi pengisian form!</div>');
                    redirect($_SERVER['HTTP_REFERER']);
                }
            } else {
                $data =  array(
                    'id_karyawan' => $this->input->post('id_karyawan'),
                    'tgl_cuti' => $this->input->post('tgl_cuti'),
                    'tgl_masuk' => $this->input->post('tgl_masuk'),
                    'jenis_cuti' => $this->input->post('jenis_cuti'),
                    'keperluan' => $this->input->post('keperluan'),
                    'alamat' => $this->input->post('alamat'),
                    'status' => $this->input->post('status'),
                    'atasan' => $this->input->post('atasan'),
                    'jumlah_cuti' => $this->input->post('sisa'),
                    'sisa_cuti' => $this->input->post('sisa_cuti'),
                    'keterangan_sisa' => $this->input->post('keterangan_sisa'),
                    'surat' => null,
                    'tgl_upload' => $this->input->post('date'),
                );

                $this->db->insert('tbl_cuti', $data);
                $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Pengajuan Cuti Telah Dikirim, Silahkan Menunggu!</div>');
                $this->kurangcuti($id_karyawan, $proses);
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }

    public function kurangcuti($id_karyawan, $proses)
    {
        $this->db->set('status', $proses);
        $this->db->where('kd_atasan', $id_karyawan);
        $this->db->update('tbl_atasan');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function ijin_keluar()
    {
        $data['title'] = 'Ijin Keluar Karyawan';

        // $nik = $data['nik'];
        $data['userid'] = $this->session->userdata('userid');
        $id = $data['userid'];
        $data['session'] = $this->session->userdata('nama');
        $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
        $data['nik'] = $this->user->getIjin($id);
        $data['foto'] = $this->detail->getFotoUser($id);
        $data['date'] = date('d F Y');
        $this->load->view('atasan/header', $data);
        $this->load->view('atasan/sidebar', $data);
        $this->load->view('atasan/topbar', $data);
        $this->load->view('atasan/ijin_keluar', $data);
        $this->load->view('atasan/footer', $data);
    }

    public function tambah_ijin()
    {
        $data['title'] = 'Form Ijin Kantor';

        // $nik = $data['nik'];
        $data['userid'] = $this->session->userdata('userid');
        $id = $data['userid'];
        $data['session'] = $this->session->userdata('nama');
        // $data['nik'] = $this->user->getSangkarBurung($id);
        $data['foto'] = $this->detail->getFotoUser($id);
        $data['date'] = date('d F Y');
        $this->load->view('atasan/header', $data);
        $this->load->view('atasan/sidebar', $data);
        $this->load->view('atasan/topbar', $data);
        $this->load->view('atasan/tambah_ijin', $data);
        $this->load->view('atasan/footer', $data);
    }

    public function tambah_ijincepat()
    {
        $data['title'] = 'Form Ijin Cepat';

        // $nik = $data['nik'];
        $data['userid'] = $this->session->userdata('userid');
        $id = $data['userid'];
        $data['session'] = $this->session->userdata('nama');
        // $data['nik'] = $this->user->getSangkarBurung($id);
        $data['foto'] = $this->detail->getFotoUser($id);
        $data['date'] = date('d F Y');
        $this->load->view('atasan/header', $data);
        $this->load->view('atasan/sidebar', $data);
        $this->load->view('atasan/topbar', $data);
        $this->load->view('atasan/tambah_ijincepat', $data);
        $this->load->view('atasan/footer', $data);
    }

    public function pengajuan_ijin()
    {
        $data = [
            'id_karyawan' => $this->input->post('id_peserta'),
            'atasan' => $this->input->post('atasan'),
            'waktu_pergi' => $this->input->post('waktu_pergi'),
            'waktu_pulang' => $this->input->post('waktu_pulang'),
            'keperluan' => $this->input->post('keperluan'),
            'tgl_ijin' => $this->input->post('tgl_ijin'),
            'status' => $this->input->post('status'),
            'jenis' => 'Normal'
        ];
        $this->db->insert('tbl_ijin', $data);
        $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Data ijin Berhasil Di Tambah</div>');
        redirect('atasan/ijin_keluar');
    }

    public function pengajuan_ijincepat()
    {
        $data = [
            'id_karyawan' => $this->input->post('id_peserta'),
            'atasan' => $this->input->post('atasan'),
            'waktu_pergi' => $this->input->post('waktu_pergi'),
            'waktu_pulang' => null,
            'keperluan' => $this->input->post('keperluan'),
            'tgl_ijin' => $this->input->post('tgl_ijin'),
            'status' => $this->input->post('status'),
            'jenis' => 'Cepat'

        ];
        $this->db->insert('tbl_ijin', $data);
        $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Data ijin Berhasil Di Tambah</div>');
        redirect('atasan/ijin_keluar');
    }
}

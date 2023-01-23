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
        $data['approved'] = $this->dashboard->countAllApproved($id);
        $data['reject'] = $this->dashboard->countAllReject($id);
        $data['process'] = $this->dashboard->countAllProcess($id);
        $data['dataijin'] = $this->dashboard->getAllIjin($id);
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

    public function pegawai()
    {
        $data['title'] = 'Data Karyawan';
        $data['role'] = $this->session->userdata('role_id');
        $data['userid'] = $this->session->userdata('userid');
        $data['golongan'] = $this->session->userdata('golongan');
        $golongan = $data['golongan'];
        $id = $data['userid'];
        $data['session'] = $this->session->userdata('nama');
        $data['foto'] = $this->dashboard->getFotoUser($id);
        $data['karyawan'] = $this->detail->getPegawai($id);
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
        $this->db->where('id_karyawan', $id);
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
        // $html = $this->load->view('atasan/laporan_karyawan', $data, true);
        // $this->load->view('invoice', $data);
        // $this->dompdfgenerator->generate($html, $file_pdf, $paper, $orientation);
        $this->load->view('atasan/laporan_karyawan', $data);
    }

    public function cetak_laporan()
    {
        $id = $this->session->userdata('userid');
        $data['cuti'] = $this->dashboard->getAllCuti($id);
        $data['title'] = 'Laporan Cuti';
        // filename dari pdf ketika didownload
        $file_pdf = 'Laporan Cuti';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "landscape";
        $data['date'] = date('d F Y');
        $html = $this->load->view('atasan/cetak_laporan', $data, true);
        // $this->load->view('atasan/cetak_laporan', $data);
        $this->dompdfgenerator->generate($html, $file_pdf, $paper, $orientation);
        // $this->load->view('invoice', $data);
    }

    public function cetak_ijin()
    {
        $id = $this->session->userdata('userid');
        $data['cuti'] = $this->dashboard->getAllIjin($id);
        $data['title'] = 'Laporan Ijin';
        // filename dari pdf ketika didownload
        $file_pdf = 'Laporan Ijin';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "landscape";
        $data['date'] = date('d F Y');
        $html = $this->load->view('atasan/cetak_ijin', $data, true);
        // $this->load->view('atasan/cetak_ijin', $data);
        $this->dompdfgenerator->generate($html, $file_pdf, $paper, $orientation);
        // $this->load->view('invoice', $data);
    }
}

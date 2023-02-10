<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ketua extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->CI = &get_instance();
        $this->load->library('form_validation');
        $this->load->helper(array('url', 'form'));
        $this->load->model('ketua/Dashboard_model', 'dashboard');
        $this->load->model('ketua/Detail_model', 'detail');
        $this->load->model('user/User_model', 'user');
        $this->load->library('dompdfgenerator');
    }

    public function index()
    {
        $data['title'] = 'Dashboard Ketua';
        $data['role'] = $this->session->userdata('role_id');
        $data['userid'] = $this->session->userdata('userid');
        $id = $data['userid'];
        $data['session'] = $this->session->userdata('nama');
        $data['foto'] = $this->dashboard->getFotoUser($id);
        $data['cuti'] = $this->dashboard->countAllCuti();
        $data['ijin'] = $this->dashboard->countAllIjin();
        $data['approved'] = $this->dashboard->countAllApproved();
        $data['approved_ijin'] = $this->dashboard->countAllApprovedIjin();
        $data['reject'] = $this->dashboard->countAllReject();
        $data['reject_ijin'] = $this->dashboard->countAllRejectIjin();
        $data['process'] = $this->dashboard->countAllProcess();
        $data['process_ijin'] = $this->dashboard->countAllProcessIjin();
        $data['tangguh'] = $this->dashboard->countAllTangguh();
        $data['datacuti'] = $this->dashboard->getAllCutiHome();
        $data['datacutiatas'] = $this->dashboard->getAllCutiHomeAtas();
        $data['dataijin'] = $this->dashboard->getAllIjinHome();
        $this->load->view('ketua/header.php', $data);
        $this->load->view('ketua/sidebar.php', $data);
        $this->load->view('ketua/topbar.php', $data);
        $this->load->view('ketua', $data);
        $this->load->view('ketua/footer.php', $data);
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
        $this->load->view('ketua/header', $data);
        $this->load->view('ketua/sidebar', $data);
        $this->load->view('ketua/topbar', $data);
        $this->load->view('ketua/detail_pegawai', $data);
        $this->load->view('ketua/footer', $data);
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
        $data['jabatan'] = $this->detail->getJabatan();
        $data['dept'] = $this->detail->getDept();
        $this->load->view('ketua/header', $data);
        $this->load->view('ketua/sidebar', $data);
        $this->load->view('ketua/topbar', $data);
        $this->load->view('ketua/karyawan', $data);
        $this->load->view('ketua/footer', $data);
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
            $this->load->view('ketua/header', $data);
            $this->load->view('ketua/sidebar', $data);
            $this->load->view('ketua/topbar', $data);
            $this->load->view('ketua/tambah_karyawan', $data);
            $this->load->view('ketua/footer', $data);
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
            redirect('ketua/pegawai');
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
        redirect('ketua/pegawai');
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
        $this->load->view('ketua/header', $data);
        $this->load->view('ketua/sidebar', $data);
        $this->load->view('ketua/topbar', $data);
        $this->load->view('ketua/kepegawaian', $data);
        $this->load->view('ketua/footer', $data);
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
        $this->load->view('ketua/header', $data);
        $this->load->view('ketua/sidebar', $data);
        $this->load->view('ketua/topbar', $data);
        $this->load->view('ketua/atasan', $data);
        $this->load->view('ketua/footer', $data);
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
        $this->form_validation->set_rules('kd_ketua', 'kd_ketua', 'required');
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
            $this->load->view('ketua/header', $data);
            $this->load->view('ketua/sidebar', $data);
            $this->load->view('ketua/topbar', $data);
            $this->load->view('ketua/edit_profil', $data);
            $this->load->view('ketua/footer', $data);
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
        $this->load->view('ketua/header', $data);
        $this->load->view('ketua/sidebar', $data);
        $this->load->view('ketua/topbar', $data);
        $this->load->view('ketua/departement', $data);
        $this->load->view('ketua/footer', $data);
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
        $this->load->view('ketua/header', $data);
        $this->load->view('ketua/sidebar', $data);
        $this->load->view('ketua/topbar', $data);
        $this->load->view('ketua/detail_kepegawaian', $data);
        $this->load->view('ketua/footer', $data);
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
        $this->load->view('ketua/header', $data);
        $this->load->view('ketua/sidebar', $data);
        $this->load->view('ketua/topbar', $data);
        $this->load->view('ketua/detail_atasan', $data);
        $this->load->view('ketua/footer', $data);
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
        redirect('ketua/departement');
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
            $this->load->view('ketua/header', $data);
            $this->load->view('ketua/sidebar', $data);
            $this->load->view('ketua/topbar', $data);
            $this->load->view('ketua/departement', $data);
            $this->load->view('ketua/footer', $data);
        } else {
            $data = [
                'dept' => $this->input->post('dept'),

            ];
            $this->db->insert('tbl_departement', $data);
            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Data Departement Berhasil Di Tambah</div>');
            redirect('ketua/departement');
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
        $this->load->view('ketua/header', $data);
        $this->load->view('ketua/sidebar', $data);
        $this->load->view('ketua/topbar', $data);
        $this->load->view('ketua/jabatan', $data);
        $this->load->view('ketua/footer', $data);
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
            $this->load->view('ketua/header', $data);
            $this->load->view('ketua/sidebar', $data);
            $this->load->view('ketua/topbar', $data);
            $this->load->view('ketua/jabatan', $data);
            $this->load->view('ketua/footer', $data);
        } else {
            $data = [
                'jabatan' => $this->input->post('jabatan'),

            ];
            $this->db->insert('tbl_jabatan', $data);
            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Data Jabatan Berhasil Di Tambah</div>');
            redirect('ketua/jabatan');
        }
    }

    public function delete_jabatan($id)
    {
        $this->dashboard->deleteJabatan($id);
        $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">Data jabatan Terhapus!</div>');
        redirect('ketua/jabatan');
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
        $data['datacuti'] = $this->dashboard->getAllCuti();
        $this->load->view('ketua/header', $data);
        $this->load->view('ketua/sidebar', $data);
        $this->load->view('ketua/topbar', $data);
        $this->load->view('ketua/cuti', $data);
        $this->load->view('ketua/footer', $data);
    }

    public function delete_cuti($id)
    {
        $this->dashboard->deleteCuti($id);
        $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">Data Cuti Terhapus!</div>');
        redirect('ketua/cuti');
    }

    public function ijin()
    {
        $data['title'] = 'Data Ijin';
        $data['role'] = $this->session->userdata('role_id');
        $data['userid'] = $this->session->userdata('userid');
        $id = $data['userid'];
        $data['session'] = $this->session->userdata('nama');
        $data['foto'] = $this->dashboard->getFotoUser($id);
        $data['jumlah'] = $this->dashboard->countAllProcess();
        $data['dataijin'] = $this->dashboard->getAllIjin();
        $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
        $this->load->view('ketua/header', $data);
        $this->load->view('ketua/sidebar', $data);
        $this->load->view('ketua/topbar', $data);
        $this->load->view('ketua/ijin', $data);
        $this->load->view('ketua/footer', $data);
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
        $this->load->view('ketua/header', $data);
        $this->load->view('ketua/sidebar', $data);
        $this->load->view('ketua/topbar', $data);
        $this->load->view('ketua/persetujuan_cuti', $data);
        $this->load->view('ketua/footer', $data);
    }

    public function edit_persetujuan($id)
    {
        $nik = $this->input->post('nik');
        $sisa = $this->input->post('sisa');
        $tgl_masuk = $this->input->post('masuk');
        $data = [
            'status' => $this->input->post('status'),
            'tgl_cuti' => $this->input->post('cuti'),
            'tgl_masuk' => $this->input->post('masuk')
        ];
        $this->db->where('id', $id);
        $this->db->update('tbl_cuti', $data);
        $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Data Telah Berhasil Di Edit</div>');
        $this->editprofilstatus($nik, $sisa, $tgl_masuk);
    }

    public function edit_persetujuanatasan($id)
    {
        $nik = $this->input->post('nik');
        $sisa = $this->input->post('sisa');
        $tgl_masuk = $this->input->post('masuk');
        $data = [
            'status' => $this->input->post('status'),
            'tgl_cuti' => $this->input->post('cuti'),
            'tgl_masuk' => $this->input->post('masuk')
        ];
        $this->db->where('id', $id);
        $this->db->update('tbl_cuti', $data);
        $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Data Telah Berhasil Di Edit</div>');
        $this->editprofilstatusatasan($nik, $sisa, $tgl_masuk);
    }

    public function editprofilstatus($nik, $sisa, $tgl_masuk)
    {
        $data = [
            'sisa_cuti' => $sisa,
            'status' => $this->input->post('status_profil'),
            'tgl_masuk' => $tgl_masuk
        ];
        $this->db->where('nik', $nik);
        $this->db->update('tbl_karyawan', $data);
        $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Data Telah Berhasil Di Edit</div>');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function editprofilstatusatasan($nik, $sisa, $tgl_masuk)
    {
        $data = [
            'sisa_cuti' => $sisa,
            'status' => $this->input->post('status_profil'),
            'tgl_masuk' => $tgl_masuk
        ];
        $this->db->where('nik', $nik);
        $this->db->update('tbl_atasan', $data);
        $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Data Telah Berhasil Di Edit</div>');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function cetak_laporan()
    {
        $from = $this->input->post('from');
        $to = $this->input->post('to');
        $id = $this->session->userdata('userid');
        $data['from'] = $from;
        $data['to'] = $to;
        $data['datacuti'] = $this->dashboard->getAllCuti($from, $to);
        $data['title'] = 'Laporan Cuti';
        // filename dari pdf ketika didownload
        $file_pdf = 'Laporan Cuti';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "potrait";
        $data['date_id'] = date('j / n / y');
        $data['date'] = date('d F Y');
        $html = $this->load->view('ketua/cetak_laporan', $data, true);
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
        $data['datacuti'] = $this->dashboard->getAllCuti($from, $to);
        $data['title'] = 'Laporan Cuti';
        // filename dari pdf ketika didownload
        $file_pdf = 'Laporan Cuti';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "potrait";
        $data['date_id'] = date('j / n / y');
        $data['date'] = date('d F Y');
        $html = $this->load->view('ketua/cetak_laporan', $data, true);
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

        $data['title'] = 'Surat Cuti Atasan';
        // filename dari pdf ketika didownload
        $file_pdf = 'Surat Cuti Atasan';
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
        $data['dataijin'] = $this->dashboard->getAllIjin($from, $to);
        $data['title'] = 'Laporan Ijin';
        // filename dari pdf ketika didownload
        $file_pdf = 'Laporan Ijin';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "potrait";
        $data['date_id'] = date('j / n / y');
        $data['date'] = date('d F Y');
        $html = $this->load->view('ketua/cetak_laporanijin', $data, true);
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
        $data['dataijin'] = $this->dashboard->getAllIjinAtasan($from, $to);
        $data['title'] = 'Laporan Ijin';
        // filename dari pdf ketika didownload
        $file_pdf = 'Laporan Ijin';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "potrait";
        $data['date_id'] = date('j / n / y');
        $data['date'] = date('d F Y');
        $html = $this->load->view('ketua/cetak_laporanijin', $data, true);
        // $this->load->view('atasan/cetak_ijin', $data);
        $this->dompdfgenerator->generate($html, $file_pdf, $paper, $orientation);
        // $this->load->view('invoice', $data);
    }
}

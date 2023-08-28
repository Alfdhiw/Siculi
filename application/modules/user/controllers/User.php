<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->CI = &get_instance();
        $this->load->library('form_validation');
        $this->load->helper(array('url', 'form'));
        $this->load->model('admin/Dashboard_model', 'dashboard');
        $this->load->model('admin/Detail_model', 'detail');
        $this->load->model('user/User_model', 'user');
        $this->CI = &get_instance();
        $this->load->library('dompdfgenerator');
    }

    public function index()
    {
        $data['title'] = 'Dashboard Karyawan';
        $data['role'] = $this->session->userdata('role_id');
        $data['nik'] = $this->session->userdata('nik');
        $nik = $data['nik'];
        $data['userid'] = $this->session->userdata('userid');
        $id = $data['userid'];
        $data['session'] = $this->session->userdata('nama');
        $data['foto'] = $this->user->getFotoUser($id);
        $data['cuti'] = $this->user->countAllCuti($id);
        $data['ijin'] = $this->user->countAllIjin($id);
        $data['approved'] = $this->user->countAllApproved($id);
        $data['approved_ijin'] = $this->user->countAllApprovedIjin($id);
        $data['reject'] = $this->user->countAllReject($id);
        $data['reject_ijin'] = $this->user->countAllRejectIjin($id);
        $data['process'] = $this->user->countAllProcess($id);
        $data['tangguh'] = $this->user->countAllTangguh($id);
        $data['process_ijin'] = $this->user->countAllProcessIjin($id);
        $data['datacuti'] = $this->user->getAllCuti($id);
        $data['dataijin'] = $this->user->getAllIjin($id);
        $this->load->view('user/header.php', $data);
        $this->load->view('user/sidebar.php', $data);
        $this->load->view('user/topbar.php', $data);
        $this->load->view('user', $data);
        $this->load->view('user/footer.php', $data);
    }

    public function cuti()
    {
        $data['title'] = 'Data Cuti';
        $data['role'] = $this->session->userdata('role_id');
        $data['nik'] = $this->session->userdata('nik');
        $nik = $data['nik'];
        $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
        $data['userid'] = $this->session->userdata('userid');
        $id = $data['userid'];
        $data['session'] = $this->session->userdata('nama');
        $data['foto'] = $this->user->getFotoUser($id);
        $data['datacuti'] = $this->user->getAllCuti($id);
        $this->load->view('user/header', $data);
        $this->load->view('user/sidebar', $data);
        $this->load->view('user/topbar', $data);
        $this->load->view('user/cuti', $data);
        $this->load->view('user/footer', $data);
    }

    public function delete_cuti($id)
    {
        $this->user->deleteCuti($id);
        $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">Data Cuti Terhapus!</div>');
        redirect('admin/cuti');
    }

    public function detail_karyawan()
    {
        $kode_id = $this->uri->segment(3);
        $data['title'] = 'Detail Data Karyawan';
        $data['role'] = $this->session->userdata('role_id');
        $data['nik'] = $this->session->userdata('nik');
        // $nik = $data['nik'];
        $data['userid'] = $this->session->userdata('userid');
        $id = $data['userid'];
        $data['session'] = $this->session->userdata('nama');
        $data['foto'] = $this->user->getFotoUser($id);
        $data['pegawai'] = $this->detail->getDataPegawai($kode_id);
        $this->load->view('user/header', $data);
        $this->load->view('user/sidebar', $data);
        $this->load->view('user/topbar', $data);
        $this->load->view('user/detail_pegawai', $data);
        $this->load->view('user/footer', $data);
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
        $data['foto'] = $this->user->getFotoUser($id);
        $data['jeniscuti'] = $this->user->getJenisCuti();
        $data['user'] = $this->user->getProfile($id);

        //Form Validation
        $this->form_validation->set_rules('jenis_cuti', 'Jenis Cuti', 'required');
        $this->form_validation->set_rules('tgl_cuti', 'tgl_cuti Peserta', 'required');
        $this->form_validation->set_rules('tgl_masuk', 'tgl_masuk', 'required');
        $this->form_validation->set_rules('keperluan', 'keperluan', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('user/header.php', $data);
            $this->load->view('user/sidebar.php', $data);
            $this->load->view('user/topbar.php', $data);
            $this->load->view('user/pengajuan_cuti', $data);
            $this->load->view('user/footer.php', $data);
        } else {
            if (!empty($_FILES["surat"]["name"])) {
                $date = substr(date('Ymd'), 2, 8);
                $config = array();
                $config['upload_path'] = './assets/data/karyawan/surat';
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
        $this->db->where('id', $id_karyawan);
        $this->db->update('tbl_karyawan');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function edit_profil()
    {
        $data['title'] = 'Edit Profi';
        $data['role'] = $this->session->userdata('role_id');
        $data['nik'] = $this->session->userdata('nik');
        $nik = $data['nik'];
        $data['userid'] = $this->session->userdata('userid');
        $id = $data['userid'];
        $data['session'] = $this->session->userdata('nama');
        $data['foto'] = $this->user->getFotoUser($id);
        $data['profil'] = $this->user->getProfile($id);
        // $data['pesertaall'] = $this->home->getProfileAll();
        $this->form_validation->set_rules('nik', 'nik', 'required');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('jeniskel', 'jeniskel', 'required');
        if ($this->form_validation->run()) {
            $this->user->update();
            $this->session->set_flashdata('success', 'Data Profil Berhasil Diperbarui');
            redirect('login/logout');
        } else {
            $this->session->set_flashdata('Error', 'Data Profil Gagal Diperbarui');
            $this->load->view('user/header', $data);
            $this->load->view('user/sidebar', $data);
            $this->load->view('user/topbar', $data);
            $this->load->view('user/edit_profil', $data);
            $this->load->view('user/footer', $data);
        }
    }

    public function editconfirm()
    {
        $id = $this->session->userdata('userid');
        $this->db->set('status', $this->input->post('status'));
        $this->db->set('tgl_masuk', $this->input->post('tgl_masuk'));
        $this->db->where('id', $id);
        $this->db->update('tbl_karyawan');
        $this->session->set_flashdata('success', 'Anda telah aktif kembali');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function cetak_cuti()
    {
        $kode_nilai = $this->uri->segment(3);
        $nik = $this->session->userdata('nik');
        $id = $this->session->userdata('userid');
        $data['cuti'] = $this->user->getFotoUser($id);
        $data['datacuti'] = $this->user->getAllCutiById($kode_nilai);
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
        $html = $this->load->view('user/cetak_cuti', $data, true);
        // $this->load->view('user/cetak_cuti', $data);
        $this->dompdfgenerator->generate($html, $file_pdf, $paper, $orientation);
        // $this->load->view('invoice', $data);
    }

    public function cetak_ijin()
    {
        $kode_nilai = $this->uri->segment(3);
        $nik = $this->session->userdata('nik');
        $id = $this->session->userdata('userid');
        $data['cuti'] = $this->user->getFotoUser($id);
        $data['dataijin'] = $this->user->getAllIjinById($kode_nilai);
        $data['ketua'] = $this->user->getKetua();

        $data['title'] = 'Surat Ijin';
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
        $html = $this->load->view('user/cetak_ijin', $data, true);
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
        $data['dataijin'] = $this->user->getAllIjinById($kode_nilai);
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
        $html = $this->load->view('user/cetak_cepat', $data, true);
        // $this->load->view('user/cetak_ijin', $data);
        $this->dompdfgenerator->generate($html, $file_pdf, $paper, $orientation);
        // $this->load->view('invoice', $data);
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
        $data['foto'] = $this->user->getFotoUser($id);
        $data['date'] = date('d F Y');
        $this->load->view('user/header', $data);
        $this->load->view('user/sidebar', $data);
        $this->load->view('user/topbar', $data);
        $this->load->view('user/ijin_keluar', $data);
        $this->load->view('user/footer', $data);
    }

    public function tambah_ijin()
    {
        $data['title'] = 'Form Ijin Kantor';

        // $nik = $data['nik'];
        $data['userid'] = $this->session->userdata('userid');
        $id = $data['userid'];
        $data['session'] = $this->session->userdata('nama');
        // $data['nik'] = $this->user->getSangkarBurung($id);
        $data['foto'] = $this->user->getFotoUser($id);
        $data['atasan'] = $this->user->getAtasanIjin($id);
        $data['date'] = date('d F Y');
        $this->load->view('user/header', $data);
        $this->load->view('user/sidebar', $data);
        $this->load->view('user/topbar', $data);
        $this->load->view('user/tambah_ijin', $data);
        $this->load->view('user/footer', $data);
    }

    public function tambah_ijincepat()
    {
        $data['title'] = 'Form Ijin Cepat';

        // $nik = $data['nik'];
        $data['userid'] = $this->session->userdata('userid');
        $id = $data['userid'];
        $data['session'] = $this->session->userdata('nama');
        // $data['nik'] = $this->user->getSangkarBurung($id);
        $data['foto'] = $this->user->getFotoUser($id);
        $data['atasan'] = $this->user->getAtasanIjin($id);
        $data['date'] = date('d F Y');
        $this->load->view('user/header', $data);
        $this->load->view('user/sidebar', $data);
        $this->load->view('user/topbar', $data);
        $this->load->view('user/tambah_ijincepat', $data);
        $this->load->view('user/footer', $data);
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
        redirect('user/ijin_keluar');
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
        redirect('user/ijin_keluar');
    }
}

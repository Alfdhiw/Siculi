<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{
    public function countAllIjin($id)
    {
        $query = "SELECT * from tbl_ijin where atasan = $id ";
        return $this->db->query($query)->num_rows();
    }

    public function countAllCuti($id)
    {
        $query = "SELECT * from tbl_cuti where atasan = $id ";
        return $this->db->query($query)->num_rows();
    }

    public function countAllApproved($id)
    {
        $query = "SELECT * from tbl_ijin where atasan = $id and status = 'Disetujui'";
        return $this->db->query($query)->num_rows();
    }

    public function countAllApprovedCuti($id)
    {
        $query = "SELECT * from tbl_cuti where atasan = $id and status = 'Disetujui'";
        return $this->db->query($query)->num_rows();
    }

    public function countAllReject($id)
    {
        $query = "SELECT * from tbl_ijin where atasan = $id and status = 'Ditolak'";
        return $this->db->query($query)->num_rows();
    }

    public function countAllRejectCuti($id)
    {
        $query = "SELECT * from tbl_cuti where atasan = $id and status = 'Ditolak'";
        return $this->db->query($query)->num_rows();
    }

    public function countAllProcess()
    {
        $reject = $this->db->get_where('tbl_ijin', ['status' => 'Proses'])->num_rows();
        return $reject;
    }

    public function countAllTangguh()
    {
        $reject = $this->db->get_where('tbl_cuti', ['status' => 'Ditangguhkan'])->num_rows();
        return $reject;
    }

    public function getAllCuti($id = 0, $from = 0, $to = 0)
    {
        $query = "SELECT k.nama, k.nik, c.* from tbl_cuti c, tbl_karyawan k where k.id = c.id_karyawan and  c.atasan = $id and c.tgl_upload BETWEEN '" . $from . "' and '" . $to . "'";
        return $this->db->query($query)->result_array();
    }

    public function getAllCutiAtasan($id = 0, $from = 0, $to = 0)
    {
        $query = "SELECT k.nama, k.nik, c.* from tbl_cuti c, tbl_atasan k where k.kd_atasan = c.id_karyawan and  c.atasan = $id and c.tgl_upload BETWEEN '" . $from . "' and '" . $to . "'";
        return $this->db->query($query)->result_array();
    }

    public function getAllCutiAtasanDewe($id = 0, $from = 0, $to = 0)
    {
        $query = "SELECT k.nama, k.nik, c.* from tbl_cuti c, tbl_atasan k where k.kd_atasan = c.id_karyawan and  c.id_karyawan = $id and c.tgl_upload BETWEEN '" . $from . "' and '" . $to . "'";
        return $this->db->query($query)->result_array();
    }

    public function getAllIjin($id = 0, $from = 0, $to = 0)
    {
        $query = "SELECT k.nama, k.nik, i.atasan, i.waktu_pergi, i.waktu_pulang, i.keperluan, i.tgl_ijin, i.status, i.id_karyawan, i.jenis, i.tgl_ijin from tbl_karyawan k, tbl_ijin i where i.id_karyawan = k.id and i.atasan = $id and i.tgl_ijin BETWEEN '" . $from . "' and '" . $to . "'";
        return $this->db->query($query)->result_array();
    }

    public function getAllIjinAtasan($id = 0, $from = 0, $to = 0)
    {
        $query = "SELECT k.nama, k.nik, i.atasan, i.waktu_pergi, i.waktu_pulang, i.keperluan, i.tgl_ijin, i.status, i.id_karyawan, i.jenis, i.tgl_ijin from tbl_atasan k, tbl_ijin i where i.id_karyawan = k.kd_atasan and i.atasan = $id and i.tgl_ijin BETWEEN '" . $from . "' and '" . $to . "'";
        return $this->db->query($query)->result_array();
    }

    public function getAllIjinDewe($id = 0, $from = 0, $to = 0)
    {
        $query = "SELECT k.nama, k.nik, i.atasan, i.waktu_pergi, i.waktu_pulang, i.keperluan, i.tgl_ijin, i.status, i.id_karyawan, i.jenis, i.tgl_ijin from tbl_atasan k, tbl_ijin i where i.id_karyawan = k.kd_atasan and i.id_karyawan = $id and i.tgl_ijin BETWEEN '" . $from . "' and '" . $to . "'";
        return $this->db->query($query)->result_array();
    }

    public function getAllCutiHome($id)
    {
        $query = "SELECT k.nama, k.nik, c.* from tbl_cuti c, tbl_karyawan k where c.id_karyawan = k.id and c.atasan = $id";
        return $this->db->query($query)->result_array();
    }

    public function getAllCutiHomeAtas($id)
    {
        $query = "SELECT a.nama, a.nik, c.* from tbl_cuti c, tbl_atasan a where c.id_karyawan = a.kd_atasan and c.atasan = $id";
        return $this->db->query($query)->result_array();
    }

    public function getAllCutiHomeAtasDewe($id)
    {
        $query = "SELECT a.nama, a.nik, c.* from tbl_cuti c, tbl_atasan a where c.id_karyawan = a.kd_atasan and c.id_karyawan = $id";
        return $this->db->query($query)->result_array();
    }

    public function getAllIjinHome($id)
    {
        $query = "SELECT k.nama, k.nik, i.atasan, i.waktu_pergi, i.waktu_pulang, i.keperluan, i.tgl_ijin, i.status, i.id_karyawan, i.jenis from tbl_karyawan k, tbl_ijin i where i.id_karyawan = k.id and i.atasan = $id ";
        return $this->db->query($query)->result_array();
    }

    public function getAllIjinHomeAtasan($id)
    {
        $query = "SELECT k.nama, k.nik, i.atasan, i.waktu_pergi, i.waktu_pulang, i.keperluan, i.tgl_ijin, i.status, i.id_karyawan, i.jenis from tbl_atasan k, tbl_ijin i where i.id_karyawan = k.kd_atasan and i.atasan = $id ";
        return $this->db->query($query)->result_array();
    }

    public function getAllIjinHomeDewe($id)
    {
        $query = "SELECT k.nama, k.nik, i.atasan, i.waktu_pergi, i.waktu_pulang, i.keperluan, i.tgl_ijin, i.status, i.id_karyawan, i.jenis from tbl_atasan k, tbl_ijin i where i.id_karyawan = k.kd_atasan and i.id_karyawan = $id ";
        return $this->db->query($query)->result_array();
    }

    public function getAllCutiByProses($id)
    {
        $query = "SELECT k.email,k.nama, k.nik, c.* from tbl_cuti c, tbl_karyawan k where k.id = c.id_karyawan and  k.atasan = $id and c.status = 'Process'";
        return $this->db->query($query)->result_array();
    }

    public function getAllIjinByProses()
    {
        return $this->db->get_where('tbl_ijin', ['status' => 'Process'])->result_array();
    }

    public function getSangkarBurung($id)
    {
        $query = "SELECT k.email,k.nama, k.nik, i.* from tbl_ijin i, tbl_karyawan k where k.id = i.id_karyawan and  i.atasan = $id and i.status = 'Process'";
        return $this->db->query($query)->result_array();
    }

    public function getDept()
    {
        $query = "SELECT * from tbl_departement";
        return $this->db->query($query)->result_array();
    }

    public function getFotoUser($id)
    {
        $query = "SELECT * from tbl_atasan where kd_atasan = $id";
        return $this->db->query($query)->row_array();
    }

    public function getProfile($id = 0)
    {

        if ($id < 1) {
            $id = $this->session->userdata('userid');
        }

        return $this->db->get_where('tbl_atasan', ["kd_atasan" => $id])->row_array();
    }

    public function deleteDept($id)
    {
        $this->db->delete('tbl_departement', ['id' => $id]);
    }

    public function deleteCuti($id)
    {
        $this->db->delete('tbl_cuti', ['id' => $id]);
    }

    public function deleteJabatan($id)
    {
        $this->db->delete('tbl_jabatan', ['id' => $id]);
    }

    public function update()
    {

        $post = $this->input->post();

        $this->kd_atasan = $post["kd_atasan"];

        $this->nama = $post["nama"];

        $this->email = $post["email"];

        $this->password = $post['password'];

        $this->jeniskel = $post['jeniskel'];

        if (!empty($_FILES["foto"]["name"])) {

            $this->foto = $this->_uploadImage();
        } else {

            $this->foto = $post["gambar_lama"];
        }

        return $this->db->update('tbl_atasan', $this, array('kd_atasan' => $post['kd_atasan']));
    }

    private function _uploadImage()
    {
        $date = substr(date('Ymd'), 2, 8);

        $post = $this->input->post();

        $config['upload_path']          = './assets/data/atasan/profil/';

        $config['allowed_types']        = 'gif|jpg|png|jpeg';

        $config['file_name']            = $date . '-' . $_FILES['foto']['name'];

        $config['overwrite']            = true;

        $config['max_size']             = 5000; // 1MB

        // $config['max_width']            = 1024;

        // $config['max_height']           = 768;



        $this->load->library('upload', $config);



        if ($this->upload->do_upload('foto')) {

            return $this->upload->data("file_name");
        }

        return base_url('assets/data/atasan/profil/') . $post["gambar_lama"];
    }
}

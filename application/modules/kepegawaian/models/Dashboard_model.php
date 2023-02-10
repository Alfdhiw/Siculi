<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{
    public function countAllCuti($id)
    {
        $query = "SELECT * from tbl_cuti where kepegawaian = $id ";
        return $this->db->query($query)->num_rows();
    }

    public function countAllIjin($id)
    {
        $query = "SELECT * from tbl_ijin where atasan = $id ";
        return $this->db->query($query)->num_rows();
    }

    public function countAllApproved($id)
    {
        $query = "SELECT * from tbl_cuti where kepegawaian = $id and status = 'Disetujui'";
        return $this->db->query($query)->num_rows();
    }

    public function countAllApprovedIjin($id)
    {
        $query = "SELECT * from tbl_ijin where atasan = $id and status = 'Disetujui'";
        return $this->db->query($query)->num_rows();
    }

    public function countAllReject($id)
    {
        $query = "SELECT * from tbl_cuti where kepegawaian = $id and status = 'Ditolak'";
        return $this->db->query($query)->num_rows();
    }

    public function countAllRejectIjin($id)
    {
        $query = "SELECT * from tbl_ijin where atasan = $id and status = 'Ditolak'";
        return $this->db->query($query)->num_rows();
    }

    public function countAllProcess($id)
    {
        $query = "SELECT * from tbl_cuti where kepegawaian = $id and status = 'Proses'";
        return $this->db->query($query)->num_rows();
    }

    public function countAllProcessIjin($id)
    {
        $query = "SELECT * from tbl_ijin where kepegawaian = $id and status = 'Proses'";
        return $this->db->query($query)->num_rows();
    }

    public function countAllTangguh($id)
    {
        $query = "SELECT * from tbl_cuti where kepegawaian = $id and status = 'Ditangguhkan'";
        return $this->db->query($query)->num_rows();
    }

    public function getAllCuti($id = 0, $from = 0, $to = 0)
    {
        $query = "SELECT k.nama, k.nik, c.* from tbl_cuti c, tbl_karyawan k where k.id = c.id_karyawan and  c.kepegawaian = $id and c.tgl_upload BETWEEN '" . $from . "' and '" . $to . "'";
        return $this->db->query($query)->result_array();
    }

    public function getAllIjin($id = 0, $from = 0, $to = 0)
    {
        $query = "SELECT k.nama, k.nik, i.atasan, i.waktu_pergi, i.waktu_pulang, i.keperluan, i.tgl_ijin, i.status, i.id_karyawan, i.jenis, i.tgl_ijin from tbl_karyawan k, tbl_ijin i where i.id_karyawan = k.id and i.kepegawaian = $id and i.tgl_ijin BETWEEN '" . $from . "' and '" . $to . "'";
        return $this->db->query($query)->result_array();
    }

    public function getAllCutiHome($id)
    {
        $query = "SELECT k.nama, k.nik, c.* from tbl_cuti c, tbl_karyawan k where c.id_karyawan = k.id and c.kepegawaian = $id";
        return $this->db->query($query)->result_array();
    }

    public function getAllIjinHome($id)
    {
        $query = "SELECT k.nama, k.nik, i.atasan, i.waktu_pergi, i.waktu_pulang, i.keperluan, i.tgl_ijin, i.status, i.id_karyawan, i.jenis from tbl_karyawan k, tbl_ijin i where i.id_karyawan = k.id and i.kepegawaian = $id ";
        return $this->db->query($query)->result_array();
    }

    public function getAllCutiByProses($id)
    {
        $query = "SELECT k.email,k.nama, k.nik, c.* from tbl_cuti c, tbl_karyawan k where k.id = c.id_karyawan and  k.kepegawaian = $id and c.status = 'Proses' order by c.id desc";
        return $this->db->query($query)->result_array();
    }

    public function getAllIjinByProses()
    {
        return $this->db->get_where('tbl_ijin', ['status' => 'Process'])->result_array();
    }

    public function getSangkarBurung($id)
    {
        $query = "SELECT k.email,k.nama, k.nik, i.* from tbl_ijin i, tbl_karyawan k where k.id = i.id_karyawan and  i.kepegawaian = $id and i.status = 'Process'";
        return $this->db->query($query)->result_array();
    }

    public function getDept()
    {
        $query = "SELECT * from tbl_departement";
        return $this->db->query($query)->result_array();
    }

    public function getFotoUser($id)
    {
        return $this->db->get_where('tbl_kepegawaian', ['kd_kepegawaian' => $id])->row_array();
    }

    public function getProfile($id = 0)
    {

        if ($id < 1) {
            $id = $this->session->userdata('userid');
        }

        return $this->db->get_where('tbl_kepegawaian', ["kd_kepegawaian" => $id])->row_array();
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

        $this->kd_kepegawaian = $post["kd_kepegawaian"];

        $this->nama = $post["nama"];

        $this->email = $post["email"];

        $this->password = $post['password'];

        $this->jeniskel = $post['jeniskel'];

        if (!empty($_FILES["foto"]["name"])) {

            $this->foto = $this->_uploadImage();
        } else {

            $this->foto = $post["gambar_lama"];
        }

        return $this->db->update('tbl_kepegawaian', $this, array('kd_kepegawaian' => $post['kd_kepegawaian']));
    }

    private function _uploadImage()
    {
        $date = substr(date('Ymd'), 2, 8);

        $post = $this->input->post();

        $config['upload_path']          = './assets/data/kepegawaian/profil/';

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

        return base_url('assets/data/kepegawaian/profil/') . $post["gambar_lama"];
    }
}

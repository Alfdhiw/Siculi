<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function getFotoUser($id)
    {
        $query = "SELECT * from tbl_karyawan where id = $id";
        return $this->db->query($query)->row_array();
    }

    public function getKepegawaian()
    {
        return $this->db->get_where('tbl_kepegawaian')->row_array();
    }

    public function getKetua()
    {
        return $this->db->get_where('tbl_ketua')->row_array();
    }

    public function getAtasan()
    {
        return $this->db->get_where('tbl_kepegawaian')->row_array();
    }

    public function getSangkarBurung($id)
    {
        $query = "SELECT k.id, k.nik, k.nama, i.atasan, i.waktu_pergi, i.waktu_pulang, i.keperluan, i.tgl_ijin, i.status from tbl_karyawan k, tbl_ijin i where k.id = i.id_karyawan and k.id = '$id' ORDER BY i.id DESC";
        return $this->db->query($query)->result_array();
    }

    public function countAllCuti($id)
    {
        $query = "SELECT * from tbl_karyawan where id = '$id'";
        return $this->db->query($query)->row_array();
    }

    public function countAllApproved($nik)
    {
        $query = "SELECT k.nama, k.nik, c.* from tbl_karyawan k, tbl_cuti c where c.id_karyawan = k.id and c.status = 'Approved' and k.nik ='$nik'";
        return $this->db->query($query)->num_rows();
    }

    public function countAllReject($nik)
    {
        $query = "SELECT k.nama, k.nik, c.* from tbl_karyawan k, tbl_cuti c where c.status = 'Reject' and k.nik ='$nik'";
        return $this->db->query($query)->num_rows();
    }

    public function countAllProcess($nik)
    {
        $query = "SELECT k.nama, k.nik, c.* from tbl_karyawan k, tbl_cuti c where c.status = 'Process' and k.nik ='$nik'";
        return $this->db->query($query)->num_rows();
    }

    public function getAllCuti($nik)
    {
        $query = "SELECT k.nama, k.nik, c.* from tbl_karyawan k, tbl_cuti c where k.id = c.id_karyawan and k.nik = '$nik'";
        return $this->db->query($query)->result_array();
    }

    public function getAllCutiById($id)
    {
        $query = "SELECT k.nama, k.nik, k.alamat, p.jabatan,p.golongan, k.sisa_cuti, c.jenis_cuti, c.tgl_cuti, c.tgl_masuk from tbl_karyawan k, tbl_kepegawaian p, tbl_cuti c where k.id = c.id_karyawan and k.atasan = p.kd_kepegawaian and c.id_karyawan = $id";
        return $this->db->query($query)->row_array();
    }

    public function deleteCuti($id)
    {
        $this->db->delete('tbl_cuti', ['id' => $id]);
    }

    public function getJenisCuti()
    {
        $query = "SELECT * from tbl_jenis_cuti";
        return $this->db->query($query)->result_array();
    }

    public function getProfile($id)
    {
        $query = "SELECT k.*, a.jabatan, a.golongan from tbl_karyawan k, tbl_atasan a where k.atasan = a.kd_atasan and id = '$id'";
        return $this->db->query($query)->row_array();
    }

    public function update()
    {

        $post = $this->input->post();

        $this->nik = $post["nik"];

        $this->nama = $post["nama"];

        $this->email = $post["email"];

        $this->password = $post['password'];

        $this->jenis_kelamin = $post['jeniskel'];

        if (!empty($_FILES["foto"]["name"])) {

            $this->foto = $this->_uploadImage();
        } else {

            $this->foto = $post["gambar_lama"];
        }

        return $this->db->update('tbl_karyawan', $this, array('nik' => $post['nik']));
    }

    private function _uploadImage()
    {
        $date = substr(date('Ymd'), 2, 8);

        $post = $this->input->post();

        $config['upload_path']          = './assets/data/karyawan/profil/';

        $config['allowed_types']        = 'gif|jpg|png';

        $config['file_name']            = $date . '-' . $_FILES['foto']['name'];

        $config['overwrite']            = true;

        $config['max_size']             = 5000; // 1MB

        // $config['max_width']            = 1024;

        // $config['max_height']           = 768;



        $this->load->library('upload', $config);



        if ($this->upload->do_upload('foto')) {

            return $this->upload->data("file_name");
        }

        return base_url('assets/data/karyawan/profil/') . $post["gambar_lama"];
    }
}

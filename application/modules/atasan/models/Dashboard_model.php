<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{
    public function countAllIjin($id)
    {
        $query = "SELECT * from tbl_ijin where atasan = $id ";
        return $this->db->query($query)->num_rows();
    }

    public function countAllApproved($id)
    {
        $query = "SELECT * from tbl_ijin where atasan = $id and status = 'Approved'";
        return $this->db->query($query)->num_rows();
    }

    public function countAllReject()
    {
        $reject = $this->db->get_where('tbl_ijin', ['status' => 'Reject'])->num_rows();
        return $reject;
    }

    public function countAllProcess()
    {
        $reject = $this->db->get_where('tbl_ijin', ['status' => 'Process'])->num_rows();
        return $reject;
    }

    public function getAllCuti($id)
    {
        $query = "SELECT k.nama, k.nik, c.* from tbl_cuti c, tbl_karyawan k where k.id = c.id_karyawan and  c.atasan = $id";
        return $this->db->query($query)->result_array();
    }

    public function getAllIjin($id)
    {
        $query = "SELECT k.nama, k.nik, i.atasan, i.waktu_pergi, i.waktu_pulang, i.keperluan, i.tgl_ijin, i.status, i.id_karyawan from tbl_karyawan k, tbl_ijin i where i.id_karyawan = k.id and i.atasan = $id ";
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

        return base_url('assets/data/atasan/profil/') . $post["gambar_lama"];
    }
}

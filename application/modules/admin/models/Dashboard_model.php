<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{
    public function countAllCuti()
    {
        $cuti = $this->db->get('tbl_cuti')->num_rows();
        return $cuti;
    }

    public function countAllApproved()
    {
        $approved = $this->db->get_where('tbl_cuti', ['status' => 'Approved'])->num_rows();
        return $approved;
    }

    public function countAllReject()
    {
        $reject = $this->db->get_where('tbl_cuti', ['status' => 'Reject'])->num_rows();
        return $reject;
    }

    public function countAllProcess()
    {
        $reject = $this->db->get_where('tbl_cuti', ['status' => 'Process'])->num_rows();
        return $reject;
    }

    public function getAllCuti()
    {
        $query = "SELECT k.nama, k.nik, c.* from tbl_cuti c, tbl_karyawan k where k.id = c.id_karyawan";
        return $this->db->query($query)->result_array();
    }

    public function getAllIjin()
    {
        $query = "SELECT k.nama, k.nik,k.id, i.atasan, i.waktu_pergi, i.waktu_pulang, i.keperluan, i.tgl_ijin, i.status from tbl_karyawan k, tbl_ijin i where i.id_karyawan = k.id ";
        return $this->db->query($query)->result_array();
    }

    public function getAllCutiByProses()
    {
        return $this->db->get_where('tbl_cuti', ['status' => 'Process'])->result_array();
    }

    public function getAllIjinByProses()
    {
        return $this->db->get_where('tbl_ijin', ['status' => 'Process'])->result_array();
    }

    public function getSangkarBurung()
    {
        $query = "SELECT k.id, k.nik, k.nama, i.atasan, i.waktu_pergi, i.waktu_pulang, i.keperluan, i.tgl_ijin, i.status from tbl_karyawan k, tbl_ijin i where k.id = i.id_karyawan ORDER BY i.id DESC";
        return $this->db->query($query)->result_array();
    }

    public function getDept()
    {
        $query = "SELECT * from tbl_departement";
        return $this->db->query($query)->result_array();
    }

    public function getFotoUser($id)
    {
        return $this->db->get_where('tbl_admin', ['kd_admin' => $id])->row_array();
    }

    public function getProfile($id = 0)
    {

        if ($id < 1) {
            $id = $this->session->userdata('userid');
        }

        return $this->db->get_where('tbl_admin', ["kd_admin" => $id])->row_array();
    }

    public function deleteDept($id)
    {
        $this->db->delete('tbl_departement', ['id' => $id]);
    }

    public function deleteCuti($id)
    {
        $this->db->delete('tbl_cuti', ['id' => $id]);
    }

    public function deleteIjin($id)
    {
        $this->db->delete('tbl_ijin', ['id' => $id]);
    }

    public function deleteJabatan($id)
    {
        $this->db->delete('tbl_jabatan', ['id' => $id]);
    }

    public function update()
    {

        $post = $this->input->post();

        $this->kd_admin = $post["kd_admin"];

        $this->nama = $post["nama"];

        $this->email = $post["email"];

        $this->password = $post['password'];

        $this->jeniskel = $post['jeniskel'];

        if (!empty($_FILES["foto"]["name"])) {

            $this->foto = $this->_uploadImage();
        } else {

            $this->foto = $post["gambar_lama"];
        }

        return $this->db->update('tbl_admin', $this, array('kd_admin' => $post['kd_admin']));
    }

    private function _uploadImage()
    {
        $date = substr(date('Ymd'), 2, 8);

        $post = $this->input->post();

        $config['upload_path']          = './assets/data/admin/profil/';

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

        return base_url('assets/data/admin/profil/') . $post["gambar_lama"];
    }
}

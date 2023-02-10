<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Detail_model extends CI_Model
{

    public function getDataPegawai($kode_id)
    {
        $query = "SELECT k. *, p.nama as nama_atasan from tbl_atasan p, tbl_karyawan k where p.kd_atasan = k.atasan and k.id = '$kode_id'";
        return $this->db->query($query)->row_array();
    }

    public function getDataKepegawaian($kode_id)
    {
        return $this->db->get_where('tbl_kepegawaian', ['kd_kepegawaian' => $kode_id])->row_array();
    }

    public function getDataAtasan($kode_id)
    {
        return $this->db->get_where('tbl_atasan', ['kd_atasan' => $kode_id])->row_array();
    }

    public function getPegawai()
    {
        $query = "SELECT k.id, k.nik, k.nama, k.email, k.status, a.jabatan, a.golongan from tbl_atasan a, tbl_karyawan k where k.atasan = a.kd_atasan";
        return $this->db->query($query)->result_array();
    }

    public function getKepegawaian()
    {
        return $this->db->get('tbl_kepegawaian')->result_array();
    }

    public function getAtasan()
    {
        return $this->db->get('tbl_atasan')->result_array();
    }

    public function getPegawaiByDept($kode_dept)
    {
        $query = "SELECT d.id,d.dept,k.nama,k.departement from tbl_departement d, tbl_karyawan k where d.dept = k.departement and k.departement = '$kode_dept'";
        return $this->db->query($query)->result_array();
    }


    public function getJabatan()
    {
        return $this->db->get('tbl_jabatan')->result_array();
    }

    public function getDept()
    {
        $query = "SELECT d.* from tbl_departement d order by d.dept asc";
        return $this->db->query($query)->result_array();
    }

    public function deleteKaryawan($id)
    {
        $this->db->delete('tbl_karyawan', ['id' => $id]);
    }

    public function deleteKepegawaian($id)
    {
        $this->db->delete('tbl_kepegawaian', ['kd_kepegawaian' => $id]);
    }

    public function getKetua()
    {
        return $this->db->get('tbl_ketua')->row_array();
    }

    public function getAllAtasanById($id_atasan)
    {
        $query = "SELECT * from tbl_atasan where tbl_atasan.kd_atasan = $id_atasan";
        return $this->db->query($query)->row_array();
    }

    public function getAllCutiById($id)
    {
        $query = "SELECT a.nama, a.nik, c.alamat, a.masuk_kerja, a.telp, a.jabatan,a.golongan, a.atasan, a.sisa_cuti, c.id as id_cuti, c.jenis_cuti, c.tgl_cuti, c.tgl_masuk, c.keperluan, c.status from tbl_atasan a, tbl_cuti c where a.kd_atasan = c.id_karyawan and c.id = $id";
        return $this->db->query($query)->row_array();
    }
}

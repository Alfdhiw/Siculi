<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Detail_model extends CI_Model
{

    public function getDataPegawai($kode_id)
    {
        $query = "SELECT k.*, p.nama AS nama_atasan from tbl_karyawan k, tbl_atasan p where  k.atasan = p.kd_atasan and k.id = $kode_id";
        return $this->db->query($query)->row_array();
    }

    public function getPegawai($id)
    {
        $query = "SELECT k.* from tbl_karyawan k where k.atasan = $id";
        return $this->db->query($query)->result_array();
    }

    public function getPegawaiAtas($id)
    {
        $query = "SELECT k.* from tbl_atasan k where k.atasan = $id";
        return $this->db->query($query)->result_array();
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
        return $this->db->get('tbl_departement')->result_array();
    }

    public function deleteKaryawan($nik)
    {
        $this->db->delete('tbl_karyawan', ['nik' => $nik]);
    }

    public function getKetua()
    {
        return $this->db->get('tbl_ketua')->row_array();
    }

    public function getFotoUser($id)
    {
        $query = "SELECT * from tbl_atasan where kd_atasan = $id";
        return $this->db->query($query)->row_array();
    }

    public function getProfile($id)
    {
        $query = "SELECT k.* from tbl_atasan k where kd_atasan = '$id'";
        return $this->db->query($query)->row_array();
    }

    public function getDataAtasan($kode_id)
    {
        return $this->db->get_where('tbl_atasan', ['kd_atasan' => $kode_id])->row_array();
    }

    public function getAllCutiById($id)
    {
        $query = "SELECT a.nama, a.nik, c.alamat, a.masuk_kerja, a.telp, a.jabatan,a.golongan, a.atasan, a.sisa_cuti, c.id as id_cuti, c.jenis_cuti, c.tgl_cuti, c.tgl_masuk, c.keperluan, c.status from tbl_atasan a, tbl_cuti c where a.kd_atasan = c.id_karyawan and c.id = $id";
        return $this->db->query($query)->row_array();
    }

    public function getAllAtasanById($id_atasan)
    {
        $query = "SELECT * from tbl_atasan where tbl_atasan.kd_atasan = $id_atasan";
        return $this->db->query($query)->row_array();
    }

    public function getAllIjinById($id)
    {
        $query = "SELECT k.nama, k.nik, k.alamat, k.masuk_kerja, k.telp, p.jabatan,p.golongan, p.nama as nama_atasan, p.nik as nik_atasan,k.sisa_cuti, c.id as id_ijin, c.jenis, c.waktu_pergi, c.waktu_pulang, c.keperluan, c.status, c.tgl_ijin from tbl_karyawan k, tbl_atasan p, tbl_ijin c where k.id = c.id_karyawan and k.atasan = p.kd_atasan and c.id = $id";
        return $this->db->query($query)->row_array();
    }

    public function getAllIjinByIdAtasan($id)
    {
        $query = "SELECT k.nama, k.nik, k.masuk_kerja, k.telp, k.jabatan,k.golongan, k.atasan, k.sisa_cuti, c.id as id_ijin, c.jenis, c.waktu_pergi, c.waktu_pulang, c.keperluan, c.status, c.tgl_ijin from tbl_atasan k, tbl_ijin c where k.kd_atasan = c.id_karyawan and c.id = $id";
        return $this->db->query($query)->row_array();
    }

    public function getAllIjinByIdDewe($id)
    {
        $query = "SELECT k.nama, k.nik, k.masuk_kerja, k.telp, k.jabatan,k.golongan, k.atasan, k.sisa_cuti, c.id as id_ijin, c.jenis, c.waktu_pergi, c.waktu_pulang, c.keperluan, c.status, c.tgl_ijin from tbl_atasan k, tbl_ijin c where k.kd_atasan = c.id_karyawan and c.id = $id";
        return $this->db->query($query)->row_array();
    }
}

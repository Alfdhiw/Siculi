<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Detail_model extends CI_Model
{

    public function getDataPegawai($kode_id)
    {
        $query = "SELECT k.*, p.jabatan, p.golongan from tbl_karyawan k, tbl_atasan p where  k.atasan = p.kd_atasan and k.id = $kode_id";
        return $this->db->query($query)->row_array();
    }

    public function getPegawai($id)
    {
        $query = "SELECT k.*, p.jabatan, p.golongan from tbl_karyawan k, tbl_atasan p where k.atasan = p.kd_atasan and  k.kepegawaian = $id";
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
}

<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Detail_model extends CI_Model
{

    public function getDataPegawai($kode_id)
    {
        $query = "SELECT k. *, p.golongan, p.jabatan from tbl_kepegawaian p, tbl_karyawan k where p.kd_kepegawaian = k.atasan and k.id = '$kode_id'";
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
        $query = "SELECT k. *, p.golongan, p.jabatan, p.nama AS nama_kepegawaian, p.kd_kepegawaian from tbl_kepegawaian p, tbl_karyawan k where p.kd_kepegawaian = k.atasan";
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
        return $this->db->get('tbl_departement')->result_array();
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
}

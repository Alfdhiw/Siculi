<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{
    public function getUsernameUsers($email)
    {
        $query = "select `tbl_kepegawaian`.`kd_kepegawaian` AS `kode`,`tbl_kepegawaian`.`nama` AS `nama`,`tbl_kepegawaian`.`password` AS `password`,`tbl_kepegawaian`.`email` AS `email`,`tbl_kepegawaian`.`id_role` AS `id_role`,`tbl_kepegawaian`.`jeniskel` AS `jeniskel`,`tbl_kepegawaian`.`status` AS `status`,`tbl_kepegawaian`.`foto` AS `foto`, `tbl_kepegawaian`.`nik` AS `nik` from `tbl_kepegawaian` where email='" . $email . "'
        union
        select `tbl_karyawan`.`id` AS `kode`,`tbl_karyawan`.`nama` AS `nama`,`tbl_karyawan`.`password` AS `password`,`tbl_karyawan`.`email` AS `email`,`tbl_karyawan`.`id_role` AS `id_role`,`tbl_karyawan`.`jenis_kelamin` AS `jeniskel`,`tbl_karyawan`.`status` AS `status`,`tbl_karyawan`.`foto` AS `foto`, `tbl_karyawan`.`nik` AS `nik` from `tbl_karyawan` where email='" . $email . "'
        union
        select `tbl_ketua`.`kd_ketua` AS `kode`,`tbl_ketua`.`nama` AS `nama`,`tbl_ketua`.`password` AS `password`,`tbl_ketua`.`email` AS `email`,`tbl_ketua`.`id_role` AS `id_role`,`tbl_ketua`.`jeniskel` AS `jeniskel`,`tbl_ketua`.`status` AS `status`,`tbl_ketua`.`foto` AS `foto`, `tbl_ketua`.`nik` AS `nik` from `tbl_ketua` where email='" . $email . "'
        union
        select `tbl_admin`.`kd_admin` AS `kode`,`tbl_admin`.`nama` AS `nama`,`tbl_admin`.`password` AS `password`,`tbl_admin`.`email` AS `email`,`tbl_admin`.`id_role` AS `id_role`,`tbl_admin`.`jeniskel` AS `jeniskel`,`tbl_admin`.`status` AS `status`,`tbl_admin`.`foto` AS `foto`, `tbl_admin`.`nik` AS `nik` from `tbl_admin` where email='" . $email . "'
        union
        select `tbl_atasan`.`kd_atasan` AS `kode`,`tbl_atasan`.`nama` AS `nama`,`tbl_atasan`.`password` AS `password`,`tbl_atasan`.`email` AS `email`,`tbl_atasan`.`id_role` AS `id_role`,`tbl_atasan`.`jeniskel` AS `jeniskel`,`tbl_atasan`.`status` AS `status`,`tbl_atasan`.`foto` AS `foto`, `tbl_atasan`.`nik` AS `nik` from `tbl_atasan` where email='" . $email . "';";
        return $this->db->query($query)->row();
    }

    public function getUserPassUsers($email, $password)
    {
        $query = "select `tbl_kepegawaian`.`kd_kepegawaian` AS `kode`,`tbl_kepegawaian`.`nama` AS `nama`,`tbl_kepegawaian`.`password` AS `password`,`tbl_kepegawaian`.`email` AS `email`,`tbl_kepegawaian`.`id_role` AS `id_role`,`tbl_kepegawaian`.`jeniskel` AS `jeniskel`,`tbl_kepegawaian`.`status` AS `status`,`tbl_kepegawaian`.`foto` AS `foto`, `tbl_kepegawaian`.`nik` AS `nik` from tbl_kepegawaian  where email='" . $email . "' and password='" . $password . "'
        union
        select `tbl_karyawan`.`id` AS `kode`,`tbl_karyawan`.`nama` AS `nama`,`tbl_karyawan`.`password` AS `password`,`tbl_karyawan`.`email` AS `email`,`tbl_karyawan`.`id_role` AS `id_role`,`tbl_karyawan`.`jenis_kelamin` AS `jeniskel`,`tbl_karyawan`.`status` AS `status`,`tbl_karyawan`.`foto` AS `foto`, `tbl_karyawan`.`nik` AS `nik` from `tbl_karyawan` where email='" . $email . "' and password='" . $password . "'
        union 
        select `tbl_ketua`.`kd_ketua` AS `kode`,`tbl_ketua`.`nama` AS `nama`,`tbl_ketua`.`password` AS `password`,`tbl_ketua`.`email` AS `email`,`tbl_ketua`.`id_role` AS `id_role`,`tbl_ketua`.`jeniskel` AS `jeniskel`,`tbl_ketua`.`status` AS `status`,`tbl_ketua`.`foto` AS `foto`, `tbl_ketua`.`nik` AS `nik` from `tbl_ketua` where email='" . $email . "' and password='" . $password . "'
        union 
        select `tbl_admin`.`kd_admin` AS `kode`,`tbl_admin`.`nama` AS `nama`,`tbl_admin`.`password` AS `password`,`tbl_admin`.`email` AS `email`,`tbl_admin`.`id_role` AS `id_role`,`tbl_admin`.`jeniskel` AS `jeniskel`,`tbl_admin`.`status` AS `status`,`tbl_admin`.`foto` AS `foto`, `tbl_admin`.`nik` AS `nik`  from `tbl_admin` where email='" . $email . "' and password='" . $password . "'
        union 
        select `tbl_atasan`.`kd_atasan` AS `kode`,`tbl_atasan`.`nama` AS `nama`,`tbl_atasan`.`password` AS `password`,`tbl_atasan`.`email` AS `email`,`tbl_atasan`.`id_role` AS `id_role`,`tbl_atasan`.`jeniskel` AS `jeniskel`,`tbl_atasan`.`status` AS `status`,`tbl_atasan`.`foto` AS `foto`, `tbl_atasan`.`nik` AS `nik` from tbl_atasan  where email='" . $email . "' and password='" . $password . "'";
        return $this->db->query($query);
    }
}

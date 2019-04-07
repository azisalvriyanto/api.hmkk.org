<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class M_Pengguna extends CI_Model {
    public function daftar()
    {
        $query = $this->db->select("*")->from("pengguna")->get();

        if ($query->num_rows() > 0) {
            return array(
                "status" => 200,
                "keterangan" => json_decode(json_encode($query->result()), TRUE)
            );
        }
        else {
            return array(
                "status" => 204,
                "keterangan" => "Daftar anggota tidak ditemukan."
            );
        }
    }

    public function lihat($username)
    {
        $query = $this->db->select("*")->from("pengguna")->where("pengguna_username", $username)->get();

        if ($query->num_rows() > 0) {
            $query  = $query->row();
            return array(
                "status" => 200,
                "keterangan" => array(
                    "username" => $query->pengguna_username,
                    "nama" => $query->pengguna_nama,
                    "divisi" => $query->pengguna_keterangan,
                    "email" => $query->pengguna_email,
                    "motto" => $query->pengguna_motto
                )
            );
        }
        else {
            return array(
                "status" => 204,
                "keterangan" => "Profil tidak ditemukan."
            );
        }
    }

    public function tambah(
        $keterangan=0,
        $username,
        $password,
        $nama,
        $email,
        $motto
    ) {
        $query = $this->db->insert("pengguna",
            array(
                "pengguna_keterangan" => $keterangan,
                "pengguna_nama" => $nama,
                "pengguna_password" => $password,
                "pengguna_username" => $username,
                "pengguna_nama" => $nama,
                "pengguna_email" => $email,
                "pengguna_motto" => $motto
            )
        );

        if (!empty($query)) {
            return array(
                "status" => 200,
                "keterangan" => "Profil berhasil ditambahkan."
            );
        } else {
            return array(
                "status" => 204,
                "keterangan" => "Profil gagal ditambahkan."
            );
        }
    }

    public function perbarui(
        $keterangan,
        $username,
        $nama,
        $email,
        $motto
    ) {
        $query = $this->db->where("pengguna_username", $username)->update("pengguna",
            array(
                "pengguna_keterangan" => $keterangan,
                "pengguna_nama" => $nama,
                "pengguna_email" => $email,
                "pengguna_motto" => $motto
            )
        );

        if (!empty($query)) {
            return array(
                "status" => 200,
                "keterangan" => "Profil berhasil diperbarui."
            );
        } else {
            return array(
                "status" => 204,
                "keterangan" => "Profil gagal diperbarui."
            );
        }
    }

    public function hapus($username)
    {
        $query = $this->db->where("pengguna_username", $username)->delete("pengguna");
        if (!empty($query)) {
            return array(
                "status" => 200,
                "keterangan" => "Profil berhasil dihapus."
            );
        }
        else {
            return array(
                "status" => 204,
                "keterangan" => "Profil gagal dihapus."
            );
        }
    }

    public function username($username_lama, $username_baru)
    {
        $query = $this->db->where("pengguna_username", $username_lama)->update("pengguna",
            array(
                "pengguna_username" => $username_baru
            )
        );
        if (!empty($query)) {
            return array(
                "status" => 200,
                "keterangan" => "Username berhasil diperbarui."
            );
        }
        else {
            return array(
                "status" => 204,
                "keterangan" => "Username gagal diperbarui."
            );
        }
    }

    public function password($username, $password)
    {
        $query = $this->db->where("pengguna_username", $username)->update("pengguna",
            array(
                "pengguna_password" => $password
            )
        );
        if (!empty($query)) {
            return array(
                "status" => 200,
                "keterangan" => "Kata sandi berhasil diperbarui"
            );
        }
        else {
            return array(
                "status" => 204,
                "keterangan" => "Kata sandi gagal diperbarui"
            );
        }
    }
}
<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class M_Galeri extends CI_Model {
    public function lihat($tahun)
    {
        $query = $this->db->select("*")->from("galeri")->where("galeri_tahun", $tahun)->get();
        if ($query->num_rows() > 0) {
            $query  = $query->row();
            return array(
                "status" => 200,
                "keterangan" => array(
                    "tahun" => $query->galeri_tahun,
                    "instagram" => $query->galeri_instagram
                )
            );
        }
        else {
            return array(
                "status" => 204,
                "keterangan" => "Galeri tidak ditemukan."
            );
        }
    }

    public function perbarui(
        $tahun,
        $instagram
    ) {
        $query = $this->db->where("galeri_tahun", $tahun)->update("galeri",
            array(
                "galeri_instagram" => $instagram
            )
        );
        if (!empty($query)) {
            return array(
                "status" => 200,
                "keterangan" => "Galeri berhasil diperbarui"
            );
        }
        else {
            return array(
                "status" => 204,
                "keterangan" => "Galeri gagal diperbarui"
            );
        }
    }
}
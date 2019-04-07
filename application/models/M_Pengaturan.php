<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class M_Pengaturan extends CI_Model {
    public function lihat()
    {
        $query = $this->db->select("*")->from("pengaturan")->order_by("pengaturan_tahun", "desc")->get();
        if ($query->num_rows() > 0) {
            $query = $query->row();
            return array(
                "status" => 200,
                "keterangan" => array(
                    "tahun" => $query->pengaturan_periode,
                    "nama_panjang" => $query->pengaturan_nama_panjang,
                    "nama_pendek" => $query->pengaturan_nama_pendek,
                    "deskripsi" => $query->pengaturan_deskripsi,
                    "tentang" => $query->pengaturan_tentang,
                    "kontak" => array(
                        "alamat" => $query->pengaturan_alamat,
                        "email" => $query->pengaturan_email,
                        "telepon" => $query->pengaturan_telepon,
                        "facebook" => $query->pengaturan_facebook,
                        "twitter" => $query->pengaturan_twitter,
                        "instagram" => $query->pengaturan_instagram,
                        "youtube" => $query->pengaturan_youtube,
                        "peta" => $query->pengaturan_peta
                    )
                )
            );
        }
        else {
            return array(
                "status" => 204,
                "keterangan" => "Pengaturan tidak ditemukan."
            );
        }
    }

    public function tambah(
        $tahun,
        $nama_panjang,
        $nama_pendek,
        $deskripsi,
        $tentang,
        $alamat,
        $email,
        $telepon,
        $facebook,
        $twitter,
        $instagram,
        $youtube,
        $peta
    ) {
        $pengaturan_dahulu = $this->M_Pengaturan->lihat();
        $galeri	= $this->M_Galeri->lihat($pengaturan_dahulu["keterangan"]["tahun"]);
        $this->db->trans_begin();
        $this->db->insert("pengaturan",
            array(
                "pengaturan_tahun" => $tahun,
                "pengaturan_nama_panjang" => $nama_panjang,
                "pengaturan_nama_pendek" => $nama_pendek,
                "pengaturan_deskripsi" => $deskripsi,
                "pengaturan_tentang" => $tentang,
                "pengaturan_alamat" => $alamat,
                "pengaturan_email" => $email,
                "pengaturan_telepon" => $telepon,
                "pengaturan_facebook" => $facebook,
                "pengaturan_twitter" => $twitter,
                "pengaturan_instagram" => $instagram,
                "pengaturan_youtube" => $youtube,
                "pengaturan_peta" => $peta
            )
        );
        $pengaturan_sekarang = $this->M_Pengaturan->lihat();
        $this->db->insert("galeri",
            array(
                "galeri_tahun" => $pengaturan_sekarang["keterangan"]["tahun"],
                "galeri_instagram" => $galeri["keterangan"]["instagram"]
            )
        );

        if ($this->db->trans_status() === TRUE) {
            $this->db->trans_commit();
            $path = "../pskhuinsuka.com/assets/gambar/pengaturan";
            @copy($path."/logo_".$pengaturan_dahulu["keterangan"]["tahun"].".png", $path."/logo_".$pengaturan_sekarang["keterangan"]["tahun"].".png");

            return array(
                "status" => 200,
                "keterangan" => "Pengaturan berhasil diperbarui."
            );
        }
        else {
            $this->db->trans_rollback();
            return array(
                "status" => 204,
                "keterangan" => "Pengaturan gagal diperbarui."
            );
        }
    }

    public function perbarui(
        $tahun,
        $nama_panjang,
        $nama_pendek,
        $deskripsi,
        $tentang,
        $alamat,
        $email,
        $telepon,
        $facebook,
        $twitter,
        $instagram,
        $youtube,
        $peta
    ) {
        $query = $this->db->where("pengaturan_tahun", $tahun)->update("pengaturan",
            array(
                "pengaturan_nama_panjang" => $nama_panjang,
                "pengaturan_nama_pendek" => $nama_pendek,
                "pengaturan_deskripsi" => $deskripsi,
                "pengaturan_tentang" => $tentang,
                "pengaturan_alamat" => $alamat,
                "pengaturan_email" => $email,
                "pengaturan_telepon" => $telepon,
                "pengaturan_facebook" => $facebook,
                "pengaturan_twitter" => $twitter,
                "pengaturan_instagram" => $instagram,
                "pengaturan_youtube" => $youtube,
                "pengaturan_peta" => $peta
            )
        );
        if (!empty($query)) {
            return array(
                "status" => 200,
                "keterangan" => "Pengaturan berhasil diperbarui."
            );
        }
        else {
            return array(
                "status" => 204,
                "keterangan" => "Pengaturan gagal diperbarui."
            );
        }
    }
}
<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Pengaturan extends CI_Controller {
    public function lihat()
	{
        $method = $_SERVER["REQUEST_METHOD"];
        if (
            $method === "GET"
            && !empty($periode) && is_numeric($periode)
        ) {
            $response = $this->M_Pengaturan->lihat($periode);
			json_output(200, $response);
		} else {
			json_output(200, array("status" => 400, "keterangan" => "Bad request."));
		}
    }

    public function simpan()
	{
        $method = $_SERVER["REQUEST_METHOD"];
        if (
            $method === "POST"
            && !empty($this->input->post("tahun")) && is_numeric($this->input->post("tahun"))
			&& !empty($this->input->post("nama_panjang")) && is_string($this->input->post("nama_panjang")) === TRUE
			&& !empty($this->input->post("nama_pendek")) && is_string($this->input->post("nama_pendek")) === TRUE
        ) {
            if ($this->input->post("tahun") === date("Y")) {
                $response	= $this->M_Pengaturan->perbarui(
                    $this->input->post("tahun"),
                    $this->input->post("nama_panjang"),
                    $this->input->post("nama_pendek"),
                    $this->input->post("deskripsi"),
                    $this->input->post("tentang"),
                    $this->input->post("alamat"),
                    $this->input->post("email"),
                    $this->input->post("telepon"),
                    $this->input->post("facebook"),
                    $this->input->post("twitter"),
                    $this->input->post("instagram"),
                    $this->input->post("youtube"),
                    $this->input->post("peta")
                );
            } else {
                $response	= $this->M_Pengaturan->tambah(
                    date("Y"),
                    $this->input->post("nama_panjang"),
                    $this->input->post("nama_pendek"),
                    $this->input->post("deskripsi"),
                    $this->input->post("tentang"),
                    $this->input->post("alamat"),
                    $this->input->post("email"),
                    $this->input->post("telepon"),
                    $this->input->post("facebook"),
                    $this->input->post("twitter"),
                    $this->input->post("instagram"),
                    $this->input->post("youtube"),
                    $this->input->post("peta")
                );
            }

            json_output(200, $response);
		} else {
			json_output(200, array("status" => 400, "keterangan" => "Bad Request."));
		}
    }

    public function logo()
	{
        $method = $_SERVER["REQUEST_METHOD"];
        if (
            $method === "POST"
            && !empty($this->input->post("logo_tahun")) && is_numeric($this->input->post("logo_tahun"))
            && !empty($_FILES["logo_file"])
        ) {
            $config["upload_path"] = "../hmkk.org/assets/gambar/pengaturan";
            $config["allowed_types"] = "jpg|jpeg|png";
            $config["encrypt_name"] = TRUE;
            $this->load->library("upload", $config);
            if (!$this->upload->do_upload("logo_file")) {
                $response = array(
                    "status" => 403,
                    "keterangan" => @str_replace("<p>", "", @str_replace("</p>", "", $this->upload->display_errors()))
                );
            } else {
                $data = $this->upload->data();
                @rename($config["upload_path"]."/".$data["file_name"], $config["upload_path"]."/logo_".$this->input->post("logo_tahun").".png");

                $response = array(
                    "status" => 200,
                    "keterangan" => "Logo berhasil diperbarui."
                );
            }

            json_output(200, $response);
		} else {
			json_output(200, array("status" => 400, "keterangan" => "Bad Request."));
		}
    }
}
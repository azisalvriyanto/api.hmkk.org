<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Galeri extends CI_Controller {
    public function index()
	{
		json_output(200, array("status" => 400, "keterangan" => "Bad request."));
	}

    public function lihat($tahun)
	{
        $method = $_SERVER["REQUEST_METHOD"];
        if (
			$method === "GET"
			&& !empty($tahun) && is_numeric($tahun) === TRUE
		) {
            $response = $this->M_Galeri->lihat($tahun);
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
			&& !empty($this->input->post("tahun")) && is_numeric($this->input->post("tahun")) === TRUE
		) {
			$response = $this->M_Galeri->perbarui(
				$this->input->post("tahun"),
				$this->input->post("instagram")
			);

			json_output(200, $response);
		} else {
			json_output(200, array("status" => 400, "keterangan" => "Bad Request."));
		}
    }
}
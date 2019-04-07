<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Pengguna extends CI_Controller {
    public function index()
	{
		json_output(200, array("status" => 400, "keterangan" => "Bad request."));
	}

    public function daftar()
	{
		$method = $_SERVER["REQUEST_METHOD"];
        if (
			$method === "GET"
		) {
			$response = $this->M_Pengguna->daftar();
			json_output(200, $response);
		} else {
			json_output(200, array("status" => 400, "keterangan" => "Bad Request."));
		}
	}

    public function lihat($username)
	{
		$method	 	= $_SERVER["REQUEST_METHOD"];
        if (
			$method === "GET"
			&& !empty($username) && is_string($username) === TRUE
		) {
			$response = $this->M_Pengguna->lihat($username);
			json_output(200, $response);
		} else {
			json_output(200, array("status" => 400, "keterangan" => "Bad Request."));
		}
    }

    public function tambah()
	{
        $method = $_SERVER["REQUEST_METHOD"];
        if (
			$method === "POST"
			&& !empty($this->input->post("username")) && is_string($this->input->post("username")) === TRUE
			&& !empty($this->input->post("password")) && is_string($this->input->post("password")) === TRUE
			&& !empty($this->input->post("nama")) && is_string($this->input->post("nama")) === TRUE
			&& !empty($this->input->post("email")) && is_string($this->input->post("email")) === TRUE
		) {
			$response = $this->M_Pengguna->tambah(
				$this->input->post("keterangan"),
				$this->input->post("username"),
				md5($this->input->post("password")),
				$this->input->post("nama"),
				$this->input->post("email"),
				$this->input->post("motto")
			);

			json_output(200, $response);
		} else {
			json_output(200, array("status" => 400, "keterangan" => "Bad Request."));
		}
    }

    public function perbarui()
	{
        $method = $_SERVER["REQUEST_METHOD"];
        if (
			$method === "POST"
			&& is_numeric($this->input->post("keterangan")) === TRUE
			&& !empty($this->input->post("username")) && is_string($this->input->post("username")) === TRUE
			&& !empty($this->input->post("nama")) && is_string($this->input->post("nama")) === TRUE
			&& !empty($this->input->post("email")) && is_string($this->input->post("email")) === TRUE
		) {
			$response = $this->M_Pengguna->perbarui(
				$this->input->post("keterangan"),
				$this->input->post("username"),
				$this->input->post("nama"),
				$this->input->post("email"),
				$this->input->post("motto")
			);

			json_output(200, $response);
		} else {
			json_output(200, array("status" => 400, "keterangan" => "Bad Request."));
		}
	}

    public function hapus($username)
    {
        $method = $_SERVER["REQUEST_METHOD"];
		if (
			$method === "GET"
			&& !empty($username) && is_string($username) === TRUE
		) {
			$response = $this->M_Pengguna->hapus($username);
			json_output(200, $response);
		} else {
			json_output(200, array("status" => 400, "keterangan" => "Bad Request."));
		}
	}
	
	public function username()
	{
        $method = $_SERVER["REQUEST_METHOD"];
        if (
			$method === "POST"
			&& !empty($this->input->post("username_lama")) && is_string($this->input->post("username_lama")) === TRUE
			&& !empty($this->input->post("username_baru")) && is_string($this->input->post("username_baru")) === TRUE
		
		) {
			$response = $this->M_Pengguna->username(
				$this->input->post("username_lama"),
				$this->input->post("username_baru")
			);
			json_output(200, $response);
		} else {
			json_output(200, array("status" => 400, "keterangan" => "Bad Request."));
		}
    }
	
	public function password()
	{
        $method = $_SERVER["REQUEST_METHOD"];
        if (
			$method === "POST"
			&& !empty($this->input->post("username")) && is_string($this->input->post("username")) === TRUE
			&& !empty($this->input->post("password")) && is_string($this->input->post("password")) === TRUE
		) {
			$response = $this->M_Pengguna->password(
				$this->input->post("username"),
				md5($this->input->post("password"))
			);
			json_output(200, $response);
		} else {
			json_output(200, array("status" => 400, "keterangan" => "Bad Request."));
		}
    }
}
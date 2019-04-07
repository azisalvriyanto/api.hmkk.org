<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class M_Otentikasi extends CI_Model {
    public function masuk($username, $password)
    {
        $query = $this->db->select("*")->from("pengguna")->where("pengguna_username", $username)->get();
        if ($query->num_rows() > 0) {
            $query = $query->row();
            if ($query->pengguna_keterangan !== "0") {
                $db_username    = $query->pengguna_username;
                $db_password    = $query->pengguna_password;

                $password       =  substr(md5($password), 0, 32);
                if (hash_equals($db_password, $password)) {
                    $this->session->set_userdata(
                        array(
                            "username" => $db_username
                        )
                    );
                
                    return array(
                        "status" => 200,
                        "keterangan" =>  array(
                            "username" => $db_username
                        )
                    );
                } else {
                    return array(
                        "status" => 204,
                        "keterangan" => "Password tidak benar."
                    );
                }
            } else {
                return array(
                    "status" => 204,
                    "keterangan" => "Akun sudah dinonaktifkan."
                );
            }
        } else {
            return array(
                "status" => 204,
                "keterangan" => "Username tidak ditemukan."
            );
        }
    }
}
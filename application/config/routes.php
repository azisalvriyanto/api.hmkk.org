<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route["default_controller"]	= "Awal";
$route["404_override"]			= "Galat/_404";
$route["translate_uri_dashes"]	= FALSE;

//API
$route["otentikasi"]        = "Otentikasi/index";
$route["otentikasi/masuk"]  = "Otentikasi/masuk";
$route["otentikasi/keluar"] = "Otentikasi/keluar";

$route["pengaturan"]        = "pengaturan/lihat";
$route["pengaturan/logo"]   = "pengaturan/logo";
$route["pengaturan/simpan"] = "pengaturan/simpan";
$route["pengaturan/(:num)"] = "pengaturan/lihat/$1";

$route["pengguna"]              = "Pengguna/index";
$route["pengguna/tambah"]       = "Pengguna/tambah";
$route["pengguna/perbarui"]     = "Pengguna/perbarui";
$route["pengguna/username"]     = "Pengguna/username";
$route["pengguna/password"]     = "Pengguna/password";
$route["pengguna/hapus"]        = "Pengguna/index";
$route["pengguna/hapus/(:any)"] = "Pengguna/hapus/$1";
$route["pengguna/(:any)"]       = "Pengguna/lihat/$1";

$route["artikel"]               = "Artikel/index";
$route["artikel/tambah"]        = "Artikel/tambah";
$route["artikel/hapus/(:num)"]  = "Artikel/hapus/$1";

$route["galeri"]        = "Galeri/index";
$route["galeri/simpan"] = "Galeri/simpan";
$route["galeri/(:num)"] = "Galeri/lihat/$1";
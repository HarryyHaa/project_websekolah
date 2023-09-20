<?php
// deklarasi parameter koneksi database
$server   = "localhost";
$username = "u421663715_ppdbsmkppa2021";
$password = "pF^%fgJHDTVBN=97";
$database = "u421663715_ppdbsmkppa";

// koneksi database
$koneksi = mysqli_connect($server, $username, $password, $database);
// cek koneksi
if (!$koneksi) {
    die('Koneksi Database Gagal : ');
}
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
(isset($_GET['ac'])) ? $ac = $_GET['ac'] : $ac = '';

// SETTING WAKTU
date_default_timezone_set("Asia/Jakarta");
define('BASEPATH', dirname(__FILE__));

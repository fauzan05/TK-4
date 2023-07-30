<?php
/*
---------------------------------------------
Developed by IPAN
Theme by: JANUX (Dennis Ji)
---------------------------------------------
*/
$koneksi = mysqli_connect('localhost', 'root', '', 'db_tibsc');
if (!$koneksi) {
    die('Koneksi ke database gagal: ' . mysqli_connect_error());
}?>
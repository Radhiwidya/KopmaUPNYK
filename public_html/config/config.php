<?php
date_default_timezone_set('Asia/Jakarta');
ob_start();
$host   = "localhost";
$user   = "root";
$pass   = "";
$db     = "kopma_new";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("koneksi gagal:" . mysqli_connect_error());
}
$conn->query("SET time_zone = '+07:00'");
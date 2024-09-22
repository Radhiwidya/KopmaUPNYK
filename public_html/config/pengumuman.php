<?php
session_start();
include 'config.php';

if (isset($_POST['submit'])) {
    $nim = $_POST['nim'];
}

$data = mysqli_query($conn, "SELECT * FROM diterima WHERE nim = '$nim'")
    or die(mysqli_error($conn));

$cekdata = mysqli_fetch_array($data);

if ($cekdata > 0) {
    $_SESSION['nim'] = $nim;
    $_SESSION['nama'] = $cekdata['nama'];
    header("location: ../frontend/pages/pengumuman/accepted");
} else {
    header("location: ../frontend/pages/pengumuman/rejected");
}
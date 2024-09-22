<?php
include 'config.php';
include 'config2.php';
$sukses = "";
$error  = "";

if (isset($_POST['submit'])) {
    $bukti = $_FILES['bukti']['name'];
    $file_tmp = $_FILES['bukti']['tmp_name'];
    $nama       = $_POST['nama'];
    $nim        = $_POST['nim'];
    $no_wa      = $_POST['no_wa'];
    $ttl        = $_POST['ttl'];
    $alamat     = $_POST['alamat'];
    $kelamin    = $_POST['kelamin'];
    $agama      = $_POST['agama'];
    $fakultas   = $_POST['fakultas'];
    $prodi      = $_POST['jurusan'];
    $metode     = $_POST['metode'];
    $email      = $_POST['email'];
    move_uploaded_file($file_tmp,'../backend/assets/images/bukti/' . $bukti);
    $sql1   = "INSERT INTO pendaftaran (nama, nim, no_wa, ttl, alamat, kelamin, agama, fakultas, jurusan,metode, email, bukti) values ('$nama', '$nim', '$no_wa', '$ttl', '$alamat', '$kelamin', '$agama', '$fakultas', '$prodi','$metode', '$email', '$bukti')";
    $q1     = mysqli_query($conn, $sql1);
    if ($q1) {
        $sukses = "berhasil";
    } else {
        $error  = "gagal";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran</title>
</head>

<body>
    <?php
    if ($error) {
    ?>
        <script type="text/javascript">
            alert("Pendaftaran gagal!");
            window.location.href = '../frontend/pages/Form_pendaftaran/form';
        </script>
    <?php
    }
    ?>
    <?php
    if ($sukses) {
    ?>
        <script type="text/javascript">
            alert("Pendaftaran berhasil! Pengumuman dapat dilihat pada https://kopma-upnvy.com/");
            window.location.href = 'https://kopma-upnvy.com/';
        </script>
    <?php
    }
    ?>
</body>

</html>
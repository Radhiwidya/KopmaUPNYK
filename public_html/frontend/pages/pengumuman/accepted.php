<?php
session_start();
include '../../../config/config2.php';

if (!isset($_SESSION['nim'])) {
    ?>
    <script type="text/javascript">
        alert("Harap Masukan NIM Dahulu !");
        window.location.href = '../../../index.php';
    </script>
<?php
}

$nama = $_SESSION['nama'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="icon" href="../../../backend/assets/images/Icon.png">
    <link rel="stylesheet" href="../../assets/style/style.css">
    <title>KOPMA UPNVY | Pengumuman</title>
</head>

<body>
    <div class="announcement">
        <center>
                <h3>Selamat <b style="color: red; font-size:larger;"><?php echo $nama ?></b> anda diterima menjadi anggota KOPMA UPNVY tahun 2024</h3>
                <p>Untuk Informasi Selengkapnya Silahkan Join Grup <a href="<?php echo $link1 ?>" target="_blank">Anggota</a> dan <a href="<?php echo $link2 ?>">Peserta Pendidikan</a></p>
                <a href="../../../config/logout.php"><button>kembali</button></a>
        </center>
    </div>
</body>

</html>
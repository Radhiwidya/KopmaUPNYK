<?php
include 'config.php';
$id2        = "";
$no_anggota = "";
$nama       = "";
$no_wa      = "";
$agama      = "";
$ttl        = "";
$alamat     = "";
$email      = "";
$nim        = "";
$fakultas   = "";
$prodi      = "";
$alamat     = "";
$kelamin    = "";
$sukses     = "";
$error      = "";
$versi      = "Web Version : 2.4.15";

$sql2 = "SELECT * FROM grup";
$sql3 = mysqli_query($conn, $sql2);
if (mysqli_num_rows($sql3) > 0) {
    $r3 = mysqli_fetch_assoc($sql3);
    $link1  = $r3['link'];
    $id1     = $r3['id'];
} else {
    $link1 = "Link WhatsApp Group Belum di Masukan!";
}

$sql4 = "SELECT * FROM grup2";
$sql5 = mysqli_query($conn, $sql4);
if (mysqli_num_rows($sql5) > 0) {
    $r4 = mysqli_fetch_assoc($sql5);
    $link2 = $r4['link'];
    $id2     = $r4['id'];
} else {
    $link2 = "Link WhatsApp Group Belum di Masukan!";
}

$get1 = mysqli_query($conn, "SELECT * FROM anggota");
$jumlah1 = mysqli_num_rows($get1);

$get2 = mysqli_query($conn, "SELECT * FROM pendaftaran");
$jumlah2 = mysqli_num_rows($get2);

$get3 = mysqli_query($conn, "SELECT * FROM diterima");
$jumlah3 = mysqli_num_rows($get3);

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if ($op == 'delete') {
    $aid         = $_GET['aid'];
    $sql1       = "DELETE FROM anggota WHERE no_anggota = '$aid';
                    DELETE FROM poin WHERE no_anggota = '$aid';
                    DELETE FROM simpanan WHERE no_anggota = '$aid';";
    if ($conn->multi_query($sql1)) {
        $sukses = "Data berhasil diupdate";
    } else {
        $error  = "Data gagal diupdate";
    }
}

if ($op == 'edit') {
    $nid        = $_GET['nid'];
    $sql1       = "SELECT * FROM anggota WHERE nama = '$nid'";
    $q1         = mysqli_query($conn, $sql1);
    $r1         = mysqli_fetch_array($q1);
    $no_anggota = $r1['no_anggota'];
    $nama       = $r1['nama'];
    $nim        = $r1['nim'];
    $no_wa      = $r1['no_wa'];
    $ttl        = $r1['ttl'];
    $alamat     = $r1['alamat'];
    $kelamin    = $r1['kelamin'];
    $agama      = $r1['agama'];
    $fakultas   = $r1['fakultas'];
    $prodi      = $r1['jurusan'];
    $email      = $r1['email'];
}

if (isset($_POST['simpan'])) {
    $no_anggota = $_POST['no_anggota'];
    $nama       = $_POST['nama'];
    $nim        = $_POST['nim'];
    $no_wa      = $_POST['no_wa'];
    $ttl        = $_POST['ttl'];
    $alamat     = $_POST['alamat'];
    $kelamin    = $_POST['kelamin'];
    $agama      = $_POST['agama'];
    $fakultas   = $_POST['fakultas'];
    $prodi      = $_POST['jurusan'];
    $email      = $_POST['email'];

    if ($nama) {
        if ($op == 'edit') { //update   
            $sql1   = "UPDATE anggota SET no_anggota='$no_anggota', nama='$nama', nim='$nim', no_wa='$no_wa',  ttl='$ttl', alamat='$alamat', kelamin='$kelamin', agama='$agama', fakultas='$fakultas', jurusan='$prodi', email='$email' where nama = '$nid';
                    UPDATE poin SET no_anggota='$no_anggota' WHERE nama = '$nid';
                    UPDATE simpanan SET no_anggota='$no_anggota' WHERE nama = '$nid';";
            if ($conn->multi_query($sql1)) {
                $sukses = "Data berhasil diupdate";
            } else {
                $error  = "Data gagal diupdate";
            }
        } else { //input
            $sql1   = "INSERT INTO anggota (no_anggota, nama, nim, no_wa, ttl, alamat, kelamin, agama, fakultas, jurusan, email) values ('$no_anggota', '$nama', '$nim', '$no_wa', '$ttl', '$alamat', '$kelamin', '$agama', '$fakultas', '$prodi', '$email')";
            $q1     = mysqli_query($conn, $sql1);
            if ($q1) {
                $sukses = "Berhasil memasukkan data baru";
            } else {
                $error  = "Gagal memasukkan data";
            }
        }
    } else {
        $error = "Silahkan masukkan semua data";
    }
}

if ($op == 'konfirmasi') {
    $id             = $_GET['id'];
    $queryPilih     = "SELECT nama, nim, no_wa, ttl, alamat, kelamin, agama, fakultas, jurusan, email, metode FROM pendaftaran WHERE id = $id";
    $queryTambah    = "INSERT INTO konfirmasi (nama, nim, no_wa, ttl, alamat, kelamin, agama, fakultas, jurusan, email, metode) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $queryHapus     = "DELETE FROM pendaftaran WHERE id = $id";

    $hasil = $conn->query($queryPilih);
    if ($hasil->num_rows == 1) {
        $baris = $hasil->fetch_assoc();

        $pernyataan = $conn->prepare($queryTambah);
        $pernyataan->bind_param("siissssssss", $baris['nama'], $baris['nim'], $baris['no_wa'], $baris['ttl'], $baris['alamat'], $baris['kelamin'], $baris['agama'], $baris['fakultas'], $baris['jurusan'], $baris['email'], $baris['metode']);
        $pernyataan->execute();

        $conn->query($queryHapus);
    }
}
if ($op == 'gagal') {
    $id             = $_GET['id'];
    $queryHapus     = "DELETE FROM pendaftaran WHERE id = $id";
    $query          = mysqli_query($conn, $queryHapus);
}
if ($op == 'terima') {
    $id             = $_GET['id'];
    $queryPilih     = "SELECT nama, nim, no_wa, ttl, alamat, kelamin, agama, fakultas, jurusan, email FROM konfirmasi WHERE id = $id";
    $queryTambah    = "INSERT INTO diterima (nama, nim, no_wa, ttl, alamat, kelamin, agama, fakultas, jurusan, email) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $queryHapus     = "DELETE FROM konfirmasi WHERE id = $id";

    $hasil = $conn->query($queryPilih);
    if ($hasil->num_rows == 1) {
        $baris = $hasil->fetch_assoc();

        $pernyataan = $conn->prepare($queryTambah);
        $pernyataan->bind_param("siisssssss", $baris['nama'], $baris['nim'], $baris['no_wa'], $baris['ttl'], $baris['alamat'], $baris['kelamin'], $baris['agama'], $baris['fakultas'], $baris['jurusan'], $baris['email']);
        $pernyataan->execute();

        $conn->query($queryHapus);
    }
}
if ($op == 'tolak') {
    $id             = $_GET['id'];
    $queryHapus     = "DELETE FROM konfirmasi WHERE id = $id";
    $query          = mysqli_query($conn, $queryHapus);
}

if (isset($_POST['save'])) {
    $link   = $_POST['link'];
    $jenis  = $_POST['jenis'];

    if ($link && $jenis == '1') {
        $sql1   = "INSERT INTO grup (link) values ('$link')";
        $q1     = mysqli_query($conn, $sql1);
?><script type="text/javascript">
            alert("Link WA Keluarga Berhasil ditambah!");
            window.location.href = 'diterima.php';
        </script>
    <?php
    } else if ($link && $jenis == '2') {
        $sql2   = "INSERT INTO grup2 (link) values ('$link')";
        $q2     = mysqli_query($conn, $sql2);

    ?><script type="text/javascript">
            alert("Link WA Diklat Berhasil ditambah!");
            window.location.href = 'diterima.php';
        </script>
    <?php
    }
}

if ($op == 'hapus') {
    $id             = $_GET['id'];
    $queryHapus     = "DELETE FROM diterima WHERE id = $id";
    $query          = mysqli_query($conn, $queryHapus);
}
if ($op == 'remove') {
    $sql1       = "TRUNCATE `diterima`";
    $q1         = mysqli_query($conn, $sql1);
    ?><script type="text/javascript">
        alert("Berhasil hapus semua data!");
        window.location.href = 'diterima.php';
    </script>
    <?php
}
if ($op == 'pindah') {
    $sql_copy = "INSERT INTO anggota (nama, nim, no_wa, ttl, alamat, kelamin, agama, fakultas, jurusan, email)
             SELECT nama, nim, no_wa, ttl, alamat, kelamin, agama, fakultas, jurusan, email FROM diterima;
             INSERT INTO poin (nama) SELECT nama FROM diterima;
             INSERT INTO simpanan (nama) SELECT nama FROM diterima;";

if ($conn->multi_query($sql_copy)) {
    do {
        if ($result = $conn->store_result()) {
            $result->free();
        }
    } while ($conn->more_results() && $conn->next_result());
    
    echo "<script type='text/javascript'>
            alert('Data Berhasil di Salin');
            window.location.href = 'diterima.php';
          </script>";
} else {
    echo "Error: " . $conn->error;
}

}


if ($op == 'hapuswadiklat') {
    $id             = $_GET['id'];
    $queryHapus     = "DELETE FROM grup2 WHERE id = $id";
    $query          = mysqli_query($conn, $queryHapus);
    ?><script type="text/javascript">
        alert("Link Grup Diklat Berhasil di hapus!");
        window.location.href = 'diterima.php';
    </script>
<?php
}

if ($op == 'hapuswakeluarga') {
    $id             = $_GET['id'];
    $queryHapus     = "DELETE FROM grup WHERE id = $id";
    $query          = mysqli_query($conn, $queryHapus);
?><script type="text/javascript">
        alert("Link Grup Keluarga Berhasil di hapus!");
        window.location.href = 'diterima.php';
    </script>
<?php
}

if ($op == 'tambah') {
    $id         = $_GET['id'];
    $sql1       = "SELECT * FROM poin WHERE id = '$id'";
    $q1         = mysqli_query($conn, $sql1);
    $r1         = mysqli_fetch_array($q1);
    $no_anggota = $r1['no_anggota'];
    $nama       = $r1['nama'];
}

if ($op == 'ssshusp') {
    $id         = $_GET['id'];
    $sql1       = "SELECT * FROM simpanan WHERE id = '$id'";
    $q1         = mysqli_query($conn, $sql1);
    $r1         = mysqli_fetch_array($q1);
    $no_anggota = $r1['no_anggota'];
    $nama       = $r1['nama'];
}

if ($op == 'del') {
    $id         = $_GET['id'];
    $sql1       = "DELETE FROM poin WHERE id = '$id'";
    $q1         = mysqli_query($conn, $sql1);
    if ($q1) {
        $sukses = "Berhasil hapus data";
    } else {
        $error = "Gagal melakukan delete data";
    }
}

if (isset($_POST['simpanan'])){
    $tahun      = $_POST['tahun'];
    $nominal    = $_POST['nominal'];
    $total      = "total = 2016 + 2017 + 2018 + 2019 + 2020 + 2021 + 2022 + 2023 + 2024 + 2025 + 2026 + 2027 + 2028 + 2029 + 2030 + sp + ss + shu";
    if ($tahun == '16') {
        $code       = "UPDATE simpanan SET `2016` = `2016` + $nominal, $total WHERE id = $id";
        $q2         = mysqli_query($conn, $code);
        if ($q2) {
            $sukses = "Data berhasil diupdate";
        } else {
            $error  = "Data gagal diupdate";
        }
    }
    if ($tahun == '17') {
        $code       = "UPDATE simpanan SET `2017` = `2017` + $nominal, $total WHERE id = $id";
        $q2         = mysqli_query($conn, $code);
        if ($q2) {
            $sukses = "Data berhasil diupdate";
        } else {
            $error  = "Data gagal diupdate";
        }
    }
    if ($tahun == '18') {
        $code       = "UPDATE simpanan SET `2018` = `2018` + $nominal, $total WHERE id = $id";
        $q2         = mysqli_query($conn, $code);
        if ($q2) {
            $sukses = "Data berhasil diupdate";
        } else {
            $error  = "Data gagal diupdate";
        }
    }
    if ($tahun == '19') {
        $code       = "UPDATE simpanan SET `2019` = `2019` + $nominal, $total WHERE id = $id";
        $q2         = mysqli_query($conn, $code);
        if ($q2) {
            $sukses = "Data berhasil diupdate";
        } else {
            $error  = "Data gagal diupdate";
        }
    }
    if ($tahun == '20') {
        $code       = "UPDATE simpanan SET `2020` = `2020` + $nominal, $total WHERE id = $id";
        $q2         = mysqli_query($conn, $code);
        if ($q2) {
            $sukses = "Data berhasil diupdate";
        } else {
            $error  = "Data gagal diupdate";
        }
    }
    if ($tahun == '21') {
        $code       = "UPDATE simpanan SET `2021` = `2021` + $nominal, $total WHERE id = $id";
        $q2         = mysqli_query($conn, $code);
        if ($q2) {
            $sukses = "Data berhasil diupdate";
        } else {
            $error  = "Data gagal diupdate";
        }
    }
    if ($tahun == '22') {
        $code       = "UPDATE simpanan SET `2022` = `2022` + $nominal, $total WHERE id = $id";
        $q2         = mysqli_query($conn, $code);
        if ($q2) {
            $sukses = "Data berhasil diupdate";
        } else {
            $error  = "Data gagal diupdate";
        }
    }
    if ($tahun == '23') {
        $code       = "UPDATE simpanan SET `2023` = `2023` + $nominal, $total WHERE id = $id";
        $q2         = mysqli_query($conn, $code);
        if ($q2) {
            $sukses = "Data berhasil diupdate";
        } else {
            $error  = "Data gagal diupdate";
        }
    }
    if ($tahun == '24') {
        $code       = "UPDATE simpanan SET `2024` = `2024` + $nominal, $total WHERE id = $id";
        $q2         = mysqli_query($conn, $code);
        if ($q2) {
            $sukses = "Data berhasil diupdate";
        } else {
            $error  = "Data gagal diupdate";
        }
    }
    if ($tahun == '25') {
        $code       = "UPDATE simpanan SET `2025` = `2025` + $nominal, $total WHERE id = $id";
        $q2         = mysqli_query($conn, $code);
        if ($q2) {
            $sukses = "Data berhasil diupdate";
        } else {
            $error  = "Data gagal diupdate";
        }
    }
    if ($tahun == '26') {
        $code       = "UPDATE simpanan SET `2026` = `2026` + $nominal, $total WHERE id = $id";
        $q2         = mysqli_query($conn, $code);
        if ($q2) {
            $sukses = "Data berhasil diupdate";
        } else {
            $error  = "Data gagal diupdate";
        }
    }
    if ($tahun == '27') {
        $code       = "UPDATE simpanan SET `2027` = `2027` + $nominal, $total WHERE id = $id";
        $q2         = mysqli_query($conn, $code);
        if ($q2) {
            $sukses = "Data berhasil diupdate";
        } else {
            $error  = "Data gagal diupdate";
        }
    }
    if ($tahun == '28') {
        $code       = "UPDATE simpanan SET `2028` = `2028` + $nominal, $total WHERE id = $id";
        $q2         = mysqli_query($conn, $code);
        if ($q2) {
            $sukses = "Data berhasil diupdate";
        } else {
            $error  = "Data gagal diupdate";
        }
    }
    if ($tahun == '29') {
        $code       = "UPDATE simpanan SET `2029` = `2029` + $nominal, $total WHERE id = $id";
        $q2         = mysqli_query($conn, $code);
        if ($q2) {
            $sukses = "Data berhasil diupdate";
        } else {
            $error  = "Data gagal diupdate";
        }
    }
    if ($tahun == '30') {
        $code       = "UPDATE simpanan SET `2030` = `2030` + $nominal, $total WHERE id = $id";
        $q2         = mysqli_query($conn, $code);
        if ($q2) {
            $sukses = "Data berhasil diupdate";
        } else {
            $error  = "Data gagal diupdate";
        }
    }
}

if (isset($_POST['sw'])){
    $jenis      = $_POST['jenis'];
    $nominal    = $_POST['nominal'];
    $total      = "total = 2016 + 2017 + 2018 + 2019 + 2020 + 2021 + 2022 + 2023 + 2024 + 2025 + 2026 + 2027 + 2028 + 2029 + 2030 + sp + ss + shu";
    if ($jenis == '1') {
        $code       = "UPDATE simpanan SET ss = ss + $nominal, $total WHERE id = $id";
        $q2         = mysqli_query($conn, $code);
        if ($q2) {
            $sukses = "Data berhasil diupdate";
        } else {
            $error  = "Data gagal diupdate";
        }
    }
    if ($jenis == '2') {
        $code       = "UPDATE simpanan SET shu = shu + $nominal, $total WHERE id = $id";
        $q2         = mysqli_query($conn, $code);
        if ($q2) {
            $sukses = "Data berhasil diupdate";
        } else {
            $error  = "Data gagal diupdate";
        }
    }
    if ($jenis == '3') {
        $code       = "UPDATE simpanan SET sp = sp + $nominal, $total WHERE id = $id";
        $q2         = mysqli_query($conn, $code);
        if ($q2) {
            $sukses = "Data berhasil diupdate";
        } else {
            $error  = "Data gagal diupdate";
        }
    }
}

if (isset($_POST['tambahpoint'])) {
    $point      = $_POST['point'];
    $total      = "total = i1 + i2 + i3 + i4 + i5 + i6 + i7 + i8 + i9 + i10 + i11 + i12 + e1 + e2 + e3 + e4 + e5 + e6 + e7 + e8 + e9 + e10 + e11 + e12 + e13 + e14 + o1 + o2 + o3 + o4 + o5 + o6";
    if ($point == 'i1') {
        $code       = "UPDATE poin SET i1 = i1 + 100, $total WHERE id = $id";
        $q2         = mysqli_query($conn, $code);
        if ($q2) {
            $sukses = "Data berhasil diupdate";
        } else {
            $error  = "Data gagal diupdate";
        }
    }
    if ($point == 'i2') {
        $code       = "UPDATE poin SET i2 = i2 + 85, $total WHERE id = $id";
        $q2         = mysqli_query($conn, $code);
        if ($q2) {
            $sukses = "Data berhasil diupdate";
        } else {
            $error  = "Data gagal diupdate";
        }
    }
    if ($point == 'i3') {
        $code       = "UPDATE poin SET i3 = i3 + 75, $total WHERE id = $id";
        $q2         = mysqli_query($conn, $code);
        if ($q2) {
            $sukses = "Data berhasil diupdate";
        } else {
            $error  = "Data gagal diupdate";
        }
    }
    if ($point == 'i4') {
        $code       = "UPDATE poin SET i4 = i4 + 75, $total WHERE id = $id";
        $q2         = mysqli_query($conn, $code);
        if ($q2) {
            $sukses = "Data berhasil diupdate";
        } else {
            $error  = "Data gagal diupdate";
        }
    }
    if ($point == 'i5') {
        $code       = "UPDATE poin SET i5 = i5 + 65, $total WHERE id = $id";
        $q2         = mysqli_query($conn, $code);
        if ($q2) {
            $sukses = "Data berhasil diupdate";
        } else {
            $error  = "Data gagal diupdate";
        }
    }
    if ($point == 'i6') {
        $code       = "UPDATE poin SET i6 = i6 + 55, $total WHERE id = $id";
        $q2         = mysqli_query($conn, $code);
        if ($q2) {
            $sukses = "Data berhasil diupdate";
        } else {
            $error  = "Data gagal diupdate";
        }
    }
    if ($point == 'i7') {
        $code       = "UPDATE poin SET i7 = i7 + 45, $total WHERE id = $id";
        $q2         = mysqli_query($conn, $code);
        if ($q2) {
            $sukses = "Data berhasil diupdate";
        } else {
            $error  = "Data gagal diupdate";
        }
    }
    if ($point == 'i8') {
        $code       = "UPDATE poin SET i8 = i8 + 35, $total WHERE id = $id";
        $q2         = mysqli_query($conn, $code);
        if ($q2) {
            $sukses = "Data berhasil diupdate";
        } else {
            $error  = "Data gagal diupdate";
        }
    }
    if ($point == 'i9') {
        $code       = "UPDATE poin SET i9 = i9 + 35, $total WHERE id = $id";
        $q2         = mysqli_query($conn, $code);
        if ($q2) {
            $sukses = "Data berhasil diupdate";
        } else {
            $error  = "Data gagal diupdate";
        }
    }
    if ($point == 'i10') {
        $code       = "UPDATE poin SET i10 = i10 + 30, $total WHERE id = $id";
        $q2         = mysqli_query($conn, $code);
        if ($q2) {
            $sukses = "Data berhasil diupdate";
        } else {
            $error  = "Data gagal diupdate";
        }
    }
    if ($point == 'i11') {
        $code       = "UPDATE poin SET i11 = i11 + 25, $total WHERE id = $id";
        $q2         = mysqli_query($conn, $code);
        if ($q2) {
            $sukses = "Data berhasil diupdate";
        } else {
            $error  = "Data gagal diupdate";
        }
    }
    if ($point == 'i12') {
        $code       = "UPDATE poin SET i12 = i12 + 15, $total WHERE id = $id";
        $q2         = mysqli_query($conn, $code);
        if ($q2) {
            $sukses = "Data berhasil diupdate";
        } else {
            $error  = "Data gagal diupdate";
        }
    }
    if ($point == 'e1') {
        $code       = "UPDATE poin SET e1 = e1 + 15, $total WHERE id = $id";
        $q2         = mysqli_query($conn, $code);
        if ($q2) {
            $sukses = "Data berhasil diupdate";
        } else {
            $error  = "Data gagal diupdate";
        }
    }
    if ($point == 'e2') {
        $code       = "UPDATE poin SET e2 = e2 + 35, $total WHERE id = $id";
        $q2         = mysqli_query($conn, $code);
        if ($q2) {
            $sukses = "Data berhasil diupdate";
        } else {
            $error  = "Data gagal diupdate";
        }
    }
    if ($point == 'e3') {
        $code       = "UPDATE poin SET e3 = e3 + 55, $total WHERE id = $id";
        $q2         = mysqli_query($conn, $code);
        if ($q2) {
            $sukses = "Data berhasil diupdate";
        } else {
            $error  = "Data gagal diupdate";
        }
    }
    if ($point == 'e4') {
        $code       = "UPDATE poin SET e4 = e4 + 45, $total WHERE id = $id";
        $q2         = mysqli_query($conn, $code);
        if ($q2) {
            $sukses = "Data berhasil diupdate";
        } else {
            $error  = "Data gagal diupdate";
        }
    }
    if ($point == 'e5') {
        $code       = "UPDATE poin SET e5 = e5 + 35, $total WHERE id = $id";
        $q2         = mysqli_query($conn, $code);
        if ($q2) {
            $sukses = "Data berhasil diupdate";
        } else {
            $error  = "Data gagal diupdate";
        }
    }
    if ($point == 'e6') {
        $code       = "UPDATE poin SET e6 = e6 + 35, $total WHERE id = $id";
        $q2         = mysqli_query($conn, $code);
        if ($q2) {
            $sukses = "Data berhasil diupdate";
        } else {
            $error  = "Data gagal diupdate";
        }
    }
    if ($point == 'e7') {
        $code       = "UPDATE poin SET e7 = e7 + 30, $total WHERE id = $id";
        $q2         = mysqli_query($conn, $code);
        if ($q2) {
            $sukses = "Data berhasil diupdate";
        } else {
            $error  = "Data gagal diupdate";
        }
    }
    if ($point == 'e8') {
        $code       = "UPDATE poin SET e8 = e8 + 25, $total WHERE id = $id";
        $q2         = mysqli_query($conn, $code);
        if ($q2) {
            $sukses = "Data berhasil diupdate";
        } else {
            $error  = "Data gagal diupdate";
        }
    }
    if ($point == 'e9') {
        $code       = "UPDATE poin SET e9 = e9 + 100, $total WHERE id = $id";
        $q2         = mysqli_query($conn, $code);
        if ($q2) {
            $sukses = "Data berhasil diupdate";
        } else {
            $error  = "Data gagal diupdate";
        }
    }
    if ($point == 'e10') {
        $code       = "UPDATE poin SET e10 = e10 + 85, $total WHERE id = $id";
        $q2         = mysqli_query($conn, $code);
        if ($q2) {
            $sukses = "Data berhasil diupdate";
        } else {
            $error  = "Data gagal diupdate";
        }
    }
    if ($point == 'e11') {
        $code       = "UPDATE poin SET e11 = e11 + 80, $total WHERE id = $id";
        $q2         = mysqli_query($conn, $code);
        if ($q2) {
            $sukses = "Data berhasil diupdate";
        } else {
            $error  = "Data gagal diupdate";
        }
    }
    if ($point == 'e12') {
        $code       = "UPDATE poin SET e12 = e12 + 80, $total WHERE id = $id";
        $q2         = mysqli_query($conn, $code);
        if ($q2) {
            $sukses = "Data berhasil diupdate";
        } else {
            $error  = "Data gagal diupdate";
        }
    }
    if ($point == 'e13') {
        $code       = "UPDATE poin SET e13 = e13 + 75, $total WHERE id = $id";
        $q2         = mysqli_query($conn, $code);
        if ($q2) {
            $sukses = "Data berhasil diupdate";
        } else {
            $error  = "Data gagal diupdate";
        }
    }
    if ($point == 'e14') {
        $code       = "UPDATE poin SET e14 = e14 + 65, $total WHERE id = $id";
        $q2         = mysqli_query($conn, $code);
        if ($q2) {
            $sukses = "Data berhasil diupdate";
        } else {
            $error  = "Data gagal diupdate";
        }
    }
    if ($point == 'o1') {
        $code       = "UPDATE poin SET o1 = o1 + 30, $total WHERE id = $id";
        $q2         = mysqli_query($conn, $code);
        if ($q2) {
            $sukses = "Data berhasil diupdate";
        } else {
            $error  = "Data gagal diupdate";
        }
    }
    if ($point == 'o2') {
        $code       = "UPDATE poin SET o2 = o2 + 30, $total WHERE id = $id";
        $q2         = mysqli_query($conn, $code);
        if ($q2) {
            $sukses = "Data berhasil diupdate";
        } else {
            $error  = "Data gagal diupdate";
        }
    }
    if ($point == 'o3') {
        $code       = "UPDATE poin SET o3 = o3 + 35, $total WHERE id = $id";
        $q2         = mysqli_query($conn, $code);
        if ($q2) {
            $sukses = "Data berhasil diupdate";
        } else {
            $error  = "Data gagal diupdate";
        }
    }
    if ($point == 'o4') {
        $code       = "UPDATE poin SET o4 = o4 + 25, $total WHERE id = $id";
        $q2         = mysqli_query($conn, $code);
        if ($q2) {
            $sukses = "Data berhasil diupdate";
        } else {
            $error  = "Data gagal diupdate";
        }
    }
    if ($point == 'o5') {
        $code       = "UPDATE poin SET o5 = o5 + 25, $total WHERE id = $id";
        $q2         = mysqli_query($conn, $code);
        if ($q2) {
            $sukses = "Data berhasil diupdate";
        } else {
            $error  = "Data gagal diupdate";
        }
    }
    if ($point == 'o6') {
        $code       = "UPDATE poin SET o6 = o6 + 20, $total WHERE id = $id";
        $q2         = mysqli_query($conn, $code);
        if ($q2) {
            $sukses = "Data berhasil diupdate";
        } else {
            $error  = "Data gagal diupdate";
        }
    }
}
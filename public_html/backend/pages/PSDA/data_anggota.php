<?php
session_start();
if (empty($_SESSION['username'])) {
?>
    <script type="text/javascript">
        alert("Harap Login Terlebih Dahulu !");
        window.location.href = '../../../index.php?pesan=belum_login';
    </script>
<?php
}
include '../../../config/config.php';
include '../../../config/config2.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PSDA | Data Anggota</title>
    <link rel="icon" href="../../assets/images/Icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../assets/style/style.css">
</head>

<body class="dark-mode">
    <nav class="header navbar fixed-top">
        <a class="navbar-brand" href="#">
            <img src="../../assets/images/Logo.png" alt="Logo Kopma" height="45" style="padding-left: 40px;">
        </a>
        <div class="theme-switch" onclick="toggleTheme()">
            <i class="fas fa-moon"></i>
        </div>
        <div class="sidebar-toggle" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </div>
    </nav>
    <div class="sidebar">
        <a href="../dashboard.php"><i class="fa-solid fa-gauge"></i> Dashboard</a>
        <div class="menu-item" onclick="toggleSubmenu(this)">
            <a href="#"><i class="fa-solid fa-users"></i> PSDA</a>
            <div class="submenu">
                <a href="data_anggota.php">Data Anggota</a>
                <a href="point_keaktifan.php">Point Keaktifan</a>
                <a href="register/pendaftar.php">Pendaftaran</a>
            </div>
        </div>
        <div class="menu-item" onclick="toggleSubmenu(this)">
            <a href="#"><i class="fa-solid fa-dollar-sign"></i> Keuangan</a>
            <div class="submenu">
                <a href="../Keuangan/simpanan.php">Simpanan</a>
                <a href="#">Coming Soon</a>
                <a href="#">Coming Soon</a>
            </div>
        </div>
        <div class="menu-item" onclick="toggleSubmenu(this)">
            <a href="#"><i class="fa-solid fa-shop"></i> Usaha</a>
            <div class="submenu">
                <a href="#">Coming Soon</a>
                <a href="#">Coming Soon</a>
                <a href="#">Coming Soon</a>
            </div>
        </div>
        <div class="menu-item" onclick="toggleSubmenu(this)">
            <a href="#"><i class="fa-solid fa-pen"></i> Adminhum</a>
            <div class="submenu">
                <a href="#">Coming Soon</a>
                <a href="#">Coming Soon</a>
                <a href="#">Coming Soon</a>
            </div>
        </div>
        <div class="menu-item" onclick="toggleSubmenu(this)">
            <a href="#"><i class="fa-solid fa-shield"></i> Pengawas</a>
            <div class="submenu">
                <a href="#">Coming Soon</a>
                <a href="#">Coming Soon</a>
                <a href="#">Coming Soon</a>
            </div>
        </div>
        <div class="menu-item" onclick="toggleSubmenu(this)">
            <a href="#"><i class="fa-solid fa-user"></i> Personalia</a>
            <div class="submenu">
                <a href="#">Coming Soon</a>
                <a href="#">Coming Soon</a>
                <a href="#">Coming Soon</a>
            </div>
        </div>
        <div class="menu-item" onclick="toggleSubmenu(this)">
            <a href="#"><i class="fa-solid fa-atom"></i> Riset</a>
            <div class="submenu">
                <a href="#">Coming Soon</a>
                <a href="#">Coming Soon</a>
                <a href="#">Coming Soon</a>
            </div>
        </div>
        <a href="../../../config/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
        <hr>
        <p><?php echo $versi ?></p>
    </div>
    <!-- Konten Utama -->
    <div class="main-content">
    <div class="pt-4">
            <h3><i class="bi bi-people" style="margin-right: 10px;"></i>DATA ANGGOTA</h3>
            <hr>
            <!--Input-->
            <div class="card">
                <div class="card-header text-white bg-primary">
                    Create / Edit Data
                </div>
                <div class="card-body" style="width: 100%;">
                    <?php
                    if ($error) {
                    ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $error ?>
                        </div>
                    <?php
                        header("refresh:1;url=data_anggota.php");
                    }
                    ?>
                    <?php
                    if ($sukses) {
                    ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $sukses ?>
                        </div>
                    <?php
                        header("refresh:1;url=data_anggota.php");
                    }
                    ob_end_flush();
                    ?>
                    <form action="" method="POST">
                        <div class="mb-3 row">
                            <label for="no-anggota" class="col-sm-2 col-form-label">No. Anggota</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="no_anggota" name="no_anggota" value="<?php echo $no_anggota ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="nim" id="nim" value="<?php echo $nim ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="no_wa" class="col-sm-2 col-form-label">No. WhatsApp </label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="no_wa" name="no_wa" value="<?php echo $no_wa ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="ttl" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="ttl" name="ttl" value="<?php echo $ttl ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="alamat" id="alamat" value="<?php echo $alamat ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="kelamin" id="kelamin" value="<?php echo $kelamin ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="agama" class="col-sm-2 col-form-label">Agama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="agama" id="agama" value="<?php echo $agama ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="fakultas" class="col-sm-2 col-form-label">Fakultas</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="fakultas" name="fakultas" value="<?php echo $fakultas ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="prodi" class="col-sm-2 col-form-label">Prodi</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="prodi" name="jurusan" value="<?php echo $prodi ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="email" class="col-sm-2 col-form-label">E-Mail</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" name="email" id="email" value="<?php echo $email ?>">
                            </div>
                        </div>
                        <div class="col-12">
                            <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
            <!-- Output -->
            <div class="card mt-3">
                <div class="card-header text-white bg-secondary">
                    Data Anggota
                    <input type="text" id="searchInput" placeholder="Cari data..." style="float: right; border:none; border-radius:5px;">
                </div>
                <div class="card-body" style="overflow-y: auto; width:100%">
                    <table id="dataTable" class="table table-dark table-striped table-hover table-bordered" style="width: max-content;">
                        <thead>
                            <tr>
                                <th scope="col">No. Anggota</th>
                                <th scope="col">Nama</th>
                                <th scope="col">NIM</th>
                                <th scope="col">No. WhatsApp</th>
                                <th scope="col">Tanggal Lahir</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">Jenis Kelamin</th>
                                <th scope="col">Agama</th>
                                <th scope="col">Fakultas</th>
                                <th scope="col">Prodi</th>
                                <th scope="col">E-mail</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql2       = "SELECT * FROM anggota ORDER BY id DESC";
                            $result     = $conn->query($sql2);
                            if ($result->num_rows > 0) :
                                while ($r2 = $result->fetch_assoc()) :
                                    $aid        = $r2['no_anggota'];
                                    $nid        = $r2['nama'];
                                    $id         = $r2['id'];
                            ?>
                                    <tr>
                                        <td scope="row"><?php echo htmlspecialchars($r2['no_anggota']) ?></td>
                                        <td scope="row"><?php echo htmlspecialchars($r2['nama']) ?></td>
                                        <td scope="row"><?php echo htmlspecialchars($r2['nim']) ?></td>
                                        <td scope="row"><?php echo htmlspecialchars($r2['no_wa']) ?></td>
                                        <td scope="row"><?php echo htmlspecialchars($r2['ttl']) ?></td>
                                        <td scope="row"><?php echo htmlspecialchars($r2['alamat']) ?></td>
                                        <td scope="row"><?php echo htmlspecialchars($r2['kelamin']) ?></td>
                                        <td scope="row"><?php echo htmlspecialchars($r2['agama']) ?></td>
                                        <td scope="row"><?php echo htmlspecialchars($r2['fakultas']) ?></td>
                                        <td scope="row"><?php echo htmlspecialchars($r2['jurusan']) ?></td>
                                        <td scope="row"><?php echo htmlspecialchars($r2['email']) ?></td>
                                        <td scope="row">
                                            <a href="data_anggota.php?op=edit&nid=<?php echo $nid ?>"><button type="button" class="btn btn-warning"><i class="bi bi-pencil-square"></i></button></a>
                                            <a href="data_anggota.php?op=delete&aid=<?php echo $aid ?>" onclick="return confirm('Yakin hapus data?')"><button type="button" class="btn btn-danger"><i class="bi bi-trash"></i></button></a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="3">No results found</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        function toggleTheme() {
            const body = document.body;
            body.classList.toggle('dark-mode');
            body.classList.toggle('light-mode');
            const table = document.getElementById('dataTable');
            table.classList.toggle('table-dark');
            table.classList.toggle('table-light');
            const themeSwitchIcon = document.querySelector('.theme-switch i');
            themeSwitchIcon.classList.toggle('fa-moon');
            themeSwitchIcon.classList.toggle('fa-sun');
        }

        function toggleSidebar() {
            const body = document.body;
            body.classList.toggle('sidebar-hidden');
        }

        function toggleSubmenu(element) {
            element.classList.toggle('active');
        }
        document.getElementById('searchInput').addEventListener('keyup', function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll('#dataTable tbody tr');

            rows.forEach(row => {
                let cells = row.querySelectorAll('td');
                let match = false;

                cells.forEach(cell => {
                    if (cell.textContent.toLowerCase().indexOf(filter) > -1) {
                        match = true;
                    }
                });

                if (match) {
                    row.classList.remove('hidden');
                } else {
                    row.classList.add('hidden');
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>
<?php
session_start();
if (empty($_SESSION['username'])) {
?>
    <script type="text/javascript">
        alert("Harap Login Terlebih Dahulu !");
        window.location.href = '../../../index?pesan=belum_login';
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
    <title>Keuangan | Simpanan</title>
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
        <a href="../dashboard"><i class="fa-solid fa-gauge"></i> Dashboard</a>
        <div class="menu-item" onclick="toggleSubmenu(this)">
            <a href="#"><i class="fa-solid fa-users"></i> PSDA</a>
            <div class="submenu">
                <a href="../PSDA/data_anggota">Data Anggota</a>
                <a href="../PSDA/point_keaktifan">Point Keaktifan</a>
                <a href="../PSDA/register/pendaftar">Pendaftaran</a>
            </div>
        </div>
        <div class="menu-item" onclick="toggleSubmenu(this)">
            <a href="#"><i class="fa-solid fa-dollar-sign"></i> Keuangan</a>
            <div class="submenu">
                <a href="../Keuangan/simpanan">Simpanan</a>
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
        <a href="../../../config/logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
        <hr>
        <p><?php echo $versi ?></p>
    </div>
    <!-- Konten Utama -->
    <div class="main-content">
        <div class="pt-4">
            <h3><i class="bi bi-piggy-bank" style="margin-right: 10px;"></i>SIMPANAN ANGGOTA</h3>
            <hr>
            <!-- Konten -->
            <!--<div class="alert alert-danger" role="alert">-->
            <!--    <i class="bi bi-exclamation-triangle-fill" style="padding-right: 5px;"></i> Halaman ini masih dalam pengembangan. Harap jangan menekan tombol apapun yang ada pada tabel di halaman ini!-->
            <!--</div>-->
            <div class="card mt-3">
                <div class="card-header text-white bg-secondary">
                    <a href="simpanan" class="select2">SW</a>
                    <a href="ssshusp" class="select1">SS SHU SP</a>
                    <a href="total" class="select2">Akumulasi</a>
                </div>
                <div class="card-body" style="width: 100%;">
                    <?php
                    if ($error) {
                    ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $error ?>
                        </div>
                    <?php
                        header("refresh:1;url=ssshusp");
                    }
                    ?>
                    <?php
                    if ($sukses) {
                    ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $sukses ?>
                        </div>
                    <?php
                        header("refresh:1;url=ssshusp");
                    }
                    ob_end_flush();
                    ?>
                    <form action="" method="POST">
                        <div class="mb-3 row">
                            <label for="no-anggota" class="col-sm-2 col-form-label">No. Anggota</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="no_anggota" name="no_anggota" value="<?php echo $no_anggota ?>" disabled>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama ?>" disabled>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="tahun" class="col-sm-2 col-form-label">Jenis</label>
                            <div class="col-sm-10">
                                <select id="tahun" class="form-select" name="jenis">
                                    <option value="" selected>-Pilih Simpanan-</option>
                                    <option value="1">SS</option>
                                    <option value="2">SHU</option>
                                    <option value="3">SP</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="nominal" class="col-sm-2 col-form-label">Nominal</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="nominal" name="nominal" value="<?php echo $nama ?>">
                            </div>
                        </div>
                        <div class="col-12">
                            <input type="submit" name="sw" value="Simpan Data" class="btn btn-secondary">
                        </div>
                    </form>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header text-white bg-primary" style="width: 97%;">
                    SS SHU SP
                    <input type="text" id="searchInput" placeholder="Cari data..." style="float: right; border:none; border-radius:5px;">
                </div>
                <div class="card-body pt-3" style="overflow-y: auto; width:97%; padding:0;">
                    <table id="dataTable" class="table table-dark table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">No. Anggota</th>
                                <th scope="col">Nama</th>
                                <th scope="col">SS</th>
                                <th scope="col">SHU</th>
                                <th scope="col">SP</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql2       = "SELECT * FROM simpanan ORDER BY id ASC";
                            $result     = $conn->query($sql2);
                            if ($result->num_rows > 0) :
                                while ($r2 = $result->fetch_assoc()) :
                                    $id         = $r2['id'];
                            ?>
                                    <tr>
                                        <td scope="row"><?php echo htmlspecialchars($r2['no_anggota']) ?></td>
                                        <td scope="row"><?php echo htmlspecialchars($r2['nama']) ?></td>
                                        <td scope="row">Rp. <?php echo htmlspecialchars($r2['ss']) ?></td>
                                        <td scope="row">Rp. <?php echo htmlspecialchars($r2['shu']) ?></td>
                                        <td scope="row">Rp. <?php echo htmlspecialchars($r2['sp']) ?></td>
                                        <td scope="row">
                                            <a href="ssshusp?op=ssshusp&id=<?php echo $id ?>"><button type="button" class="btn btn-warning"><i class="bi bi-pencil-square"></i></button></a>
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
            <!-- Batas Konten -->
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
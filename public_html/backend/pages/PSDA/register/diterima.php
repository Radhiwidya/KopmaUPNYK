<?php
session_start();
if (empty($_SESSION['username'])) {
?>
    <script type="text/javascript">
        alert("Harap Login Terlebih Dahulu !");
        window.location.href = '../../../../index?pesan=belum_login';
    </script>
<?php
}
include '../../../../config/config.php';
include '../../../../config/config2.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PSDA | Pendaftaran</title>
    <link rel="icon" href="../../../assets/images/Icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../../assets/style/style.css">
</head>

<body class="dark-mode">
    <nav class="header navbar fixed-top">
        <a class="navbar-brand" href="#">
            <img src="../../../assets/images/Logo.png" alt="Logo Kopma" height="45" style="padding-left: 40px;">
        </a>
        <div class="theme-switch" onclick="toggleTheme()">
            <i class="fas fa-moon"></i>
        </div>
        <div class="sidebar-toggle" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </div>
    </nav>
    <div class="sidebar">
        <a href="../../dashboard"><i class="fa-solid fa-gauge"></i> Dashboard</a>
        <div class="menu-item" onclick="toggleSubmenu(this)">
            <a href="#"><i class="fa-solid fa-users"></i> PSDA</a>
            <div class="submenu">
                <a href="../data_anggota">Data Anggota</a>
                <a href="../point_keaktifan">Point Keaktifan</a>
                <a href="../register/pendaftar">Pendaftaran</a>
            </div>
        </div>
        <div class="menu-item" onclick="toggleSubmenu(this)">
            <a href="#"><i class="fa-solid fa-dollar-sign"></i> Keuangan</a>
            <div class="submenu">
                <a href="../../Keuangan/simpanan">Simpanan</a>
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
        <a href="../../../../config/logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
        <hr>
        <p><?php echo $versi ?></p>
    </div>
    <!-- Konten Utama -->
    <div class="main-content">
        <div class="pt-4">
            <h3><i class="bi bi-person-add" style="margin-right: 10px;"></i>PENDAFTARAN
                <a href="../../../../frontend/pages/Form_Pendaftaran/form" target="_blank"><button style="float: right;" class="btn btn-outline-primary t1">Form Pendaftaran</button></a>
            </h3>
            <hr>
            <!-- Konten -->
            <div class="card mt-3">
                <div class="card-header text-white bg-secondary">
                    <a href="pendaftar" class="select2">Pendaftar</a>
                    <a href="konfirmasi" class="select2">Konfirmasi</a>
                    <a href="diterima" class="select1">Di terima</a>
                    <input type="text" class="input" id="searchInput" placeholder="Cari data..." style="float: right; border:none; border-radius:5px;">
                </div>
                <div class="card-body" style="overflow-y: auto; width:95%;">
                    <a href="diterima?op=remove" onclick="return confirm('Apa anda yakin hapus semua data?')"><button style="float: right; margin-bottom:15px;" class="btn btn-danger t1">Hapus Semua Data Diterima</button></a>
                    <a href="diterima?op=pindah" onclick="return confirm('Apa anda yakin salin semua data?')"><button style="float: right; margin-bottom:15px; margin-right:10px;" class="btn btn-success t1">Pindah ke DB Anggota</button></a>
                    <form action="" method="POST">
                        <select id="jenis" class="input" name="jenis" required>
                            <option value="" selected>-Pilih Jenis Link-</option>
                            <option value="1">Link Keluarga Kopma</option>
                            <option value="2">Link Diklat</option>
                        </select>
                        <input class="input" type="text" name="link" placeholder="Link grup WhatsApp">
                        <button class="button" type="submit" name="save">Submit</button>
                    </form>
                    <table id="tableLink" class="table table-dark table-bordered">
                        <tr>
                            <th scope="row">Link Keluarga Kopma</th>
                            <th scope="row">Aksi</th>
                        </tr>
                        <tr>
                            <td scope="row"><?php echo $link1 ?></td>
                            <td scope="row"><a href="diterima?op=hapuswakeluarga&id=<?php echo $id1 ?>" onclick="return confirm('Yakin hapus link keluarga kopma?')"><button type="button" class="btn btn-danger"><i class="bi bi-trash"></i></button></td>
                        </tr>
                    </table>
                    <table id="tableLink" class="table table-dark table-bordered">
                        <tr>
                            <th scope="row">Link Peserta Diklat</th>
                            <th scope="row">Aksi</th>
                        </tr>
                        <tr>
                            <td scope="row"><?php echo $link2 ?></td>
                            <td scope="row"><a href="diterima?op=hapuswadiklat&id=<?php echo $id2 ?>" onclick="return confirm('Yakin hapus link peserta diklat?')"><button type="button" class="btn btn-danger"><i class="bi bi-trash"></i></button></td>
                        </tr>
                    </table>
                    <table id="dataTable" class="table table-dark table-striped table-hover table-bordered" style="width: max-content;">
                        <thead>
                            <tr>
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
                            $sql2       = "SELECT * FROM diterima ORDER BY id ASC";
                            $result     = $conn->query($sql2);
                            if ($result->num_rows > 0) :
                                while ($r2 = $result->fetch_assoc()) :
                                    $id         = $r2['id'];
                            ?>
                                    <tr>
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
                                            <a href="diterima?op=hapus&id=<?php echo $id ?>" onclick="return confirm('Yakin hapus data <?php echo $r2['nama'] ?>?')"><button type="button" class="btn btn-danger"><i class="bi bi-trash"></i></button></a>
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
            const table2 = document.getElementById('tableLink');
            table2.classList.toggle('table-dark');
            table2.classList.toggle('table-light');
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
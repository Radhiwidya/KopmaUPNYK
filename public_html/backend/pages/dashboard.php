<?php
session_start();
if (empty($_SESSION['username'])) {
?>
    <script type="text/javascript">
        alert("Harap Login Terlebih Dahulu !");
        window.location.href = '../../index?pesan=belum_login';
    </script>
<?php
}
include '../../config/config2.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="icon" href="../assets/images/Icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/style/style.css">
</head>

<body class="dark-mode">
    <nav class="header navbar fixed-top">
        <a class="navbar-brand" href="#">
            <img src="../assets/images/Logo.png" alt="Logo Kopma" height="45" style="padding-left: 40px;">
        </a>
        <div class="theme-switch" onclick="toggleTheme()">
            <i class="fas fa-moon"></i>
        </div>
        <div class="sidebar-toggle" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </div>
    </nav>
    <div class="sidebar">
        <a href="dashboard"><i class="fa-solid fa-gauge"></i> Dashboard</a>
        <div class="menu-item" onclick="toggleSubmenu(this)">
            <a href="#"><i class="fa-solid fa-users"></i> PSDA</a>
            <div class="submenu">
                <a href="PSDA/data_anggota">Data Anggota</a>
                <a href="PSDA/point_keaktifan">Point Keaktifan</a>
                <a href="PSDA/register/pendaftar">Pendaftaran</a>
            </div>
        </div>
        <div class="menu-item" onclick="toggleSubmenu(this)">
            <a href="#"><i class="fa-solid fa-dollar-sign"></i> Keuangan</a>
            <div class="submenu">
                <a href="Keuangan/simpanan">Simpanan</a>
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
        <a href="../../config/logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
        <hr>
        <p><?php echo $versi ?></p>
    </div>
    <!-- Konten Utama -->
    <div class="main-content">
        <div class="pt-4"></div>
        <h3><i class="fa-solid fa-gauge" style="margin-right: 10px;"></i>DASHBOARD</h3>
        <hr>
        <div class="row row-cols-1">
            <div class="card bg-secondary notif">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="bi bi-people ico"></i>
                    </div>
                    <h5 class="card-title text-white">Total Anggota</h5>
                    <div class="display-4 text-white"><?php echo $jumlah1 ?></div>
                    <a href="PSDA/data_anggota" class="view">
                        <p class="card-text text-white">Lihat Detail <i class="bi bi-caret-right"></i></p>
                    </a>
                </div>
            </div>
            <div class="card bg-primary notif">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="bi bi-person-add ico"></i>
                    </div>
                    <h5 class="card-title text-white">Pendaftar</h5>
                    <div class="display-4 text-white"><?php echo $jumlah2 ?></div>
                    <a href="PSDA/register/pendaftar" class="view">
                        <p class="card-text text-white">Lihat Detail <i class="bi bi-caret-right"></i></p>
                    </a>
                </div>
            </div>
            <div class="card bg-danger notif">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="bi bi-person-check ico"></i>
                    </div>
                    <h5 class="card-title text-white">Di terima</h5>
                    <div class="display-4 text-white"><?php echo $jumlah3 ?></div>
                    <a href="PSDA/register/diterima" class="view">
                        <p class="card-text text-white">Lihat Detail <i class="bi bi-caret-right"></i></p>
                    </a>
                </div>
            </div>

            <div class="card bg-success notif">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="bi bi-clock ico"></i>
                    </div>
                    <h5 class="card-title text-white">Coming Soon</h5>
                    <div class="display-4 text-white">xxx</div>
                    <a href="#" class="view">
                        <p class="card-text text-white">Lihat Detail <i class="bi bi-caret-right"></i></p>
                    </a>
                </div>
            </div>
            <div class="card bg-info notif">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="bi bi-clock ico"></i>
                    </div>
                    <h5 class="card-title text-white">Coming Soon</h5>
                    <div class="display-4 text-white">xxx</div>
                    <a href="#" class="view">
                        <p class="card-text text-white">Lihat Detail <i class="bi bi-caret-right"></i></p>
                    </a>
                </div>
            </div>
            <div class="card bg-warning notif">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="bi bi-clock ico"></i>
                    </div>
                    <h5 class="card-title text-white">Coming Soon</h5>
                    <div class="display-4 text-white">xxx</div>
                    <a href="#" class="view">
                        <p class="card-text text-white">Lihat Detail <i class="bi bi-caret-right"></i></p>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script>
        function toggleTheme() {
            const body = document.body;
            body.classList.toggle('dark-mode');
            body.classList.toggle('light-mode');
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
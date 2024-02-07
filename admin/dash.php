<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Halaman Admin PT Crystal Biru Meuligo</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.theme.default.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
</head>

<body>
    <?php
    include '../koneksi.php';
    //Buat Sesi
    session_start();
    if (empty($_SESSION['login'])) {
        header("Location:../index.php");
    }
    function greetings()
    {
        date_default_timezone_set('Asia/Jakarta'); // Ganti dengan zona waktu yang sesuai

        $currentHour = date('G');

        if ($currentHour >= 5 && $currentHour < 12) {
            return "Selamat Pagi!";
        } elseif ($currentHour >= 12 && $currentHour < 15) {
            return "Selamat Siang!";
        } elseif ($currentHour >= 15 && $currentHour < 18) {
            return "Selamat Siang!";
        } else {
            return "Selamat Malam!";
        }
    }
    $sapaan = greetings();
    // Jumlah Agensi
    $agensi = "SELECT * FROM agensi";
    $result_agensi = mysqli_query($koneksi, $agensi);
    $jumlahagensi = mysqli_num_rows($result_agensi);
    // Jumlah Pengaduan
    $pengaduan = "SELECT * FROM pengaduan";
    $result_pengaduan = mysqli_query($koneksi, $pengaduan);
    $jumlahpengaduan = mysqli_num_rows($result_pengaduan);
    // Jumlah Admin
    $admin = "SELECT * FROM login WHERE role='admin';";
    $result_admin = mysqli_query($koneksi, $admin);
    $jumlahadmin = mysqli_num_rows($result_admin);
    // Jumlah User Terverifikasi
    $userverify = "SELECT * FROM login WHERE status=1";
    $result_userverify = mysqli_query($koneksi, $userverify);
    $jumlahterverfikasi = mysqli_num_rows($result_userverify);
    // Jumlah Pendaftaran
    $daftar = "SELECT * FROM daftar";
    $result_daftar = mysqli_query($koneksi, $daftar);
    $jumlahpendaftar = mysqli_num_rows($result_daftar);
    // Jumlah diterima
    $terima = "SELECT * FROM daftars WHERE terima=terima";
    $result_terima = mysqli_query($koneksi, $terima);
    $jumlahditerima = mysqli_num_rows($result_terima);
    // Jumlah Aktif
    $aktif = "SELECT * FROM daftars WHERE aktif='aktif'";
    $result_aktif = mysqli_query($koneksi, $aktif);
    $jumlahaktif = mysqli_num_rows($result_aktif);
    // Jumlah Data Kepergian
    $taiwan = "SELECT * FROM daftars WHERE negara='Taiwan'";
    $result_taiwan = mysqli_query($koneksi, $taiwan);
    $jumlahtaiwan = mysqli_num_rows($result_taiwan);

    $malaysia = "SELECT * FROM daftars WHERE negara='Malaysia'";
    $result_malaysia = mysqli_query($koneksi, $malaysia);
    $jumlahmalaysia = mysqli_num_rows($result_malaysia);

    $singapura = "SELECT * FROM daftars WHERE negara='Singapura'";
    $result_singapura = mysqli_query($koneksi, $singapura);
    $jumlahsingapura = mysqli_num_rows($result_singapura);

    $korsel = "SELECT * FROM daftars WHERE negara='Korea Selatan'";
    $result_korsel = mysqli_query($koneksi, $korsel);
    $jumlahkorsel = mysqli_num_rows($result_korsel);

    $hongkong = "SELECT * FROM daftars WHERE negara='Hong Kong'";
    $result_hongkong = mysqli_query($koneksi, $hongkong);
    $jumlahhongkong = mysqli_num_rows($result_hongkong);

    $japan = "SELECT * FROM daftars WHERE negara='Jepang'";
    $result_japan = mysqli_query($koneksi, $japan);
    $jumlahjapan = mysqli_num_rows($result_japan);
    ?>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        <?php include("include/sidebar.php"); ?>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_navbar.html -->
            <?php include("include/navbar.php"); ?>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <h2><?php echo $sapaan; ?>, Admin</h2><br>
                    <div class="row">
                        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-9">
                                            <div class="d-flex align-items-center align-self-start">
                                                <h2 class="mb-0"><?php echo $jumlahagensi ?></h2>
                                            </div>
                                        </div>
                                    </div><br>
                                    <h6 class="text-muted font-weight-normal">Jumlah Agency</h6>
                                    <a href="daftar_admin.php" class="btn btn-primary">Lihat Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-9">
                                            <div class="d-flex align-items-center align-self-start">
                                                <h2 class="mb-0"><?php echo $jumlahadmin ?></h2>
                                            </div>
                                        </div>
                                    </div><br>
                                    <h6 class="text-muted font-weight-normal">Jumlah Admin</h6>
                                    <a href="daftar_admin2.php" class="btn btn-primary">Lihat Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-9">
                                            <div class="d-flex align-items-center align-self-start">
                                                <h2 class="mb-0"><?php echo $jumlahpengaduan ?></h2>
                                            </div>
                                        </div>
                                    </div><br>
                                    <h6 class="text-muted font-weight-normal">Jumlah Pengaduan</h6>
                                    <a href="daftar_pengaduan.php" class="btn btn-primary">Lihat Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-9">
                                            <div class="d-flex align-items-center align-self-start">
                                                <h2 class="mb-0"><?php echo $jumlahpendaftar ?></h2>
                                            </div>
                                        </div>
                                    </div><br>
                                    <h6 class="text-muted font-weight-normal">Jumlah Pendaftar</h6>                         
                                    <a href="admin.php" class="btn btn-primary">Lihat Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <?php include("include/footer.php"); ?>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <script src="assets/vendors/progressbar.js/progressbar.min.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
    <script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/dashboard.js"></script>
    <!-- End custom js for this page -->
</body>

</html>
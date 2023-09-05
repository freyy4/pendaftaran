<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pendaftaran TKI Online | Verifikasi | Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .content {
            max-height: calc(100vh - 100px);
            padding: 20px;
        }

        .footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px;
            position: absolute;
            bottom: 0;
            width: 100%;
        }

        h2,
        h1 {
            font-weight: bold;
        }

        h2 {
            text-transform: capitalize;
        }

        a.password {
            font-size: 10px;
        }

        .container-fluid {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <?php
    include '../koneksi.php';
    //Buat Sesi
    session_start();
    if (empty($_SESSION['login'])) {
        header("Location:../login_admin.php");
    }
    // Jumlah Admin
    $admin = "SELECT * FROM admin";
    $result_admin = mysqli_query($koneksi, $admin);
    $jumlahadmin = mysqli_num_rows($result_admin);
    // Jumlah User Terverifikasi
    $userverify = "SELECT * FROM login WHERE status=1";
    $result_userverify = mysqli_query($koneksi, $userverify);
    $jumlahterverfikasi = mysqli_num_rows($result_userverify);
    // Jumlah Pendaftaran
    $daftar = "SELECT * FROM daftars";
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
    // Buat Greeting
    date_default_timezone_set('Asia/Jakarta');
    $hour = date('H');
    if ($hour < 12) {
        $greeting = "Selamat Pagi";
    } elseif ($hour < 15) {
        $greeting = "Selamat Siang";
    } elseif ($hour < 19) {
        $greeting = "Selamat Sore";
    } else {
        $greeting = "Selamat Malam";
    }
    ?>

    <?php include 'include/navbar.php'; ?>
    <div class="container content">
        <h2><?php echo $greeting; ?> </h2><br>
        <div class="row">
            <div class="col-md-12">
                <div class="card text-white bg-danger mb-3">
                    <div class="card-body">
                        <h1 class="card-title"><?php echo $jumlahadmin; ?></h1>
                        <p class="card-text">Jumlah Admin.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h1 class="card-title"><?php echo $jumlahterverfikasi; ?></h1>
                        <p class="card-text">Jumlah User yang Terverifikasi ✔.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card text-white bg-dark mb-3">
                    <div class="card-body">
                        <h1 class="card-title"><?php echo $jumlahditerima; ?></h1>
                        <p class="card-text">Data Pendaftaran yang sudah diterima.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h1 class="card-title"><?php echo $jumlahaktif; ?></h1>
                        <p class="card-text">Data Pendaftaran yang sudah Aktif.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
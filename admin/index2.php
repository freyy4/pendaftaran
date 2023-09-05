<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pendaftaran TKI Online | Riwayat Pendidikan</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">Pendaftaran TKI Online</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">

                </ul>
            </div>
        </div>
    </nav>
    <?php
    if (isset($_POST['daftar'])) {
        $id_pendaftaran = $_POST['id_pendaftaran'];
        $nik = $_POST['nik'];
        $nama_lengkap = $_POST['nama_lengkap'];
        $tempat_lahir = $_POST['tempat_lahir'];
        $tgl_lahir =  $_POST["tgl_lahir"];
        $status = $_POST['status'];
        $tinggi = $_POST['tinggi'];
        $berat = $_POST['berat'];
        $provinsi = $_POST['provinsi'];
        $kota = $_POST['kota'];
        $kecamatan = $_POST['kecamatan'];
        $desa = $_POST['desa'];
        $alamat_lengkap = $_POST['alamat_lengkap'];
        $telepon = $_POST['telepon'];
        $targetktp = "../ktp/";
        $targetselfie = "../selfie/";
        $foto_ktp = $targetktp . basename($_FILES['foto_ktp']['name']);
        $selfie_ktp = $targetselfie . basename($_FILES['selfie_ktp']['name']);
        move_uploaded_file($_FILES['foto_ktp']['tmp_name'], $foto_ktp);
        move_uploaded_file($_FILES['selfie_ktp']['tmp_name'], $selfie_ktp);
        include "koneksi.php";
        $insert = mysqli_query($koneksi, "INSERT INTO daftars (id_pendaftaran, nik, nama_lengkap, tempat_lahir, tgl_lahir, status, tinggi, berat, id_provinsi, id_kota, id_kecamatan, id_desa, alamat_lengkap, foto_ktp, selfie_ktp, telepon, terima, aktif) VALUES ('$id_pendaftaran', '$nik', '$nama_lengkap', '$tempat_lahir', '$tgl_lahir', '$status', '$tinggi', '$berat', '$provinsi', '$kota', '$kecamatan', '$desa', '$alamat_lengkap', '$foto_ktp', '$selfie_ktp', '62$telepon', 'tolak', 'nonaktif');");
    }
    include '../koneksi.php';
    session_start();
    if (empty($_SESSION['login'])) {
        header("Location:../login_admin.php");
    }
    ?>
    <div class="container">
        <form method="post" action="index3.php" enctype="multipart/form-data">
            <input type="hidden" name="id_pendaftaran" value="<?php echo $id_pendaftaran ?>">
            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama Sekolah *</th>
                            <th>Tanggal Masuk Sekolah *</th>
                            <th>Tanggal Lulus Sekolah *</th>
                            <th>Ijazah Sekolah *</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <tr>
                            <td>
                                <input type="text" class="form-control" name="nama_sekolah[]" placeholder="Masukkan Nama Sekolah" multiple>
                            </td>
                            <td>
                                <input type="date" class="form-control" name="tgl_masuk_sekolah[]" multiple>
                            </td>
                            <td>
                                <input type="date" class="form-control" name="tgl_lulus_sekolah[]" multiple>
                            </td>
                            <td>
                                <input type="file" class="form-control" name="ijazah_sekolah[]" multiple>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <p>Klik "&plus; Tambah Data" jika Anda mempunyai data lebih dari 1</p>
                <button type="button" class="btn btn-success form-control" id="add-row-btn">&plus; Tambah Baris</button>
            </div>
            <button type="submit" class="btn btn-primary form-control" name="daftar">Lanjut</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const addRowBtn = document.getElementById("add-row-btn");
            const tableBody = document.getElementById("table-body");

            addRowBtn.addEventListener("click", function() {
                const newRow = document.createElement("tr");
                newRow.innerHTML = `
                    <td>
                        <input type="text" class="form-control" name="nama_sekolah[]" placeholder="Masukkan Nama Sekolah" multiple>
                    </td>
                    <td>
                        <input type="date" class="form-control" name="tgl_masuk_sekolah[]" multiple>
                    </td>
                    <td>
                        <input type="date" class="form-control" name="tgl_lulus_sekolah[]" multiple>
                    </td>
                    <td>
                        <input type="file" class="form-control" name="ijazah_sekolah[]" multiple>
                    </td>
                `;

                tableBody.appendChild(newRow);
            });
        });
    </script>
</body>

</html>
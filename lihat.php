<!DOCTYPE html>
<html>

<head>
    <title>Pendaftaran TKI Online | Halaman Profil</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <style>
        .custom-alert {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <?php
    session_start();

    if (!isset($_SESSION['id_daftar'])) {
        header("Location: login.php");
        exit();
    }

    $id_daftar = $_SESSION['id_daftar'];

    include 'koneksi.php';

    $sql = "SELECT d.id_daftar, d.nik, d.nama_lengkap, d.status, d.tempat_lahir, d.tgl_lahir, d.tinggi, d.berat, d.foto_ktp, d.selfie_ktp, d.telepon, d.terima, d.aktif, p.nama AS provinsi, k.nama AS kota, kc.nama AS kecamatan, ds.nama AS desa, d.alamat_lengkap FROM daftars d JOIN provinsi p ON d.id_provinsi = p.id_provinsi JOIN kota k ON d.id_kota = k.id_kota JOIN kecamatan kc ON d.id_kecamatan = kc.id_kecamatan JOIN desa ds ON d.id_desa = ds.id_desa WHERE id_daftar=?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("i", $id_daftar);
    $stmt->execute();
    $result = $stmt->get_result();
    $profil = $result->fetch_assoc();

    $sql2 = "SELECT * FROM sekolah WHERE id_daftar=?";
    $stmt2 = $koneksi->prepare($sql2);
    $stmt2->bind_param("i", $id_daftar);
    $stmt2->execute();
    $result2 = $stmt2->get_result();

    $data_sekolah = array(); // Array untuk menyimpan data sekolah

    if ($result2->num_rows > 0) {
        while ($row = $result2->fetch_assoc()) {
            $data_sekolah[] = array(
                'nama_sekolah' => $row['nama_sekolah'],
                'tgl_masuk_sekolah' => $row['tgl_masuk_sekolah'],
                'tgl_lulus_sekolah' => $row['tgl_lulus_sekolah']
            );
        }
    }

    $sql3 = "SELECT * FROM pengalaman WHERE id_daftar=?";
    $stmt3 = $koneksi->prepare($sql3);
    $stmt3->bind_param("i", $id_daftar);
    $stmt3->execute();
    $result3 = $stmt3->get_result();

    $data_pengalaman = array(); // Array untuk menyimpan data pengalaman

    if ($result3->num_rows > 0) {
        while ($row = $result3->fetch_assoc()) {
            $data_pengalaman[] = array(
                'nama_perusahaan' => $row['nama_perusahaan'],
                'tgl_masuk_perusahaan' => $row['tgl_masuk_perusahaan'],
                'tgl_keluar_perusahaan' => $row['tgl_keluar_perusahaan'],
                'pekerjaan' => $row['pekerjaan'],
                'jabatan' => $row['jabatan'],
                'keterangan' => $row['keterangan']
            );
        }
    }

    $sql4 = "SELECT * FROM pelatihan WHERE id_daftar=?";
    $stmt4 = $koneksi->prepare($sql4);
    $stmt4->bind_param("i", $id_daftar);
    $stmt4->execute();
    $result4 = $stmt4->get_result();

    $data_pelatihan = array(); // Array untuk menyimpan data pelatihan

    if ($result4->num_rows > 0) {
        while ($row = $result4->fetch_assoc()) {
            $data_pelatihan[] = array(
                'instansi' => $row['instansi'],
                'tgl_keluar_sertifikat' => $row['tgl_keluar_sertifikat'],
                'no_sertifikat' => $row['no_sertifikat'],
                'jenis' => $row['jenis'],
                'uraian' => $row['uraian']
            );
        }
    }
    $stmt->close();
    $stmt2->close();
    $stmt3->close();
    $stmt4->close();
    $koneksi->close();
    ?>

    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">Pendaftaran TKI Online | Halaman Profil</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <!-- Ganti ikon hamburger default dengan ikon yang sesuai -->
                <span class="navbar-toggler-icon">☰</span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" target="_blank" href="generate.php" title="Cetak Profil Anda">Print Profil Anda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php" onclick="fungsi()" title="Keluar dari Akun">Keluar</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                Data Pribadi
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <?php if ($profil) : ?>
                            <p class="card-title">Nama Lengkap <br>
                            <h3><?php echo $profil['nama_lengkap']; ?></h3>
                            </p>
                            <p class="card-text">Nomor Induk Kependudukan <br>
                            <h3><?php echo $profil['nik']; ?></h3>
                            </p>
                            <p class="card-text">Tempat/Tanggal Lahir <br>
                            <h3><?php echo $profil['tempat_lahir']; ?>, <?php echo $profil['tgl_lahir']; ?></h2>
                                </p>
                                <p class="card-text">Status Perkawinan <br>
                                <h3><?php echo $profil['status']; ?></h3>
                                </p>
                                <p class="card-text">Tinggi Badan <br>
                                <h3><?php echo $profil['tinggi']; ?> cm</h2>
                                    </p>
                                    <p class="card-text">Berat Badan <br>
                                    <h3><?php echo $profil['berat']; ?> kg</h2>
                                        </p>
                                        <p class="card-text">Provinsi <br>
                                        <h3><?php echo $profil['provinsi']; ?></h2>
                                            </p>
                                            <p class="card-text">Kabupaten/Kota <br>
                                            <h3><?php echo $profil['kota']; ?></h2>
                                                </p>
                                                <p class="card-text">Kecamatan <br>
                                                <h3><?php echo $profil['kecamatan']; ?></h2>
                                                    </p>
                                                    <p class="card-text">Desa/Kelurahan <br>
                                                    <h3><?php echo $profil['desa']; ?></h2>
                                                        </p>
                                                        <p class="card-text">Nomor Telepon <br>
                                                        <h3><?php echo $profil['telepon']; ?></h2>
                                                            </p>
                                                        <?php else : ?>
                                                            <p class="card-text">Data Pendaftaran belum diisi.</p>
                                                        <?php endif; ?>
                    </div>
                    <div class="col-md-6 text-right">
                        <img src="<?php echo $profil['foto_ktp']; ?>" alt=""><br><br>
                        <img src="<?php echo $profil['selfie_ktp']; ?>" alt="">
                    </div>
                </div>
            </div>
            <a href="edit.php?id_daftar=<?php echo $profil['id_daftar']; ?>" class="btn btn-primary">Edit Data Diri</a>
        </div>
    </div>

    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                Data Sekolah
            </div>
            <div class="card-body">
                <?php if (!empty($data_sekolah)) : ?>
                    <ol>
                        <?php foreach ($data_sekolah as $sekolah) : ?>
                            <li>
                                <strong>Nama Sekolah:</strong> <?php echo $sekolah['nama_sekolah']; ?><br>
                                <strong>Tanggal Masuk Sekolah:</strong> <?php echo $sekolah['tgl_masuk_sekolah']; ?><br>
                                <strong>Tanggal Lulus Sekolah:</strong> <?php echo $sekolah['tgl_lulus_sekolah']; ?>
                            </li><br>
                        <?php endforeach; ?>
                    </ol>
                <?php else : ?>
                    <p class="card-text">Data Sekolah belum diisi.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>


    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                Data Pengalaman Bekerja
            </div>
            <div class="card-body">
                <?php if (!empty($data_pengalaman)) : ?>
                    <ol>
                        <?php foreach ($data_pengalaman as $pengalaman) : ?>
                            <li>
                                <strong>Nama Perusahaan:</strong> <?php echo $pengalaman['nama_perusahaan']; ?><br>
                                <strong>Tanggal Masuk Perusahaan:</strong> <?php echo $pengalaman['tgl_masuk_perusahaan']; ?><br>
                                <strong>Tanggal Keluar Perusahaan:</strong> <?php echo $pengalaman['tgl_keluar_perusahaan']; ?><br>
                                <strong>Pekerjaan:</strong> <?php echo $pengalaman['pekerjaan']; ?><br>
                                <strong>Jabatan:</strong> <?php echo $pengalaman['jabatan']; ?><br>
                            </li><br>
                        <?php endforeach; ?>
                    </ol>
                <?php else : ?>
                    <p class="card-text">Data Pengalaman Bekerja belum diisi.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                Data Pelatihan
            </div>
            <div class="card-body">
                <?php if (!empty($data_pelatihan)) : ?>
                    <ol>
                        <?php foreach ($data_pelatihan as $pelatihan) : ?>
                            <li>
                                <strong>Instansi:</strong> <?php echo $pelatihan['instansi']; ?><br>
                                <strong>Tanggal Keluar Sertifikat:</strong> <?php echo $pelatihan['tgl_keluar_sertifikat']; ?><br>
                                <strong>Nomor Sertifikat:</strong> <?php echo $pelatihan['no_sertifikat']; ?><br>
                                <strong>Jenis:</strong> <?php echo $pelatihan['jenis']; ?><br>
                                <strong>Uraian:</strong> <?php echo $pelatihan['uraian']; ?>
                            </li><br>
                        <?php endforeach; ?>
                    </ol>
                <?php else : ?>
                    <p class="card-text">Data Pelatihan belum diisi.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

<script>
    function fungsi() {
        alert("Apa Anda yakin ingin keluar");
    }
</script>

</html>
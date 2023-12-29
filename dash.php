<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
    <title>Landing Page</title>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .navbar {
            background-color: #ffffff;
        }

        .navbar-brand {
            font-size: 24px;
            font-weight: bold;
        }

        .card {
            margin: 20px;
            border: none;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <?php
        $id_daftar = $_SESSION['id_daftar'];
    ?>
    <?php
    session_start();
    if (empty($_SESSION['login'])) {
        header("Location:index.php");
    }
    ?>
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand" href="#">PT. CRYSTAL BIRU MEULIGO</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Dashboard</a>
                </li>
                <li class="nav-item dropdown">
                    <?php
                    $nama = $_SESSION['nama'];
                    $initials = strtoupper(substr($nama, 0, 2)); // Ambil dua huruf kapital pertama dari nama
                    ?>
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <!-- Tambahkan gambar bulat dengan latar belakang warna -->
                        <div class="profile-image" style="background-color: #007bff; border-radius: 50%; width: 30px; height: 30px; display: inline-block; text-align: center; color: #fff; line-height: 30px; font-weight: bold;">
                            <?php echo $initials; ?>
                        </div>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="profil.php">Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" href="logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>


    <?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pendaftaran TKI Online</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
</head>

<body>
    <?php
    include "koneksi.php";
    $id_daftar = $_SESSION['id_daftar'];
    if (strpos($id_daftar, 'CBM-PMI-') === 0) {
        $sql = "SELECT d.id_daftar, d.nik, d.nama_lengkap, d.status, d.tempat_lahir, d.tgl_lahir, d.tinggi, d.berat, d.foto_ktp, d.pas, d.selfie_ktp, d.telepon, d.terima, d.aktif, d.pekerjaan, d.negara, p.nama AS provinsi, k.nama AS kota, kc.nama AS kecamatan, ds.nama AS desa, d.alamat_lengkap FROM daftar d JOIN provinsi p ON d.id_provinsi = p.id_provinsi JOIN kota k ON d.id_kota = k.id_kota JOIN kecamatan kc ON d.id_kecamatan = kc.id_kecamatan JOIN desa ds ON d.id_desa = ds.id_desa WHERE d.id_daftar=?";
        $stmt = $koneksi->prepare($sql);
        $stmt->bind_param("s", $id_daftar);
        $stmt->execute();
        $result = $stmt->get_result();
        $row1 = $result->fetch_assoc();

        $sql2 = "SELECT * FROM sekolah WHERE id_daftar=?";
        $stmt2 = $koneksi->prepare($sql2);
        $stmt2->bind_param("s", $id_daftar);
        $stmt2->execute();
        $result2 = $stmt2->get_result();

        $data_sekolah = array(); // Array untuk menyimpan data sekolah

        if ($result2->num_rows > 0) {
            while ($row = $result2->fetch_assoc()) {
                $data_sekolah[] = array(
                    'nama_sekolah' => $row['nama_sekolah'],
                    'tgl_masuk_sekolah' => $row['tgl_masuk_sekolah'],
                    'tgl_lulus_sekolah' => $row['tgl_lulus_sekolah'],
                    'ijazah_sekolah' => $row['ijazah_sekolah']
                );
            }
        }

        $sql3 = "SELECT * FROM pengalaman WHERE id_daftar=?";
        $stmt3 = $koneksi->prepare($sql3);
        $stmt3->bind_param("s", $id_daftar);
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
                    'keterangan' => $row['keterangan'],
                    'sertifikasi' => $row['sertifikasi']
                );
            }
        }
        $sql4 = "SELECT * FROM pelatihan WHERE id_daftar=?";
        $stmt4 = $koneksi->prepare($sql4);
        $stmt4->bind_param("s", $id_daftar);
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
                    'uraian' => $row['uraian'],
                    'sertifikat' => $row['sertifikat']
                );
            }
        }
        $stmt->close();
        $stmt2->close();
        $stmt3->close();
        $stmt4->close();
        $koneksi->close();
    } else {
        echo "";
    }
    ?>
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="card" style="border-radius: 1rem;">
                <div class="card-body p-5">
                    <h1>Data Diri</h1><br>
                    <!-- Isi Data Diri di sini -->
                    <?php if ($row1) : ?>
                        <div class="row">
                            <div class="col-12 text-center">
                                <img src="<?php echo $row1['pas']; ?>" width="300" height="300" alt="Pas Foto">
                            </div>
                        </div><br><br>
                        <div class="row">
                            <div class="col-12 text-center">
                                <img src="<?php echo $row1['selfie_ktp']; ?>" width="150" height="150" alt="Selfie KTP">
                                <img src="<?php echo $row1['foto_ktp']; ?>" width="150" height="150" alt="Foto KTP">
                            </div>
                        </div><br><br>
                        <label>Nomor Pendaftaran</label>
                        <h3><?php echo $row1['id_daftar']; ?></h3><br><br>

                        <label>Nama Lengkap</label><br>
                        <h3><?php echo $row1['nama_lengkap']; ?></h3><br><br>

                        <label>Nomor Induk Kependudukan</label><br>
                        <h3><?php echo $row1['nik']; ?></h3><br><br>

                        <label>Tempat/Tanggal Lahir</label><br>
                        <h3><?php echo $row1['tempat_lahir']; ?>, <?php echo $row1['tgl_lahir']; ?></h3><br><br>

                        <label>Status Perkawinan</label><br>
                        <h3><?php echo $row1['status']; ?></h3><br><br>

                        <label>Tinggi Badan</label><br>
                        <h3><?php echo $row1['tinggi']; ?> cm</h3><br><br>

                        <label>Berat Badan</label><br>
                        <h3><?php echo $row1['berat']; ?> kg</h3><br><br>

                        <label>Provinsi</label><br>
                        <h3><?php echo $row1['provinsi']; ?></h3><br><br>

                        <label>Kabupaten/Kota</label><br>
                        <h3><?php echo $row1['kota']; ?></h3><br><br>

                        <label>Kecamatan</label><br>
                        <h3><?php echo $row1['kecamatan']; ?></h3><br><br>

                        <label>Desa/Kelurahan</label><br>
                        <h3><?php echo $row1['desa']; ?></h3><br><br>

                        <label>Nomor Telepon</label><br>
                        <h3><?php echo $row1['telepon']; ?></h3><br><br>

                        <label>Jenis Pekerjaan yang dipilih</label><br>
                        <h3><?php echo $row1['pekerjaan']; ?></h3><br><br>

                        <label>Negara yang dipilih</label><br>
                        <h3><?php echo $row1['negara']; ?></h3><br>
                        <a href="edit.php" class="btn btn-success form-control">Edit PMI</a>
                    <?php else : ?>
                        <p class="card-text">Data Pendaftaran belum diisi.</p>
                        <a href="daftar.php" class="btn btn-primary">Data Diri</a><br><br>
                    <?php endif; ?>
                </div>

                <div class="card-body p-5">
                    <h1>Riwayat Pendidikan.</h1><br>
                    <div class="row">
                        <?php if (!empty($data_sekolah)) : ?>
                            <?php foreach ($data_sekolah as $sekolah) : ?>
                                <div class="col-md-6 col-xl-6 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <label>Nama Sekolah:</label>
                                            <h3><?php echo $sekolah['nama_sekolah']; ?></h3><br>
                                            <label>Tanggal Masuk Sekolah:</label>
                                            <h3><?php echo $sekolah['tgl_masuk_sekolah']; ?></h3> <br>
                                            <label>Tanggal Lulus Sekolah:</label>
                                            <h3><?php echo $sekolah['tgl_lulus_sekolah']; ?></h3><br>
                                            <a href="../<?php echo $sekolah['ijazah_sekolah']; ?>" target="_blank" class="btn btn-primary">Download Ijazah dari <?php echo $sekolah['nama_sekolah']; ?></a><br><br>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <div class="col-md-6 col-xl-6 grid-margin stretch-card">
                                <p class="card-text">Data Sekolah belum diisi.</p>
                                <a href="daftar2.php" class="btn btn-primary">Tambah Sekolah</a><br><br>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php if (!empty($data_sekolah)) : ?>
                    <?php foreach ($data_sekolah as $sekolah) : ?>
                    <a href="edit2.php" class="btn btn-success form-control">Edit Sekolah</a>
                    <?php endforeach; ?>
                    <?php else : ?>
                    <?php endif; ?>
                </div>

                <div class="card-body p-5">
                    <h1>Pengalaman Bekerja.</h1><br>
                    <div class="row">
                        <?php if (!empty($data_pengalaman)) : ?>
                            <?php foreach ($data_pengalaman as $pengalaman) : ?>
                                <div class="col-md-6 col-xl-6 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <label>Nama Perusahaan:</label>
                                            <h3><?php echo $pengalaman['nama_perusahaan']; ?></h3><br>
                                            <label>Tanggal Masuk Perusahaan:</label>
                                            <h3><?php echo $pengalaman['tgl_masuk_perusahaan']; ?></h3> <br>
                                            <label>Tanggal Keluar Perusahaan:</label>
                                            <h3><?php echo $pengalaman['tgl_keluar_perusahaan']; ?></h3> <br>
                                            <label>Pekerjaan:</label>
                                            <h3><?php echo $pengalaman['pekerjaan']; ?></h3> <br>
                                            <label>Jabatan:</label>
                                            <h3><?php echo $pengalaman['jabatan']; ?></h3><br>
                                            <a href="../<?php echo $pengalaman['sertifikasi']; ?>" target="_blank" class="btn btn-primary">Download Sertifikasi dari <?php echo $pengalaman['nama_perusahaan']; ?></a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <div class="col-md-6 col-xl-6 grid-margin stretch-card">
                                    <p class="card-text">Data Pengalaman Bekerja belum diisi.</p>
                                    <a href="daftar3.php" class="btn btn-primary">Tambah Pengalaman</a><br><br>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php if (!empty($data_pengalaman)) : ?>
                    <?php foreach ($data_pengalaman as $pengalaman) : ?>
                    <a href="edit3.php" class="btn btn-success form-control">Edit Pengalaman</a>
                    <?php endforeach; ?>
                    <?php else : ?>
                    <?php endif; ?>
                </div>

                <div class="card-body p-5">
                    <h1>Riwayat Pelatihan.</h1><br>
                    <div class="row">
                        <?php if (!empty($data_pelatihan)) : ?>
                            <?php foreach ($data_pelatihan as $pelatihan) : ?>
                                <div class="col-md-6 col-xl-6 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <label>Nama Instansi:</label>
                                            <h3><?php echo $pelatihan['instansi']; ?></h3><br>
                                            <label>Tanggal Keluar Sertifikat:</label>
                                            <h3><?php echo $pelatihan['tgl_keluar_sertifikat']; ?></h3> <br>
                                            <label>Nomor Sertifikat:</label>
                                            <h3><?php echo $pelatihan['no_sertifikat']; ?></h3> <br>
                                            <label>Jenis Sertifikat:</label>
                                            <h3><?php echo $pelatihan['jenis']; ?></h3> <br>
                                            <label>Uraian Sertifikat:</label>
                                            <h3><?php echo $pelatihan['uraian']; ?></h3><br>
                                            <a href="../<?php echo $pelatihan['sertifikat']; ?>" target="_blank" class="btn btn-primary">Download Sertifikat dari <?php echo $pelatihan['instansi']; ?></a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <div class="col-md-6 col-xl-6 grid-margin stretch-card">
                                <p class="card-text">Data Pelatihan belum diisi.</p>
                                <a href="daftar4.php" class="btn btn-primary">Tambah Pelatihan</a><br><br>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php if (!empty($data_pelatihan)) : ?>
                    <?php foreach ($data_pelatihan as $pelatihan) : ?>
                    <a href="edit4.php" class="btn btn-success form-control">Edit Pelatihan</a>
                    <?php endforeach; ?>
                    <?php else : ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</body>

</html>

<?php
$_SESSION['id_daftar'] = $id_daftar;
?>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>

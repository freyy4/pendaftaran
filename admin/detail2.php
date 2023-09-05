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

    if (empty($_SESSION['login'])) {
        header("Location:../login_admin.php");
    }

    include 'koneksi.php';

    if (isset($_GET['id_daftar'])) {
        $id_daftar = $_GET['id_daftar'];

        $sql = "SELECT d.id_daftar, d.nik, d.nama_lengkap, d.status, d.tempat_lahir, d.tgl_lahir, d.tinggi, d.berat, d.foto_ktp, d.selfie_ktp, d.telepon, d.terima, d.aktif, p.nama AS provinsi, k.nama AS kota, kc.nama AS kecamatan, ds.nama AS desa, d.alamat_lengkap FROM daftars d JOIN provinsi p ON d.id_provinsi = p.id_provinsi JOIN kota k ON d.id_kota = k.id_kota JOIN kecamatan kc ON d.id_kecamatan = kc.id_kecamatan JOIN desa ds ON d.id_desa = ds.id_desa WHERE d.id_daftar=?";
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
                    'tgl_lulus_sekolah' => $row['tgl_lulus_sekolah'],
                    'ijazah_sekolah' => $row['ijazah_sekolah']
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
                    'keterangan' => $row['keterangan'],
                    'sertifikasi' => $row['sertifikasi']
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
        echo "ID Daftar tidak valid.";
    }
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
                        <a class="nav-link" href="javascript:void(0);" onclick="cetakProfil()" title="Cetak Profil Anda">Cetak Profil Anda</a>
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
            <div class="card-header bg-primary text-center">
                Data Pribadi
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                         <?php if ($profil) : ?>
                            <p>
                            <p>Nama Lengkap</p>
                            </p>
                            <strong><?php echo $profil['nama_lengkap']; ?></strong>
                            <p>
                            <p>Nomor Induk Kependudukan</p>
                            </p>
                            <strong><?php echo $profil['nik']; ?></strong>
                            <p>
                            <p>Tempat/Tanggal Lahir</p>
                            </p>
                            <strong><?php echo $profil['tempat_lahir']; ?>, <?php echo $profil['tgl_lahir']; ?></strong>
                            <p>
                            <p>Status Perkawinan</p>
                            </p>
                            <strong><?php echo $profil['status']; ?></strong>
                            <p>
                            <p>Tinggi Badan</p>
                            </p>
                            <strong><?php echo $profil['tinggi']; ?> cm</strong>
                            <p>
                            <p>Berat Badan</p>
                            </p>
                            <strong><?php echo $profil['berat']; ?> kg</strong>
                            <p>
                            <p>Provinsi</p>
                            </p>
                            <strong><?php echo $profil['provinsi']; ?></strong>
                            <p>
                            <p>Kabupaten/Kota</p>
                            </p>
                            <strong><?php echo $profil['kota']; ?></strong>
                            <p>
                            <p>Kecamatan</p>
                            </p>
                            <strong><?php echo $profil['kecamatan']; ?></strong>
                            <p>
                            <p>Desa/Kelurahan</p>
                            </p>
                            <strong><?php echo $profil['desa']; ?></strong>
                            <p>
                            <p>Nomor Telepon</p>
                            </p>
                            <strong><?php echo $profil['telepon']; ?></strong>
                            <p>
                            <p>Status Penerimaan</p>
                            </p>
                            <strong class="<?php echo ($profil['terima'] === 'terima') ? 'text-success' : 'text-danger'; ?>" style="text-transform: capitalize;"><?php echo $profil['terima']; ?></strong>
                            <p>
                            <p>Status Keaktifan</p>
                            </p>
                            <strong class="<?php echo ($profil['aktif'] === 'aktif') ? 'text-success' : 'text-danger'; ?>" style="text-transform: capitalize;"><?php echo $profil['aktif']; ?></strong>
                        <?php else : ?>
                            <p class="card-text">Data Pendaftaran belum diisi.</p>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6 text-right">
                        <img src="../<?php echo $profil['foto_ktp']; ?>" alt=""><br><br>
                        <img src="../<?php echo $profil['selfie_ktp']; ?>" alt="">
                    </div>
                </div>
            </div>
            <a href="ubah2.php?id_daftar=<?php echo $profil['id_daftar']; ?>" class="btn btn-primary">Update Status Penerimaan dan Keaktifan</a>
        </div>
    </div>

    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-success text-center">
                Data Sekolah
            </div>
            <div class="card-body">
                <?php if (!empty($data_sekolah)) : ?>
                    <ol>
                        <?php foreach ($data_sekolah as $sekolah) : ?>
                            <li>
                                <strong>Nama Sekolah:</strong> <?php echo $sekolah['nama_sekolah']; ?><br>
                                <strong>Tanggal Masuk Sekolah:</strong> <?php echo $sekolah['tgl_masuk_sekolah']; ?><br>
                                <strong>Tanggal Lulus Sekolah:</strong> <?php echo $sekolah['tgl_lulus_sekolah']; ?><br>
                                <strong>Ijazah Sekolah</strong> <a href="../<?php echo $sekolah['ijazah_sekolah']; ?>" target="_blank" class="btn btn-primary">Download</a>
                            </li><br>
                        <?php endforeach; ?>
                    </ol>
                <?php else : ?>
                    <strong class="card-text">Data Sekolah belum diisi.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>


    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-info text-center">
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
                                <strong>Sertifikasi</strong> <a href="../<?php echo $pengalaman['sertifikasi']; ?>" target="_blank" class="btn btn-primary">Download</a>
                            </li><br>
                        <?php endforeach; ?>
                    </ol>
                <?php else : ?>
                    <strong class="card-text">Data Pengalaman Bekerja belum diisi.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-dark text-center">
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
                                <strong>Uraian:</strong> <?php echo $pelatihan['uraian']; ?><br>
                                <strong>Sertifikat</strong> <a href="../<?php echo $pelatihan['sertifikat']; ?>" target="_blank" class="btn btn-primary">Download</a>
                            </li><br>
                        <?php endforeach; ?>
                    </ol>
                <?php else : ?>
                    <strong class="card-text">Data Pelatihan belum diisi.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

<script>
        function cetakProfil() {
            // Sembunyikan tombol cetak dan bagian navigasi sebelum mencetak
            document.querySelector(".navbar").style.display = "none";
            document.querySelector(".nav-item").style.display = "none";
            document.querySelector(".btn").style.display = "none";

            // Cetak halaman
            window.print();

            // Tampilkan kembali tombol cetak dan bagian navigasi setelah mencetak selesai
            document.querySelector(".navbar").style.display = "block";
            document.querySelector(".nav-item").style.display = "block";
            document.querySelector(".btn").style.display = "block";
        }
</script>

</html>
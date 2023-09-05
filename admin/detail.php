<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pendaftaran TKI Online | Verifikasi Data</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" />
</head>

<body>
    <?php
    session_start();
    if (empty($_SESSION['login'])) {
        header("Location:../login_admin.php");
        exit;
    }

    include '../koneksi.php';

    $id_pendaftaran = $_GET['id_pendaftaran'] ?? null;

    if ($id_pendaftaran) {
        $sql = "SELECT d.id_pendaftaran, d.id_daftar, d.nik, d.nama_lengkap, d.status, d.tempat_lahir, d.tgl_lahir, d.tinggi, d.berat, d.foto_ktp, d.selfie_ktp, d.telepon, d.terima, d.aktif, p.nama AS provinsi, k.nama AS kota, kc.nama AS kecamatan, ds.nama AS desa, d.alamat_lengkap FROM daftars d JOIN provinsi p ON d.id_provinsi = p.id_provinsi JOIN kota k ON d.id_kota = k.id_kota JOIN kecamatan kc ON d.id_kecamatan = kc.id_kecamatan JOIN desa ds ON d.id_desa = ds.id_desa WHERE d.id_pendaftaran=?";
        $stmt = $koneksi->prepare($sql);
        $stmt->bind_param("i", $id_pendaftaran);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $sql2 = "SELECT * FROM sekolah WHERE id_pendaftaran=?";
        $stmt2 = $koneksi->prepare($sql2);
        $stmt2->bind_param("i", $id_pendaftaran);
        $stmt2->execute();
        $result2 = $stmt2->get_result();
        $data_sekolah = $result2->fetch_all(MYSQLI_ASSOC);

        $sql3 = "SELECT * FROM pengalaman WHERE id_pendaftaran=?";
        $stmt3 = $koneksi->prepare($sql3);
        $stmt3->bind_param("i", $id_pendaftaran);
        $stmt3->execute();
        $result3 = $stmt3->get_result();
        $data_pengalaman = $result3->fetch_all(MYSQLI_ASSOC);

        $sql4 = "SELECT * FROM pelatihan WHERE id_pendaftaran=?";
        $stmt4 = $koneksi->prepare($sql4);
        $stmt4->bind_param("i", $id_pendaftaran);
        $stmt4->execute();
        $result4 = $stmt4->get_result();
        $data_pelatihan = $result4->fetch_all(MYSQLI_ASSOC);

        $stmt->close();
        $stmt2->close();
        $stmt3->close();
        $stmt4->close();
    } else {
        echo "ID Pendaftaran tidak valid.";
        exit;
    }
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
                        <a class="nav-link btn btn-primary text-light" href="javascript:void(0);" onclick="cetakProfil()" title="Cetak Profil Anda">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                                <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
                                <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z" />
                            </svg>
                            Cetak Profil Anda</a>
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
                        <?php if ($row) : ?>
                            <p>
                            <p>Nama Lengkap</p>
                            </p>
                            <strong><?php echo $row['nama_lengkap']; ?></strong>
                            <p>
                            <p>Nomor Induk Kependudukan</p>
                            </p>
                            <strong><?php echo $row['nik']; ?></strong>
                            <p>
                            <p>Tempat/Tanggal Lahir</p>
                            </p>
                            <strong><?php echo $row['tempat_lahir']; ?>, <?php echo $row['tgl_lahir']; ?></strong>
                            <p>
                            <p>Status Perkawinan</p>
                            </p>
                            <strong><?php echo $row['status']; ?></strong>
                            <p>
                            <p>Tinggi Badan</p>
                            </p>
                            <strong><?php echo $row['tinggi']; ?> cm</strong>
                            <p>
                            <p>Berat Badan</p>
                            </p>
                            <strong><?php echo $row['berat']; ?> kg</strong>
                            <p>
                            <p>Provinsi</p>
                            </p>
                            <strong><?php echo $row['provinsi']; ?></strong>
                            <p>
                            <p>Kabupaten/Kota</p>
                            </p>
                            <strong><?php echo $row['kota']; ?></strong>
                            <p>
                            <p>Kecamatan</p>
                            </p>
                            <strong><?php echo $row['kecamatan']; ?></strong>
                            <p>
                            <p>Desa/Kelurahan</p>
                            </p>
                            <strong><?php echo $row['desa']; ?></strong>
                            <p>
                            <p>Nomor Telepon</p>
                            </p>
                            <strong><?php echo $row['telepon']; ?></strong>
                            <p>
                            <p>Status Penerimaan</p>
                            </p>
                            <strong class="<?php echo ($row['terima'] === 'terima') ? 'text-success' : 'text-danger'; ?>" style="text-transform: capitalize;"><?php echo $row['terima']; ?></strong>
                            <p>
                            <p>Status Keaktifan</p>
                            </p>
                            <strong class="<?php echo ($row['aktif'] === 'aktif') ? 'text-success' : 'text-danger'; ?>" style="text-transform: capitalize;"><?php echo $row['aktif']; ?></strong>
                        <?php else : ?>
                            <p class="card-text">Data Pendaftaran belum diisi.</p>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6 text-right">
                        <?php if ($row) : ?>
                            <img src="../<?php echo $row['foto_ktp']; ?>" alt="Foto KTP" class="img-fluid mb-3">
                            <img src="../<?php echo $row['selfie_ktp']; ?>" alt="Selfie dengan KTP" class="img-fluid">
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php if ($row) : ?>
                <div class="card-footer">
                    <a href="edit.php?id_pendaftaran=<?php echo $row['id_pendaftaran']; ?>" class="btn btn-success form-control">Edit</a>
                    <a href="ubah.php?id_pendaftaran=<?php echo $row['id_pendaftaran']; ?>" class="btn btn-primary form-control">Update Keaktifan & Penerimaan</a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="container mt-5">
        <div class="card">
            <div class="card-header text-center bg-success">
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
                                <a href="../<?php echo $sekolah['ijazah_sekolah']; ?>" target="_blank" class="btn btn-primary">Download Ijazah Sekolah</a>
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
                                <a href="../<?php echo $pengalaman['sertifikasi']; ?>" target="_blank" class="btn btn-primary">Download Sertifikasi</a>
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
                                <a href="../<?php echo $pelatihan['sertifikat']; ?>" target="_blank" class="btn btn-primary">Download Sertifikat</a>
                            </li><br>
                        <?php endforeach; ?>
                    </ol>
                <?php else : ?>
                    <p class="card-text">Data Pelatihan belum diisi.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script>
        function cetakProfil() {
            var downloadButtons = document.querySelectorAll(".btn-primary");
            for (var i = 0; i < downloadButtons.length; i++) {
                downloadButtons[i].style.display = "none";
            }
            // Sembunyikan tombol cetak dan bagian navigasi sebelum mencetak
            document.querySelector(".navbar").style.display = "none";
            document.querySelector(".nav-item").style.display = "none";
            document.querySelector(".card-footer").style.display = "none";
            document.querySelector(".btn").style.display = "none";
            document.querySelector(".btn-primary").style.display = "none";

            // Cetak halaman
            window.print();

            // Tampilkan kembali tombol cetak dan bagian navigasi setelah mencetak selesai
            document.querySelector(".navbar").style.display = "block";
            document.querySelector(".nav-item").style.display = "block";
            document.querySelector(".card-footer").style.display = "block";
            document.querySelector(".btn").style.display = "block";
            document.querySelector(".btn-primary").style.display = "block";
            for (var i = 0; i < downloadButtons.length; i++) {
                downloadButtons[i].style.display = "inline-block"; // or "block" as per your styling
            }
        }
    </script>

</body>

</html>
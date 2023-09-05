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
        h1, h2, h3, h4, h5, h6{
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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
    <div class="container mt-5">
    <p><strong style="font-size: 30px;">PROFIL "<?php echo $profil['nama_lengkap']; ?>".</strong></p><br>
    <div class="card">
        <div class="card-header">
            Data Pribadi
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <?php if ($profil) : ?>
                        <p><strong>Nama Lengkap</strong><br>
                        <?php echo $profil['nama_lengkap']; ?>
                        </p>
                        <p><strong>Nomor Induk Kependudukan</strong><br>
                        <?php echo $profil['nik']; ?>
                        </p>
                        <p><strong>Tempat/Tanggal Lahir</strong><br>
                        <?php echo $profil['tempat_lahir']; ?>, <?php echo $profil['tgl_lahir']; ?>
                        </p>
                        <p><strong>Status Perkawinan</strong><br>
                        <?php echo $profil['status']; ?>
                        </p>
                        <p><strong>Tinggi Badan</strong><br>
                        <?php echo $profil['tinggi']; ?> cm
                        </p>
                        <p><strong>Berat Badan</strong><br>
                        <?php echo $profil['berat']; ?> kg
                        </p>
                        <p><strong>Provinsi</strong><br>
                        <?php echo $profil['provinsi']; ?>
                        </p>
                        <p><strong>Kabupaten/Kota</strong><br>
                        <?php echo $profil['kota']; ?>
                        </p>
                        <p><strong>Kecamatan</strong><br>
                        <?php echo $profil['kecamatan']; ?>
                        </p>
                        <p><strong>Desa/Kelurahan</strong><br>
                        <?php echo $profil['desa']; ?>
                        </p>
                        <p><strong>Nomor Telepon</strong><br>
                        <?php echo $profil['telepon']; ?>
                        <img src="data:image/jpeg;base64,<?php echo base64_encode(file_get_contents($profil['foto_ktp'])); ?>" alt="Foto KTP">
                        <img src="data:image/jpeg;base64,<?php echo base64_encode(file_get_contents($profil['selfie_ktp'])); ?>" alt="Selfie KTP">
                        </p>
                    <?php else : ?>
                        <p><strong>Data Pendaftaran belum diisi.</strong></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
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
                                <strong>Nama Sekolah:</strong><br> <?php echo $sekolah['nama_sekolah']; ?><br>
                                <strong>Tanggal Masuk Sekolah:</strong><br> <?php echo $sekolah['tgl_masuk_sekolah']; ?><br>
                                <strong>Tanggal Lulus Sekolah:</strong><br> <?php echo $sekolah['tgl_lulus_sekolah']; ?>
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
                                <strong>Nama Perusahaan:</strong><br> <?php echo $pengalaman['nama_perusahaan']; ?><br>
                                <strong>Tanggal Masuk Perusahaan:</strong><br> <?php echo $pengalaman['tgl_masuk_perusahaan']; ?><br>
                                <strong>Tanggal Keluar Perusahaan:</strong><br> <?php echo $pengalaman['tgl_keluar_perusahaan']; ?><br>
                                <strong>Pekerjaan:</strong><br> <?php echo $pengalaman['pekerjaan']; ?><br>
                                <strong>Jabatan:</strong><br> <?php echo $pengalaman['jabatan']; ?><br>
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
                                <strong>Instansi:</strong><br> <?php echo $pelatihan['instansi']; ?><br>
                                <strong>Tanggal Keluar Sertifikat:</strong><br> <?php echo $pelatihan['tgl_keluar_sertifikat']; ?><br>
                                <strong>Nomor Sertifikat:</strong><br> <?php echo $pelatihan['no_sertifikat']; ?><br>
                                <strong>Jenis:</strong><br> <?php echo $pelatihan['jenis']; ?><br>
                                <strong>Uraian:</strong><br> <?php echo $pelatihan['uraian']; ?>
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

</html>
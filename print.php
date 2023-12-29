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

    <style>
        .gradient-custom {
            /* fallback for old browsers */
            background: #6a11cb;

            /* Chrome 10-25, Safari 5.1-6 */
            background: -webkit-linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));

            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            background: linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1))
        }

        .card {
            background-color: black;
            color: white;
            margin-bottom: 20px;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <?php
    include "koneksi.php";
    $id_daftar = $_SESSION['id_daftar'];
    if (strpos($id_daftar, 'PSN-PMI-') === 0) {
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
        echo "ID Daftar tidak valid.";
    }
    ?>
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row">
                <div class="col-12 text-center">
                    <img src="https://primasyifanusantara.co.id/images/logo_psn copy.png" class="img-fluid mx-auto" style="width: 150px; height: 150px;"><br><br>
                    <h1 class="text-white">PT PRIMA SYIFA NUSANTARA</h1>
                </div>
            </div><br>
            <div class="row d-flex justify-content-center align-items-center">
                <a href="generate.php" class="btn btn-success justify-content-center btn-lg px-5 align-items-center" target="_blank">Print</a>
                <a href="logout.php" class="btn btn-danger justify-content-center btn-lg px-5 align-items-center">Logout</a>
            </div><br>
            <div class="card bg-dark text-white" style="border-radius: 1rem;">
                <div class="card-body p-5">
                    <h1>Data Diri Anda.</h1><br>
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
                                <div class="card">
                                    <h1 class="card-title">Riwayat Pendidikan</h1>
                                    <div class="card-body">
                                        <h3 class="card-text">Data Sekolah belum diisi.</h3>
                                        <a href="tambah_sekolah.php" class="btn btn-primary">Tambah Sekolah</a>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <a href="edit2.php" class="btn btn-success form-control">Edit Sekolah</a>
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
                                <div class="card">
                                    <h1 class="card-title">Pengalaman Bekerja</h1>
                                    <div class="card-body">
                                        <h3 class="card-text">Data Pengalaman Bekerja belum diisi.</h3>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <a href="edit3.php" class="btn btn-success form-control">Edit Pengalaman</a>
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
                                <div class="card">
                                    <h1 class="card-title">Pelatihan</h1>
                                    <div class="card-body">
                                        <h3 class="card-text">Data Pelatihan belum diisi.</h3>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <a href="edit4.php" class="btn btn-success form-control">Edit Pelatihan</a>
                </div>
            </div>
        </div>
    </section>
</body>

</html>

<?php
$_SESSION['id_daftar'] = $id_daftar;
?>
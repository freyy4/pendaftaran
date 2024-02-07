<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Halaman Admin PT Prima Syifa Nusantara</title>
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        #stickyElement {
            position: fixed;
        }
    </style>
    <link rel="shortcut icon" href="assets/images/Screenshot__3_-removebg-preview.png" />
</head>

<body>
    <?php
    session_start();

    if (empty($_SESSION['login'])) {
        header("Location:../index.php");
    }

    include '../koneksi.php';

    if (isset($_GET['id_daftar'])) {
        $id_daftar = $_GET['id_daftar'];
        $_SESSION['id_daftar'] = $id_daftar;
        if (strpos($id_daftar, 'CBM-PMI-') === 0) {
            $sql = "SELECT d.id_daftar, d.nik, d.nama_lengkap, d.status, d.tempat_lahir, d.tgl_lahir, d.tinggi, d.berat, d.foto_ktp, d.selfie_ktp, d.pas, d.telepon, d.terima, d.aktif, d.pekerjaan, d.negara, p.nama AS provinsi, k.nama AS kota, kc.nama AS kecamatan, ds.nama AS desa, d.alamat_lengkap FROM daftar d JOIN provinsi p ON d.id_provinsi = p.id_provinsi JOIN kota k ON d.id_kota = k.id_kota JOIN kecamatan kc ON d.id_kecamatan = kc.id_kecamatan JOIN desa ds ON d.id_desa = ds.id_desa WHERE d.id_daftar=?";
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
    }
    ?>

    <div class="container-scroller">
        <?php include("include/sidebar.php"); ?>
        <div class="container-fluid page-body-wrapper">
            <?php include("include/navbar.php"); ?>
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-6 col-xl-6 grid-margin stretch-card">

                        </div>
                        <div class="col-md-6 col-xl-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-row justify-content-between">
                                        <h2 class="card-title">1. Data Diri PMI</h2>
                                    </div>
                                    <div class="preview-list">
                                        <?php
                                            $path_folder_a = "";
                                            $path_folder_b = "../";
                                        ?>
                                        <div class="card-body">
                                            <?php if ($row1) : ?>
                                                <?php
                                                    $path_selfie_ktp = $row1['selfie_ktp'];
                                                    $path_pas_foto = $row1['pas'];
                                                    $path_foto_ktp = $row1['foto_ktp'];
                                                
                                                    function tampilkanGambar($path, $folder_a, $folder_b) {
                                                        if (file_exists($folder_a . $path)) {
                                                            echo '<img src="' . $folder_a . $path . '" width="150" height="150" alt="Gambar">';
                                                        } elseif (file_exists($folder_b . $path)) {
                                                            echo '<img src="' . $folder_b . $path . '" width="150" height="150" alt="Gambar">';
                                                        } else {
                                                            echo 'Gambar tidak ditemukan di kedua folder. Path A: ' . $folder_a . $path . ', Path B: ' . $folder_b . $path;
                                                        }
                                                    }                                                    
                                                    
                                                    tampilkanGambar($path_selfie_ktp, $path_folder_a, $path_folder_b);
                                                    tampilkanGambar($path_pas_foto, $path_folder_a, $path_folder_b);
                                                    tampilkanGambar($path_foto_ktp, $path_folder_a, $path_folder_b);
                                                ?>
                                                <br><br><br>
                                                <label>Daftar ID</label>
                                                <h1><?php echo $row1['id_daftar']; ?></h1><br><br>
                                                <label>Nama Lengkap</label><br>
                                                <h1><?php echo $row1['nama_lengkap']; ?></h1><br><br>

                                                <label>Nomor Induk Kependudukan</label><br>
                                                <h1><?php echo $row1['nik']; ?></h1><br><br>

                                                <label>Tempat/Tanggal Lahir</label><br>
                                                <h1><?php echo $row1['tempat_lahir']; ?>, <?php echo $row1['tgl_lahir']; ?></h1><br><br>

                                                <label>Status Perkawinan</label><br>
                                                <h1><?php echo $row1['status']; ?></h1><br><br>

                                                <label>Tinggi Badan</label><br>
                                                <h1><?php echo $row1['tinggi']; ?> cm</h1><br><br>

                                                <label>Berat Badan</label><br>
                                                <h1><?php echo $row1['berat']; ?> kg</h1><br><br>

                                                <label>Provinsi</label><br>
                                                <h1><?php echo $row1['provinsi']; ?></h1><br><br>

                                                <label>Kabupaten/Kota</label><br>
                                                <h1><?php echo $row1['kota']; ?></h1><br><br>

                                                <label>Kecamatan</label><br>
                                                <h1><?php echo $row1['kecamatan']; ?></h1><br><br>

                                                <label>Desa/Kelurahan</label><br>
                                                <h1><?php echo $row1['desa']; ?></h1><br><br>

                                                <label>Nomor Telepon</label><br>
                                                <h1><?php echo $row1['telepon']; ?></h1><br><br>

                                                <label>Status Penerimaan</label><br>
                                                <h1 class="<?php echo ($row1['terima'] === 'terima') ? 'text-success' : 'text-danger'; ?>" style="text-transform: capitalize;"><?php echo $row1['terima']; ?></h1><br><br>

                                                <label>Status Keaktifan</label><br>
                                                <h1 class="<?php echo ($row1['aktif'] === 'aktif') ? 'text-success' : 'text-danger'; ?>" style="text-transform: capitalize;"><?php echo $row1['aktif']; ?></h1><br><br>

                                                <label>Jenis Pekerjaan yang dipilih</label><br>
                                                <h1><?php echo $row1['pekerjaan']; ?></h1><br><br>

                                                <label>Negara yang dipilih</label><br>
                                                <h1><?php echo $row1['negara']; ?></h1><br>
                                                <a href="edit.php" class="btn btn-primary btn-outline-white form-control">Edit PMI</a>
                                            <?php else : ?>
                                                <p class="card-text">Data Pendaftaran belum diisi.</p>
                                            <?php endif; ?>
                                            <br><br><br>
                                            <h1>2. Riwayat Pendidikan</h1><br>
                                            <?php if (!empty($data_sekolah)) : ?>
                                                <?php foreach ($data_sekolah as $sekolah) : ?>
                                                    <label>Nama Sekolah:</label>
                                                    <h1><?php echo $sekolah['nama_sekolah']; ?></h1><br>
                                                    <label>Tanggal Masuk Sekolah:</label>
                                                    <h1><?php echo $sekolah['tgl_masuk_sekolah']; ?></h1> <br>
                                                    <label>Tanggal Lulus Sekolah:</label>
                                                    <h1><?php echo $sekolah['tgl_lulus_sekolah']; ?></h1><br>
                                                    <a href="<?php echo $sekolah['ijazah_sekolah']; ?>" target="_blank" class="btn btn-primary">Download Ijazah dari <?php echo $sekolah['nama_sekolah']; ?></a><br><br>
                                                <?php endforeach; ?>
                                                <a href="edit2.php" class="btn btn-primary btn-outline-white form-control">Edit Sekolah</a>
                                            <?php else : ?>
                                                <h1 class="card-text">Data Sekolah belum diisi.</p>
                                                <?php endif; ?>
                                                <br><br><br>
                                                <h1>3. Pengalaman Bekerja</h1><br>
                                                <?php if (!empty($data_pengalaman)) : ?>
                                                    <?php foreach ($data_pengalaman as $pengalaman) : ?>
                                                        <label>Nama Perusahaan:</label>
                                                        <h1><?php echo $pengalaman['nama_perusahaan']; ?></h1><br>
                                                        <label>Tanggal Masuk Perusahaan:</label>
                                                        <h1><?php echo $pengalaman['tgl_masuk_perusahaan']; ?></h1> <br>
                                                        <label>Tanggal Keluar Perusahaan:</label>
                                                        <h1><?php echo $pengalaman['tgl_masuk_perusahaan']; ?></h1> <br>
                                                        <label>Pekerjaan:</label>
                                                        <h1><?php echo $pengalaman['pekerjaan']; ?></h1> <br>
                                                        <label>Jabatan:</label>
                                                        <h1><?php echo $pengalaman['jabatan']; ?></h1><br>
                                                        <a href="<?php echo $pengalaman['setifikasi']; ?>" target="_blank" class="btn btn-primary">Download Sertifikasi dari <?php echo $pengalaman['nama_perusahaan']; ?></a><br><br>
                                                    <?php endforeach; ?>
                                                    <a href="edit3.php" class="btn btn-primary btn-outline-white form-control">Edit Pengalaman</a>
                                                <?php else : ?>
                                                    <h1 class="card-text">Data Sekolah belum diisi.</p>
                                                    <?php endif; ?>
                                                    <br><br><br>
                                                    <h1>4. Pelatihan</h1><br>
                                                    <?php if (!empty($data_pelatihan)) : ?>
                                                        <?php foreach ($data_pelatihan as $pelatihan) : ?>
                                                            <label>Nama Instansi:</label>
                                                            <h1><?php echo $pelatihan['instansi']; ?></h1><br>
                                                            <label>Tanggal Keluar Sertifikat:</label>
                                                            <h1><?php echo $pelatihan['tgl_keluar_sertifikat']; ?></h1> <br>
                                                            <label>Nomor Sertifikat:</label>
                                                            <h1><?php echo $pelatihan['no_sertifikat']; ?></h1> <br>
                                                            <label>Jenis Sertifikat:</label>
                                                            <h1><?php echo $pelatihan['jenis']; ?></h1> <br>
                                                            <label>Uraian Sertifikat:</label>
                                                            <h1><?php echo $pelatihan['uraian']; ?></h1><br>
                                                            <a href="<?php echo $pelatihan['setifikat']; ?>" target="_blank" class="btn btn-primary">Download Sertifikat dari <?php echo $pelatihan['instansi']; ?></a><br><br>
                                                        <?php endforeach; ?>
                                                        <a href="edit4.php" class="btn btn-primary btn-outline-white form-control">Edit Pelatihan</a>
                                                    <?php else : ?>
                                                        <h1 class="card-text">Data Sekolah belum diisi.</p>
                                                        <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 col-xl-5 grid-margin-top" id="stickyElement">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-row justify-content-between">
                                        <h2 class="card-title">Ubah Status PMI</h2>
                                    </div>
                                    <div class="preview-list">
                                        <div class="card-body">
                                            <form action="detail.php" method="post">
                                                <input type="hidden" name="id_daftar" value="<?php echo $id_daftar; ?>">
                                                <label for="terima">Status Penerimaan</label>
                                                <select name="terima" id="terima" class="form-control">
                                                    <option value="terima">Terima</option>
                                                    <option value="tolak">Tolak</option>
                                                </select>
                                                <label for="aktif">Status Aktif</label>
                                                <select name="aktif" id="aktif" class="form-control">
                                                    <option value="aktif">Aktif</option>
                                                    <option value="nonaktif">Nonaktif</option>
                                                </select><br>
                                                <input type="submit" value="Update" class="btn btn-primary" onClick="alet()">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <script src="assets/vendors/progressbar.js/progressbar.min.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
    <script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <script src="assets/js/dashboard.js"></script>
    <script>
        $(document).ready(function() {
            $('#mydata').DataTable({
                "paging": false,
                "info": false,
                "language": {
                    "infoEmpty": 'Tidak ada Data',
                    "zeroRecords": 'Belum ada tindakan apapun',
                    "lengthMenu": 'Lihat _MENU_ rekaman per halaman',
                    "search": 'Cari',
                }
            });
        });
    </script>
</body>

</html>
<?php
if (isset($_POST['id_daftar'], $_POST['terima'], $_POST['aktif'])) {
    include '../koneksi.php';
    $id_daftar = mysqli_real_escape_string($koneksi, $_POST['id_daftar']);
    $terima = mysqli_real_escape_string($koneksi, $_POST['terima']);
    $aktif = mysqli_real_escape_string($koneksi, $_POST['aktif']);
    $update = "UPDATE daftar SET terima='$terima', aktif='$aktif' WHERE id_daftar='$id_daftar'";
    if (mysqli_query($koneksi, $update)) {
        echo "<script>window.location.href = 'admin.php';</script>";
    } else {
        echo "Terjadi kesalahan dalam memperbarui data: " . mysqli_error($koneksi);
    }
    mysqli_close($koneksi);
}
?>
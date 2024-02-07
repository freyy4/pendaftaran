<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Download Files | PT. CRYSTAL BIRU MEULIGO</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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

    include 'koneksi.php';
    
    if (isset($_GET['id_daftar'])) {
        $id_daftar = $_GET['id_daftar'];
        $_SESSION['id_daftar'] = $id_daftar;
        if (strpos($id_daftar, 'CBM-PMI-') === 0) {
        $sql = "SELECT d.id_daftar, d.nik, d.nama_lengkap, d.email, d.medsos, d.jk, d.status, d.kk, d.akte_kelahiran, d.akte_cerai, d.buku_nikah, d.foto_ktp, d.selfie_ktp, d.pas, d.telepon, d.video, d.tempat_lahir, d.tgl_lahir, d.tinggi, d.berat, d.pekerjaan, d.negara, p.nama AS provinsi, k.nama AS kota, kc.nama AS kecamatan, ds.nama AS desa, d.alamat_lengkap 
        FROM daftar d 
        JOIN provinsi p ON d.id_provinsi = p.id_provinsi 
        JOIN kota k ON d.id_kota = k.id_kota 
        JOIN kecamatan kc ON d.id_kecamatan = kc.id_kecamatan 
        JOIN desa ds ON d.id_desa = ds.id_desa 
        WHERE d.id_daftar=?";
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

            $data_sekolah = array();  //Array untuk menyimpan data sekolah

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

            $data_pengalaman = array();  //Array untuk menyimpan data pengalaman

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

            $data_pelatihan = array();  //Array untuk menyimpan data pelatihan

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
            $sql5 = "SELECT * FROM vaksin WHERE id_daftar=?";
            $stmt5 = $koneksi->prepare($sql5);
            $stmt5->bind_param("s", $id_daftar);
            $stmt5->execute();
            $result5 = $stmt5->get_result();
    
            $data_vaksin = array(); // Array untuk menyimpan data pelatihan
    
            if ($result5->num_rows > 0) {
                while ($row = $result5->fetch_assoc()) {
                    $data_vaksin[] = array(
                        'sertifikat_vaksin' => $row['sertifikat_vaksin'],
                        'jenis_vaksin' => $row['jenis_vaksin']
                    );
                }
            }
            $stmt->close();
            $stmt2->close();
            $stmt3->close();
            $stmt4->close();
            $stmt5->close();
            $koneksi->close();
        } else {
            echo "ID Daftar tidak valid.";
        }
    }
    ?>
    <?php
    include 'navbar1.php';
?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="preview-list">
                            <?php
                        $path_folder_a = "";
                        $path_folder_b = "../";
                        ?>
                            <div class="card-body">
                                <?php if (!empty($data_vaksin) || $row1 || !empty($data_sekolah) || !empty($data_pengalaman) || !empty($data_pelatihan)) : ?>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($row1) {
                                            $path_selfie_ktp = $row1['selfie_ktp'];
                                            $path_pas_foto = $row1['pas'];
                                            $path_foto_ktp = $row1['foto_ktp'];
                                            $path_kk = $row1['kk'];
                                            $path_lahir = $row1['akte_kelahiran'];
                                            $path_nikah = $row1['buku_nikah'];
                                            $path_cerai = $row1['akte_cerai'];
                                            $path_surat = $row1['surat_keluarga'];
                                            $path_foto = $row1['foto'];
                                            $path_video = $row1['video'];

                                            function generateTableRow($path, $folder_a, $folder_b, $alt, $description)
                                            {
                                                echo '<tr>';
                                                echo '<td>' . $alt . '</td>';
                                                echo '<td><a class="btn btn-primary" href="' . (file_exists($folder_a . $path) ? $folder_a . $path : $folder_b . $path) . '" download="' . $alt . '">Download</a></td>';
                                                echo '</tr>';
                                            }

                                            generateTableRow($path_selfie_ktp, $path_folder_a, $path_folder_b, 'ID Card Selfie', 'Deskripsi Selfie KTP');
                                            generateTableRow($path_pas_foto, $path_folder_a, $path_folder_b, 'Photo', 'Deskripsi Pas Foto');
                                            generateTableRow($path_foto_ktp, $path_folder_a, $path_folder_b, 'Photo ID Card', 'Deskripsi Foto KTP');
                                            generateTableRow($path_kk, $path_folder_a, $path_folder_b, 'Family Card', 'Deskripsi KK');
                                            generateTableRow($path_lahir, $path_folder_a, $path_folder_b, 'Birth Certificate', 'Deskripsi Akte Kelahiran');
                                            generateTableRow($path_nikah, $path_folder_a, $path_folder_b, 'Marriage Book', 'Deskripsi Buku Nikah');
                                            generateTableRow($path_cerai, $path_folder_a, $path_folder_b, 'Divorce Deed', 'Deskripsi Akte Cerai');
                                            generateTableRow($path_surat, $path_folder_a, $path_folder_b, 'Family Letters', 'Deskripsi Surat Keluarga');
                                            generateTableRow($path_foto, $path_folder_a, $path_folder_b, 'Full Body Photo', 'Deskripsi Foto');
                                        }
                                        ?>
                                        <?php if (!empty($data_sekolah)) : ?>
                                        <?php foreach ($data_sekolah as $sekolah) : ?>
                                        <tr>
                                            <td>Certificate School <?php echo $sekolah['nama_sekolah']; ?></td>
                                            <td><a href="<?php echo $sekolah['ijazah_sekolah']; ?>" target="_blank"
                                                    class="btn btn-primary">Download</a></td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <?php endif; ?>
                                        <?php if (!empty($data_pengalaman)) : ?>
                                        <?php foreach ($data_pengalaman as $pengalaman) : ?>
                                        <tr>
                                            <td>Certificate of Employment <?php echo $pengalaman['nama_perusahaan']; ?>
                                            </td>
                                            <td><a href="<?php echo $pengalaman['sertifikasi']; ?>" target="_blank"
                                                    class="btn btn-primary">Download</a></td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <?php endif; ?>
                                        <?php if (!empty($data_pelatihan)) : ?>
                                        <?php foreach ($data_pelatihan as $pelatihan) : ?>
                                        <tr>
                                            <td>Training Certificate <?php echo $pelatihan['instansi']; ?></td>
                                            <td><a href="<?php echo $pelatihan['sertifikat']; ?>" target="_blank"
                                                    class="btn btn-primary">Download</a></td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                                <?php else : ?>
                                <p>File not found.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    include 'footer.php';
?>

    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <script src="assets/vendors/progressbar.js/progressbar.min.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
    <script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
    <script src="https:cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
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
    <script>
    document.getElementById('btnPrint').addEventListener('click', function() {
        Mendapatkan ID Daftar dari PHP(Anda dapat menyesuaikannya sesuai kebutuhan)
        var idDaftar = <?php echo json_encode($_SESSION['id_daftar']); ?>;

        Buka halaman cetak terpisah saat tombol diklik
        window.open('print_page.php?id_daftar=' + idDaftar, '_blank');
    });
    </script>
</body>

</html>
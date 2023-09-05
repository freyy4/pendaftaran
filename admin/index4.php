<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pendaftaran TKI Online | Pelatihan</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="//cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
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
        include "koneksi.php";
        $id_pendaftaran = $_POST['id_pendaftaran'];
        $nama_perusahaanArr = $_POST['nama_perusahaan'];
        $tgl_masuk_perusahaanArr = $_POST['tgl_masuk_perusahaan'];
        $tgl_keluar_perusahaanArr = $_POST['tgl_keluar_perusahaan'];
        $pekerjaanArr = $_POST['pekerjaan'];
        $jabatanArr = $_POST['jabatan'];
        $keteranganArr = $_POST['keterangan'];
        $sertifikasiArr = $_FILES['sertifikasi'];

        for ($i = 0; $i < count($nama_perusahaanArr); $i++) {
            $id_pendaftaran = $_POST['id_pendaftaran'];
            $nama_perusahaan = mysqli_real_escape_string($koneksi, $nama_perusahaanArr[$i]);
            $tgl_masuk_perusahaan = mysqli_real_escape_string($koneksi, $tgl_masuk_perusahaanArr[$i]);
            $tgl_keluar_perusahaan = mysqli_real_escape_string($koneksi, $tgl_keluar_perusahaanArr[$i]);
            $pekerjaan = mysqli_real_escape_string($koneksi, $pekerjaanArr[$i]);
            $jabatan = mysqli_real_escape_string($koneksi, $jabatanArr[$i]);
            $keterangan = mysqli_real_escape_string($koneksi, $keteranganArr[$i]);

            $target_dir = "../sertifikasi/";
            $sertifikasi = $target_dir . basename($sertifikasiArr['name'][$i]);
            move_uploaded_file($sertifikasiArr['tmp_name'][$i], $sertifikasi);

            $insert = mysqli_query($koneksi, "INSERT INTO pengalaman (id_pendaftaran, nama_perusahaan, tgl_masuk_perusahaan, tgl_keluar_perusahaan, pekerjaan, jabatan, keterangan, sertifikasi) VALUES ('$id_pendaftaran', '$nama_perusahaan', '$tgl_masuk_perusahaan', '$tgl_keluar_perusahaan', '$pekerjaan', '$jabatan', '$keterangan', '$sertifikasi');");

            if (!$insert) {
                die("Gagal menyimpan data");
            }
        }

        echo "<script>
        alert('Data berhasil disimpan 😁');
        window.location='index4.php';
        </script>";
    }

    include '../koneksi.php';
    $query = mysqli_query($koneksi, "SELECT * FROM daftars");
    $num = mysqli_num_rows($query);
    $jmlh = $num;
    $nomor = $jmlh;
    session_start();
    if (empty($_SESSION['login'])) {
        header("Location:../login_admin.php");
    }
    ?>
    <div class="container">
        <form method="post" action="daftar4.php" enctype="multipart/form-data">
            <input type="hidden" name="id_pendaftaran" value="<?php echo $nomor ?>">
            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Instansi yang mengeluarkan Sertifikat *</th>
                            <th>Sertifikat Pelatihan</th>
                            <th>Tanggal Pengeluaran Sertifikat *</th>
                            <th>Nomor Sertifikat *</th>
                            <th>Jenis Sertifikat *</th>
                            <th>Uraian *</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <tr>
                            <td>
                                <input type="file" class="form-control" name="sertifikat[]" multiple>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="instansi[]" multiple>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="tgl_keluar_sertifikat[]" multiple>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="no_sertifikat[]" multiple>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="jenis[]" multiple>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="uraian[]" multiple>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <p>Klik "&plus; Tambah Data" jika Anda mempunyai data lebih dari 1</p>
                <button type="button" class="btn btn-success form-control" id="add-row-btn">&plus; Tambah Baris</button>
            </div>
            <button type="submit" class="btn btn-success form-control" name="daftar">Selesai</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        function yakin() {
            return alert("Apa Anda Yakin Ingin Keluar?");
        }
        $(document).ready(function() {
            $(".select2").select2({
                tags: true,
                placeholder: function() {
                    $(this).data('placeholder');
                },
                tokenSeparators: [',']
            });

            const addRowBtn = document.getElementById("add-row-btn");
            const tableBody = document.getElementById("table-body");

            addRowBtn.addEventListener("click", function() {
                const newRow = document.createElement("tr");
                newRow.innerHTML = `
                    <td>
                        <input type="file" class="form-control" name="sertifikat[]" multiple>
                    </td>
                    <td>
                        <input type="text" class="form-control" name="instansi[]" multiple>
                    </td>
                    <td>
                        <input type="text" class="form-control" name="tgl_keluar_sertifikat[]" multiple>
                    </td>
                    <td>
                        <input type="text" class="form-control" name="no_sertifikat[]" multiple>
                    </td>
                    <td>
                        <input type="text" class="form-control" name="jenis[]" multiple>
                    </td>
                    <td>
                        <input type="text" class="form-control" name="uraian[]" multiple>
                    </td>
                `;

                tableBody.appendChild(newRow);
                $(".select2").select2({
                    tags: true,
                    placeholder: function() {
                        $(this).data('placeholder');
                    },
                    tokenSeparators: [',']
                });
            });
        });
    </script>
</body>

</html>
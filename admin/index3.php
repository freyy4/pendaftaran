<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pendaftaran TKI Online | Pengalaman Bekerja</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
        $nama_sekolahArr = $_POST['nama_sekolah'];
        $tgl_masuk_sekolahArr = $_POST['tgl_masuk_sekolah'];
        $tgl_lulus_sekolahArr = $_POST['tgl_lulus_sekolah'];
        $ijazah_sekolahArr = $_FILES['ijazah_sekolah'];

        $targetsekolah = "../sekolah/";

        for ($i = 0; $i < count($nama_sekolahArr); $i++) {
            $id_pendaftaran = $_POST['id_pendaftaran'];
            $nama_sekolah = mysqli_real_escape_string($koneksi, $nama_sekolahArr[$i]);
            $tgl_masuk_sekolah = $tgl_masuk_sekolahArr[$i];
            $tgl_lulus_sekolah = $tgl_lulus_sekolahArr[$i];

            $ijazah_sekolah = $targetsekolah . basename($ijazah_sekolahArr['name'][$i]);

            move_uploaded_file($ijazah_sekolahArr['tmp_name'][$i], $ijazah_sekolah);

            $insert = mysqli_query($koneksi, "INSERT INTO sekolah 
                        (id_pendaftaran, nama_sekolah, tgl_masuk_sekolah, tgl_lulus_sekolah, ijazah_sekolah) VALUES 
                        ('$id_pendaftaran', '$nama_sekolah', '$tgl_masuk_sekolah', '$tgl_lulus_sekolah', '$ijazah_sekolah');");

            if (!$insert) {
                die("Gagal menyimpan data");
            }
        }

        echo "<script>
        alert('Data berhasil disimpan 😁');
        window.location='index3.php';
        </script>";
    }
    ?>

    <?php
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
        <form method="post" action="index4.php" enctype="multipart/form-data">
            <input type="hidden" name="id_pendaftaran" value="<?php echo $nomor ?>">
            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama Perusahaan *</th>
                            <th>Tanggal Masuk Perusahaan *</th>
                            <th>Tanggal Keluar Perusahaan *</th>
                            <th>Pekerjaan *</th>
                            <th>Jabatan *</th>
                            <th>Keterangan Pekerjaan</th>
                            <th>Sertifikasi/Bukti Bekerja</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <tr>
                            <td>
                                <input type="text" class="form-control" name="nama_perusahaan[]" placeholder="Masukkan Nama Perusahaan" multiple>
                            </td>
                            <td>
                                <input type="date" class="form-control" name="tgl_masuk_perusahaan[]" multiple>
                            </td>
                            <td>
                                <input type="date" class="form-control" name="tgl_keluar_perusahaan[]" multiple>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="pekerjaan[]" placeholder="Masukkan Nama Pekerjaan" multiple>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="jabatan[]" placeholder="Masukkan Nama Jabatan" multiple>
                            <td>
                                <textarea class="form-control" name="keterangan[]" rows="3" placeholder="Masukkan Keterangan Pekerjaan Anda (Tidak harus diisi)"></textarea>
                            </td>
                            <td>
                                <input type="file" class="form-control" name="sertifikasi[]" multiple>
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
                        <input type="text" class="form-control" name="nama_perusahaan[]" multiple>
                    </td>
                    <td>
                        <input type="date" class="form-control" name="tgl_masuk_perusahaan[]" multiple>
                    </td>
                    <td>
                        <input type="date" class="form-control" name="tgl_keluar_perusahaan[]" multiple>
                    </td>
                    <td>
                        <input type="text" class="form-control" name="pekerjaan[]" multiple>
                    </td>
                    <td>
                        <input type="text" class="form-control" name="jabatan[]" multiple>
                    <td>
                        <textarea class="form-control" name="keterangan[]" rows="3" placeholder="Masukkan Keterangan Pekerjaan Anda (Tidak harus diisi)"></textarea>
                    </td>
                    <td>
                        <input type="file" class="form-control" name="sertifikasi[]" multiple>
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
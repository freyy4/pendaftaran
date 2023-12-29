<?php
session_start();
if (empty($_SESSION['login'])) {
    header("Location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pendaftaran TKI Online | Edit Pengalaman</title>
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
    include "../koneksi.php";
    $id_daftar = $_SESSION['id_daftar'];

    // Tambahkan kode untuk mengambil data pengalaman yang sudah tersimpan
    $sqlPengalaman = "SELECT * FROM pengalaman WHERE id_daftar=?";
    $stmtPengalaman = $koneksi->prepare($sqlPengalaman);
    $stmtPengalaman->bind_param("s", $id_daftar);
    $stmtPengalaman->execute();
    $resultPengalaman = $stmtPengalaman->get_result();
    $dataPengalaman = array();

    if ($resultPengalaman->num_rows > 0) {
        while ($rowPengalaman = $resultPengalaman->fetch_assoc()) {
            $dataPengalaman[] = $rowPengalaman;
        }
    }
    $stmtPengalaman->close();
    ?>

    <div class="container">
        <form method="post" action="edit3.php" enctype="multipart/form-data">
            <input type="hidden" name="id_daftar" value="<?php echo $id_daftar ?>">
            <div class="table-container table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama Perusahaan *</th>
                            <th>Tanggal Masuk Perusahaan *</th>
                            <th>Tanggal Keluar Perusahaan *</th>
                            <th>Pekerjaan *</th>
                            <th>Jabatan *</th>
                            <th>Keterangan *</th>
                            <th>Sertifikasi *</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <?php foreach ($dataPengalaman as $pengalaman) : ?>
                            <tr>
                                <td>
                                    <input type="text" class="form-control" name="nama_perusahaan[]" placeholder="Masukkan Nama Perusahaan" value="<?php echo $pengalaman['nama_perusahaan']; ?>" multiple>
                                </td>
                                <td>
                                    <input type="date" class="form-control" name="tgl_masuk_perusahaan[]" value="<?php echo $pengalaman['tgl_masuk_perusahaan']; ?>" multiple>
                                </td>
                                <td>
                                    <input type="date" class="form-control" name="tgl_keluar_perusahaan[]" value="<?php echo $pengalaman['tgl_keluar_perusahaan']; ?>" multiple>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="pekerjaan[]" placeholder="Masukkan Pekerjaan" value="<?php echo $pengalaman['pekerjaan']; ?>" multiple>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="jabatan[]" placeholder="Masukkan Jabatan" value="<?php echo $pengalaman['jabatan']; ?>" multiple>
                                </td>
                                <td>
                                    <textarea class="form-control" name="keterangan[]" placeholder="Masukkan Keterangan" rows="3" multiple><?php echo $pengalaman['keterangan']; ?></textarea>
                                </td>
                                <td>
                                    <input type="file" class="form-control" name="sertifikasi[]" placeholder="Masukkan Sertifikasi" value="<?php echo $pengalaman['sertifikasi']; ?>" multiple>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <!-- Baris kosong untuk menambahkan data baru -->
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
                                <input type="text" class="form-control" name="pekerjaan[]" placeholder="Masukkan Pekerjaan" multiple>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="jabatan[]" placeholder="Masukkan Jabatan" multiple>
                            </td>
                            <td>
                                <textarea class="form-control" name="keterangan[]" placeholder="Masukkan Keterangan" rows="3" multiple></textarea>
                            </td>
                            <td>
                                <input type="file" class="form-control" name="sertifikasi[]" placeholder="Masukkan Sertifikasi" multiple>
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
        document.addEventListener("DOMContentLoaded", function() {
            const addRowBtn = document.getElementById("add-row-btn");
            const tableBody = document.getElementById("table-body");

            addRowBtn.addEventListener("click", function() {
                const newRow = document.createElement("tr");
                newRow.innerHTML = `
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
                        <input type="text" class="form-control" name="pekerjaan[]" placeholder="Masukkan Pekerjaan" multiple>
                    </td>
                    <td>
                        <input type="text" class="form-control" name="jabatan[]" placeholder="Masukkan Jabatan" multiple>
                    </td>
                    <td>
                        <textarea class="form-control" name="keterangan[]" placeholder="Masukkan Keterangan" rows="3" multiple></textarea>
                    </td>
                    <td>
                        <input type="file" class="form-control" name="sertifikasi[]" placeholder="Masukkan Sertifikasi" multiple>
                    </td>
                `;

                tableBody.appendChild(newRow);
            });
        });
    </script>
</body>

</html>

<?php
if (isset($_POST['daftar'])) {
    // Tambahkan kode untuk menyimpan data baru atau mengupdate data yang sudah ada
    include "../koneksi.php";
    $nama_perusahaanArr = $_POST['nama_perusahaan'];
    $tgl_masuk_perusahaanArr = $_POST['tgl_masuk_perusahaan'];
    $tgl_keluar_perusahaanArr = $_POST['tgl_keluar_perusahaan'];
    $pekerjaanArr = $_POST['pekerjaan'];
    $jabatanArr = $_POST['jabatan'];
    $keteranganArr = $_POST['keterangan'];
    $sertifikasiArr = $_POST['sertifikasi'];

    $targetpengalaman = "pengalaman/";

    for ($i = 0; $i < count($nama_perusahaanArr); $i++) {
        $nama_perusahaan = mysqli_real_escape_string($koneksi, $nama_perusahaanArr[$i]);
        $tgl_masuk_perusahaan = $tgl_masuk_perusahaanArr[$i];
        $tgl_keluar_perusahaan = $tgl_keluar_perusahaanArr[$i];
        $pekerjaan = mysqli_real_escape_string($koneksi, $pekerjaanArr[$i]);
        $jabatan = mysqli_real_escape_string($koneksi, $jabatanArr[$i]);
        $keterangan = mysqli_real_escape_string($koneksi, $keteranganArr[$i]);
        $sertifikasi = mysqli_real_escape_string($koneksi, $sertifikasiArr[$i]);

        // Periksa apakah file ijazah_sekolah di-upload
        if (!empty($ijazah_sekolahArr['name'][$i])) {
            $ijazah_sekolah = $targetpengalaman . basename($sertifikasiArr['name'][$i]);
            move_uploaded_file($sertifikasiArr['tmp_name'][$i], $sertifikasi);
        } else {
            // Jika tidak, gunakan data ijazah_sekolah yang sudah ada
            $sertifikasi = $dataPengalaman[$i]['sertifikasi'];
        }

        // Periksa apakah data pengalaman sudah ada
        if (isset($dataPengalaman[$i]['id_pengalaman'])) {
            // Jika sudah ada, lakukan update
            $id_pengalaman = $dataPengalaman[$i]['id_pengalaman'];
            $update = mysqli_query($koneksi, "UPDATE pengalaman SET 
                        nama_perusahaan='$nama_perusahaan', 
                        tgl_masuk_perusahaan='$tgl_masuk_perusahaan', 
                        tgl_keluar_perusahaan='$tgl_keluar_perusahaan', 
                        pekerjaan='$pekerjaan', 
                        jabatan='$jabatan', 
                        keterangan='$keterangan', 
                        sertifikasi='$sertifikasi' 
                        WHERE id='$id_pengalaman';");
            if (!$update) {
                die("Gagal mengupdate data");
            }
        } else {
            // Jika belum ada, lakukan insert
            $insert = mysqli_query($koneksi, "INSERT INTO pengalaman 
                        (id_daftar, nama_perusahaan, tgl_masuk_perusahaan, tgl_keluar_perusahaan, pekerjaan, jabatan, keterangan, sertifikasi) VALUES 
                        ('$id_daftar', '$nama_perusahaan', '$tgl_masuk_perusahaan', '$tgl_keluar_perusahaan', '$pekerjaan', '$jabatan', '$keterangan', '$sertifikasi');");
            if (!$insert) {
                die("Gagal menyimpan data");
            }
        }
    }

    echo "<script>
    Swal.fire({
        title: 'Data berhasil disimpan',
        icon: 'success',
        confirmButtonText: 'OK'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location = 'admin.php';
        }
    });
</script>";
}
?>

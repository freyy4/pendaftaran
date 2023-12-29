<?php
session_start();
if (empty($_SESSION['login'])) {
    header("Location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pendaftaran TKI Online | Edit Pelatihan</title>
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

    // Ambil data pelatihan yang sudah tersimpan
    $sqlPelatihan = "SELECT * FROM pelatihan WHERE id_daftar=?";
    $stmtPelatihan = $koneksi->prepare($sqlPelatihan);
    $stmtPelatihan->bind_param("s", $id_daftar);
    $stmtPelatihan->execute();
    $resultPelatihan = $stmtPelatihan->get_result();
    $dataPelatihan = array();

    if ($resultPelatihan->num_rows > 0) {
        while ($rowPelatihan = $resultPelatihan->fetch_assoc()) {
            $dataPelatihan[] = $rowPelatihan;
        }
    }
    $stmtPelatihan->close();
    ?>

    <div class="container">
        <form method="post" action="edit_pelatihan.php" enctype="multipart/form-data">
            <input type="hidden" name="id_daftar" value="<?php echo $id_daftar ?>">
            <div class="table-container table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Instansi *</th>
                            <th>Sertifikat *</th>
                            <th>Tanggal Keluar Sertifikat *</th>
                            <th>No. Sertifikat *</th>
                            <th>Jenis *</th>
                            <th>Uraian *</th>
                            <th>File Sertifikat *</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <?php foreach ($dataPelatihan as $pelatihan) : ?>
                            <tr>
                                <td>
                                    <input type="text" class="form-control" name="instansi[]" placeholder="Masukkan Instansi" value="<?php echo $pelatihan['instansi']; ?>" multiple>
                                </td>
                                <td>
                                    <input type="file" class="form-control" name="sertifikat[]" value="<?php echo $pelatihan['sertifikat']; ?>" multiple>
                                </td>
                                <td>
                                    <input type="date" class="form-control" name="tgl_keluar_sertifikat[]" value="<?php echo $pelatihan['tgl_keluar_sertifikat']; ?>" multiple>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="no_sertifikat[]" placeholder="Masukkan No. Sertifikat" value="<?php echo $pelatihan['no_sertifikat']; ?>" multiple>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="jenis[]" placeholder="Masukkan Jenis Pelatihan" value="<?php echo $pelatihan['jenis']; ?>" multiple>
                                </td>
                                <td>
                                    <textarea class="form-control" name="uraian[]" placeholder="Masukkan Uraian Pelatihan" rows="3" multiple><?php echo $pelatihan['uraian']; ?></textarea>
                                </td>
                                <td>
                                    <input type="file" class="form-control" name="file_sertifikat[]" multiple>
                                </td>
                            </tr>
                        <?php endforeach; ?>
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
                        <input type="text" class="form-control" name="instansi[]" placeholder="Masukkan Instansi" multiple>
                    </td>
                    <td>
                        <input type="file" class="form-control" name="sertifikat[]" multiple>
                    </td>
                    <td>
                        <input type="date" class="form-control" name="tgl_keluar_sertifikat[]" multiple>
                    </td>
                    <td>
                        <input type="text" class="form-control" name="no_sertifikat[]" placeholder="Masukkan No. Sertifikat" multiple>
                    </td>
                    <td>
                        <input type="text" class="form-control" name="jenis[]" placeholder="Masukkan Jenis Pelatihan" multiple>
                    </td>
                    <td>
                        <textarea class="form-control" name="uraian[]" placeholder="Masukkan Uraian Pelatihan" rows="3" multiple></textarea>
                    </td>
                    <td>
                        <input type="file" class="form-control" name="file_sertifikat[]" multiple>
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
    // Proses penyimpanan data
    include "koneksi.php";
    $instansiArr = $_POST['instansi'];
    $sertifikatArr = $_POST['sertifikat'];
    $tgl_keluar_sertifikatArr = $_POST['tgl_keluar_sertifikat'];
    $no_sertifikatArr = $_POST['no_sertifikat'];
    $jenisArr = $_POST['jenis'];
    $uraianArr = $_POST['uraian'];
    $file_sertifikatArr = $_FILES['file_sertifikat'];

    $targetpelatihan = "pelatihan/";

    for ($i = 0; $i < count($instansiArr); $i++) {
        $instansi = mysqli_real_escape_string($koneksi, $instansiArr[$i]);
        $sertifikat = mysqli_real_escape_string($koneksi, $sertifikatArr[$i]);
        $tgl_keluar_sertifikat = $tgl_keluar_sertifikatArr[$i];
        $no_sertifikat = mysqli_real_escape_string($koneksi, $no_sertifikatArr[$i]);
        $jenis = mysqli_real_escape_string($koneksi, $jenisArr[$i]);
        $uraian = mysqli_real_escape_string($koneksi, $uraianArr[$i]);

        // Periksa apakah file sertifikat di-upload
        if (!empty($file_sertifikatArr['name'][$i])) {
            $file_sertifikat = $targetpelatihan . basename($file_sertifikatArr['name'][$i]);
            move_uploaded_file($file_sertifikatArr['tmp_name'][$i], $file_sertifikat);
        } else {
            // Jika tidak, gunakan data sertifikat yang sudah ada
            $file_sertifikat = $dataPelatihan[$i]['file_sertifikat'];
        }

        // Periksa apakah data pelatihan sudah ada
        if (isset($dataPelatihan[$i]['id_pelatihan'])) {
            // Jika sudah ada, lakukan update
            $id_pelatihan = $dataPelatihan[$i]['id_pelatihan'];
            $update = mysqli_query($koneksi, "UPDATE pelatihan SET 
                        instansi='$instansi', 
                        sertifikat='$sertifikat', 
                        tgl_keluar_sertifikat='$tgl_keluar_sertifikat', 
                        no_sertifikat='$no_sertifikat', 
                        jenis='$jenis', 
                        uraian='$uraian', 
                        sertifikat='$file_sertifikat' 
                        WHERE id_pelatihan='$id_pelatihan';");
            if (!$update) {
                die("Gagal mengupdate data");
            }
        } else {
            // Jika belum ada, lakukan insert
            $insert = mysqli_query($koneksi, "INSERT INTO pelatihan 
                        (id_daftar, instansi, sertifikat, tgl_keluar_sertifikat, no_sertifikat, jenis, uraian, file_sertifikat) VALUES 
                        ('$id_daftar', '$instansi', '$sertifikat', '$tgl_keluar_sertifikat', '$no_sertifikat', '$jenis', '$uraian', '$file_sertifikat');");
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
            window.location = 'lihat.php';
        }
    });
</script>";
}
?>
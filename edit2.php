<?php
session_start();
if (empty($_SESSION['login'])) {
    header("Location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pendaftaran TKI Online | Riwayat Pendidikan</title>
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

    // Tambahkan kode untuk mengambil data sekolah yang sudah tersimpan
    $sqlSekolah = "SELECT * FROM sekolah WHERE id_daftar=?";
    $stmtSekolah = $koneksi->prepare($sqlSekolah);
    $stmtSekolah->bind_param("s", $id_daftar);
    $stmtSekolah->execute();
    $resultSekolah = $stmtSekolah->get_result();
    $dataSekolah = array();

    if ($resultSekolah->num_rows > 0) {
        while ($rowSekolah = $resultSekolah->fetch_assoc()) {
            $dataSekolah[] = $rowSekolah;
        }
    }
    $stmtSekolah->close();
    ?>

    <div class="container">
        <form method="post" action="edit2.php" enctype="multipart/form-data">
            <input type="hidden" name="id_daftar" value="<?php echo $id_daftar ?>">
            <div class="table-container table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama Sekolah *</th>
                            <th>Tanggal Masuk Sekolah *</th>
                            <th>Tanggal Lulus Sekolah *</th>
                            <th>Ijazah Sekolah *</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <?php foreach ($dataSekolah as $sekolah) : ?>
                            <tr>
                                <td>
                                    <input type="text" class="form-control" name="nama_sekolah[]" placeholder="Masukkan Nama Sekolah" value="<?php echo $sekolah['nama_sekolah']; ?>" multiple>
                                </td>
                                <td>
                                    <input type="date" class="form-control" name="tgl_masuk_sekolah[]" value="<?php echo $sekolah['tgl_masuk_sekolah']; ?>" multiple>
                                </td>
                                <td>
                                    <input type="date" class="form-control" name="tgl_lulus_sekolah[]" value="<?php echo $sekolah['tgl_lulus_sekolah']; ?>" multiple>
                                </td>
                                <td>
                                    <input type="file" class="form-control" name="ijazah_sekolah[]" multiple>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <!-- Baris kosong untuk menambahkan data baru -->
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
                        <input type="text" class="form-control" name="nama_sekolah[]" placeholder="Masukkan Nama Sekolah" multiple>
                    </td>
                    <td>
                        <input type="date" class="form-control" name="tgl_masuk_sekolah[]" multiple>
                    </td>
                    <td>
                        <input type="date" class="form-control" name="tgl_lulus_sekolah[]" multiple>
                    </td>
                    <td>
                        <input type="file" class="form-control" name="ijazah_sekolah[]" multiple>
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
    include "koneksi.php";
    $nama_sekolahArr = $_POST['nama_sekolah'];
    $tgl_masuk_sekolahArr = $_POST['tgl_masuk_sekolah'];
    $tgl_lulus_sekolahArr = $_POST['tgl_lulus_sekolah'];
    $ijazah_sekolahArr = $_FILES['ijazah_sekolah'];

    $targetsekolah = "sekolah/";

    for ($i = 0; $i < count($nama_sekolahArr); $i++) {
        $nama_sekolah = mysqli_real_escape_string($koneksi, $nama_sekolahArr[$i]);
        $tgl_masuk_sekolah = $tgl_masuk_sekolahArr[$i];
        $tgl_lulus_sekolah = $tgl_lulus_sekolahArr[$i];

        // Periksa apakah file ijazah_sekolah di-upload
        if (!empty($ijazah_sekolahArr['name'][$i])) {
            $ijazah_sekolah = $targetsekolah . basename($ijazah_sekolahArr['name'][$i]);
            move_uploaded_file($ijazah_sekolahArr['tmp_name'][$i], $ijazah_sekolah);
        } else {
            // Jika tidak, gunakan data ijazah_sekolah yang sudah ada
            $ijazah_sekolah = $dataSekolah[$i]['ijazah_sekolah'];
        }

        // Periksa apakah data sekolah sudah ada
        if (isset($dataSekolah[$i]['id_sekolah'])) {
            // Jika sudah ada, lakukan update
            $id_sekolah = $dataSekolah[$i]['id_sekolah'];
            $update = mysqli_query($koneksi, "UPDATE sekolah SET 
                        nama_sekolah='$nama_sekolah', 
                        tgl_masuk_sekolah='$tgl_masuk_sekolah', 
                        tgl_lulus_sekolah='$tgl_lulus_sekolah', 
                        ijazah_sekolah='$ijazah_sekolah' 
                        WHERE id='$id_sekolah';");
            if (!$update) {
                die("Gagal mengupdate data");
            }
        } else {
            // Jika belum ada, lakukan insert
            $insert = mysqli_query($koneksi, "INSERT INTO sekolah 
                        (id_daftar, nama_sekolah, tgl_masuk_sekolah, tgl_lulus_sekolah, ijazah_sekolah) VALUES 
                        ('$id_daftar', '$nama_sekolah', '$tgl_masuk_sekolah', '$tgl_lulus_sekolah', '$ijazah_sekolah');");
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
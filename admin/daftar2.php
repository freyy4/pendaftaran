<?php
session_start();
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
</head>

<body>
    <?php
    $id_daftar = $_SESSION['id_daftar'];
    ?>
    <?php include 'navbar.php'; ?>
    <div class="container">
        <form method="post" action="daftar2.php" enctype="multipart/form-data">
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
                        <tr>
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
    include "../koneksi.php";
    $nama_sekolahArr = $_POST['nama_sekolah'];
    $tgl_masuk_sekolahArr = $_POST['tgl_masuk_sekolah'];
    $tgl_lulus_sekolahArr = $_POST['tgl_lulus_sekolah'];
    $ijazah_sekolahArr = $_FILES['ijazah_sekolah'];

    $targetsekolah = "sekolah/";

    for ($i = 0; $i < count($nama_sekolahArr); $i++) {
        $nama_sekolah = mysqli_real_escape_string($koneksi, $nama_sekolahArr[$i]);
        $tgl_masuk_sekolah = $tgl_masuk_sekolahArr[$i];
        $tgl_lulus_sekolah = $tgl_lulus_sekolahArr[$i];

        $ijazah_sekolah = $targetsekolah . basename($ijazah_sekolahArr['name'][$i]);

        move_uploaded_file($ijazah_sekolahArr['tmp_name'][$i], $ijazah_sekolah);

        $insert = mysqli_query($koneksi, "INSERT INTO sekolah 
                        (id_daftar, nama_sekolah, tgl_masuk_sekolah, tgl_lulus_sekolah, ijazah_sekolah) VALUES 
                        ('$id_daftar', '$nama_sekolah', '$tgl_masuk_sekolah', '$tgl_lulus_sekolah', '$ijazah_sekolah');");
        $_SESSION['id_daftar'] = $id_daftar;
        if (!$insert) {
            die("Gagal menyimpan data");
        }
    }

    echo "<script>
        alert('Data berhasil disimpan 😁');
        window.location='daftar3.php';
        </script>";
}
?>
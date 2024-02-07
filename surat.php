<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pendaftaran TKI Online | Edit</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="cbm.png">
</head>

<body>
    <?php
    include 'koneksi.php';
    session_start();
    $id_daftar = $_SESSION['id_daftar'];
    $sql = "SELECT * FROM daftar WHERE id_daftar = '$id_daftar'";
    $data = mysqli_query($koneksi, $sql);
    while ($d = mysqli_fetch_array($data)) {
    ?>
        <div class="container card">
            <h5>Update Data dengan Nama "<?php echo $d['nama_lengkap']; ?>"</h5>
            <form action="surat.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id_daftar" value="<?php echo $d['id_daftar']; ?>">
                <div class="form-group">
                    <label for="surat">Upload Surat Pernyataan*</label>
                    <input type="file" class="form-control" id="surat" name="surat">
                </div>
                <input type="submit" value="Update" class="btn btn-primary form-control" name="update">
            </form>
        </div>
    <?php
    }
    ?>

    <?php
    if (isset($_POST['update'])) {
        $id_daftar = $_POST['id_daftar'];
        $surat = basename($_FILES['surat']['name']);
        move_uploaded_file($_FILES['surat']['tmp_name'], __DIR__ . '/' . $surat);
        include "koneksi.php";
        $update = mysqli_query($koneksi, "UPDATE daftar SET surat_keluarga = '$surat' WHERE id_daftar = '$id_daftar';");
        if ($update) {
            echo "<script>
            alert('Data berhasil diperbarui 😁');
            window.location='dash.php';
            </script>";
        } else {
            echo "Error: " . mysqli_error($koneksi);
        }
    }
    ?>

</body>

</html>

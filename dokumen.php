<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pendaftaran TKI Online | Edit</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
    $d = mysqli_fetch_assoc($data);
    ?>
    <div class="container card">
        <h5>Update Data dengan Nama "<?php echo $d['nama_lengkap']; ?>"</h5>
        <form action="berkas.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_daftar" value="<?php echo $d['id_daftar']; ?>">
            <div class="form-group">
                <label for="foto_ktp">Kartu Tanda Penduduk </label>
                <input type="file" class="form-control" id="foto_ktp" name="foto_ktp" accept="image/" required>
            </div>
            <div class="form-group">
                <label for="selfie_ktp">Selfie Dengan KTP Asli </label>
                <input type="file" class="form-control" id="selfie_ktp" name="selfie_ktp" accept="image/" required>
            </div>
            <div class="form-group">
                <label for="pas">Pas Foto 3 x 4 </label>
                <input type="file" class="form-control" id="pas" name="pas" accept="image/" required>
            </div>
            <div class="form-group">
                <label for="foto">Foto Keseluruhan Badan (Tanpa Hijab/Penutup Kepala)</label>
                <input type="file" class="form-control" id="foto" name="foto" accept="image/" required>
            </div>
            <div class="form-group">
                <label for="kk">Kartu Keluarga </label>
                <input type="file" class="form-control" id="kk" name="kk" accept="image/" required>
            </div>
            <div class="form-group">
                <label for="nikah">Buku Nikah / Surat Keterangan Nikah (Jika sudah menikah, belum cerai)</label>
                <input type="file" class="form-control" id="nikah" name="nikah" accept="image/" required>
            </div>
            <div class="form-group">
                <label for="cerai">Akte Cerai (Jika sudah cerai) </label>
                <input type="file" class="form-control" id="cerai" name="cerai" accept="image/" required>
            </div>
            <div class="form-group">
                <label for="lahir">Akte Kelahiran</label>
                <input type="file" class="form-control" id="lahir" name="lahir" accept="image/" required>
            </div>
            <div class="form-group">
                <label for="video">Video Perkenalan (Maks. 1 Menit) </label>
                <input type="file" class="form-control" id="video" name="video" required>
            </div>
            <input type="submit" value="Update" class="btn btn-primary form-control" name="update">
        </form>
    </div>

    <?php
    if (isset($_POST['update'])) {
        $id_daftar = $_POST['id_daftar'];
        $foto_ktp = basename($_FILES['foto_ktp']['name']);
        $selfie_ktp = basename($_FILES['selfie_ktp']['name']);
        $pas = basename($_FILES['pas']['name']);
        $foto = basename($_FILES['foto']['name']);
        $kk = basename($_FILES['kk']['name']);
        $nikah = basename($_FILES['nikah']['name']);
        $cerai = basename($_FILES['cerai']['name']);
        $lahir = basename($_FILES['lahir']['name']);
        $video = basename($_FILES['video']['name']);
        move_uploaded_file($_FILES['foto_ktp']['tmp_name'], __DIR__ . '/' . $foto_ktp);
        move_uploaded_file($_FILES['selfie_ktp']['tmp_name'], __DIR__ . '/' . $selfie_ktp);
        move_uploaded_file($_FILES['pas']['tmp_name'], __DIR__ . '/' . $pas);
        move_uploaded_file($_FILES['foto']['tmp_name'], __DIR__ . '/' . $foto);
        move_uploaded_file($_FILES['kk']['tmp_name'], __DIR__ . '/' . $kk);
        move_uploaded_file($_FILES['nikah']['tmp_name'], __DIR__ . '/' . $nikah);
        move_uploaded_file($_FILES['cerai']['tmp_name'], __DIR__ . '/' . $cerai);
        move_uploaded_file($_FILES['lahir']['tmp_name'], __DIR__ . '/' . $lahir);
        move_uploaded_file($_FILES['video']['tmp_name'], __DIR__ . '/' . $video);
        include "koneksi.php";
        $update = mysqli_query($koneksi, "UPDATE daftar SET 
        foto_ktp='$foto_ktp', 
        selfie_ktp='$selfie_ktp', 
        pas='$pas', 
        foto='$foto', 
        kk='$kk', 
        buku_nikah='$nikah', 
        akte_cerai='$cerai', 
        akte_kelahiran='$lahir', 
        video='$video'
        WHERE id_daftar='$id_daftar'");
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

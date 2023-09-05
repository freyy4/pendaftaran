<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pendaftaran TKI Online | Admin | "<?php echo $d['nama_lengkap']; ?>"</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>

<body>
    <?php
    include '../koneksi.php';
    session_start();
    $id_daftar = $_GET['id_daftar'];
    $sql = "SELECT * FROM daftars WHERE id_daftar = '$id_daftar'";
    $data = mysqli_query($koneksi, $sql);
    while ($d = mysqli_fetch_array($data)) {
    ?>
        <div class="container card">
            <h5>Update Data dengan Nama "<?php echo $d['nama_lengkap']; ?>"</h5>
            <form action="ubah2.php" method="post">
                <input type="hidden" name="id_daftar" value="<?php echo $d['id_daftar']; ?>">
                <label for="terima">Terima / Tolak</label>
                <select name="terima" id="terima" class="form-control" value="<?php echo $d['terima']; ?>">
                    <option value="terima">Terima</option>
                    <option value="tolak">Tolak</option>
                </select>
                <label for="aktif">Aktif / Nonaktif</label>
                <select name="aktif" id="aktif" class="form-control" value="<?php echo $d['aktif']; ?>">
                    <option value="aktif">Aktif</option>
                    <option value="nonaktif">Nonaktif</option>
                </select>
                <input type="submit" value="Update" class="btn btn-primary form-control" onClick="alet()">
            </form>
        <?php } ?>
        </div>

        <?php
        if (isset($_POST['id_daftar'], $_POST['terima'], $_POST['aktif'])) {
            include '../koneksi.php';
            $id_daftar = mysqli_real_escape_string($koneksi, $_POST['id_daftar']);
            $terima = mysqli_real_escape_string($koneksi, $_POST['terima']);
            $aktif = mysqli_real_escape_string($koneksi, $_POST['aktif']);
            $update = "UPDATE daftars SET terima='$terima', aktif='$aktif' WHERE id_daftar='$id_daftar'";
            if (mysqli_query($koneksi, $update)) {
                echo "<script>alert('Data berhasil diperbarui.'); window.location.href = 'admin.php';</script>";
            } else {
                echo "Terjadi kesalahan dalam memperbarui data: " . mysqli_error($koneksi);
            }
            mysqli_close($koneksi);
        }
        ?>
        <!-- Include Bootstrap JS and jQuery -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>
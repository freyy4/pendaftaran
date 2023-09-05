<?php
if (isset($_POST['daftar'])) {
    // Ambil data dari formulir
    $id_daftar = $_POST['id_daftar'];
    $instansiArr = $_POST['instansi'];
    $tgl_keluar_sertifikatArr = $_POST['tgl_keluar_sertifikat'];
    $no_sertifikatArr = $_POST['no_sertifikat'];
    $jenisArr = $_POST['jenis'];
    $uraianArr = $_POST['uraian'];

    // Mengatur lokasi penyimpanan file sertifikat
    $target_dir = "sertifikat/";

    // Proses multiple insert
    include "koneksi.php";

    for ($i = 0; $i < count($instansiArr); $i++) {
        $instansi = mysqli_real_escape_string($koneksi, $instansiArr[$i]);
        $tgl_keluar_sertifikat = mysqli_real_escape_string($koneksi, $tgl_keluar_sertifikatArr[$i]);
        $no_sertifikat = mysqli_real_escape_string($koneksi, $no_sertifikatArr[$i]);
        $jenis = mysqli_real_escape_string($koneksi, $jenisArr[$i]);
        $uraian = mysqli_real_escape_string($koneksi, $uraianArr[$i]);

        $sertifikat = $target_dir . basename($_FILES['sertifikat']['name'][$i]);

        if (move_uploaded_file($_FILES['sertifikat']['tmp_name'][$i], $sertifikat)) {
            $insert = mysqli_query($koneksi, "INSERT INTO pelatihan (id_daftar, instansi, sertifikat, tgl_keluar_sertifikat, no_sertifikat, jenis, uraian) 
                                              VALUES ('$id_daftar', '$instansi', '$sertifikat', '$tgl_keluar_sertifikat', '$no_sertifikat', '$jenis', '$uraian');");
            
            if (!$insert) {
                die("Gagal menyimpan data");
            }
        } else {
            die("Gagal mengupload file sertifikat");
        }
    }

    echo "<script>
        alert('Data berhasil disimpan 😁');
        window.location='lihat.php';
        </script>";
}
?>

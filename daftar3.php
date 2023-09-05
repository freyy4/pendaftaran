<?php
if (isset($_POST['daftar'])) {
    include "koneksi.php";

    $id_daftar = mysqli_real_escape_string($koneksi, $_POST['id_daftar']);
    $nama_perusahaanArr = $_POST['nama_perusahaan'];
    $tgl_masuk_perusahaanArr = $_POST['tgl_masuk_perusahaan'];
    $tgl_keluar_perusahaanArr = $_POST['tgl_keluar_perusahaan'];
    $pekerjaanArr = $_POST['pekerjaan'];
    $jabatanArr = $_POST['jabatan'];
    $keteranganArr = $_POST['keterangan'];
    $sertifikasiArr = $_FILES['sertifikasi'];

    for ($i = 0; $i < count($nama_perusahaanArr); $i++) {
        $nama_perusahaan = mysqli_real_escape_string($koneksi, $nama_perusahaanArr[$i]);
        $tgl_masuk_perusahaan = mysqli_real_escape_string($koneksi, $tgl_masuk_perusahaanArr[$i]);
        $tgl_keluar_perusahaan = mysqli_real_escape_string($koneksi, $tgl_keluar_perusahaanArr[$i]);
        $pekerjaan = mysqli_real_escape_string($koneksi, $pekerjaanArr[$i]);
        $jabatan = mysqli_real_escape_string($koneksi, $jabatanArr[$i]);
        $keterangan = mysqli_real_escape_string($koneksi, $keteranganArr[$i]);

        $target_dir = "sertifikasi/";
        $sertifikasi = $target_dir . basename($sertifikasiArr['name'][$i]);
        move_uploaded_file($sertifikasiArr['tmp_name'][$i], $sertifikasi);

        $insert = mysqli_query($koneksi, "INSERT INTO pengalaman (id_daftar, nama_perusahaan, tgl_masuk_perusahaan, tgl_keluar_perusahaan, pekerjaan, jabatan, keterangan, sertifikasi) VALUES ('$id_daftar', '$nama_perusahaan', '$tgl_masuk_perusahaan', '$tgl_keluar_perusahaan', '$pekerjaan', '$jabatan', '$keterangan', '$sertifikasi');");

        if (!$insert) {
            die("Gagal menyimpan data");
        }
    }

    echo "<script>
        alert('Data berhasil disimpan 😁');
        window.location='index4.php';
        </script>";
}
?>

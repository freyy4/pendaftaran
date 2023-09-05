<?php
if (isset($_POST['daftar'])) {
    $id_daftar = $_POST['id_daftar'];
    $nik=$_POST['nik'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tgl_lahir=  $_POST["tgl_lahir"];
    $status = $_POST['status'];
    $tinggi = $_POST['tinggi'];
    $berat = $_POST['berat'];
    $provinsi = $_POST['provinsi'];
    $kota = $_POST['kota'];
    $kecamatan = $_POST['kecamatan'];
    $desa = $_POST['desa'];
    $alamat_lengkap = $_POST['alamat_lengkap'];
    $telepon = $_POST['telepon'];
    $targetktp = "ktp/";
    $targetselfie = "selfie/";
    $foto_ktp = $targetktp . basename($_FILES['foto_ktp']['name']);
    $selfie_ktp = $targetselfie . basename($_FILES['selfie_ktp']['name']);
    move_uploaded_file($_FILES['foto_ktp']['tmp_name'], $foto_ktp);
    move_uploaded_file($_FILES['selfie_ktp']['tmp_name'], $selfie_ktp);
    include "koneksi.php";
    $insert = mysqli_query($koneksi, "INSERT INTO daftars (id_daftar, nik, nama_lengkap, tempat_lahir, tgl_lahir, status, tinggi, berat, id_provinsi, id_kota, id_kecamatan, id_desa, alamat_lengkap, foto_ktp, selfie_ktp, telepon, terima, aktif) VALUES ('$id_daftar', '$nik', '$nama_lengkap', '$tempat_lahir', '$tgl_lahir', '$status', '$tinggi', '$berat', '$provinsi', '$kota', '$kecamatan', '$desa', '$alamat_lengkap', '$foto_ktp', '$selfie_ktp', '62$telepon', 'tolak', 'nonaktif');");
    if ($insert) {
        echo "<script>
        alert('Data berhasil disimpan 😁');
        window.location='index2.php';
        </script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>
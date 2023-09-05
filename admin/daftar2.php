<?php
if (isset($_POST['daftar'])) {
        include "koneksi.php";
        $id_pendaftaran = $_POST['id_pendaftaran'];
        $nama_sekolahArr = $_POST['nama_sekolah'];
        $tgl_masuk_sekolahArr = $_POST['tgl_masuk_sekolah'];
        $tgl_lulus_sekolahArr = $_POST['tgl_lulus_sekolah'];
        $ijazah_sekolahArr = $_FILES['ijazah_sekolah'];

        $targetsekolah = "../sekolah/";

        for ($i = 0; $i < count($nama_sekolahArr); $i++) {
            $id_pendaftaran = $_POST['id_pendaftaran'];
            $nama_sekolah = mysqli_real_escape_string($koneksi, $nama_sekolahArr[$i]);
            $tgl_masuk_sekolah = $tgl_masuk_sekolahArr[$i];
            $tgl_lulus_sekolah = $tgl_lulus_sekolahArr[$i];

            $ijazah_sekolah = $targetsekolah . basename($ijazah_sekolahArr['name'][$i]);

            move_uploaded_file($ijazah_sekolahArr['tmp_name'][$i], $ijazah_sekolah);

            $insert = mysqli_query($koneksi, "INSERT INTO sekolah 
                        (id_pendaftaran, nama_sekolah, tgl_masuk_sekolah, tgl_lulus_sekolah, ijazah_sekolah) VALUES 
                        ('$id_pendaftaran', '$nama_sekolah', '$tgl_masuk_sekolah', '$tgl_lulus_sekolah', '$ijazah_sekolah');");

            if (!$insert) {
                die("Gagal menyimpan data");
            }
        }

        echo "<script>
        alert('Data berhasil disimpan 😁');
        window.location='index3.php';
        </script>";
    }
    ?>

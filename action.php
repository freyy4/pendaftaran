<?php
include('koneksi.php');
session_start();

if (!empty($_SESSION['login'])) {
    header("Location: dash.php");
    exit();
}

if (isset($_POST["login"])) {
    $nowa = mysqli_real_escape_string($koneksi, trim($_POST['nowa']));
    $password = trim($_POST['password']);

    // Fetch data user berdasarkan nomor WhatsApp
    $sql = mysqli_query($koneksi, "SELECT * FROM login WHERE nowa = '$nowa'");
    $count = mysqli_num_rows($sql);

    if ($count > 0) {
        $fetch = mysqli_fetch_array($sql);
        $hashpassword = $fetch["password"];

        // Verifikasi password
        if (password_verify($password, $hashpassword)) {
            $_SESSION['login'] = md5($fetch['nowa']);
            $_SESSION['id'] = $fetch['id'];
            $_SESSION['id_daftar'] = $fetch['id_daftar'];
            $_SESSION['nowa'] = $fetch['nowa'];

            if ($fetch['role'] == 'user') {
                if ($fetch['id_daftar'] != null) {
                    echo "<script>alert('Anda berhasil Login.'); window.location.replace('dash.php');</script>";
                    exit();
                } else {
                    // Pendaftaran belum lengkap
                    echo "<script>alert('Anda belum melengkapi pendaftaran.');</script>";
                }
            } elseif ($fetch['role'] == 'admin') {
                header("Location: admin/dash.php");
                exit();
            }
        } else {
            // Password salah
            echo "<script>alert('Nomor WhatsApp atau Password Anda Salah, Coba Lagi');</script>";
        }
    } else {
        // Nomor WhatsApp tidak ditemukan
        echo "<script>alert('Nomor WhatsApp tidak ditemukan');</script>";
    }
}
?>

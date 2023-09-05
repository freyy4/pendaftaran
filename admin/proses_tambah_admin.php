<?php
include('../koneksi.php');

if (isset($_POST["register"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Periksa apakah email sudah ada dalam database
    $check_query = mysqli_query($koneksi, "SELECT * FROM admin WHERE email = '$email'");
    $rowCount = mysqli_num_rows($check_query);

    if ($rowCount > 0) {
        ?>
        <script>
            alert("Email sudah ada");
            window.location.replace('tambah_user.php');
        </script>
        <?php
    } else {
        // Hash password sebelum menyimpannya ke database
        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        // Simpan data ke database
        $result = mysqli_query($koneksi, "INSERT INTO admin (email, password, status) VALUES ('$email', '$password_hash', 1)");
        
        if ($result) {
            ?>
            <script>
                alert("Pendaftaran Berhasil");
                window.location.replace('daftar_admin.php');
            </script>
            <?php
        } else {
            ?>
            <script>
                alert("Registrasi Gagal, Coba lagi");
                window.location.replace('tambah_user.php');
            </script>
            <?php
        }
    }
}
?>

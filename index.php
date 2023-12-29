<?php
include('koneksi.php');
session_start();

if (!empty($_SESSION['login'])) {
    header("Location: dash.php");
    exit();
}

if (isset($_POST["login"])) {
    $credential = mysqli_real_escape_string($koneksi, trim($_POST['credential']));
    $password = trim($_POST['password']);

    // Fetch data user berdasarkan nomor WhatsApp atau email
    $sql = mysqli_query($koneksi, "SELECT * FROM login WHERE nowa = '$credential' OR email = '$credential'");
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
            $_SESSION['nama'] = $fetch['nama'];
            $_SESSION['email'] = $fetch['email'];

            if ($fetch['role'] == 'user') {
                if ($fetch['id_daftar'] != null) {
                    header("Location: dash.php");
                    exit();
                } else {
                    header("Location: dash.php");
                    exit();
                }
            } elseif ($fetch['role'] == 'admin') {
                header("Location: admin/dash.php");
                exit();
            }
        } else {
            echo "<script>alert('Nomor WhatsApp atau Email dan Password Anda Salah, Coba Lagi');</script>";
        }
    } else {
        echo "<script>alert('Nomor WhatsApp atau Email tidak ditemukan');</script>";
    }
}
?>


<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
    <link rel="icon" href="Favicon.png">

    <!-- Bootstrap CSS -->
    <style>
        .gradient-custom {
            /* fallback for old browsers */
            background: #6a11cb;

            /* Chrome 10-25, Safari 5.1-6 */
            background: -webkit-linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));

            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            background: linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1))
        }
    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <title>Pendaftaran TKI Online | Login</title>
</head>

<body>
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5">

                            <form class="mb-md-5 mt-md-4 pb-5" action="#" method="POST" name="login">
                                <div class="row">
                                    <h2 class="text-center">PT CRYSTAL BIRU MEULIGO</h2>
                                </div><br>
                                <div class="form-outline form-white mb-4">
                                    <label class="form-label" for="typeCredential">Nomor WhatsApp atau Email</label>
                                    <input type="text" id="typeCredential" class="form-control form-control-lg" name="credential" placeholder="Masukkan Nomor WhatsApp atau Email" required autofocus />
                                </div>

                                <div class="form-outline form-white mb-4">
                                    <label class="form-label" for="typePasswordX">Password</label>
                                    <div class="input-group">
                                        <input type="password" id="password" class="form-control form-control-lg" name="password" placeholder="Masukkan Password" required>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <img src="https://cdn.icon-icons.com/icons2/3361/PNG/512/optical_vision_views_visible_eye_password_show_password_visibility_view_eye_icon_210818.png" height="30px" width="30px" id="togglePassword">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-outline-light btn-lg px-5" value="Masuk" name="login">
                                <p class="mb-0">Belum punya Akun? <a href="register.php" class="text-white-50 fw-bold">Registrasi disini</a>
                            </form>

                            <div>
                                <div class="text-center">
                                    <p>Lupa Password</p>
                                    <a href="wa.php" class="btn btn-success btn-sm">Kirim Lewat WhatsApp</a> 
                                    <a href="recover_psw.php" class="btn btn-danger btn-sm">Kirim Lewat Email</a> 
                                </div>
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
<script>
    const toggle = document.getElementById('togglePassword');
    const password = document.getElementById('password');
    const credentialInput = document.getElementById('typeCredential');

    toggle.addEventListener('click', function() {
        if (password.type === "password") {
            password.type = 'text';
        } else {
            password.type = 'password';
        }
        this.classList.toggle('bi-eye');
    });

    document.querySelector('form[name="login"]').addEventListener('submit', function (event) {
        // Check if the input is a phone number
        const isPhoneNumber = /^\d+$/.test(credentialInput.value);

        // If it's a phone number, remove leading '0' and prepend '62'
        if (isPhoneNumber && credentialInput.value.startsWith('0')) {
            credentialInput.value = '62' + credentialInput.value.slice(1);
        }
    });
</script>
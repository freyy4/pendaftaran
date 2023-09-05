<?php
include('koneksi.php');
session_start();
if (!empty($_SESSION['login'])) {
    header("Location: index.php");
}

if (isset($_POST["login"])) {
    $email = mysqli_real_escape_string($koneksi, trim($_POST['email']));
    $password = trim($_POST['password']);
    $sql = mysqli_query($koneksi, "SELECT * FROM login WHERE email = '$email'");
    $count = mysqli_num_rows($sql);
    $fetch = mysqli_fetch_array($sql);

    if ($count > 0) {
        $hashpassword = $fetch["password"];
        if ($fetch["status"] == 0) {
            ?>
            <script>
                alert("Email Anda belum Terverifikasi");
            </script>
        <?php
        } else if (password_verify($password, $hashpassword)) {
            $_SESSION['login'] = md5($fetch['email']);
            $_SESSION['id_daftar'] = $fetch['id_daftar'];
            $_SESSION['email'] = $fetch['email'];

            // Tambahkan pengecekan apakah data sudah diisi semua
            $id_daftar = $_SESSION['id_daftar'];
            $sql_data_check = "SELECT * FROM daftars WHERE id_daftar = ? 
                                AND id_daftar IN (SELECT id_daftar FROM sekolah) 
                                AND id_daftar IN (SELECT id_daftar FROM pengalaman)";
            $stmt_data_check = $koneksi->prepare($sql_data_check);
            $stmt_data_check->bind_param("i", $id_daftar);
            $stmt_data_check->execute();
            $result_data_check = $stmt_data_check->get_result();
            $stmt_data_check->close();

            if ($result_data_check->num_rows > 0) {
                header("Location: lihat.php");
                exit();
            } else {
                header("Location: index.php"); // Halaman untuk melengkapi data jika belum lengkap
                exit();
            }
        } else {
        ?>
            <script>
                alert("Email dan Password Anda Salah, Coba Lagi");
            </script>
<?php
        }
    }
}
?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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

    <link rel="stylesheet" href="style.css">

    <link rel="icon" href="Favicon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <title>Pendaftaran TKI Online | Login</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light navbar-laravel">
        <div class="container">
            <a class="navbar-brand" href="#">Pendaftaran TKI Online</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="login.php" style="font-weight:bold; color:black; text-decoration:underline">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Register</a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>

    <main class="login-form">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Login</div>
                        <div class="card-body">
                            <form action="#" method="POST" name="login">
                                <div class="form-group row">
                                    <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail</label>
                                    <div class="col-md-6">
                                        <input type="text" id="email_address" class="form-control" name="email" required autofocus>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                    <div class="col-md-6">
                                        <input type="password" id="password" class="form-control" name="password" required><br>
                                        <i class="bi bi-eye-slash" id="togglePassword"> Lihat Password</i>
                                    </div>
                                </div>

                                <div class="col-md-6 offset-md-4">
                                    <input type="submit" class="btn btn-success" value="Login" name="login">
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>

    </main>
</body>

</html>
<script>
    const toggle = document.getElementById('togglePassword');
    const password = document.getElementById('password');

    toggle.addEventListener('click', function() {
        if (password.type === "password") {
            password.type = 'text';
        } else {
            password.type = 'password';
        }
        this.classList.toggle('bi-eye');
    });
</script>
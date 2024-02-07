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
            $_SESSION['email_verify'] = $fetch['email_verify'];
            $_SESSION['role'] = $fetch['role'];

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
            echo '<div class="alert alert-danger alert-dismissible fade show sticky-top" role="alert">
                    <strong>Oops...</strong> Nomor WhatsApp atau Email dan Password Anda Salah, Coba Lagi
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
        }
    } else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Oops...</strong> Nomor WhatsApp atau Email tidak ditemukan
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="favicon.jpg" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
    <title>Login PT. CBM | Pendaftaran Online</title>
    <style>
    body {
        background: #373B44;
        background: -webkit-linear-gradient(190deg, #4286f4, #373B44);
        background: linear-gradient(190deg, #4286f4, #373B44);
        font-family: 'Raleway', sans-serif;
        color: white;
    }

    .container {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
    }

    .card {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 20px;
    }

    input[type=text],
    input[type=password] {
        background-color: transparent;
    }

    input[type=text]::placeholder,
    input[type=password]::placeholder {
        color: white;
    }

    #togglePassword {
        cursor: pointer;
    }

    .usaha {
        width: 60px;
        height: 60px;
    }

    p,
    label,
    a,
    .btn {
        color: white;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="col-md-6">
            <div class="card shadow-lg mb-5">
                <div class="text-center">
                    <img class="usaha" src="https://ptcbm.id/wp-content/uploads/2023/03/logo-pt-cbm-white.png" alt="">
                </div>
                <div class="card-body">
                    <form class="mb-md-5" action="index.php" method="POST" name="login">
                        <div class="form-group">
                            <label for="typeCredential">Nomor WhatsApp atau Email-mu</label>
                            <input type="text" id="typeCredential" class="form-control" name="credential"
                                placeholder="Nomor WhatsApp atau Email" required autofocus />
                        </div>
                        <div class="form-group">
                            <label for="typePasswordX">Password</label>
                            <div class="input-group">
                                <input type="password" id="password" class="form-control" name="password"
                                    placeholder="Masukkan Password" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <img src="https://cdn.icon-icons.com/icons2/2406/PNG/512/eye_slash_visible_hide_hidden_show_icon_145987.png"
                                            height="20px" width="20px" id="togglePassword">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-outline-dark btn-lg btn-block" value="Masuk"
                            name="login"><br>
                        <p class="mt-3 mb-0">Belum punya Akun? <a href="register.php" class="text-black fw-bold"
                                style="color: white;">Registrasi disini</a></p>
                        <div class="text-center">
                            <p class="mt-3 mb-0">Lupa Password ?</p>
                            <a href="wa.php" class="btn btn-outline-success btn-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                    class="bi bi-whatsapp" viewBox="0 0 16 16">
                                    <path
                                        d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232" />
                                </svg> WhatsApp</a>
                            <a href="recover_psw.php" class="btn btn-outline-danger btn-sm"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                    class="bi bi-envelope" viewBox="0 0 16 16">
                                    <path
                                        d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z" />
                                </svg>
                                Email</a>
                        </div>
                    </form><br>
                    <p class="text-white text-center" style="font-size:12px;">Copyright &copy; PT. Crystal Biru Meuligo
                        | 2024</p>
                </div>
            </div>
        </div>
    </div>

    <script>
    const toggle = document.getElementById('togglePassword');
    const password = document.getElementById('password');

    toggle.addEventListener('click', function() {
        if (password.type === "password") {
            password.type = 'text';
            toggle.src =
                'https://cdn.icon-icons.com/icons2/2406/PNG/512/eye_visible_hide_hidden_show_icon_145988.png';
        } else {
            password.type = 'password';
            toggle.src =
                'https://cdn.icon-icons.com/icons2/2406/PNG/512/eye_slash_visible_hide_hidden_show_icon_145987.png';
        }
    });
    </script>
</body>

</html>
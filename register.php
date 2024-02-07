<?php
session_start();
include('koneksi.php');

if (isset($_POST["register"])) {
    $nowa = $_POST["nowa"];
    $password = $_POST["password"];
    $nama = $_POST["nama"];

    $check_query = mysqli_query($koneksi, "SELECT * FROM login where nowa ='$nowa'");
    $rowCount = mysqli_num_rows($check_query);

    if (!empty($nowa) && !empty($password)) {
        if ($rowCount > 0) {
            echo '<div class="alert alert-danger alert-dismissible fade show sticky-top" role="alert">
            <strong>Oops...</strong> Nomor WhatsApp ada
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
        } else {
            $password_hash = password_hash($password, PASSWORD_BCRYPT);
            $user = "user";

            $result = mysqli_query($koneksi, "INSERT INTO login (nama, nowa, password, status, role) VALUES ('$nama', '$nowa', '$password_hash', 0, '$user')");
            if ($result) {
                $otp = rand(100000, 999999);
                $_SESSION['otp'] = $otp;
                $_SESSION['nowa'] = $nowa;
                $_SESSION['nama'] = $nama;
                $curl = curl_init();
                $dataSending = array(
                    "api_key" => "VLEHPESTOYDX4GKW",
                    "number_key" => "NV7JDP4tjchTa67Y",
                    "phone_no" => $nowa,
                    "message" => "Halo $nama, Selamat Datang di WhatsApp Resmi PT. Crystal Biru Meuligo, Kode OTP-mu adalah : $otp"
                );
                curl_setopt_array($curl, array(
                  CURLOPT_URL => 'https://api.watzap.id/v1/send_message',
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => '',
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => 'POST',
                  CURLOPT_POSTFIELDS => json_encode($dataSending),
                  CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                  ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);
                echo '<script>
                    alert("Registrasi Berhasil, OTP berhasil dikirim ke Nomor WhatsApp' .  $nowa . '");
                    window.location.replace("verification.php");
                    </script>';
            }
        }
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="favicon.jpg" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
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
        background: rgba(255, 255, 255, 0.1) !important;
        border-radius: 20px !important;
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
        color: white !important;
    }
    </style>
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <link rel="icon" href="Favicon.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <title>Registrasi PT CBM | Pendaftaran Online</title>
</head>

<body>
    <div class="container">
        <div class="col-md-6">
            <div class="card shadow-lg p-3 mb-5">
                <div class="text-center">
                    <img class="usaha"
                        src="https://ptcbm.id/wp-content/uploads/2023/03/logo-pt-cbm-white.png"
                        alt="">
                </div>
                <div class="card-body">
                    <form class="mb-md-5" action="register.php" method="POST" name="register">
                        <div class="form-outline form-white mb-4">
                            <label class="form-label" for="typeEmailX">Nama Lengkap</label>
                            <input type="text" id="nama" class="form-control" name="nama"
                                placeholder="Masukkan Nama Lengkap" required autofocus/>
                        </div>
                        <div class="form-outline form-white mb-4">
                            <label class="form-label" for="typeEmailX">Nomor WhatsApp</label>
                            <input type="number" id="nowa" class="form-control" name="nowa"
                                placeholder="Masukkan Nomor WhatsApp" required/>
                        </div>
                        <div class="form-outline form-white mb-4">
                            <label class="form-label" for="typePasswordX">Password</label>
                            <div class="input-group">
                                <input type="password" id="password" class="form-control"
                                    name="password" placeholder="Masukkan Password" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <img src="https://cdn.icon-icons.com/icons2/2406/PNG/512/eye_visible_hide_hidden_show_icon_145988.png"
                                            height="20px" width="20px" id="togglePassword">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-outline-dark btn-lg btn-block" value="Daftar"
                            name="register">
                    </form><br>

                    <div>
                        <p class="mb-0">Sudah punya Akun? <a href="index.php" class="fw-bold" style="color: white;">Masuk
                                disini</a>
                        </p><br>
                        <p class="text-white text-center" style="font-size:12px;">Copyright &copy; PT. Crystal Biru Meuligo
                        | 2024</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
const toggle = document.getElementById('togglePassword');
const password = document.getElementById('password');

toggle.addEventListener('click', function() {
    if (password.type === "password") {
        password.type = 'text';
        toggle.src =
            'https://cdn.icon-icons.com/icons2/2406/PNG/512/eye_slash_visible_hide_hidden_show_icon_145987.png';
    } else {
        password.type = 'password';
        toggle.src =
            'https://cdn.icon-icons.com/icons2/2406/PNG/512/eye_visible_hide_hidden_show_icon_145988.png';
    }
});
</script>
</html>
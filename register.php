<?php
session_start();
include('koneksi.php');

if (isset($_POST["register"])) {
    $nowa = $_POST["nowa"];
    $password = $_POST["password"];

    $check_query = mysqli_query($koneksi, "SELECT * FROM login where nowa ='$nowa'");
    $rowCount = mysqli_num_rows($check_query);

    if (!empty($nowa) && !empty($password)) {
        if ($rowCount > 0) {
            ?>
            <script>
                alert("Nomor WhatsApp sudah ada");
            </script>
            <?php
        } else {
            $password_hash = password_hash($password, PASSWORD_BCRYPT);
            $user = "user";

            $result = mysqli_query($koneksi, "INSERT INTO login (nowa, password, status, role) VALUES ('$nowa', '$password_hash', 0, '$user')");
            if ($result) {
                $otp = rand(100000, 999999);
                $_SESSION['otp'] = $otp;
                $_SESSION['nowa'] = $nowa;
                $curl = curl_init();
                $dataSending = array(
                    "api_key" => "VLEHPESTOYDX4GKW",
                    "number_key" => "NV7JDP4tjchTa67Y",
                    "phone_no" => $nowa,
                    "message" => "Halo, Selamat Datang di WhatsApp Resmi PT. Crystal Biru Meuligo, Kode OTP-mu adalah : $otp"
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
                echo $response;
                ?>
            <script>
                alert("Register Berhasil, OTP berhasil dikirim ke Nomor WhatsApp <?php echo $nowa; ?>");
                window.location.replace('verification.php');
            </script>
            <?php
            }
        }
    }
}
?>

<!-- Kode HTML lainnya tetap sama -->

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


<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
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

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <title>Pendaftaran TKI Online | Registrasi Calon Tenaga Kerja</title>
</head>

<body>

    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5">

                            <form class="mb-md-5 mt-md-4 pb-5" action="register.php" method="POST" name="register">
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <img src="https://crystalbirumeuligo.com/images/logo_cbm.png" class="img-fluid mx-auto" style="width: 150px; height: 150px;">
                                    </div>
                                </div><br>
                                <div class="form-outline form-white mb-4">
                                    <label class="form-label" for="typeEmailX">Nomor WhatsApp</label>
                                    <input type="number" id="nowa" class="form-control form-control-lg" name="nowa" placeholder="Masukkan Nomor WhatsApp" required autofocus />
                                </div>

                                <div class="form-outline form-white mb-4">
                                    <label class="form-label" for="typePasswordX">Password</label>
                                    <div class="input-group">
                                        <input type="password" id="password" class="form-control form-control-lg" name="password" placeholder="Masukkan Password" required>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <input type="checkbox" id="togglePassword">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-outline-light btn-lg px-5" value="Daftar" name="register">
                            </form>

                            <div>
                                <p class="mb-0">Sudah punya Akun? <a href="index.php" class="text-white-50 fw-bold">Masuk disini</a>
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
<script>
    const toggle = document.getElementById('togglePassword');
    const password = document.getElementById('password');
    const nowa = document.getElementById('nowa');

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
        const isPhoneNumber = /^\d+$/.test(nowa.value);

        // If it's a phone number, remove leading '0' and prepend '62'
        if (isPhoneNumber && nowaInput.value.startsWith('0')) {
            nowaInput.value = '62' + nowaInput.value.slice(1);
        }
    });
</script>
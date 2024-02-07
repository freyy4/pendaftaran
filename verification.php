<?php session_start() ?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <link rel="icon" href="Favicon.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <title>One Time Password PT CBM | Pendaftaran Online</title>
</head>
<body>
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-lg p-3 mb-5" style="border-radius: 1rem;">
                        <div class="card-body p-5">
                            <form class="mb-md-5 mt-md-4 pb-5" action="#" method="POST">
                                <div class="form-outline form-white mb-4">
                                    <label class="form-label" for="typeEmailX">Kode OTP</label>
                                    <input type="text" id="otp" class="form-control form-control-lg" name="otp_code" placeholder="Masukkan Kode OTP" required autofocus><br>
                                    <p class="text-danger">Masukkan kode OTP yang kami kirimkan ke Nomor WhatsApp Anda.</p>
                                </div>
                                <input type="submit" class="btn btn-outline-black" value="Verifikasi" name="verify">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
<?php
include('koneksi.php');
if (isset($_POST["verify"])) {
    $otp = $_SESSION['otp'];
    $nowa = $_SESSION['nowa'];
    $otp_code = $_POST['otp_code'];

    if ($otp != $otp_code) {
?>
        <script>
            alert("OTP tidak sama dengan yang kami kirimkan ke Nomor WhatApp, Coba lagi");
        </script>
    <?php
    } else {
        mysqli_query($koneksi, "UPDATE login SET status = 1 WHERE nowa = '$nowa'");
    ?>
        <script>
            alert("Verifikasi Berhasil, silahkan login dengan Nomor WhatsApp Anda");
            window.location.replace("index.php");
        </script>
<?php
    }
}

?>
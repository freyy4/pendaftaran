<?php session_start() ?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
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
    <title>Pendaftaran TKI Online | Pemulihan Password</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light navbar-laravel">
        <div class="container">
            <a class="navbar-brand" href="#">Pendaftaran TKI Online</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

        </div>
    </nav>

    <main class="login-form">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Pemulihan Password</div>
                        <div class="card-body">
                            <form action="#" method="POST" name="recover_psw">
                                <div class="form-group row">
                                    <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail</label>
                                    <div class="col-md-6">
                                        <input type="text" id="email_address" class="form-control" name="email" required autofocus>
                                    </div>
                                </div>

                                <div class="col-md-6 offset-md-4">
                                    <input type="submit" value="Ganti Password" name="recover" class="btn btn-success">
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

<?php
if (isset($_POST["recover"])) {
    include('koneksi.php');
    $email = $_POST["email"];

    $sql = mysqli_query($koneksi, "SELECT * FROM admin WHERE email='$email'");
    $query = mysqli_num_rows($sql);
    $fetch = mysqli_fetch_assoc($sql);

    if (mysqli_num_rows($sql) <= 0) {
?>
        <script>
            alert("<?php echo "Maaf Email tidak ada" ?>");
        </script>
    <?php
    } else if ($fetch["status"] == 0) {
    ?>
        <script>
            alert("Maaf, Email Anda belum terverifikasi!");
            window.location.replace("login_admin.php");
        </script>
        <?php
    } else {
        // generate token by binaryhexa 
        $token = bin2hex(random_bytes(50));

        //session_start ();
        $_SESSION['token'] = $token;
        $_SESSION['email'] = $email;

        require "Mail/phpmailer/PHPMailerAutoload.php";
        $mail = new PHPMailer;

        $mail->isSMTP();
        $mail->Host = 'smtpdm-ap-southeast-1.aliyun.com';
        $mail->Port = 465;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';

        // h-hotel account
        $mail->Username = 'info@crystalbirumeuligo.com';
        $mail->Password = '444R3Km4l4n9BB';

        // send by h-hotel email
        $mail->setFrom('info@crystalbirumeuligo.com', 'PT Crystal Biru Meuligo');
        $mail->addAddress($_POST["email"]);

        // HTML body
        $mail->isHTML(true);
        $mail->Subject = "Pemulihan Password";
        $mail->Body = "<h3>Silahkan untuk reset password Anda, Klik tautan dibawah ini</h3>
            <a href=https://daftartki.kasir.xyz/reset_psw.php align=center>Reset Password</a>
            <br><br>
            <p>Hormat Kami</p><br><br>
            <b>PT. Crystal Biru Meuligo</b>";

        if (!$mail->send()) {
        ?>
            <script>
                alert("<?php echo " Email tidak diketahui" ?>");
            </script>
        <?php
        } else {
        ?>
            <script>
                alert("Email berhasil dikirim, lihat Email Anda ");
            </script>
<?php
        }
    }
}


?>
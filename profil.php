<!DOCTYPE html>
<?php
session_start();
if (empty($_SESSION['login'])) {
    header("Location:index.php");
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" />
    <title>Profil Pengguna</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .profile-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        .profile-picture {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto 15px;
        }

        .profile-picture img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        h2 {
            margin-bottom: 10px;
            color: #333;
        }

        p {
            color: #666;
        }

        .social-links {
            margin-top: 20px;
        }

        .social-links a {
            display: inline-block;
            margin: 0 10px;
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>
<body>

    <div class="profile-container">
        <h2>
            <?php 
            $nama = $_SESSION['nama'];
            $nowa = $_SESSION['nowa'];
            if ($nama) {
                echo $nama;
            } else {
                echo "+$nowa";
            }
            ?>
        </h2>
        <p>Email : 
        <?php 
            $email = $_SESSION['email'];
            if ($email) {
                echo $email;
                if ($_SESSION['email_verified']) {
                    echo " <img src='centang.png' style='width:20px; height:20px;'>";
                } else {
                    echo " (Belum Terverifikasi) <br><a href='send_otp.php' class='btn btn-primary'>Verifikasi Email</a>";
                }
            } else {
                echo "-";
            }
        ?>
        </p>

        <p>Nomor WhatsApp : 
        <?php 
            $nowa = $_SESSION['nowa'];
            if ($nowa) {
                echo "+$nowa";
            } else {
                echo "-";
            }
        ?>
        </p>

        <div class="social-links">
            <a href="dash.php">Keluar</a>
            <a href="edit_profil.php">Edit Profile</a>
        </div>
    </div>

</body>
</html>

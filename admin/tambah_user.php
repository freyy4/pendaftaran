<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pendaftaran TKI Online | Verifikasi | Data Pendaftaran</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .content {
            max-height: calc(100vh - 100px);
            padding: 20px;
        }

        .footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px;
            position: absolute;
            bottom: 0;
            width: 100%;
        }

        .container-fluid {
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <?php
    session_start();
    if (empty($_SESSION['login'])) {
        header("Location:../login_admin.php");
    }
    ?>
    <div class="container mt-5">
        <h2>Tambah Admin Baru</h2>
        <form method="post" action="proses_tambah_admin.php">
            <div class="mb-3">
                <label for="username" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="showPassword">
                    <label class="form-check-label" for="showPassword">Tampilkan password</label>
                </div>
            </div>

            <button type="submit" name="register" class="btn btn-primary">Tambah Admin</button>
        </form>
    </div>

    <script>
        const passwordInput = document.getElementById("password");
        const showPasswordCheckbox = document.getElementById("showPassword");

        showPasswordCheckbox.addEventListener("change", function() {
            if (this.checked) {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        });
    </script>

</body>

</html>
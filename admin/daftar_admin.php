<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pendaftaran TKI Online | Verifikasi | Data Pendaftaran</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <style>
        .container-fluid {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div id="page-content-wrapper">
        <?php include 'include/navbar.php'; ?>
        <div class="container content">
            <?php include 'include/sidebar.php'; ?>
            <?php
            include '../koneksi.php';
            session_start();
            if (empty($_SESSION['login'])) {
                header("Location:../login_admin.php");
            }
            ?>
            <h3>Data Admin</h3>
            <a href=""></a>
            <div class="card table-responsive">
                <table id="mydata" class="table table-dark">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include '../koneksi.php';
                        $sql1 = "SELECT * FROM admin";
                        $result = mysqli_query($koneksi, $sql1);
                        $no = 1;
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $no++ . "</td>";
                                echo "<td>" . $row["email"] . "</td>";
                                echo "</tr>";
                            }
                        }

                        $koneksi->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /#wrapper -->

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#mydata').DataTable();
        });

        function yakin() {
            return confirm("Apa Anda Yakin Ingin Keluar?");
        }
    </script>
</body>

</html>
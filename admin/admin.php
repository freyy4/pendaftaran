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
        td.badge-danger,
        td.badge-success {
            text-transform: capitalize;
        }

        .dataTables_filter input {
            appearance: none;
            border: none;
            outline: none;
            border-bottom: .2em solid blue;
            background: rgba(blue, .2);
            border-radius: .2em .2em 0 0;
            padding: .4em;
            color: blue;
        }

        .dataTables_length select {
            appearance: none;
            border: none;
            outline: none;
            border-bottom: .2em solid blue;
            background: rgba(blue, .2);
            border-radius: .2em .2em 0 0;
            padding: .4em;
            color: blue;
        }

        .container-fluid {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <?php include 'include/navbar.php'; ?>
    <div class="container content">
        <?php
        include '../koneksi.php';
        session_start();
        if (empty($_SESSION['login'])) {
            header("Location:../login_admin.php");
        }
        ?>
        <h3>Verifikasi Pendaftaran </h3>
        <a href="index.php" class="btn btn-info">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
            </svg>
            Tambah Data
        </a>
        <div class="card table-responsive">
            <table id="mydata" class="table table-dark">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nomor Induk Kependudukan</th>
                        <th>Nama Lengkap</th>
                        <th>Status Penerimaan</th>
                        <th>Status Aktif</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include '../koneksi.php';
                    $sql1 = "SELECT d.id_pendaftaran, d.id_daftar, d.nik, d.nama_lengkap, d.status, d.tempat_lahir, d.tgl_lahir, d.tinggi, d.berat, d.foto_ktp, d.selfie_ktp, d.telepon, d.terima, d.aktif, p.nama AS provinsi, k.nama AS kota, kc.nama AS kecamatan, ds.nama AS desa, d.alamat_lengkap FROM daftars d JOIN provinsi p ON d.id_provinsi = p.id_provinsi JOIN kota k ON d.id_kota = k.id_kota JOIN kecamatan kc ON d.id_kecamatan = kc.id_kecamatan JOIN desa ds ON d.id_desa = ds.id_desa;";
                    $result = mysqli_query($koneksi, $sql1);
                    $no = 1;
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $no++ . "</td>";
                            echo "<td>" . $row["nik"] . "</td>";
                            echo "<td>" . $row["nama_lengkap"] . "</td>";
                            echo "<td class='" . ($row["terima"] === "terima" ? "badge-success" : "badge-danger") . "'>" . $row["terima"] . "</td>";
                            echo "<td class='" . ($row["aktif"] === "aktif" ? "badge-success" : "badge-danger") . "'>" . $row["aktif"] . "</td>";

                            if ($row["id_daftar"] !== null) {
                                echo "<td><a href='detail2.php?id_daftar=" . $row["id_daftar"] . "' class='btn btn-primary'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-arrow-down-right-circle-fill' viewBox='0 0 16 16'>
                                    <path d='M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm5.904-2.803a.5.5 0 1 0-.707.707L9.293 10H6.525a.5.5 0 0 0 0 1H10.5a.5.5 0 0 0 .5-.5V6.525a.5.5 0 0 0-1 0v2.768L5.904 5.197z'/>
                                </svg>
                                Lihat Lebih Detail</a></td>";
                            } else {
                                echo "";
                            }

                            // Check if id_pendaftaran is null and disable the button accordingly
                            if ($row["id_pendaftaran"] !== null) {
                                echo "<td><a href='detail.php?id_pendaftaran=" . $row["id_pendaftaran"] . "' class='btn btn-primary'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-arrow-down-right-circle-fill' viewBox='0 0 16 16'>
                                <path d='M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm5.904-2.803a.5.5 0 1 0-.707.707L9.293 10H6.525a.5.5 0 0 0 0 1H10.5a.5.5 0 0 0 .5-.5V6.525a.5.5 0 0 0-1 0v2.768L5.904 5.197z'/>
                            </svg>
                                Lihat Lebih Detail</a></td>";
                            } else {
                                echo "";
                            }
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
            $('#mydata').DataTable({
                "language": {
                    "searchPlaceholder": "Cari NIK atau Nama Lengkap",
                    "infoEmpty": 'Tidak ada Data',
                    "zeroRecords": 'Tidak ada Data',
                    "info": 'Halaman _PAGE_',
                    "lengthMenu": 'Lihat _MENU_ rekaman per halaman',
                    "search": 'Cari',
                    "paginate": {
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    }
                }
            });
        });

        function yakin() {
            return confirm("Apa Anda Yakin Ingin Keluar?");
        }
    </script>
</body>

</html>
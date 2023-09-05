<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pendaftaran TKI Online | Pelatihan</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="//cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>

<body>
    <?php
    session_start();
    if (isset($_SESSION['id_daftar'])) {
        $id_daftar = $_SESSION['id_daftar'];
    }
    ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">Pendaftaran TKI Online</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <form method="post" action="daftar4.php" enctype="multipart/form-data">
            <input type="hidden" name="id_daftar" value="<?php echo $id_daftar ?>">
            <div class="table-container table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Instansi yang mengeluarkan Sertifikat *</th>
                            <th>Sertifikat Pelatihan</th>
                            <th>Tanggal Pengeluaran Sertifikat *</th>
                            <th>Nomor Sertifikat *</th>
                            <th>Jenis Sertifikat *</th>
                            <th>Uraian *</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <tr>
                            <td>
                                <input type="file" class="form-control" name="sertifikat[]" multiple>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="instansi[]" multiple>
                            </td>
                            <td>
                                <input type="date" class="form-control" name="tgl_keluar_sertifikat[]" multiple>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="no_sertifikat[]" multiple>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="jenis[]" multiple>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="uraian[]" multiple>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <p>Klik "&plus; Tambah Data" jika Anda mempunyai data lebih dari 1</p>
                <button type="button" class="btn btn-success form-control" id="add-row-btn">&plus; Tambah Baris</button>
            </div>
            <button type="submit" class="btn btn-success form-control" name="daftar">Selesai</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        function yakin() {
            return alert("Apa Anda Yakin Ingin Keluar?");
        }
        $(document).ready(function() {
            $(".select2").select2({
                tags: true,
                placeholder: function() {
                    $(this).data('placeholder');
                },
                tokenSeparators: [',']
            });

            const addRowBtn = document.getElementById("add-row-btn");
            const tableBody = document.getElementById("table-body");

            addRowBtn.addEventListener("click", function() {
                const newRow = document.createElement("tr");
                newRow.innerHTML = `
                    <td>
                        <input type="file" class="form-control" name="sertifikat[]" multiple>
                    </td>
                    <td>
                        <input type="text" class="form-control" name="instansi[]" multiple>
                    </td>
                    <td>
                        <input type="date" class="form-control" name="tgl_keluar_sertifikat[]" multiple>
                    </td>
                    <td>
                        <input type="text" class="form-control" name="no_sertifikat[]" multiple>
                    </td>
                    <td>
                        <input type="text" class="form-control" name="jenis[]" multiple>
                    </td>
                    <td>
                        <input type="text" class="form-control" name="uraian[]" multiple>
                    </td>
                `;

                tableBody.appendChild(newRow);
                $(".select2").select2({
                    tags: true,
                    placeholder: function() {
                        $(this).data('placeholder');
                    },
                    tokenSeparators: [',']
                });
            });
        });
    </script>
</body>

</html>
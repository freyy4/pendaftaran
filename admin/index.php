<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pendaftaran TKI Online | Data Diri</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }
        .custom-alert {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">Pendaftaran TKI Online</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">

                </ul>
            </div>
        </div>
    </nav>
    <?php
    include '../koneksi.php';
    $query = mysqli_query($koneksi, "SELECT * FROM daftars");
    $num = mysqli_num_rows($query);
    $jmlh = $num + 1;
    $nomor = $jmlh;
    session_start();
    if (empty($_SESSION['login'])) {
        header("Location:../login_admin.php");
    }
    ?>
    <form method="post" action="index2.php" enctype="multipart/form-data" id="myForm" class="container">
        <input type="hidden" name="id_pendaftaran" value="<?php echo $nomor; ?>">
        <div class="form-group">
            <label for="nik">Nomor Induk Kependudukan *</label>
            <input type="number" class="form-control" id="nik" placeholder="Masukkan Nomor Induk Kependudukan" name="nik" required>
        </div>
        <div class="form-group">
            <label for="nama_lengkap">Nama Lengkap *</label>
            <input type="text" class="form-control" id="nama_lengkap" placeholder="Masukkan Nama Lengkap" name="nama_lengkap" required>
        </div>
        <div class="form-group">
            <label for="nama_lengkap">Tempat Lahir *</label>
            <input type="text" class="form-control" id="tempat_lahir" placeholder="Masukkan Tempat Lahir" name="tempat_lahir" required>
        </div>
        <div class="form-group">
            <label for="nama_lengkap">Tanggal Lahir *</label>
            <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" required>
        </div>
        <div class="form-group">
            <label for="nama_lengkap">Status Perkawinan *</label>
            <select id="status" name="status" class="form-control" required>
                <option value="Belum Menikah">Belum Menikah</option>
                <option value="Sudah Menikah">Sudah Menikah</option>
                <option value="Cerai Hidup">Cerai Hidup</option>
                <option value="Cerai Mati">Cerai Mati</option>
            </select>
        </div>
        <div class="form-group">
            <label for="nik">Tinggi Badan *</label>
            <input type="number" class="form-control-sm" id="tinggi" placeholder="Masukkan Tinggi Badan" name="tinggi" required> cm
        </div>
        <div class="form-group">
            <label for="nik">Berat Badan *</label>
            <input type="number" class="form-control-sm" id="berat" placeholder="Masukkan Berat Badan" name="berat" required> kg
        </div>
        <div class="form-group">
            <label for="provinsi">Provinsi *</label>
            <select id="provinsi" name="provinsi" class="form-control" onclick="loadProvinsi()" required>
                <option value="">Pilih Provinsi</option>
            </select>
        </div>
        <div class="form-group">
            <label for="kota">Kabupaten/Kota *</label>
            <select id="kota" name="kota" class="form-control" onclick="kabka()" required>
                <option value="">Pilih Kabupaten/Kota</option>
            </select>
        </div>
        <div class="form-group">
            <label for="kecamatan">Kecamatan *</label>
            <select id="kecamatan" name="kecamatan" class="form-control" onclick="kec()" required>
                <option value="">Pilih Kecamatan</option>
            </select>
        </div>
        <div class="form-group">
            <label for="kelurahan">Desa *</label>
            <select id="kelurahan" name="desa" class="form-control" onclick="loadKelurahan()" required>
                <option value="">Pilih Desa</option>
            </select>
        </div>
        <div class="form-group">
            <label for="alamat_lengkap">Alamat Lengkap *</label>
            <textarea class="form-control" id="alamat_lengkap" name="alamat_lengkap" rows="3" placeholder="Masukkan Alamat Lengkap Anda" required></textarea>
        </div>
        <div class="form-group">
            <label for="telepon">Nomor Telepon *</label>
            <input type="number" class="form-control" id="telepon" placeholder="Masukkan Telepon yang bisa dihubungi" name="telepon" required>
        </div>
        <div class="form-group">
            <label for="foto_ktp">Kartu Tanda Penduduk *</label>
            <input type="file" class="form-control" id="foto_ktp" name="foto_ktp" accept="image/*" required>
        </div>
        <div class="form-group">
            <label for="selfie_ktp">Selfie Dengan KTP Asli *</label>
            <input type="file" class="form-control" id="selfie_ktp" name="selfie_ktp" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-primary form-control" name="daftar" id="submitButton" disabled>Lanjut</button>
    </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        const form = document.getElementById('myForm');
        const submitButton = document.getElementById('submitButton');

        form.addEventListener('input', function() {
            if (isFormComplete()) {
                submitButton.removeAttribute('disabled');
            } else {
                submitButton.setAttribute('disabled', 'disabled');
            }
        });

        function isFormComplete() {
            const inputs = form.querySelectorAll('input[required]');
            for (const input of inputs) {
                if (!input.value.trim()) {
                    return false;
                }
            }
            return true;
        }
    </script>

    <script>
        $(document).ready(function() {
            $("#provinsi").select2({
                data: loadProvinsi(),
                placeholder: "Pilih Provinsi Anda"
            });
        });

        function yakin() {
            return alert("Apa Anda Yakin Ingin Keluar?");
        }
    </script>
    <script>
        function loadProvinsi() {
            let xhr = new XMLHttpRequest();
            xhr.open(
                "GET",
                '../json/provinces.json'
            );

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    let provinsi = JSON.parse(xhr.responseText);
                    let provinsiSelect = document.getElementById("provinsi");
                    for (let i = 0; i < provinsi.length; i++) {
                        let option = document.createElement("option");
                        option.value = provinsi[i].id;
                        option.text = provinsi[i].nama;
                        provinsiSelect.add(option);
                    }
                }
            };
            xhr.send();
        }

        function kabka() {
            let xhr = new XMLHttpRequest();
            let provinsiId = document.getElementById("provinsi").value;
            xhr.open(
                "GET", `../json/kabupaten/${provinsiId}.json`
            );

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    let kabka = JSON.parse(xhr.responseText);
                    let kabkaSelect = document.getElementById("kota");
                    for (let i = 0; i < kabka.length; i++) {
                        let option = document.createElement("option");
                        option.value = kabka[i].id;
                        option.text = kabka[i].nama;
                        kabkaSelect.add(option);
                        $("#kota").select2({
                            placeholder: "Pilih Kabupaten/Kota Anda"
                        });
                    }
                }
            };
            xhr.send();
        }

        function kec() {
            let xhr = new XMLHttpRequest();
            let kabupatenId = document.getElementById("kota").value; // Menggunakan ID kabupaten yang dipilih
            xhr.open(
                "GET", `../json/kecamatan/${kabupatenId}.json` // Ganti dengan path ke file JSON kecamatan
            );

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    let kecamatan = JSON.parse(xhr.responseText);
                    let kecamatanSelect = document.getElementById("kecamatan");
                    for (let i = 0; i < kecamatan.length; i++) {
                        let option = document.createElement("option");
                        option.value = kecamatan[i].id;
                        option.text = kecamatan[i].nama;
                        kecamatanSelect.add(option);
                        $("#kecamatan").select2({
                            placeholder: "Pilih Kecamatan Anda"
                        });
                    }
                }
            };
            xhr.send();
        }

        function loadKelurahan() {
            let xhr = new XMLHttpRequest();
            let kecamatanId = document.getElementById("kecamatan").value; // Menggunakan ID kecamatan yang dipilih
            xhr.open(
                "GET", `../json/kelurahan/${kecamatanId}.json` // Ganti dengan path ke file JSON desa
            );

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    let kelurahanData = JSON.parse(xhr.responseText);
                    let kelurahanSelect = document.getElementById("kelurahan");
                    for (let i = 0; i < kelurahanData.length; i++) {
                        let option = document.createElement("option");
                        option.value = kelurahanData[i].id;
                        option.text = kelurahanData[i].nama;
                        kelurahanSelect.add(option);
                        $("#kelurahan").select2({
                            placeholder: "Pilih Desa/Kelurahan Anda"
                        });
                    }
                }
            };
            xhr.send();
        }
    </script>
</body>

</html>
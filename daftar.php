<?php
session_start();
if (empty($_SESSION['login'])) {
    header("Location:index.php");
}
?>
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css" />
    <style>
        body {
            padding-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="col">
            <div class="alert alert-success custom-alert">
                <strong>Selamat Datang di Pendaftaran TKI Online</strong>
            </div>
        </div>

        <div class="container">
            <form method="post" action="daftar.php" enctype="multipart/form-data" id="myForm">
                <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="nik">Nomor Induk Kependudukan *</label>
                    <input type="number" class="form-control" id="nik" placeholder="Masukkan Nomor Induk Kependudukan" name="nik" pattern="[0-9]{16}" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="nama_lengkap">Nama Lengkap *</label>
                    <input type="text" class="form-control" id="nama_lengkap" placeholder="Masukkan Nama Lengkap" name="nama_lengkap" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="nama_lengkap">Tempat Lahir *</label>
                    <input type="text" class="form-control" id="tempat_lahir" placeholder="Masukkan Tempat Lahir" name="tempat_lahir" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="nama_lengkap">Tanggal Lahir *</label>
                    <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="nama_lengkap">Status Perkawinan *</label>
                    <select id="status" name="status" class="form-control" required>
                        <option value="Belum Menikah">Belum Menikah</option>
                        <option value="Sudah Menikah">Sudah Menikah</option>
                        <option value="Cerai Hidup">Cerai Hidup</option>
                        <option value="Cerai Mati">Cerai Mati</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="nik">Tinggi Badan (cm)*</label>
                    <input type="number" class="form-control" id="tinggi" placeholder="Masukkan Tinggi Badan" name="tinggi" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="nik">Berat Badan (kg)*</label>
                    <input type="number" class="form-control" id="berat" placeholder="Masukkan Berat Badan" name="berat" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="provinsi">Provinsi *</label>
                    <select id="provinsi" name="provinsi" class="form-control select2" onclick="loadProvinsi()" required>
                        <option value="">Pilih Provinsi</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="kota">Kabupaten/Kota *</label>
                    <select id="kota" name="kota" class="form-control select2" onclick="kabka()" required>
                        <option value="">Pilih Kabupaten/Kota</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="kecamatan">Kecamatan *</label>
                    <select id="kecamatan" name="kecamatan" class="form-control" onclick="kec()" required>
                        <option value="">Pilih Kecamatan</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="kelurahan">Desa *</label>
                    <select id="kelurahan" name="desa" class="form-control" onclick="loadKelurahan()" required>
                        <option value="">Pilih Desa</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="alamat_lengkap">Alamat Lengkap *</label>
                    <textarea class="form-control" id="alamat_lengkap" name="alamat_lengkap" rows="3" placeholder="Masukkan Alamat Lengkap Anda" required></textarea>
                </div>
                <div class="form-group col-md-4">
                    <label for="telepon">Nomor Telepon *</label>
                    <input type="number" class="form-control" id="telepon" placeholder="Masukkan Telepon yang bisa dihubungi" name="telepon" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="foto_ktp">Kartu Tanda Penduduk *</label>
                    <input type="file" class="form-control" id="foto_ktp" name="foto_ktp" accept="image/*" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="selfie_ktp">Selfie Dengan KTP Asli *</label>
                    <input type="file" class="form-control" id="selfie_ktp" name="selfie_ktp" accept="image/*" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="selfie_ktp">Pas Foto 3 x 4 *</label>
                    <input type="file" class="form-control" id="pas" name="pas" accept="image/*" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="nama_lengkap">Jenis Pekerjaan *</label>
                    <select id="status" name="jenis" class="form-control" required>
                        <option value="Perawat Orang Tua">Perawat Orang Tua</option>
                        <option value="Panti Jompo">Panti Jompo</option>
                        <option value="Konstruksi">Konstruksi</option>
                        <option value="Manufaktur">Manufaktur</option>
                        <option value="Housemaid">Housemaid</option>
                        <option value="Baby Sitter">Baby Sitter</option>
                        <option value="Welder">Welder</option>
                        <option value="Filter">Filter</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="nama_lengkap">Negara Tujuan *</label>
                    <select id="status" name="negara" class="form-control" required>
                        <option value="Taiwan">Taiwan</option>
                        <option value="Hong Kong">Hong Kong</option>
                        <option value="Singapura">Singapura</option>
                        <option value="Malaysia">Malaysia</option>
                        <option value="Korea Selatan">Korea Selatan</option>
                        <option value="Jepang">Jepang</option>
                    </select>
                </div>
                </div>
                <button type="submit" class="btn btn-primary form-control" name="daftar" id="submitButton">Lanjut</button>
            </form>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
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
                    'json/provinces.json'
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
                    "GET", `json/kabupaten/${provinsiId}.json`
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
                    "GET", `json/kecamatan/${kabupatenId}.json` // Ganti dengan path ke file JSON kecamatan
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
                    "GET", `json/kelurahan/${kecamatanId}.json` // Ganti dengan path ke file JSON desa
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
<?php
session_start();
if (isset($_POST['daftar'])) {
    include "koneksi.php";
    $query_latest_id = "SELECT id_daftar FROM daftar ORDER BY id_daftar DESC LIMIT 1";
    $result_latest_id = mysqli_query($koneksi, $query_latest_id);

    $prefix = "CBM-PMI-";
    $next_number = 1;

    if (mysqli_num_rows($result_latest_id) > 0) {
        $latest_id = mysqli_fetch_assoc($result_latest_id)['id_daftar'];
        $latest_number = intval(substr($latest_id, strlen($prefix))); // Extract the numeric part
        $next_number = $latest_number + 1;
    }

    $id_daftar = $prefix . sprintf('%02d', $next_number);

    $nik = $_POST['nik'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tgl_lahir = $_POST["tgl_lahir"];
    $status = $_POST['status'];
    $tinggi = $_POST['tinggi'];
    $berat = $_POST['berat'];
    $provinsi = $_POST['provinsi'];
    $kota = $_POST['kota'];
    $kecamatan = $_POST['kecamatan'];
    $desa = $_POST['desa'];
    $alamat_lengkap = $_POST['alamat_lengkap'];
    $telepon = $_POST['telepon'];
    $jenis = $_POST['jenis'];
    $negara = $_POST['negara'];
    $targetktp = "ktp/";
    $targetselfie = "selfie/";
    $targetpas = "pas/";
    $foto_ktp = $targetktp . basename($_FILES['foto_ktp']['name']);
    $selfie_ktp = $targetselfie . basename($_FILES['selfie_ktp']['name']);
    $pas = $targetpas . basename($_FILES['pas']['name']);
    move_uploaded_file($_FILES['foto_ktp']['tmp_name'], $foto_ktp);
    move_uploaded_file($_FILES['selfie_ktp']['tmp_name'], $selfie_ktp);
    move_uploaded_file($_FILES['pas']['tmp_name'], $pas);

    $insert = mysqli_query($koneksi, "INSERT INTO daftar (id_daftar, nik, nama_lengkap, tempat_lahir, tgl_lahir, status, tinggi, berat, id_provinsi, id_kota, id_kecamatan, id_desa, alamat_lengkap, foto_ktp, selfie_ktp, pas, telepon, terima, aktif, pekerjaan, negara) VALUES ('$id_daftar', '$nik', '$nama_lengkap', '$tempat_lahir', '$tgl_lahir', '$status', '$tinggi', '$berat', '$provinsi', '$kota', '$kecamatan', '$desa', '$alamat_lengkap', '$foto_ktp', '$selfie_ktp', '$pas', '$telepon', 'tolak', 'nonaktif', '$jenis', '$negara');");
    $_SESSION['id_daftar'] = $id_daftar;
    if ($insert) {
        echo "<script>
            Swal.fire({
                title: 'Data berhasil disimpan',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = 'daftar2.php';
                }
            });
        </script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}

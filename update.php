<?php include "head.php"; ?>
<?php session_start(); ?>
<?php include "navbar2.php"; ?>
<?php 
    $id_daftar = $_GET['id_daftar'];
    $_SESSION['id_daftar'] = $id_daftar; 
?>
<div class="container">
    <div class="col-md-12" id="stickyElement">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-row justify-content-between">
                    <h2 class="card-title">Ubah Status PMI</h2>
                </div>
                <div class="preview-list">
                    <div class="card-body">
                        <form action="update.php" method="post">
                            <input type="hidden" name="id_daftar" value="<?php echo $id_daftar; ?>">
                            <label for="terima">Status Penerimaan</label>
                            <select name="terima" id="terima" class="form-control">
                                <option value="terima">Terima</option>
                                <option value="tolak">Tolak</option>
                            </select>
                            <label for="aktif">Status Aktif</label>
                            <select name="aktif" id="aktif" class="form-control">
                                <option value="aktif">Aktif</option>
                                <option value="nonaktif">Nonaktif</option>
                            </select><br>
                            <input type="submit" value="Update" class="btn btn-primary" onClick="alet()">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_POST['id_daftar'], $_POST['terima'], $_POST['aktif'])) {
    include 'koneksi.php';
    
    $id_daftar = mysqli_real_escape_string($koneksi, $_POST['id_daftar']);
    $result = mysqli_query($koneksi, "SELECT telepon FROM daftar WHERE id_daftar = '$id_daftar'");
    
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $nowa = $row['telepon']; 
    } else {
        echo "Nomor telepon tidak ditemukan atau terdapat lebih dari satu entri dengan id_daftar yang sama.";
        exit; 
    }
    
    $terima = mysqli_real_escape_string($koneksi, $_POST['terima']);
    $aktif = mysqli_real_escape_string($koneksi, $_POST['aktif']);
    
    $update = "UPDATE daftar SET terima='$terima', aktif='$aktif' WHERE id_daftar='$id_daftar'";
    
    if (mysqli_query($koneksi, $update)) {
        if ($terima === 'terima' && $aktif === 'aktif') {
            // Kirim pesan WhatsApp hanya jika status adalah 'terima' dan 'aktif'
            $pesan = "Halo, Dengan ini kami sampaikan dari pihak HRD PT. Crystal Biru Meuligo ingin mengundang saudara agar turut hadir dalam tes wawancara. Tes wawancara ini akan diadakan pada: \n \n Pukul : 09.00 WIB - 17.00 WIB \n Lokasi : Jalan Bunga No. 88, RT 09, RW 04, Kelurahan Jatibening Baru, Kecamatan Pondok Gede, Bekasi 17412 \n \n Catatan: \n Saudara diminta membawa dokumen yang diperlukan (Sesuai dengan yang diupload online).";
            $dataSending = array(
                "api_key" => "VLEHPESTOYDX4GKW",
                "number_key" => "NV7JDP4tjchTa67Y",
                "phone_no" => $nowa,
                "message" => $pesan,
            );

            $curl = curl_init();

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
            $error = curl_error($curl);

            curl_close($curl);

            if ($error) {
                echo "Error: $error";
            } else {
                echo "<script>alert('Pesan Anda telah dikirim ke WhatsApp');
                window.location.href = 'admin/admin.php';
                </script>";
            }
        } else {
            echo "<script>alert('Status telah diupdate, tetapi tidak mengirim pesan karena status bukan 'terima' dan 'aktif'');
            window.location.href = 'admin/admin.php';
            </script>";
        }

    } else {
        echo "Terjadi kesalahan dalam memperbarui data: " . mysqli_error($koneksi);
    }
    mysqli_close($koneksi);
}
?>
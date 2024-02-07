<?php
include 'koneksi.php';

// Ambil data dari tabel daftar yang dokumennya belum terupload
$sql = "SELECT id_daftar, telepon, nama_lengkap, foto_ktp, selfie_ktp, pas, buku_nikah, surat_keluarga, kk, akte_kelahiran, akte_cerai FROM daftar WHERE (foto_ktp = '' OR selfie_ktp = '' OR pas = '' OR buku_nikah = '' OR surat_keluarga = 0 OR kk = '' OR akte_kelahiran = '' OR akte_cerai = '')";
$result = mysqli_query($koneksi, $sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $nowa = $row['telepon']; // Nomor telepon dari tabel daftar
        $namaLengkap = $row['nama_lengkap']; // Nama lengkap dari tabel daftar
        $token = generateToken(); // Fungsi untuk menghasilkan token, sesuaikan dengan kebutuhan Anda

        $dokumenBelumDiupload = array();
        if ($row['foto_ktp'] === '') {
            $dokumenBelumDiupload[] = "Foto KTP";
        }
    
        if ($row['selfie_ktp'] === '') {
            $dokumenBelumDiupload[] = "Selfie KTP";
        }
    
        if ($row['pas'] === '') {
            $dokumenBelumDiupload[] = "Pas Foto";
        }
    
        if ($row['buku_nikah'] === '' && $row['status'] === 'Menikah') {
            $dokumenBelumDiupload[] = "Buku Nikah";
        }
    
        if ($row['surat_keluarga'] === 0) {
            $dokumenBelumDiupload[] = "Surat Keluarga";
        }
    
        if ($row['kk'] === '') {
            $dokumenBelumDiupload[] = "Kartu Keluarga";
        }
    
        if ($row['akte_kelahiran'] === '') {
            $dokumenBelumDiupload[] = "Akte Kelahiran";
        }
    
        if ($row['status'] == 'Cerai Hidup' || $row['status'] == 'Cerai Mati') {
            if ($row['akte_cerai'] === '') {
                $dokumenBelumDiupload[] = "Akte Cerai";
            }
        }

        // Kirim pesan WhatsApp jika ada dokumen yang belum diupload
        if (!empty($dokumenBelumDiupload)) {
            sendWhatsAppMessage($nowa, $namaLengkap, $token, $dokumenBelumDiupload);
        }
    }
} else {
    echo 'Semua dokumen telah terupload.';
}

function sendWhatsAppMessage($nowa, $namaLengkap, $token, $dokumenBelumDiupload)
{
    // Skrip pengiriman pesan WhatsApp
    $curl = curl_init();

    // Buat pesan WhatsApp
    $pesan = "Halo $namaLengkap,\n\nDokumen Anda belum lengkap. Silakan lengkapi dokumen berikut:\n";
    foreach ($dokumenBelumDiupload as $dokumen) {
        $pesan .= "- $dokumen\n";
    }
    $pesan .= "\nSilakan lengkapi dokumen di https://daftarpmi.crystalbirumeuligo.com/dash.php\n\nSekian, Terima Kasih\n\nPT Crystal Biru Meuligo";

    $dataSending = array(
        "api_key" => "VLEHPESTOYDX4GKW",
        "number_key" => "NV7JDP4tjchTa67Y",
        "phone_no" => $nowa,
        "message" => $pesan,
    );

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

    // Tambahkan log atau notifikasi jika diperlukan
    if (!$error) {
        echo "Pesan WhatsApp $namaLengkap terkirim ke $nowa. Dokumen belum diupload: " . implode(", ", $dokumenBelumDiupload) . "<br>";
    } else {
        echo "Gagal mengirim pesan WhatsApp ke $nowa. Error: $error <br>";
    }
}

function generateToken()
{
    // Fungsi untuk menghasilkan token unik, sesuaikan dengan kebutuhan Anda
    return uniqid('token_', true);
}
?>

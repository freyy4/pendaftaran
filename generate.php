<?php
require 'vendor/autoload.php'; // Sesuaikan jalur ke autoload.php

use Dompdf\Dompdf;
use Dompdf\Options;

// Buat instance Dompdf baru
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('defaultFont', 'Tahoma');
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);

// Muat konten HTML Anda ke Dompdf
ob_start();
include 'print.php'; // Ganti dengan jalur sebenarnya ke berkas HTML Anda
$html = ob_get_clean();

$dompdf->loadHtml($html);

// Atur ukuran kertas dan hasilkan HTML sebagai PDF
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// Keluarkan PDF yang dihasilkan (Anda juga dapat menyimpannya ke berkas)
$dompdf->stream('profil.pdf', ['Attachment' => false]);
exit;
?>

<?php
require_once __DIR__ . '/vendor/autoload.php';

require 'functions.php';
$mahasiswa = query("SELECT * FROM mahasiswa");

$mpdf = new \Mpdf\Mpdf();

$html = ' <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mahasiswa</title>
</head>
<body>
    <h2 style="text-align: center;">Laporan Data Mahasiswa</h2>
    <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>NPM</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Jurusan</th>
            </tr>';
$i = 1;
foreach ($mahasiswa as $mhs) {
    $html .= '
            <tr>
                <td>' . $i++ . '</td>
                <td><img src="img/' . $mhs["gambar"] . '" width="50"></td>
                <td>' . $mhs["npm"] . '</td>
                <td>' . $mhs["nama"] . '</td>
                <td>' . $mhs["email"] . '</td>
                <td>' . $mhs["jurusan"] . '</td>
            </tr>';
}

$html .= '</table>
</body>
</html>';

// Tulis konten HTML ke dalam mPDF
$mpdf->WriteHTML($html);

// Output file PDF
$mpdf->Output('Laporan_Mahasiswa.pdf', \Mpdf\Output\Destination::INLINE);

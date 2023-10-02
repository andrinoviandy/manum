<?php

// Load the database configuration file 
require('../../config/koneksi.php');

// Include XLSX generator library 
require_once '../../plugins/PhpXlsxGenerator-master/PhpXlsxGenerator.php';

$sql = "SELECT * FROM paket WHERE id = $_GET[id]";
$data = $koneksi->prepare($sql);
$data->execute();
$row1 = $data->fetch();
$namaPaket = $row1['nama_paket'];

// Excel file name for download 
$fileName = 'Paket ' . $namaPaket . ' (' . date('d-m-Y') . ").xlsx";

$head1 = '<style border="1" height="30" bgcolor="#0b8a00" color="#ffffff"><middle><b>';
$head2 = '</b></middle></style>';

$tglbrgkt = '';
if ($row1['tgl_berangkat'] != '') {
    $tglbrgkt = date('d M Y', strtotime($row1['tgl_berangkat']));
}

$excelData[] = array(
    '<style height="30" font-size="14"><middle><b>Nama Paket : ' . $row1['nama_paket'] . '</b></middle></style>',
    '', '',
    '<style height="30" font-size="14"><middle><b>Tanggal Keberangkatan : ' . $tglbrgkt . '</b></middle></style>',
    '', '',
    '<style height="30" font-size="14"><middle><b>Pesawat : ' . $row1['pesawat'] . '</b></middle></style>'
);
$excelData[] = array(
    '<style height="30" font-size="14"><middle><b>Bulan Berangkat : ' . $row1['bulan_berangkat'] . '</b></middle></style>',
    '', '',
    '<style height="30" font-size="14"><middle><b>Asal Keberangkatan : ' . $row1['asal_keberangkatan'] . '</b></middle></style>',
    '', '',
    '<style height="30" font-size="14"><middle><b>Hotel : ' . $row1['hotel'] . '</b></middle></style>'
);
$excelData[] = array(
    '<style height="30" font-size="14"><middle><b>Harga Paket : ' . number_format($row1['harga'], 0, ',', '.') . '</b></middle></style>',
    '', '',
    '<style height="30" font-size="14"><middle><b>Pembimbing : ' . $row1['pembimbing'] . '</b></middle></style>',
    '', '',
    '<style height="30" font-size="14"><middle><b>Bis : ' . $row1['bis'] . '</b></middle></style>'
);
$excelData[] = array(
    ''
);
$excelData[] = array('<style height="30" font-size="20"><middle><center><b>DATA CALON JAMAAH</b></center></middle></style>');
$excelData[] = array($head1 . 'No' . $head2, $head1 . 'NIK' . $head2, $head1 . 'Nama Lengkap' . $head2, $head1 . 'Jenis Kelamin' . $head2, $head1 . 'No. Telp' . $head2, $head1 . 'Provinsi' . $head2, $head1 . 'Kota Kabupaten' . $head2, $head1 . 'Kantor Cabang' . $head2, $head1 . 'Saldo' . $head2);

$cabang = '';
if ($_SESSION['role_id'] == 1) {
    $cabang = "WHERE p.id IS NOT NULL";
} else {
    $cabang = "WHERE p.cabang_id = $_SESSION[cabang_id]";
}

if ($_SESSION['cabang_id'] != 1) {
    $cabang = $cabang . " AND p.cabang_id = $_SESSION[cabang_id]";
}
$sql = "SELECT COUNT(*) OVER () AS total, row_number() OVER (ORDER BY pk.id DESC) AS no, j.*, pd.id AS id_p, pro.nama_provinsi, pd.id AS id_d, k.nama_kabupaten, c.cabang, m.nama_marketing, (SELECT SUM(k.nominal) FROM keuangan k INNER JOIN proses_jamaah pj ON pj.id = k.proses_jamaah_id WHERE pj.jamaah_id = j.id AND pj.paket_id = pk.id) AS saldo FROM paket pk INNER JOIN proses_jamaah pj ON pk.id = pj.paket_id INNER JOIN jamaah j ON j.id = pj.jamaah_id INNER JOIN pendaftaran pd ON j.id = pd.jamaah_id INNER JOIN cabang c ON c.id = pd.cabang_id LEFT JOIN marketing m ON m.id = pj.marketing_id INNER JOIN provinsi pro ON pro.id = j.provinsi_id INNER JOIN kabupaten k ON k.id = j.kabupaten_id WHERE pk.id = $_GET[id]";

$data = $koneksi->prepare($sql);
$data->execute();
$row = $data->fetchAll();
$count = $data->rowCount();
// Fetch records from database and store in an array 
$body1 = '<style border="1">';
$body2 = '</style>';
if ($count > 0) {
    foreach ($row as $dt) {
        $lineData = array('<style border="1" width=""><center>' . $dt['no'] . '</center></style>', $body1 . $dt['nik'] . $body2, $body1 . $dt['nama'] . $body2, $body1 . $dt['jenis_kelamin'] . $body2, $body1 . $dt['no_hp'] . $body2, $body1 . $dt['nama_provinsi'] . $body2, $body1 . $dt['nama_kabupaten'] . $body2, $body1 . $dt['cabang'] . $body2, $body1 . $dt['saldo'] . $body2);
        $excelData[] = $lineData;
    }
}

// Export data to excel and download as xlsx file 
// $xlsx = CodexWorld\PhpXlsxGenerator::fromArray($excelData);
$xlsx = CodexWorld\PhpXlsxGenerator::fromArray($excelData)
    ->setDefaultFont('Calibri')
    ->mergeCells('A1:C1')
    ->mergeCells('D1:F1')
    ->mergeCells('G1:I1')
    ->mergeCells('A2:C2')
    ->mergeCells('D2:F2')
    ->mergeCells('G2:I2')
    ->mergeCells('A3:C3')
    ->mergeCells('D3:F3')
    ->mergeCells('G3:I3')
    ->mergeCells('A5:I5')
    ->autoFilter('A6:I6')
    ->setColWidth(1, 6)
    ->setDefaultFontSize(12);

$xlsx->downloadAs($fileName);

// echo $xlsx;

exit;

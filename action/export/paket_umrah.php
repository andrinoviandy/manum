<?php

// Load the database configuration file 
require('../../config/koneksi.php');

// Include XLSX generator library 
require_once '../../plugins/PhpXlsxGenerator-master/PhpXlsxGenerator.php';

// Excel file name for download 
$fileName = "Paket Umrah Haji / " . date('d-m-Y') . ".xlsx";

$head1 = '<style border="1" height="30" bgcolor="#0b8a00" color="#ffffff"><middle><b>';
$head2 = '</b></middle></style>';
$excelData[] = array('<style height="50" font-size="20"><middle><center><b>Paket Umrah / Haji</b></center></middle></style>');
$excelData[] = array(
    $head1 . 'No' . $head2,
    $head1 . 'Status' . $head2,
    $head1 . 'Nama' . $head2,
    $head1 . 'Harga' . $head2,
    $head1 . 'Bulan Berangkat' . $head2,
    $head1 . 'Tanggal Berangkat' . $head2,
    $head1 . 'Asal Keberangkatan' . $head2,
    $head1 . 'Jamaah Join' . $head2
);

$where = '';
if (isset($_GET['form']) && isset($_GET['to'])) {
    $where = $where . "WHERE p.tgl_berangkat BETWEEN '$_GET[form]' AND '$_GET[to]'";
}

$sql = "SELECT COUNT(*) OVER () AS total, row_number() OVER (ORDER BY p.id DESC) AS no, p.*, (SELECT COUNT(*) FROM proses_jamaah WHERE paket_id = p.id) AS jumlah_jamaah, CASE WHEN p.tayang = 0 THEN 'Belum Tayang' ELSE 'Sudah Tayang' END AS status FROM paket p $where ORDER BY id DESC";

$data = $koneksi->prepare($sql);
$data->execute();
$row = $data->fetchAll();
$count = $data->rowCount();
// Fetch records from database and store in an array 
$body1 = '<style border="1">';
$body2 = '</style>';
if ($count > 0) {
    foreach ($row as $dt) {
        $lineData = array(
            '<style border="1"><center>' . $dt['no'] . '</center></style>',
            $body1 . $dt['status'] . $body2,
            $body1 . $dt['nama_paket'] . $body2,
            $body1 . number_format($dt['harga'], 0, ',', '.') . $body2,
            $body1 . $dt['bulan_berangkat'] . $body2,
            $body1 . date('d-m-Y', strtotime($dt['tgl_berangkat'])) . $body2,
            $body1 . $dt['asal_keberangkatan'] . $body2,
            $body1 . $dt['jumlah_jamaah'] . $body2
        );
        $excelData[] = $lineData;
    }
}

// Export data to excel and download as xlsx file 
// $xlsx = CodexWorld\PhpXlsxGenerator::fromArray($excelData);
$xlsx = CodexWorld\PhpXlsxGenerator::fromArray($excelData)
    ->setDefaultFont('Calibri')
    ->mergeCells('A1:H1')
    ->autoFilter('A2:H2')
    ->setColWidth(1, 6)
    ->setDefaultFontSize(12);

$xlsx->downloadAs($fileName);

exit;

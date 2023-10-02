<?php

// Load the database configuration file 
require('../../config/koneksi.php');

// Include XLSX generator library 
require_once '../../plugins/PhpXlsxGenerator-master/PhpXlsxGenerator.php';

$namaCabang = "";
if ($_SESSION['cabang_id'] != 1) {
    $sql = "SELECT cabang FROM cabang WHERE id = $_SESSION[cabang_id]";
    $data = $koneksi->prepare($sql);
    $data->execute();
    $row = $data->fetch();
    $namaCabang = $row['cabang'];
} else {
    $namaCabang = "Semua Cabang";
}

// Excel file name for download 
$fileName = "Data Jamaah ($namaCabang) / " . date('d-m-Y') . ".xlsx";

$head1 = '<style border="1" height="30" bgcolor="#0b8a00" color="#ffffff"><middle><b>';
$head2 = '</b></middle></style>';
$excelData[] = array('<style height="50" font-size="20"><middle><center><b>DATA JAMAAH ' . strtoupper($namaCabang) . '</b></center></middle></style>');
$excelData[] = array($head1 . 'No' . $head2, $head1 . 'NIK' . $head2, $head1 . 'Nama Lengkap' . $head2, $head1 . 'Jenis Kelamin' . $head2, $head1 . 'No. Telp' . $head2, $head1 . 'Provinsi' . $head2, $head1 . 'Kota Kabupaten' . $head2, $head1 . 'Kantor Cabang' . $head2);

$cabang = '';
if ($_SESSION['role_id'] == 1) {
    $cabang = "WHERE p.id IS NOT NULL";
} else {
    $cabang = "WHERE p.cabang_id = $_SESSION[cabang_id]";
}

if ($_SESSION['cabang_id'] != 1) {
    $cabang = $cabang . " AND p.cabang_id = $_SESSION[cabang_id]";
}
$sql = "SELECT COUNT(*) OVER () AS total, row_number() OVER (ORDER BY p.id DESC) AS no, j.*, p.id AS id_p, j.id AS id_j, p.*, c.cabang, m.nama_marketing, pro.nama_provinsi, k.nama_kabupaten, (SELECT COUNT(*) FROM proses_jamaah WHERE jamaah_id = j.id) AS countproses FROM jamaah j LEFT JOIN pendaftaran p ON j.id = p.jamaah_id LEFT JOIN provinsi pro ON pro.id = j.provinsi_id LEFT JOIN kabupaten k ON k.id = j.kabupaten_id LEFT JOIN cabang c ON c.id = p.cabang_id LEFT JOIN marketing m ON m.id = p.marketing_id $cabang ORDER BY p.id DESC";

$data = $koneksi->prepare($sql);
$data->execute();
$row = $data->fetchAll();
$count = $data->rowCount();
// Fetch records from database and store in an array 
$body1 = '<style border="1">';
$body2 = '</style>';
if ($count > 0) {
    foreach ($row as $dt) {
        $lineData = array('<style border="1" width=""><center>' . $dt['no'] . '</center></style>', $body1 . $dt['nik'] . $body2, $body1 . $dt['nama'] . $body2, $body1 . $dt['jenis_kelamin'] . $body2, $body1 . $dt['no_hp'] . $body2, $body1 . $dt['nama_provinsi'] . $body2, $body1 . $dt['nama_kabupaten'] . $body2, $body1 . $dt['cabang'] . $body2);
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

// echo $xlsx;

exit;

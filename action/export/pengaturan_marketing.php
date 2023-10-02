<?php

// Load the database configuration file 
require('../../config/koneksi.php');

// Include XLSX generator library 
require_once '../../plugins/PhpXlsxGenerator-master/PhpXlsxGenerator.php';

// Excel file name for download 
$fileName = "Data Marketing / " . date('d-m-Y') . ".xlsx";

$head1 = '<style border="1" height="30" bgcolor="#0b8a00" color="#ffffff"><middle><b>';
$head2 = '</b></middle></style>';
$excelData[] = array('<style height="50" font-size="20"><middle><center><b>Data Marketing</b></center></middle></style>');
$excelData[] = array(
    $head1 . 'No' . $head2,
    $head1 . 'NIK' . $head2,
    $head1 . 'Nama' . $head2,
    $head1 . 'No. HP' . $head2,
    $head1 . 'Email' . $head2
);

$sql = "SELECT COUNT(*) OVER () AS total, row_number() OVER (ORDER BY u.id DESC) AS no, u.* FROM marketing u ORDER BY u.id DESC";

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
            '<style border="1" width=""><center>' . $dt['no'] . '</center></style>', 
            $body1 . $dt['nik'] . $body2,
            $body1 . $dt['nama_marketing'] . $body2, 
            $body1 . $dt['no_hp'] . $body2, 
            $body1 . $dt['email'] . $body2
        );
        $excelData[] = $lineData;
    }
}

// Export data to excel and download as xlsx file 
// $xlsx = CodexWorld\PhpXlsxGenerator::fromArray($excelData);
$xlsx = CodexWorld\PhpXlsxGenerator::fromArray($excelData)
    ->setDefaultFont('Calibri')
    ->mergeCells('A1:E1')
    ->autoFilter('A2:E2')
    ->setColWidth(1, 6)
    ->setDefaultFontSize(12);

$xlsx->downloadAs($fileName);

// echo $xlsx;

exit;

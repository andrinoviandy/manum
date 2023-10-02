<?php

// Load the database configuration file 
require('../../config/koneksi.php');

// Include XLSX generator library 
require_once '../../plugins/PhpXlsxGenerator-master/PhpXlsxGenerator.php';

// Excel file name for download 
$fileName = "Akun Kas/Bank / " . date('d-m-Y') . ".xlsx";

$head1 = '<style border="1" height="30" bgcolor="#0b8a00" color="#ffffff"><middle><b>';
$head2 = '</b></middle></style>';
$excelData[] = array('<style height="50" font-size="20"><middle><center><b>Akun Kas/Bank</b></center></middle></style>');
$excelData[] = array(
    $head1 . 'No' . $head2,
    $head1 . 'Nama Kas' . $head2,
    $head1 . 'Pemilik' . $head2,
    $head1 . 'Cabang' . $head2,
    $head1 . 'No. Rekening' . $head2
);

if ($_SESSION['role_id'] == 1) {
    $sql = "SELECT COUNT(*) OVER () AS total, row_number() OVER (ORDER BY k.id DESC) AS no, k.*, c.cabang, (SELECT SUM(nominal) FROM keuangan WHERE kas_id = k.id AND status_konfirmasi = 1) AS saldo FROM kas k LEFT JOIN cabang c ON c.id = k.cabang_id WHERE k.id IS NOT NULL ORDER BY k.id DESC";
} else {
    $sql = "SELECT COUNT(*) OVER () AS total, row_number() OVER (ORDER BY k.id DESC) AS no, k.*, c.cabang, (SELECT SUM(nominal) FROM keuangan WHERE kas_id = k.id AND status_konfirmasi = 1) AS saldo FROM kas k LEFT JOIN cabang c ON c.id = k.cabang_id WHERE k.id IS NOT NULL AND k.cabang_id = $_SESSION[cabang_id] ORDER BY k.id DESC";
}

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
            $body1 . $dt['nama_kas'] . $body2,
            $body1 . $dt['pemilik_kas'] . $body2, 
            $body1 . $dt['cabang'] . $body2, 
            $body1 . $dt['no_rekening'] . $body2
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

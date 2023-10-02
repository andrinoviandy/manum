<?php

// Load the database configuration file 
require('../../config/koneksi.php');

// Include XLSX generator library 
require_once '../../plugins/PhpXlsxGenerator-master/PhpXlsxGenerator.php';

// Excel file name for download 
$fileName = "Reimburse / " . date('d-m-Y') . ".xlsx";

$head1 = '<style border="1" height="30" bgcolor="#0b8a00" color="#ffffff"><middle><b>';
$head2 = '</b></middle></style>';
$excelData[] = array('<style height="50" font-size="20"><middle><center><b>Reimburse</b></center></middle></style>');
$excelData[] = array(
    $head1 . 'No' . $head2,
    $head1 . 'Tanggal' . $head2,
    $head1 . 'Nomor' . $head2,
    $head1 . 'Pembayaran' . $head2,
    $head1 . 'Nominal' . $head2,
    $head1 . 'Kas/Bank' . $head2,
    $head1 . 'Keterangan' . $head2
);

$cabang = '';
if ($_SESSION['role_id'] == 1) {
    $cabang = "";
} else {
    $cabang = "AND ks.cabang_id = $_SESSION[cabang_id]";
}
$sql = "SELECT COUNT(*) OVER () AS total, row_number() OVER (ORDER BY k.id DESC) AS no, k.*, ks.nama_kas FROM keuangan k INNER JOIN kategori_keuangan kk ON kk.id = k.kategori_keuangan_id INNER JOIN kas ks ON ks.id = k.kas_id WHERE kk.id = 3 $cabang ORDER BY k.id DESC";

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
            $body1 . date('d-m-Y', strtotime($dt['tanggal'])) . $body2,
            $body1 . $dt['nomor'] . $body2,
            $body1 . $dt['pembayaran'] . $body2,
            $body1 . $dt['nominal'] . $body2,
            $body1 . $dt['nama_kas'] . $body2,
            $body1 . $dt['keterangan'] . $body2
        );
        $excelData[] = $lineData;
    }
}

// Export data to excel and download as xlsx file 
// $xlsx = CodexWorld\PhpXlsxGenerator::fromArray($excelData);
$xlsx = CodexWorld\PhpXlsxGenerator::fromArray($excelData)
    ->setDefaultFont('Calibri')
    ->mergeCells('A1:G1')
    ->autoFilter('A2:G2')
    ->setColWidth(1, 6)
    ->setDefaultFontSize(12);

$xlsx->downloadAs($fileName);

exit;

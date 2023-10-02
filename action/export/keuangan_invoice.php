<?php

// Load the database configuration file 
require('../../config/koneksi.php');

// Include XLSX generator library 
require_once '../../plugins/PhpXlsxGenerator-master/PhpXlsxGenerator.php';

// Excel file name for download 
$fileName = "Invoice / " . date('d-m-Y') . ".xlsx";

$head1 = '<style border="1" height="30" bgcolor="#0b8a00" color="#ffffff"><middle><b>';
$head2 = '</b></middle></style>';
$excelData[] = array('<style height="50" font-size="20"><middle><center><b>Invoice</b></center></middle></style>');
$excelData[] = array(
    $head1 . 'No' . $head2,
    $head1 . 'Tanggal' . $head2,
    $head1 . 'Nomor' . $head2,
    $head1 . 'Pembayaran' . $head2,
    $head1 . 'Nominal' . $head2,
    $head1 . 'Kas/Bank' . $head2,
    // $head1 . 'Keterangan' . $head2,
    $head1 . 'Diproses Tanggal' . $head2,
    $head1 . 'NIK Jamaah' . $head2,
    $head1 . 'Nama Jamaah' . $head2
);

$cabang = '';
if ($_SESSION['role_id'] == 1) {
    $cabang = "AND ks.cabang_id = $_SESSION[cabang_id] AND k.status_konfirmasi = 1";
} else {
    $cabang = "AND ks.cabang_id = $_SESSION[cabang_id]";
}
$sql = "SELECT COUNT(*) OVER () AS total, row_number() OVER (ORDER BY k.id DESC) AS no, k.*, ks.nama_kas, kk.nama_kategori, pj.tgl_proses, j.nik, j.nama AS nama_jamaah FROM keuangan k INNER JOIN kategori_keuangan kk ON kk.id = k.kategori_keuangan_id INNER JOIN kas ks ON ks.id = k.kas_id INNER JOIN proses_jamaah pj ON pj.id = k.proses_jamaah_id INNER JOIN jamaah j ON j.id = pj.jamaah_id WHERE kk.jenis_kategori = 'd' $cabang ORDER BY k.id DESC";

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
            // $body1 . $dt['keterangan'] . $body2,
            $body1 . date('d-m-Y', strtotime($dt['tgl_proses'])) . $body2,
            $body1 . $dt['nik'] . $body2,
            $body1 . $dt['nama_jamaah'] . $body2
        );
        $excelData[] = $lineData;
    }
}

// Export data to excel and download as xlsx file 
// $xlsx = CodexWorld\PhpXlsxGenerator::fromArray($excelData);
$xlsx = CodexWorld\PhpXlsxGenerator::fromArray($excelData)
    ->setDefaultFont('Calibri')
    ->mergeCells('A1:I1')
    ->autoFilter('A2:I2')
    ->setColWidth(1, 6)
    ->setDefaultFontSize(12);

$xlsx->downloadAs($fileName);

exit;

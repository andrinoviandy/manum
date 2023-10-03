<?php

// Load the database configuration file 
require('../../config/koneksi.php');

// Include XLSX generator library 
require_once '../../plugins/PhpXlsxGenerator-master/PhpXlsxGenerator.php';

// Excel file name for download 
$fileName = "Progress Data / " . date('d-m-Y') . ".xlsx";

$head1 = '<style border="1" height="30" bgcolor="#0b8a00" color="#ffffff"><middle><b>';
$head2 = '</b></middle></style>';
$excelData[] = array('<style height="50" font-size="20"><middle><center><b>Progress Data Jamaah</b></center></middle></style>');
$excelData[] = array(
    $head1 . 'No' . $head2,
    $head1 . 'Status' . $head2,
    $head1 . 'Tanggal Proses' . $head2,
    $head1 . 'Nama Paket' . $head2,
    $head1 . 'Tanggal Berangkat' . $head2,
    $head1 . 'NIK' . $head2,
    $head1 . 'Nama' . $head2,
    $head1 . 'No HP' . $head2,
    $head1 . 'Nama Provinsi' . $head2,
    $head1 . 'Nama Kabupaten' . $head2,
    $head1 . 'Cabang' . $head2,
    $head1 . 'Marketing' . $head2
);

$cabang = '';
if ($_SESSION['role_id'] == 1) {
    $cabang = "WHERE p.id IS NOT NULL";
} else {
    $cabang = "WHERE p.cabang_id = $_SESSION[cabang_id]";
}
$where = '';
if (isset($_GET['form']) && isset($_GET['to'])) {
    $where = $where . " AND pj.tgl_proses BETWEEN '$_GET[form]' AND '$_GET[to]'";
}
$sql = "SELECT COUNT(*) OVER () AS total, row_number() OVER (ORDER BY p.id DESC) AS no, j.*, pj.id AS id_p, pj.*, c.cabang, m.nama_marketing, pro.nama_provinsi, k.nama_kabupaten, pak.nama_paket, pak.tgl_berangkat, CASE WHEN pj.status_proses = 0 THEN 'Masih Proses' ELSE 'Selesai' END AS status FROM proses_jamaah pj LEFT JOIN jamaah j ON j.id = pj.jamaah_id LEFT JOIN pendaftaran p ON j.id = p.jamaah_id LEFT JOIN provinsi pro ON pro.id = j.provinsi_id LEFT JOIN kabupaten k ON k.id = j.kabupaten_id LEFT JOIN cabang c ON c.id = p.cabang_id LEFT JOIN marketing m ON m.id = pj.marketing_id LEFT JOIN paket pak ON pak.id = pj.paket_id $cabang $where ORDER BY p.id DESC";

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
            $body1 . date('d-m-Y', strtotime($dt['tgl_proses'])) . $body2,
            $body1 . $dt['nama_paket'] . $body2,
            $body1 . date('d-m-Y', strtotime($dt['tgl_berangkat'])) . $body2,
            $body1 . $dt['nik'] . $body2,
            $body1 . $dt['nama'] . $body2,
            $body1 . $dt['no_hp'] . $body2,
            $body1 . $dt['nama_provinsi'] . $body2,
            $body1 . $dt['nama_kabupaten'] . $body2,
            $body1 . $dt['cabang'] . $body2,
            $body1 . $dt['nama_marketing'] . $body2
        );
        $excelData[] = $lineData;
    }
}

// Export data to excel and download as xlsx file 
// $xlsx = CodexWorld\PhpXlsxGenerator::fromArray($excelData);
$xlsx = CodexWorld\PhpXlsxGenerator::fromArray($excelData)
    ->setDefaultFont('Calibri')
    ->mergeCells('A1:L1')
    ->autoFilter('A2:L2')
    ->setColWidth(1, 6)
    ->setDefaultFontSize(12);

$xlsx->downloadAs($fileName);

exit;

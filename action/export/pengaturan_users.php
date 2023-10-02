<?php

// Load the database configuration file 
require('../../config/koneksi.php');

// Include XLSX generator library 
require_once '../../plugins/PhpXlsxGenerator-master/PhpXlsxGenerator.php';

// Excel file name for download 
$fileName = "Data Users / " . date('d-m-Y') . ".xlsx";

$head1 = '<style border="1" height="30" bgcolor="#0b8a00" color="#ffffff"><middle><b>';
$head2 = '</b></middle></style>';
$excelData[] = array('<style height="50" font-size="20"><middle><center><b>Data Users</b></center></middle></style>');
$excelData[] = array(
    $head1 . 'No' . $head2,
    $head1 . 'Nama' . $head2,
    $head1 . 'Role' . $head2,
    $head1 . 'Cabang' . $head2,
    $head1 . 'Username' . $head2,
    $head1 . 'Status' . $head2
);

$sql = "SELECT COUNT(*) OVER () AS total, row_number() OVER (ORDER BY u.id DESC) AS no, u.*, r.nama_role, c.cabang, CASE WHEN u.enable = 0 THEN 'Tidak Aktif' ELSE 'Aktif' END AS enable FROM users u LEFT JOIN cabang c ON c.id = u.cabang_id LEFT JOIN role r ON r.id = u.role_id ORDER BY u.id DESC";

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
            $body1 . $dt['nama'] . $body2,
            $body1 . $dt['nama_role'] . $body2, 
            $body1 . $dt['cabang'] . $body2, 
            $body1 . $dt['username'] . $body2,  
            $body1 . $dt['enable'] . $body2
        );
        $excelData[] = $lineData;
    }
}

// Export data to excel and download as xlsx file 
// $xlsx = CodexWorld\PhpXlsxGenerator::fromArray($excelData);
$xlsx = CodexWorld\PhpXlsxGenerator::fromArray($excelData)
    ->setDefaultFont('Calibri')
    ->mergeCells('A1:F1')
    ->autoFilter('A2:F2')
    ->setColWidth(1, 6)
    ->setDefaultFontSize(12);

$xlsx->downloadAs($fileName);

// echo $xlsx;

exit;

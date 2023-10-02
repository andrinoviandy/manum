<?php
require('../../config/koneksi.php');
// $limit = 10;
// $paging = 0;
// if (isset($_POST['show'])) {
//     $limit = $_POST['show'];
// }
// if (isset($_POST['paging'])) {
//     $paging = ($_POST['paging'] - 1) * $limit;
// }
// $where = '';
// if (isset($_POST['search'])) {
//     $where = $where . "WHERE (LOWER(nama_paket) LIKE LOWER('%" . $_POST['search'] . "%') OR LOWER(harga::VARCHAR) LIKE LOWER('%" . $_POST['search'] . "%') OR LOWER(bulan_berangkat) LIKE LOWER('%" . $_POST['search'] . "%') OR LOWER(asal_keberangkatan) LIKE LOWER('%" . $_POST['search'] . "%') OR LOWER(pesawat) LIKE LOWER('%" . $_POST['search'] . "%') OR LOWER(hotel) LIKE LOWER('%" . $_POST['search'] . "%') OR LOWER(bis) LIKE LOWER('%" . $_POST['search'] . "%'))";
// }
$sql = "SELECT * FROM proses_jamaah ORDER BY id DESC LIMIT 20";
// -- $limit OFFSET $paging;

// echo "<script>alert($_POST[show])</script>";

$data = $koneksi->prepare($sql);
$data->execute();
$row = $data->fetchAll();
$count = $data->rowCount();
$no = 0;
echo $row;
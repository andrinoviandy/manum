<?php
require('../../config/koneksi.php');
try {
//     $sqlId = "SELECT max(id) AS id_max FROM cabang";
//     $dataId = $koneksi->prepare($sqlId);
//     $dataId->execute();
//     $row = $dataId->fetch();
//     // echo $row['id_max'];
//     //code...
//     $kode = "CA" . strval($row['id_max']);
    $sql = "INSERT INTO kategori_keuangan(nama_kategori, jenis_kategori) VALUES('" . $_POST['nama'] . "','" . $_POST['jenis'] . "')";
    $data = $koneksi->prepare($sql);
    $data->execute();
    echo '1';
} catch (\Throwable $th) {
    echo '0';
}

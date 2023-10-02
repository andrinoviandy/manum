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
    $sql = "INSERT INTO kas(nama_kas, pemilik_kas, cabang_id, no_rekening) VALUES('" . $_POST['nama_kas'] . "','" . $_POST['pemilik'] . "','" . $_POST['cabang'] . "','" . $_POST['no_rekening'] . "')";
    $data = $koneksi->prepare($sql);
    $data->execute();
    echo '1';
} catch (\Throwable $th) {
    echo '0';
}

<?php
require('../../config/koneksi.php');
try {
    // $sqlId = "SELECT max(id) AS id_max FROM cabang";
    // $dataId = $koneksi->prepare($sqlId);
    // $dataId->execute();
    // $row = $dataId->fetch();
    //code...
    $name_file = "pendukung_" . date('dmYHis') . "." . explode("/", $_FILES['file_berkas']['type'])[1];
    move_uploaded_file($_FILES['file_berkas']['tmp_name'], "../../file/dok_pendukung/" . $name_file);
    $sql = "INSERT INTO dok_jamaah(proses_jamaah_id, nama_berkas, file_berkas, status_valid) VALUES('" . $_POST['id_proses'] . "', '" . $_POST['nama_berkas'] . "','" . $name_file . "', '0')";
    $data = $koneksi->prepare($sql);
    $data->execute();
    echo '1';
} catch (\Throwable $th) {
    echo '0';
}

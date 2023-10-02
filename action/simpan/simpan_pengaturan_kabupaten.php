<?php
require('../../config/koneksi.php');
try {
    $sql = "INSERT INTO kabupaten(provinsi_id, nama_kabupaten) VALUES('".$_POST['provinsi']."', '".$_POST['nama_kabupaten']."')";
    $data = $koneksi->prepare($sql);
    $data->execute();
    echo '1';
} catch (\Throwable $th) {
    echo '0';
}

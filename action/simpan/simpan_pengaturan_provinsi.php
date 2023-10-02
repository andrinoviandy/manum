<?php
require('../../config/koneksi.php');
try {
    $sql = "INSERT INTO provinsi(nama_provinsi) VALUES('".$_POST['nama_provinsi']."')";
    $data = $koneksi->prepare($sql);
    $data->execute();
    echo '1';
} catch (\Throwable $th) {
    echo '0';
}

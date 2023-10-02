<?php
require('../../config/koneksi.php');
try {
    //code...
    $sql = "UPDATE provinsi SET nama_provinsi = '".$_POST['nama_provinsi']."' WHERE id = ".$_POST['id']."";
    $data = $koneksi->prepare($sql);
    $data->execute();
    echo '1';
} catch (\Throwable $th) {
    echo "0";
}

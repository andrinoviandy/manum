<?php
require('../../config/koneksi.php');
try {
    //code...
    $sql = "UPDATE kabupaten SET nama_kabupaten = '".$_POST['nama_kabupaten']."', provinsi_id = '".$_POST['provinsi']."' WHERE id = ".$_POST['id']."";
    $data = $koneksi->prepare($sql);
    $data->execute();
    echo '1';
} catch (\Throwable $th) {
    echo "0";
}

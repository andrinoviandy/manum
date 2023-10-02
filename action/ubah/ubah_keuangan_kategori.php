<?php
require('../../config/koneksi.php');
try {
    //code...
    $sql = "UPDATE kategori_keuangan SET nama_kategori = '".$_POST['nama']."', jenis_kategori = '".$_POST['jenis']."' WHERE id = ".$_POST['id']."";
    $data = $koneksi->prepare($sql);
    $data->execute();
    echo '1';
} catch (\Throwable $th) {
    echo "0";
}

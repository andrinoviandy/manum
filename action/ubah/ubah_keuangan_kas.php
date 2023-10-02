<?php
require('../../config/koneksi.php');
try {
    //code...
    $sql = "UPDATE kas SET nama_kas = '".$_POST['nama_kas']."', pemilik_kas = '".$_POST['pemilik']."', cabang_id = '".$_POST['cabang']."', no_rekening = '".$_POST['no_rekening']."' WHERE id = ".$_POST['id']."";
    $data = $koneksi->prepare($sql);
    $data->execute();
    echo '1';
} catch (\Throwable $th) {
    echo "0";
}

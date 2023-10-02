<?php
require('../../config/koneksi.php');
try {
    $sql = "UPDATE keuangan SET status_konfirmasi = '" . $_POST['konfirmasi'] . "' WHERE nomor = '" . $_POST['nomor'] . "'";
    $data = $koneksi->prepare($sql);
    $data->execute();
    echo '1';
} catch (\Throwable $th) {
    echo '0';
}

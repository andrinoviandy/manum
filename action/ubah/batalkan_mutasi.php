<?php
require('../../config/koneksi.php');
try {
    $sql = "UPDATE keuangan SET status_mutasi = 0 WHERE id = " . $_POST['id_keuangan'] . "";
    $data = $koneksi->prepare($sql);
    $data->execute();
    $sql2 = "DELETE FROM keuangan WHERE nomor = '".$_POST['nomor']."' AND id != " . $_POST['id_keuangan'] . "";
    $data2 = $koneksi->prepare($sql2);
    $data2->execute();
    echo '1';
} catch (\Throwable $th) {
    echo $th;
}

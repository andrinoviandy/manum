<?php
require('../../config/koneksi.php');
try {
    $sql = "SELECT * FROM proses_jamaah WHERE jamaah_id = '" . $_POST['id_jamaah'] . "' AND status_proses = 0";
    $data = $koneksi->prepare($sql);
    $data->execute();
    $count = $data->rowCount();
    echo $count;
} catch (\Throwable $th) {
    echo '0';
}

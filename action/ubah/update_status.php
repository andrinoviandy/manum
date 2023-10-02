<?php
require('../../config/koneksi.php');
try {
    $sql = "UPDATE proses_jamaah SET status_proses = '" . $_POST['status'] . "' WHERE id = " . $_POST['id_proses'] . "";
    $data = $koneksi->prepare($sql);
    $data->execute();
    echo '1';
} catch (\Throwable $th) {
    echo '0';
}

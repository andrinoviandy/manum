<?php
require('../../config/koneksi.php');
try {
    $sql = "UPDATE dok_jamaah SET status_valid = '" . $_POST['verif'] . "' WHERE id = " . $_POST['id'] . "";
    $data = $koneksi->prepare($sql);
    $data->execute();
    echo '1';
} catch (\Throwable $th) {
    echo '0';
}

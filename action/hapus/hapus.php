<?php
require('../../config/koneksi.php');
try {
    $sql = "DELETE FROM " . $_POST['table'] . " WHERE id = '" . $_POST['id'] . "'";
    $data = $koneksi->prepare($sql);
    $data->execute();
    echo '1';
} catch (\Throwable $th) {
    echo '0';
}

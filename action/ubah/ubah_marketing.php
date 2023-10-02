<?php
require('../../config/koneksi.php');
try {
    if ($_POST['value'] !== 0 || $_POST['value'] !== NULL) {
        $sql = "UPDATE proses_jamaah SET marketing_id = ".$_POST['value']." WHERE id = " . $_POST['id'] . "";
    } else {
        $sql = "UPDATE proses_jamaah SET marketing_id = '' WHERE id = " . $_POST['id'] . "";
    }
    $data = $koneksi->prepare($sql);
    $data->execute();
    echo '1';
} catch (\Throwable $th) {
    echo '0';
}

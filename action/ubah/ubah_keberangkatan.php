<?php
require('../../config/koneksi.php');
try {
    if (!empty($_POST['value'])) {
        $sql = "UPDATE proses_jamaah SET tgl_keberangkatan = '".$_POST['value']."' WHERE id = " . $_POST['id'] . "";
    } else {
        $sql = "UPDATE proses_jamaah SET tgl_keberangkatan = NULL WHERE id = " . $_POST['id'] . "";
    }
    $data = $koneksi->prepare($sql);
    $data->execute();
    echo $_POST['value'];
} catch (\Throwable $th) {
    echo '0';
}

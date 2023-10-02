<?php
require('../../config/koneksi.php');
try {
    $sql = "SELECT * FROM ".$_POST['table']." WHERE ".$_POST['field']." = '" . $_POST['field_value'] . "'";
    $data = $koneksi->prepare($sql);
    $data->execute();
    $count = $data->rowCount();
    echo $count;
} catch (\Throwable $th) {
    echo '0';
}

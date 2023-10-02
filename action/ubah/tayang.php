<?php
require('../../config/koneksi.php');
try {
    if (isset($_POST['action']) && $_POST['action'] == 0) {
        $sql = "SELECT * FROM proses_jamaah WHERE paket_id = " . $_POST['id'] . "";
        $data = $koneksi->prepare($sql);
        $data->execute();
        $count = $data->rowCount();
        if ($count !== 0) {
            echo '0';
            return false;
        } else {
            $sql = "UPDATE paket SET tayang = '" . $_POST['action'] . "' WHERE id = " . $_POST['id'] . "";
            $data = $koneksi->prepare($sql);
            $data->execute();
            echo '1';
        }
    } else {
        $sql = "UPDATE paket SET tayang = '" . $_POST['action'] . "' WHERE id = " . $_POST['id'] . "";
        $data = $koneksi->prepare($sql);
        $data->execute();
        echo '1';
    }
} catch (\Throwable $th) {
    echo '0';
}

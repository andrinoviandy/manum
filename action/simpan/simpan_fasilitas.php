<?php
require('../../config/koneksi.php');
try {
    if ($_POST['save'] == 1) {
        $sqlId = "SELECT * FROM fas_jamaah WHERE proses_jamaah_id = " . $_POST['id_proses'] . " AND nama_fasilitas = 'Passport'";
        $dataId = $koneksi->prepare($sqlId);
        $dataId->execute();
        $row = $dataId->fetch();
        $count = $dataId->rowCount();

        $name_file = "fasilitas_" . date('dmYHis') . "." . explode("/", $_FILES['file']['type'])[1];
        move_uploaded_file($_FILES['file']['tmp_name'], "../../file/fasilitas/" . $name_file);
        if ($count !== 0) {
            $sql = "UPDATE fas_jamaah SET file = '" . $name_file . "' WHERE id = ".$row['id']."";
        } else {
            $sql = "INSERT INTO fas_jamaah(proses_jamaah_id, nama_fasilitas, file) VALUES('" . $_POST['id_proses'] . "', '" . $_POST['nama'] . "','" . $name_file . "')";
        }
    } else if ($_POST['save'] == 2) {
        $sqlId = "SELECT * FROM fas_jamaah WHERE proses_jamaah_id = " . $_POST['id_proses'] . " AND nama_fasilitas = 'Perlengkapan Umrah/Haji'";
        $dataId = $koneksi->prepare($sqlId);
        $dataId->execute();
        $row = $dataId->fetch();
        $count = $dataId->rowCount();

        if ($count !== 0) {
            $sql = "UPDATE fas_jamaah SET tgl_diterima = '" . $_POST['tgl'] . "' WHERE id = ".$row['id']."";
        } else {
            $sql = "INSERT INTO fas_jamaah(proses_jamaah_id, nama_fasilitas, tgl_diterima) VALUES('" . $_POST['id_proses'] . "', '" . $_POST['nama'] . "','" . $_POST['tgl'] . "')";
        }
    } else if ($_POST['save'] == 3) {
        $sqlId = "SELECT * FROM fas_jamaah WHERE proses_jamaah_id = " . $_POST['id_proses'] . " AND nama_fasilitas = 'Manasik'";
        $dataId = $koneksi->prepare($sqlId);
        $dataId->execute();
        $row = $dataId->fetch();
        $count = $dataId->rowCount();

        if ($count !== 0) {
            $sql = "UPDATE fas_jamaah SET jadwal = '" . $_POST['jadwal'] . "' WHERE id = ".$row['id']."";
        } else {
            $sql = "INSERT INTO fas_jamaah(proses_jamaah_id, nama_fasilitas, jadwal) VALUES('" . $_POST['id_proses'] . "', '" . $_POST['nama'] . "','" . $_POST['jadwal'] . "')";
        }
    }
    $data = $koneksi->prepare($sql);
    $data->execute();
    echo '1';
} catch (\Throwable $th) {
    echo '0';
}

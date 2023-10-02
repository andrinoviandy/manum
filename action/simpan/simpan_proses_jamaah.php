<?php
require('../../config/koneksi.php');
try {
    if ($_POST['paket'] !== '' && $_POST['marketing'] !== '') {
        $sql = "INSERT INTO proses_jamaah(tgl_proses, jamaah_id, paket_id, marketing_id) VALUES('".$_POST['tgl_proses']."', '".$_POST['jamaah_id']."','" . $_POST['paket'] . "','" . $_POST['marketing'] . "')";
    } 
    else if ($_POST['paket'] !== '' && $_POST['marketing'] == '') {
        $sql = "INSERT INTO proses_jamaah(tgl_proses, jamaah_id, paket_id) VALUES('".$_POST['tgl_proses']."', '".$_POST['jamaah_id']."','" . $_POST['paket'] . "')";
    } 
    else if ($_POST['paket'] == '' && $_POST['marketing'] !== '') {
        $sql = "INSERT INTO proses_jamaah(tgl_proses, jamaah_id, marketing_id) VALUES('".$_POST['tgl_proses']."', '".$_POST['jamaah_id']."','" . $_POST['marketing'] . "')";
    } 
    else {
        $sql = "INSERT INTO proses_jamaah(tgl_proses, jamaah_id) VALUES('".$_POST['tgl_proses']."', '".$_POST['jamaah_id']."')";
    }
    $data = $koneksi->prepare($sql);
    $data->execute();
    echo '1';
} catch (\Throwable $th) {
    echo '0';
}

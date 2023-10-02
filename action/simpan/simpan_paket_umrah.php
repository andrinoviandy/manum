<?php
require('../../config/koneksi.php');
try {
    // $sqlId = "SELECT max(id) AS id_max FROM cabang";
    // $dataId = $koneksi->prepare($sqlId);
    // $dataId->execute();
    // $row = $dataId->fetch();
    //code...
    if ($_POST['harga'] !== '') {
        $harga = str_replace(".", "", $_POST['harga']);
    } else {
        $harga = 0;
    }
    $name_file = "flyer_" . date('dmYHis') . "." . explode("/", $_FILES['flyer']['type'])[1];
    if ($_POST['tgl_berangkat'] !== '') {
        $sql = "INSERT INTO paket(nama_paket, harga, bulan_berangkat, tgl_berangkat, asal_keberangkatan, pesawat, hotel, bis, flyer, pembimbing) VALUES('" . $_POST['nama'] . "','$harga','" . $_POST['bulan_berangkat'] . "','" . $_POST['tgl_berangkat'] . "','" . $_POST['asal_keberangkatan'] . "', '" . $_POST['pesawat'] . "', '" . $_POST['hotel'] . "', '" . $_POST['bis'] . "', '" . $name_file . "', '" . $_POST['pembimbing'] . "')";
    } else {
        $sql = "INSERT INTO paket(nama_paket, harga, bulan_berangkat, asal_keberangkatan, pesawat, hotel, bis, flyer, pembimbing) VALUES('" . $_POST['nama'] . "','$harga','" . $_POST['bulan_berangkat'] . "','" . $_POST['asal_keberangkatan'] . "', '" . $_POST['pesawat'] . "', '" . $_POST['hotel'] . "', '" . $_POST['bis'] . "', '" . $name_file . "', '" . $_POST['pembimbing'] . "')";
    }
    move_uploaded_file($_FILES['flyer']['tmp_name'], "../../file/paket_umrah/" . $name_file);
    $data = $koneksi->prepare($sql);
    $data->execute();
    echo '1';
} catch (\Throwable $th) {
    echo '0';
}

<?php
require('../../config/koneksi.php');
try {
    //code...
    if ($_POST['harga'] !== '') {
        $harga = str_replace(".", "", $_POST['harga']);
    } else {
        $harga = 0;
    }
    if ($_FILES['flyer']['name'] !== '') {
        if ($_POST['tgl_berangkat'] !== '') {
            $name_file = "flyer_" . date('dmYHis') . "." . explode("/", $_FILES['flyer']['type'])[1];
            move_uploaded_file($_FILES['flyer']['tmp_name'], "../../file/paket_umrah/" . $name_file);
            $sql = "UPDATE paket SET nama_paket = '" . $_POST['nama'] . "', harga = '$harga', bulan_berangkat = '" . $_POST['bulan_berangkat'] . "', tgl_berangkat = '" . $_POST['tgl_berangkat'] . "', asal_keberangkatan = '" . $_POST['asal_keberangkatan'] . "', pesawat = '" . $_POST['pesawat'] . "', hotel = '" . $_POST['hotel'] . "', bis = '" . $_POST['bis'] . "', flyer = '" . $name_file . "', pembimbing = '" . $_POST['pembimbing'] . "' WHERE id = " . $_POST['id'] . "";
            $data = $koneksi->prepare($sql);
            $data->execute();
            echo '1';
        } else {
            $name_file = "flyer_" . date('dmYHis') . "." . explode("/", $_FILES['flyer']['type'])[1];
            move_uploaded_file($_FILES['flyer']['tmp_name'], "../../file/paket_umrah/" . $name_file);
            $sql = "UPDATE paket SET nama_paket = '" . $_POST['nama'] . "', harga = '$harga', bulan_berangkat = '" . $_POST['bulan_berangkat'] . "', asal_keberangkatan = '" . $_POST['asal_keberangkatan'] . "', pesawat = '" . $_POST['pesawat'] . "', hotel = '" . $_POST['hotel'] . "', bis = '" . $_POST['bis'] . "', flyer = '" . $name_file . "', pembimbing = '" . $_POST['pembimbing'] . "' WHERE id = " . $_POST['id'] . "";
            $data = $koneksi->prepare($sql);
            $data->execute();
            echo '1';
        }
    } else {
        if ($_POST['tgl_berangkat'] !== '') {
            $sql = "UPDATE paket SET nama_paket = '" . $_POST['nama'] . "', harga = '$harga', bulan_berangkat = '" . $_POST['bulan_berangkat'] . "', tgl_berangkat = '" . $_POST['tgl_berangkat'] . "', asal_keberangkatan = '" . $_POST['asal_keberangkatan'] . "', pesawat = '" . $_POST['pesawat'] . "', hotel = '" . $_POST['hotel'] . "', bis = '" . $_POST['bis'] . "', pembimbing = '" . $_POST['pembimbing'] . "' WHERE id = " . $_POST['id'] . "";
            $data = $koneksi->prepare($sql);
            $data->execute();
            echo '1';
        } else {
            $sql = "UPDATE paket SET nama_paket = '" . $_POST['nama'] . "', harga = '$harga', bulan_berangkat = '" . $_POST['bulan_berangkat'] . "', asal_keberangkatan = '" . $_POST['asal_keberangkatan'] . "', pesawat = '" . $_POST['pesawat'] . "', hotel = '" . $_POST['hotel'] . "', bis = '" . $_POST['bis'] . "', pembimbing = '" . $_POST['pembimbing'] . "' WHERE id = " . $_POST['id'] . "";
            $data = $koneksi->prepare($sql);
            $data->execute();
            echo '1';
        }
    }
} catch (\Throwable $th) {
    echo '0';
}

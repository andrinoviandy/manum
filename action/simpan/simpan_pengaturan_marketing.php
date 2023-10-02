<?php
require('../../config/koneksi.php');
try {
    $sqlCek = "SELECT * FROM marketing WHERE LOWER(nama_marketing) = LOWER('" . $_POST['nama'] . "')";
    $dataCek = $koneksi->prepare($sqlCek);
    $dataCek->execute();
    $cekData = $dataCek->rowCount();
    if ($cekData == 0) {
        $name_file = "photo_" . date('dmYHis') . "." . explode("/", $_FILES['photo']['type'])[1];
        move_uploaded_file($_FILES['photo']['tmp_name'], "../../file/marketing/" . $name_file);
        $sql = "INSERT INTO marketing(nik, nama_marketing, no_hp, email, photo) VALUES('" . $_POST['nik'] . "', '" . $_POST['nama'] . "','" . $_POST['no_hp'] . "','" . $_POST['email'] . "', '" . $name_file . "')";
        $data = $koneksi->prepare($sql);
        $data->execute();
        echo '1';
    } else {
        echo "Marketing Sudah Terdaftar !";
    }
} catch (\Throwable $th) {
    echo '0';
}

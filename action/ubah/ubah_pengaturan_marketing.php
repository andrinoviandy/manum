<?php
require('../../config/koneksi.php');
try {
    $sqlCek = "SELECT * FROM marketing WHERE LOWER(nama_marketing) = LOWER('" . $_POST['nama'] . "') AND id != " . $_POST['id'] . "";
    $dataCek = $koneksi->prepare($sqlCek);
    $dataCek->execute();
    $cekData = $dataCek->rowCount();
    if ($cekData == 0) {
        if ($_FILES['photo']['name'] !== '') {
            $name_file = "photo_" . date('dmYHis') . "." . explode("/", $_FILES['photo']['type'])[1];
            move_uploaded_file($_FILES['photo']['tmp_name'], "../../file/marketing/" . $name_file);
            $sql = "UPDATE marketing SET nik = '" . $_POST['nik'] . "', nama_marketing = '" . $_POST['nama'] . "', no_hp = '" . $_POST['no_hp'] . "', email = '" . $_POST['email'] . "', photo = '" . $name_file . "' WHERE id = " . $_POST['id'] . "";
            $data = $koneksi->prepare($sql);
            $data->execute();
            echo '1';
        } else {
            $sql = "UPDATE marketing SET nik = '" . $_POST['nik'] . "', nama_marketing = '" . $_POST['nama'] . "', no_hp = '" . $_POST['no_hp'] . "', email = '" . $_POST['email'] . "' WHERE id = " . $_POST['id'] . "";
            $data = $koneksi->prepare($sql);
            $data->execute();
            echo '1';
        }
    } else {
        echo "Marketing Sudah Terdaftar !";
    }
} catch (\Throwable $th) {
    echo "0";
}

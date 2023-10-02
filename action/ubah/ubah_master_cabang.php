<?php
require('../../config/koneksi.php');
try {
    //code...
    $sqlCek = "SELECT * FROM cabang WHERE LOWER(cabang) = LOWER('" . $_POST['nama_cabang'] . "') AND id != " . $_POST['id'] . "";
    $dataCek = $koneksi->prepare($sqlCek);
    $dataCek->execute();
    $cekData = $dataCek->rowCount();
    if ($cekData == 0) {
        $sql = "UPDATE cabang SET pemilik = '" . $_POST['nama_pemilik'] . "', no_hp = '" . $_POST['no_hp'] . "', email = '" . $_POST['email'] . "', cabang = '" . $_POST['nama_cabang'] . "', status = '" . $_POST['status'] . "', tgl_daftar = '" . $_POST['tgl_daftar'] . "' WHERE id = " . $_POST['id'] . "";
        $data = $koneksi->prepare($sql);
        $data->execute();
        echo '1';
    } else {
        echo "Cabang Sudah Terdaftar !";
    }
} catch (\Throwable $th) {
    echo "0";
}

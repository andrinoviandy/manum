<?php
require('../../config/koneksi.php');
try {
    //code...
    $sqlCek = "SELECT * FROM users WHERE LOWER(username) = LOWER('" . $_POST['username'] . "') AND id != " . $_POST['id'] . "";
    $dataCek = $koneksi->prepare($sqlCek);
    $dataCek->execute();
    $cekData = $dataCek->rowCount();
    if ($cekData == 0) {
        $sql = "UPDATE users SET nama = '" . $_POST['nama'] . "', role_id = '" . $_POST['role'] . "', cabang_id = '" . $_POST['cabang'] . "', username = '" . $_POST['username'] . "', password = '" . md5($_POST['password']) . "', enable = '" . $_POST['status'] . "' WHERE id = " . $_POST['id'] . "";
        $data = $koneksi->prepare($sql);
        $data->execute();
        echo '1';
    } else {
        echo "Username Sudah Terdaftar !";
    }
} catch (\Throwable $th) {
    echo "0";
}

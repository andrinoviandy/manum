<?php
require('../../config/koneksi.php');
try {
    $sqlCek = "SELECT * FROM users WHERE LOWER(username) = LOWER('" . $_POST['username'] . "')";
    $dataCek = $koneksi->prepare($sqlCek);
    $dataCek->execute();
    $cekData = $dataCek->rowCount();
    if ($cekData == 0) {
        $sql = "INSERT INTO users(nama, role_id, cabang_id, username, password, enable) VALUES('" . $_POST['nama'] . "','" . $_POST['role'] . "','" . $_POST['cabang'] . "','" . $_POST['username'] . "','" . md5($_POST['password']) . "', '" . $_POST['status'] . "')";
        $data = $koneksi->prepare($sql);
        $data->execute();
        echo '1';
    } else {
        echo "Username Sudah Terdaftar !";
    }
} catch (\Throwable $th) {
    echo '0';
}

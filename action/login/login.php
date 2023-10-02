<?php
require('../../config/koneksi.php');
try {
    //code...
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");

    $sql = "SELECT * FROM users WHERE username = '" . $_POST['username'] . "' AND password = md5('" . $_POST['password'] . "')";
    $data = $koneksi->prepare($sql);
    $data->execute();
    $count = $data->rowCount();

    if ($count > 0) {
        $row = $data->fetch();
        $_SESSION['id'] = $row['id'];
        $_SESSION['role_id'] = $row['role_id'];
        $_SESSION['cabang_id'] = $row['cabang_id'];
        $_SESSION['nama'] = $row['nama'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['password'] = $row['password'];
        echo '1';
    } else {
        echo '0';
    }
} catch (\Throwable $th) {
    echo "0";
}

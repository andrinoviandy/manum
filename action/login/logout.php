<?php
require('../../config/koneksi.php');
try {
    //code...
    unset($_SESSION['id']);
    unset($_SESSION['role_id']);
    unset($_SESSION['cabang_id']);
    unset($_SESSION['nama']);
    unset($_SESSION['username']);
    unset($_SESSION['password']);

    // header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
    // header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");

    echo '1';
} catch (\Throwable $th) {
    echo "0";
}

<?php
require('../../config/koneksi.php');
try {
    $sqlCek = "SELECT * FROM cabang WHERE LOWER(cabang) = LOWER('" . $_POST['nama_cabang'] . "')";
    $dataCek = $koneksi->prepare($sqlCek);
    $dataCek->execute();
    $cekData = $dataCek->rowCount();
    if ($cekData == 0) {
        $sqlId = "SELECT max(id) AS id_max FROM cabang";
        $dataId = $koneksi->prepare($sqlId);
        $dataId->execute();
        $row = $dataId->fetch();
        // echo $row['id_max'];
        //code...
        $kode = "CA" . strval($row['id_max']);
        $sql = "INSERT INTO cabang(kode, pemilik, no_hp, email, cabang, status, tgl_daftar) VALUES('$kode','" . $_POST['nama_pemilik'] . "','" . $_POST['no_hp'] . "','" . $_POST['email'] . "','" . $_POST['nama_cabang'] . "', '" . $_POST['status'] . "', '" . $_POST['tgl_daftar'] . "')";
        $data = $koneksi->prepare($sql);
        $data->execute();
        echo '1';
    } else {
        echo "Cabang Sudah Terdaftar !";
    }
} catch (\Throwable $th) {
    echo '0';
}

<?php
require('../../config/koneksi.php');
try {
    //cek
    $sqlCek = "SELECT * FROM jamaah WHERE nik = '" . $_POST['nik'] . "'";
    $dataCek = $koneksi->prepare($sqlCek);
    $dataCek->execute();
    $cekData = $dataCek->rowCount();
    if ($cekData == 0) {
        $name_file = "jamaah_" . date('dmYHis') . "." . explode("/", $_FILES['ktp']['type'])[1];
        move_uploaded_file($_FILES['ktp']['tmp_name'], "../../file/data_jamaah/" . $name_file);
        // jamaah
        $sql = "INSERT INTO jamaah(nik, nama, tempat_lahir, tgl_lahir, jenis_kelamin, no_hp, email, alamat, provinsi_id, kabupaten_id, ahli_waris, foto_ktp) VALUES('" . $_POST['nik'] . "','" . $_POST['nama'] . "','" . $_POST['tempat_lahir'] . "','" . $_POST['tgl_lahir'] . "','" . $_POST['jenis_kelamin'] . "', '" . $_POST['no_hp'] . "', '" . $_POST['email'] . "', '" . $_POST['alamat'] . "', '" . $_POST['provinsi'] . "', '" . $_POST['kabupaten'] . "', '" . $_POST['ahli_waris'] . "', '" . $name_file . "')";
        $data = $koneksi->prepare($sql);
        $exec = $data->execute();
        //id max
        if ($exec === true) {
            $sqlId = "SELECT max(id) AS id_max FROM jamaah";
            $dataId = $koneksi->prepare($sqlId);
            $dataId->execute();
            $row = $dataId->fetch();
            //pendaftaran
            $sql2 = "INSERT INTO pendaftaran(tgl_daftar, jamaah_id, marketing_id, cabang_id) VALUES('" . $_POST['tgl_daftar'] . "','" . $row['id_max'] . "','" . $_POST['marketing'] . "','" . $_POST['cabang'] . "')";
            $data2 = $koneksi->prepare($sql2);
            $data2->execute();
        }

        echo '1';
    } else {
        echo "NIK Sudah Terdaftar !";
    }
} catch (\Throwable $th) {
    echo '0';
}

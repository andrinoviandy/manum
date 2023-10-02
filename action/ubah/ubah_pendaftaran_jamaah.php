<?php
require('../../config/koneksi.php');
try {
    //code...
    $sqlCek = "SELECT * FROM jamaah WHERE nik = '" . $_POST['nik'] . "' AND id != $_POST[id_j]";
    $dataCek = $koneksi->prepare($sqlCek);
    $dataCek->execute();
    $cekData = $dataCek->rowCount();
    if ($cekData == 0) {
        if ($_FILES['ktp']['name'] !== '') {
            $name_file = "jamaah_" . date('dmYHis') . "." . explode("/", $_FILES['ktp']['type'])[1];
            move_uploaded_file($_FILES['ktp']['tmp_name'], "../../file/data_jamaah/" . $name_file);

            $sqlId = "SELECT jamaah_id FROM pendaftaran WHERE id = " . $_POST['id'] . "";
            $dataId = $koneksi->prepare($sqlId);
            $dataId->execute();
            $row = $dataId->fetch();
            // jamaah
            $sql = "UPDATE jamaah set nik = '" . $_POST['nik'] . "', nama = '" . $_POST['nama'] . "', tempat_lahir = '" . $_POST['tempat_lahir'] . "', tgl_lahir = '" . $_POST['tgl_lahir'] . "', jenis_kelamin = '" . $_POST['jenis_kelamin'] . "', no_hp = '" . $_POST['no_hp'] . "', email = '" . $_POST['email'] . "', alamat = '" . $_POST['alamat'] . "', provinsi_id = '" . $_POST['provinsi'] . "', kabupaten_id = '" . $_POST['kabupaten'] . "', ahli_waris = '" . $_POST['ahli_waris'] . "', foto_ktp = '" . $name_file . "' WHERE id = " . $row['jamaah_id'] . "";
            $data = $koneksi->prepare($sql);
            $exec = $data->execute();
            //id max
            if ($exec === true) {
                //pendaftaran
                $sql2 = "UPDATE pendaftaran set tgl_daftar = '" . $_POST['tgl_daftar'] . "', marketing_id = '" . $_POST['marketing'] . "', cabang_id = '" . $_POST['cabang'] . "' WHERE id = " . $_POST['id'] . "";
                $data2 = $koneksi->prepare($sql2);
                $data2->execute();
            }
            echo '1';
        } else {
            $sqlId = "SELECT jamaah_id FROM pendaftaran WHERE id = " . $_POST['id'] . "";
            $dataId = $koneksi->prepare($sqlId);
            $dataId->execute();
            $row = $dataId->fetch();
            // jamaah
            $sql = "UPDATE jamaah set nik = '" . $_POST['nik'] . "', nama = '" . $_POST['nama'] . "', tempat_lahir = '" . $_POST['tempat_lahir'] . "', tgl_lahir = '" . $_POST['tgl_lahir'] . "', jenis_kelamin = '" . $_POST['jenis_kelamin'] . "', no_hp = '" . $_POST['no_hp'] . "', email = '" . $_POST['email'] . "', alamat = '" . $_POST['alamat'] . "', provinsi_id = '" . $_POST['provinsi'] . "', kabupaten_id = '" . $_POST['kabupaten'] . "', ahli_waris = '" . $_POST['ahli_waris'] . "' WHERE id = " . $row['jamaah_id'] . "";
            $data = $koneksi->prepare($sql);
            $exec = $data->execute();
            //id max
            if ($exec === true) {
                //pendaftaran
                $sql2 = "UPDATE pendaftaran set tgl_daftar = '" . $_POST['tgl_daftar'] . "', marketing_id = '" . $_POST['marketing'] . "', cabang_id = '" . $_POST['cabang'] . "' WHERE id = " . $_POST['id'] . "";
                $data2 = $koneksi->prepare($sql2);
                $data2->execute();
            }
            echo '1';
        }
    } else {
        echo "NIK Sudah Terdaftar !";
    }
} catch (\Throwable $th) {
    echo '0';
}

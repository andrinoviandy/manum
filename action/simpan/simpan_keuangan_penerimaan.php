<?php
require('../../config/koneksi.php');
try {
    // $sqlId = "SELECT max(id) AS id_max FROM cabang";
    // $dataId = $koneksi->prepare($sqlId);
    // $dataId->execute();
    // $row = $dataId->fetch();
    //code...
    $sqlCek = "SELECT * FROM keuangan k INNER JOIN kategori_keuangan kk ON kk.id = k.kategori_keuangan_id WHERE kk.jenis_kategori = 'd' AND k.nomor = '" . $_POST['nomor'] . "'";
    $dataCek = $koneksi->prepare($sqlCek);
    $dataCek->execute();
    $cekData = $dataCek->rowCount();
    if ($cekData == 0) {
        $konfirmasi = 0;
        if ($_SESSION['role_id'] == 1) {
            $konfirmasi = 1;
        }
        if ($_FILES['bukti']['name'] !== '') {
            $name_file = "penerimaan_" . date('dmYHis') . "." . explode("/", $_FILES['bukti']['type'])[1];
            move_uploaded_file($_FILES['bukti']['tmp_name'], "../../file/keuangan/" . $name_file);
            $sql = "INSERT INTO keuangan(kategori_keuangan_id, nomor, tanggal, pembayaran, nominal, kas_id, keterangan, bukti, d_k, status_konfirmasi) VALUES('" . $_POST['kategori'] . "','" . $_POST['nomor'] . "','" . $_POST['tanggal'] . "','" . $_POST['pembayaran'] . "', '" . str_replace(".", "", $_POST['nominal']) . "', '" . $_POST['kas'] . "', '" . $_POST['keterangan'] . "', '" . $name_file . "', 'd', '$konfirmasi')";
            $data = $koneksi->prepare($sql);
            $data->execute();
            echo '1';
        } else {
            $sql = "INSERT INTO keuangan(kategori_keuangan_id, nomor, tanggal, pembayaran, nominal, kas_id, keterangan, d_k, status_konfirmasi) VALUES('" . $_POST['kategori'] . "','" . $_POST['nomor'] . "','" . $_POST['tanggal'] . "','" . $_POST['pembayaran'] . "', '" . str_replace(".", "", $_POST['nominal']) . "', '" . $_POST['kas'] . "', '" . $_POST['keterangan'] . "', 'd', '$konfirmasi')";
            $data = $koneksi->prepare($sql);
            $data->execute();
            echo '1';
        }
    } else {
        echo "Nomor Invoice Sudah Ada !";
    }
} catch (\Throwable $th) {
    echo '0';
}

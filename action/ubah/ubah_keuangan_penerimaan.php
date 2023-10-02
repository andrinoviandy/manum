<?php
require('../../config/koneksi.php');
try {
    //code...
    $sqlCek = "SELECT * FROM keuangan k INNER JOIN kategori_keuangan kk ON kk.id = k.kategori_keuangan_id WHERE kk.jenis_kategori = 'd' AND k.nomor = '" . $_POST['nomor'] . "' AND id != " . $_POST['id'] . "";
    $dataCek = $koneksi->prepare($sqlCek);
    $dataCek->execute();
    $cekData = $dataCek->rowCount();
    if ($cekData == 0) {
        if ($_FILES['bukti']['name'] !== '') {
            $name_file = "keuangan_" . date('dmYHis') . "." . explode("/", $_FILES['bukti']['type'])[1];
            move_uploaded_file($_FILES['bukti']['tmp_name'], "../../file/keuangan/" . $name_file);
            $sql = "UPDATE keuangan SET kategori_keuangan_id = '" . $_POST['kategori'] . "', nomor = '" . $_POST['nomor'] . "', tanggal = '" . $_POST['tanggal'] . "', pembayaran = '" . $_POST['pembayaran'] . "', nominal = '" . str_replace(".", "", $_POST['nominal']) . "', kas_id = '" . $_POST['kas'] . "', keterangan = '" . $_POST['keterangan'] . "', bukti = '" . $name_file . "' WHERE id = " . $_POST['id'] . "";
            $data = $koneksi->prepare($sql);
            $data->execute();
            echo '1';
        } else {
            $sql = "UPDATE keuangan SET kategori_keuangan_id = '" . $_POST['kategori'] . "', nomor = '" . $_POST['nomor'] . "', tanggal = '" . $_POST['tanggal'] . "', pembayaran = '" . $_POST['pembayaran'] . "', nominal = '" . str_replace(".", "", $_POST['nominal']) . "', kas_id = '" . $_POST['kas'] . "', keterangan = '" . $_POST['keterangan'] . "' WHERE id = " . $_POST['id'] . "";
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

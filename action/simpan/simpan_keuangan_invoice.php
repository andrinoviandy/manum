<?php
require('../../mail/phpmailer/src/Exception.php');
require('../../mail/phpmailer/src/PHPMailer.php');
require('../../mail/phpmailer/src/SMTP.php');

use PHPMailer\PHPMailer\PHPMailer;

require('../../config/koneksi.php');
try {
    // $sqlId = "SELECT max(id) AS id_max FROM cabang";
    // $dataId = $koneksi->prepare($sqlId);
    // $dataId->execute();
    // $row = $dataId->fetch();
    //code...
    $sqlCek = "SELECT * FROM keuangan k INNER JOIN kategori_keuangan kk ON kk.id = k.kategori_keuangan_id WHERE kk.jenis_kategori = 'd' AND k.nomor = '" . $_POST['no_invoice'] . "'";
    $dataCek = $koneksi->prepare($sqlCek);
    $dataCek->execute();
    $cekData = $dataCek->rowCount();
    if ($cekData == 0) {
        $name_file = "invoice_" . date('dmYHis') . "." . explode("/", $_FILES['bukti']['type'])[1];
        move_uploaded_file($_FILES['bukti']['tmp_name'], "../../file/keuangan/" . $name_file);
        $sql = "INSERT INTO keuangan(kategori_keuangan_id, proses_jamaah_id, nomor, tanggal, pembayaran, nominal, kas_id, keterangan, bukti, d_k) VALUES('4', '" . $_POST['id_proses'] . "', '" . $_POST['no_invoice'] . "','" . $_POST['tanggal'] . "','" . $_POST['pembayaran'] . "', '" . str_replace(".", "", $_POST['nominal']) . "', '" . $_POST['kas'] . "', '" . $_POST['keterangan'] . "', '" . $name_file . "', 'd')";
        $data = $koneksi->prepare($sql);
        $data->execute();

        $data_jamaah = $koneksi->prepare("SELECT j.nik, j.nama FROM proses_jamaah pj INNER JOIN jamaah j ON j.id = pj.jamaah_id WHERE pj.id='$_POST[id_proses]'");
        $data_jamaah->execute();
        $row = $data_jamaah->fetch();

        $nomor = $_POST['no_invoice'];
        $tanggal = date('d/M/Y', strtotime($_POST['tanggal']));
        $pembayaran = $_POST['pembayaran'];
        $nominal = $_POST['nominal'];
        $nik = $row['nik'];
        $jamaah = $row['nama'];

        $subject = 'Invoice Masuk';
        $message = '<html>
<head>
</head>
<body style="font-family: Calibri;" align="center">
<div width="400px" style="border: 1px solid; border-style: thin; padding: 10px;">
<div style="">

<h2>Invoice Masuk</h2>
</div>
<hr>
    <table width="100%" border="1" style="border: 1px solid; border-style: thin;" cellpadding="10">
        <tr style="background-color:#69BE28; color:white; font-weight:bold;">
            <td>Nomor</td>
            <td>Tanggal</td>
            <td>Pembayaran</td>
            <td>Nominal</td>
            <td>NIK Jamaah</td>
            <td>Nama Jamaah</td>
        </tr>
        <tr>
            <td>' . $nomor . '</td>
            <td>' . $tanggal . '</td>
            <td>' . $pembayaran . '</td>
            <td>' . $nominal . '</td>
            <td>' . $nik . '</td>
            <td>' . $jamaah . '</td>
        </tr>
    </table>
    <br>
    <br>
    <p align="right">From : Admin Pusat</p>
</div>
</body>
</html>';


        //init data
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Username = "yuidjanto@gmail.com"; // Replace with your mail id
        $mail->Password = "spsp kmbg zoru hvss"; //Replace with your mail pass
        $mail->SMTPAuth = true;  // authentication enabled
        $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for GMail
        $mail->SMTPAutoTLS = false;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;


        //Recipients
        $mail->setFrom('no-reply@gmail.com', 'Abid Soeheily Qary');
        // $mail->addAddress('sh_adi@rocketmail.com', '');  //add to email  
        // $mail->addAddress('yulsania0@gmail.com', '');  //add to email  
        $mail->addAddress('asqtourtravel@gmail.com', '');  //add to email  
        // $mail->addReplyTo('andrinoviandy77@gmail.com', 'saiarlen');  //add replay to email



        // Content
        $mail->isHTML(true);  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $message;
        $mail->send();
        echo '1';
    } else {
        echo "Nomor Invoice Sudah Ada !";
    }
} catch (\Throwable $th) {
    echo '0';
}

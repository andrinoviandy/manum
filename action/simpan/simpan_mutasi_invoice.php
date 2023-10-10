<?php
require('../../mail/phpmailer/src/Exception.php');
require('../../mail/phpmailer/src/PHPMailer.php');
require('../../mail/phpmailer/src/SMTP.php');

use PHPMailer\PHPMailer\PHPMailer;

require('../../config/koneksi.php');
try {
    $sqlId = "SELECT * FROM keuangan WHERE id = " . $_POST['id_keuangan'] . "";
    $dataId = $koneksi->prepare($sqlId);
    $dataId->execute();
    $row = $dataId->fetch();
    //code...
    $sql = "INSERT INTO keuangan(kategori_keuangan_id, proses_jamaah_id, nomor, tanggal, pembayaran, nominal, kas_id, keterangan, bukti, d_k, status_mutasi) VALUES('" . $row['kategori_keuangan_id'] . "', '" . $row['proses_jamaah_id'] . "', '" . $row['nomor'] . "','" . $row['tanggal'] . "','" . $row['pembayaran'] . "', '" . $row['nominal'] . "', '" . $_POST['kas'] . "', '" . $_POST['keterangan'] . "', '" . $row['bukti'] . "', 'd', '0')";
    $data = $koneksi->prepare($sql);
    $data->execute();

    $data2 = $koneksi->prepare("UPDATE keuangan SET status_mutasi = 1 WHERE id = " . $_POST['id_keuangan'] . "");
    $data2->execute();

    $data_jamaah = $koneksi->prepare("SELECT j.nik, j.nama FROM proses_jamaah pj INNER JOIN jamaah j ON j.id = pj.jamaah_id WHERE pj.id='$row[proses_jamaah_id]'");
    $data_jamaah->execute();
    $row_j = $data_jamaah->fetch();

    $nomor = $row['nomor'];
    $tanggal = date('d/M/Y', strtotime($row['tanggal']));
    $pembayaran = $row['pembayaran'];
    $nominal = number_format($row['nominal'], 0, ',', '.');
    $nik = $row_j['nik'];
    $jamaah = $row_j['nama'];

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
    $mail->setFrom('no-reply@email.com', 'Abid Soeheily Qary');
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
} catch (\Throwable $th) {
    echo '0';
}

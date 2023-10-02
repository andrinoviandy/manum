<!DOCTYPE html>
<?php
require('../../config/koneksi.php');

$sql = "SELECT j.nik, j.nama AS nama_jamaah, k.*, ks.* FROM keuangan k INNER JOIN kas ks ON ks.id = k.kas_id INNER JOIN proses_jamaah pj ON pj.id = k.proses_jamaah_id INNER JOIN jamaah j ON j.id = pj.jamaah_id WHERE k.id = $_GET[id]";

$data = $koneksi->prepare($sql);
$data->execute();
$row = $data->fetch();
?>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Print</title>
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.css">
  <style>
    body {
      font-family: 'Calibri';
    }

    @media print {
      #print {
        display: none;
      }
    }

    @media print {
      #PrintButton {
        display: none;
      }
    }
  </style>
  <link rel="icon" href="manum/dist/img/ikon.png">
</head>

<body>
  <!-- Content Header (Page header) -->
  <div>
    <div class="col-12">
      <div class="container-fluid text-center">
        <img src="../../dist/img/kop.png" width="70%">
      </div>
    </div>
    <hr style="height: 3px; background-color: green">
    <div class="col-12 mb-2">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-6 text-center">
            <h1 style="font-size: 100px; color:green;">INVOICE</h1>
            <h3>Nomor : <?php echo $row['nomor'] ?></h3>
          </div>
          <div class="col-6">
            <h3 class="float-right">Tanggal : <?php echo date('d M Y', strtotime($row['tanggal'])) ?></h3>
            <br>
            <br>
            <br>
            <h3 class="text-bold text-center">Pembayaran</h3>
            <h3 class="text-center"><?php echo ucwords(($row['pembayaran'])) ?></h3>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="col-12">
      <div class="container-fluid">
        <div class="row mb-2 text-center">
          <table style="width: 100%; font-size:20px" border="1" cellpadding="10">
            <thead style="background-color: green; color:black">
              <tr>
                <th>Nominal</th>
                <th>Bank Penerima</th>
                <th>NIK Jamaah</th>
                <th>Nama Jamaah</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><?php echo number_format($row['nominal'],0,',','.') ?></td>
                <td><?php echo $row['nama_kas'] ?></td>
                <td><?php echo $row['nik'] ?></td>
                <td><?php echo $row['nama_jamaah'] ?></td>
              </tr>
              <tr>
                <td colspan="4" style="padding: 20px;" class="text-left" height="200px" valign="top">
                  <table width="100%">
                    <tr>
                      <td width="10%" valign="top"><strong>Keterangan</strong></td>
                      <td valign="top" width="5%" align="center"> : </td>
                      <td><?php echo $row['keterangan'] ?></td>
                    </tr>
                  </table>
                </td>
              </tr>
            </tbody>
          </table>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="col-12 mt-1">
      <div class="container-fluid">
        <div class="row mb-2 text-center">
          <h5>Dicetak Tanggal <?php echo date('d M Y') ?></h5>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
  </div>
  <hr style="border-top: 1px dashed red; margin-bottom: 40px">
  <div>
    <div class="col-12">
      <div class="container-fluid text-center">
        <img src="../../dist/img/kop.png" width="70%">
      </div>
    </div>
    <hr style="height: 3px; background-color: green">
    <div class="col-12 mb-2">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-6 text-center">
            <h1 style="font-size: 100px; color:green;">INVOICE</h1>
            <h3>Nomor : <?php echo $row['nomor'] ?></h3>
          </div>
          <div class="col-6">
            <h3 class="float-right">Tanggal : <?php echo date('d M Y', strtotime($row['tanggal'])) ?></h3>
            <br>
            <br>
            <br>
            <h3 class="text-bold text-center">Pembayaran</h3>
            <h3 class="text-center"><?php echo ucwords(($row['pembayaran'])) ?></h3>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="col-12">
      <div class="container-fluid">
        <div class="row mb-2 text-center">
          <table style="width: 100%; font-size:20px" border="1" cellpadding="10">
            <thead style="background-color: green; color:black">
              <tr>
                <th>Nominal</th>
                <th>Bank Penerima</th>
                <th>NIK Jamaah</th>
                <th>Nama Jamaah</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><?php echo number_format($row['nominal'],0,',','.') ?></td>
                <td><?php echo $row['nama_kas'] ?></td>
                <td><?php echo $row['nik'] ?></td>
                <td><?php echo $row['nama_jamaah'] ?></td>
              </tr>
              <tr>
                <td colspan="4" style="padding: 20px;" class="text-left" height="200px" valign="top">
                  <table width="100%">
                    <tr>
                      <td width="10%" valign="top"><strong>Keterangan</strong></td>
                      <td valign="top" width="5%" align="center"> : </td>
                      <td><?php echo $row['keterangan'] ?></td>
                    </tr>
                  </table>
                </td>
              </tr>
            </tbody>
          </table>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="col-12 mt-1">
      <div class="container-fluid">
        <div class="row mb-2 text-center">
          <h5>Dicetak Tanggal <?php echo date('d M Y') ?></h5>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
  </div>
  <center><button id="PrintButton" onclick="PrintPage()">Print</button></center>
  <script type="text/javascript">
    function PrintPage() {
      window.print();
    }
    window.addEventListener('DOMContentLoaded', (event) => {
      PrintPage()
      setTimeout(function() {
        window.close()
      }, 750)
    });
  </script>
  <!-- jQuery UI 1.11.4 -->
  <script src="../../plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../plugins/moment/moment.min.js"></script>
  <script>
    const dateNow = moment().format('DD-MM-YYYY HH:mm')
  </script>
  <!-- AdminLTE App -->
  <script src="../../dist/js/adminlte.js"></script>
</body>

</html>
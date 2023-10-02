<?php
require('../config/koneksi.php');
if (isset($_POST['id'])) {
    $_SESSION['id_ubah'] = $_POST['id'];
    $sql = "SELECT p.id AS id_p, p.*, j.*, pro.nama_provinsi, k.nama_kabupaten, m.nama_marketing, c.cabang FROM pendaftaran p INNER JOIN jamaah j ON j.id = p.jamaah_id LEFT JOIN provinsi pro ON pro.id = j.provinsi_id LEFT JOIN kabupaten k ON k.id = j.kabupaten_id LEFT JOIN cabang c ON c.id = p.cabang_id LEFT JOIN marketing m ON m.id = p.marketing_id WHERE p.id = $_POST[id]";
    $data = $koneksi->prepare($sql);
    $data->execute();
    $row = $data->fetch();
}
if (isset($_SESSION['id_ubah'])) {
    $sql = "SELECT p.id AS id_p, p.*, j.*, pro.nama_provinsi, k.nama_kabupaten, m.nama_marketing, c.cabang FROM pendaftaran p INNER JOIN jamaah j ON j.id = p.jamaah_id LEFT JOIN provinsi pro ON pro.id = j.provinsi_id LEFT JOIN kabupaten k ON k.id = j.kabupaten_id LEFT JOIN cabang c ON c.id = p.cabang_id LEFT JOIN marketing m ON m.id = p.marketing_id WHERE p.id = $_SESSION[id_ubah]";
    $data = $koneksi->prepare($sql);
    $data->execute();
    $row = $data->fetch();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="m-0">On Progress</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <section class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="card elevation-2" style="height: 205px;">
                                            <div style="background-image: url('manum/file/data_jamaah/<?php echo $row['foto_ktp']; ?>'); background-position: top; height: 100%; background-size: cover; background-repeat: no-repeat">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card col-lg-4 table-responsive p-0" style="height: 205px; font-size: 12px;">
                                        <table class="table text-bold">
                                            <tr>
                                                <td colspan="3" style="position: sticky; top:0;" class="bg-info text-center">Data Pendaftaran Jamaah</td>
                                            </tr>
                                            <tr>
                                                <td>NIK</td>
                                                <td>:</td>
                                                <td><?php echo $row['nik']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Nama Lengkap</td>
                                                <td>:</td>
                                                <td><?php echo $row['nama']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Tempat Lahir</td>
                                                <td>:</td>
                                                <td><?php echo $row['tempat_lahir']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal Lahir</td>
                                                <td>:</td>
                                                <td><?php echo date("d/m/Y", strtotime($row['tgl_lahir'])); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Jenis Kelamin</td>
                                                <td>:</td>
                                                <td><?php echo $row['jenis_kelamin'] === 'L' ? 'Laki-laki' : 'Perempuan'; ?></td>
                                            </tr>
                                            <tr>
                                                <td>No. Telp</td>
                                                <td>:</td>
                                                <td><?php echo $row['no_hp']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td>:</td>
                                                <td><?php echo $row['email']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Alamat</td>
                                                <td>:</td>
                                                <td><?php echo $row['alamat']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Provinsi</td>
                                                <td>:</td>
                                                <td><?php echo $row['nama_provinsi']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Kabupaten</td>
                                                <td>:</td>
                                                <td><?php echo $row['nama_kabupaten']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Ahli Waris</td>
                                                <td>:</td>
                                                <td><?php echo $row['ahli_waris']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Kantor Cabang</td>
                                                <td>:</td>
                                                <td><?php echo $row['cabang']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Marketing</td>
                                                <td>:</td>
                                                <td><?php echo $row['nama_marketing']; ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-lg-4">
                                        <form class="float-right col-lg-10">
                                            <div class="form-group">
                                                <label>Tanggal Proses</label>
                                                <input type="date" name="tgl_proses" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Pilih Paket</label>
                                                <div id="dropdown_paket"></div>
                                                <script>
                                                    dropdown('dropdown_paket', 'paket', 'nama_paket')
                                                </script>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <button class="btn btn-sm btn-default mr-2" type="button" onclick="loadContent(url)"><span class="fas fa-reply"></span> Kembali</button>
                                <button onclick="loadContent(`${url}_proses`, <?php echo $row['id_p'] ?>);" class="btn btn-sm btn-success m-1"><span class="fas fa-check-circle"></span> Proses</button>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </section>
    </div>
</body>

</html>
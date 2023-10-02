<?php
require('../config/koneksi.php');
if (isset($_POST['id'])) {
    $_SESSION['id_ubah'] = $_POST['id'];
    $sql = "SELECT p.*, (SELECT COUNT(pa.id) FROM proses_jamaah pj INNER JOIN paket pa ON pa.id = pj.paket_id INNER JOIN jamaah j ON j.id = pj.jamaah_id WHERE pa.id = p.id AND j.jenis_kelamin = 'L') AS countl, (SELECT COUNT(pa.id) FROM proses_jamaah pj INNER JOIN paket pa ON pa.id = pj.paket_id INNER JOIN jamaah j ON j.id = pj.jamaah_id WHERE pa.id = p.id AND j.jenis_kelamin = 'P') AS countp FROM paket p WHERE p.id = $_POST[id]";
    $data = $koneksi->prepare($sql);
    $data->execute();
    $row = $data->fetch();
}
if (isset($_SESSION['id_ubah'])) {
    $sql = "SELECT p.*, (SELECT COUNT(pa.id) FROM proses_jamaah pj INNER JOIN paket pa ON pa.id = pj.paket_id INNER JOIN jamaah j ON j.id = pj.jamaah_id WHERE pa.id = p.id AND j.jenis_kelamin = 'L') AS countl, (SELECT COUNT(pa.id) FROM proses_jamaah pj INNER JOIN paket pa ON pa.id = pj.paket_id INNER JOIN jamaah j ON j.id = pj.jamaah_id WHERE pa.id = p.id AND j.jenis_kelamin = 'P') AS countp FROM paket p WHERE p.id = $_SESSION[id_ubah]";
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
                        <h1 class="m-0">Detail Paket</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <section class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    <div class="input-group input-group">
                                        <!-- <a href="manum/action/export/paket_umrah.php"> -->
                                        <button type="button" class="btn btn-secondary ml-2" onclick="exportToExcelById('paket_umrah_detail', <?php echo $row['id']; ?>)">
                                            <i class="fas fa-file mr-1"></i> Export (.xlsx)
                                        </button>
                                        <!-- </a> -->
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="card elevation-2" style="height: 205px;">
                                            <div style="background-image: url('manum/file/paket_umrah/<?php echo $row['flyer']; ?>'); background-position: top; height: 100%; background-size: cover; background-repeat: no-repeat">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="card elevation-2 col-lg-12 bg-info p-2 text-center">
                                            <h4><?php echo $row['nama_paket'] . " " . $row['bulan_berangkat'] . "<br>" . number_format($row['harga'], 0, ',', '.') ?></h4>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="card elevation-2 bg-info">
                                                    <div class="card-header text-center text-bold">
                                                        Laki-Laki
                                                    </div>
                                                    <div class="card-footer text-center">
                                                        <h4><?php echo $row['countl'] ?></h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="card elevation-2 bg-info">
                                                    <div class="card-header text-center text-bold">
                                                        Perempuan
                                                    </div>
                                                    <div class="card-footer text-center">
                                                        <h4><?php echo $row['countp'] ?></h4>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <table class="table text-bold" style="height: 205px;">
                                            <tr class="bg-danger">
                                                <td colspan="3" align="center">Tanggal Keberangkatan
                                                    <br>
                                                    <?php if ($row['tgl_berangkat'] != '') {
                                                        echo date("d F Y", strtotime($row['tgl_berangkat']));
                                                    } ?>
                                                </td>
                                            </tr>
                                            <tr class="bg-success">
                                                <td>Asal Keberangkatan</td>
                                                <td>:</td>
                                                <td><?php echo $row['asal_keberangkatan']; ?></td>
                                            </tr>
                                            <tr class="bg-info">
                                                <td>Pembimbing</td>
                                                <td>:</td>
                                                <td><?php echo $row['pembimbing']; ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="info-box">
                                            <span class="info-box-icon bg-green"><i class="fa fa-plane"></i></span>

                                            <div class="info-box-content">
                                                <span class="info-box-body text-center">
                                                    <h4><?php echo $row['pesawat'] ?></h4>
                                                </span>
                                            </div>
                                            <!-- /.info-box-content -->
                                        </div>
                                        <!-- /.info-box -->
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="info-box">
                                            <span class="info-box-icon bg-yellow"><i class="fa fa-hotel"></i></span>

                                            <div class="info-box-content">
                                                <span class="info-box-body text-center">
                                                    <h4><?php echo $row['hotel'] ?></h4>
                                                </span>
                                            </div>
                                            <!-- /.info-box-content -->
                                        </div>
                                        <!-- /.info-box -->
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="info-box">
                                            <span class="info-box-icon bg-red"><i class="fa fa-bus"></i></span>

                                            <div class="info-box-content">
                                                <span class="info-box-body text-center">
                                                    <h4><?php echo $row['bis'] ?></h4>
                                                </span>
                                            </div>
                                            <!-- /.info-box-content -->
                                        </div>
                                        <!-- /.info-box -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="row">
                    <section class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    <h4>Data Calon Jamaah</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="card">
                                    <div class="card-header center">
                                        <div class="card-title">
                                            <table style="scrollbar-color: blue;">
                                                <tr>
                                                    <td>Show : &nbsp;</td>
                                                    <td>
                                                        <select class="form-control" id="show" onchange="show_dataCustom(this.value, url + '_detail', {id : <?php echo $row['id'] ?>})">
                                                            <option value="10">10</option>
                                                            <option value="20">20</option>
                                                            <option value="50">50</option>
                                                            <option value="100">100</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="card-title float-right">
                                            <div class="input-group input-group">
                                                <input type="text" id="table_search" class="form-control float-right" placeholder="Search...">
                                                <div class="input-group-append">
                                                    <button type="button" class="btn btn-default" onclick="cari_dataCustom(url + '_detail', {id : <?php echo $row['id'] ?>});">
                                                        <i class="fas fa-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-hover text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>NIK</th>
                                                    <th>Nama Lengkap</th>
                                                    <th>Jenis Kelamin</th>
                                                    <th>No. Telp</th>
                                                    <th>Provinsi</th>
                                                    <th>Kota Kabupaten</th>
                                                    <th>Kantor Cabang</th>
                                                    <th>Marketing</th>
                                                    <th>Saldo</th>
                                                    <td width="10%" style="position: sticky; right:0;" class="btn-default text-bold" align="center">Aksi</td>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody">
                                                <?php include('loading/loading.php') ?>
                                            </tbody>
                                            <script>
                                                fetchDataCustom(url + '_detail', {
                                                    id: <?php echo $row['id']; ?>
                                                })
                                            </script>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-header">
                                        <div class="col-12 pt-2 pb-2">
                                            <table class="w-100">
                                                <tr>
                                                    <td width="25%">
                                                        <button class="btn btn-sm btn-success" onclick="pagingCustom('prev', url + '_detail', {id : <?php echo $row['id'] ?>})"><span class="fas fa-arrow-circle-left"></span> Previous</button>
                                                        <input type="hidden" value="1" id="paging">
                                                    </td>
                                                    <td align="center">
                                                        <div id="jumlah_data" class="text-bold"></div>
                                                    </td>
                                                    <td width="25%">
                                                        <button class="btn btn-sm btn-success float-right" onclick="pagingCustom('next', url + '_detail', {id : <?php echo $row['id'] ?>})">Next <span class="fas fa-arrow-circle-right"></span></button>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </section>
    </div>
</body>

</html>
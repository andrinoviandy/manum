<?php
require('../config/koneksi.php');
if (isset($_POST['id'])) {
    $_SESSION['id_ubah'] = $_POST['id'];
    $sql = "SELECT pj.id AS id_p, pj.*, j.*, pro.nama_provinsi, k.nama_kabupaten, m.nama_marketing, c.cabang, pk.tgl_berangkat FROM proses_jamaah pj LEFT JOIN jamaah j ON j.id = pj.jamaah_id LEFT JOIN pendaftaran p ON j.id = p.jamaah_id LEFT JOIN provinsi pro ON pro.id = j.provinsi_id LEFT JOIN kabupaten k ON k.id = j.kabupaten_id LEFT JOIN cabang c ON c.id = p.cabang_id LEFT JOIN marketing m ON m.id = pj.marketing_id LEFT JOIN paket pk ON pk.id = pj.paket_id WHERE pj.id = $_POST[id]";
    $data = $koneksi->prepare($sql);
    $data->execute();
    $row = $data->fetch();
}
if (isset($_SESSION['id_ubah'])) {
    $sql = "SELECT pj.id AS id_p, pj.*, j.*, pro.nama_provinsi, k.nama_kabupaten, m.nama_marketing, c.cabang, pk.tgl_berangkat FROM proses_jamaah pj LEFT JOIN jamaah j ON j.id = pj.jamaah_id LEFT JOIN pendaftaran p ON j.id = p.jamaah_id LEFT JOIN provinsi pro ON pro.id = j.provinsi_id LEFT JOIN kabupaten k ON k.id = j.kabupaten_id LEFT JOIN cabang c ON c.id = p.cabang_id LEFT JOIN marketing m ON m.id = pj.marketing_id LEFT JOIN paket pk ON pk.id = pj.paket_id WHERE pj.id = $_SESSION[id_ubah]";
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
                        <h1 class="m-0">Detail Progress</h1>
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
                                <?php if ($row['status_proses'] == 0) { ?>
                                    <badge class="badge badge-warning text-md">Status : Masih Proses</badge>
                                <?php } else { ?>
                                    <badge class="badge badge-success text-md">Status : Selesai</badge>
                                <?php } ?>
                                <button class="btn btn-md btn-info float-right" onclick="updateStatus(<?php echo $row['id_p'] ?>, {title: 'Upgrade Status', id_p : <?php echo $row['id_p'] ?>, status_proses : <?php echo $row['status_proses'] ?>})"><span class="fas fa-check-circle mr-1"></span> Upgrade Status</button>
                            </div>
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
                                        <div class="float-right col-lg-12">
                                            <div class="card p-2 elevation-2 bg-success text-bold text-center text-md">Tanggal Diproses : <?php echo date('d M Y', strtotime($row['tgl_proses'])) ?></div>
                                        </div>
                                        <div class="float-right col-lg-12">
                                            <div class="card p-2 elevation-2 bg-success text-bold text-center text-md">
                                                <div class="align-self-center">
                                                    <table style="width: 100%;">
                                                        <tr>
                                                            <td>Paket</td>
                                                            <td>: </td>
                                                            <td>
                                                                <div id="dropdown_paket" class="col-12"></div>
                                                                <script>
                                                                    dropdownOnChange({
                                                                        name: 'dropdown_paket',
                                                                        table: 'paket',
                                                                        field: 'nama_paket',
                                                                        where: "WHERE tayang = 1",
                                                                        id_proses: <?php echo $row['id_p'] ?>
                                                                    })
                                                                </script>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Marketing</td>
                                                            <td>: </td>
                                                            <td>
                                                                <div id="dropdown_marketing" class="col-12"></div>
                                                                <script>
                                                                    dropdownOnChangeMarketing({
                                                                        name: 'dropdown_marketing',
                                                                        table: 'marketing',
                                                                        field: 'nama_marketing',
                                                                        where: "",
                                                                        id_proses: <?php echo $row['id_p'] ?>
                                                                    })
                                                                </script>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="float-right col-lg-12">
                                            <div class="card p-2 elevation-2 bg-success text-bold text-center text-md">
                                                <div class="align-self-center">
                                                    <table style="width: 100%;" class="">
                                                        <tr>
                                                            <td>Keberangkatan</td>
                                                            <td>: </td>
                                                            <td>
                                                                <?php if ($row['tgl_berangkat'] !== NULL) {
                                                                    echo date('d M Y', strtotime($row['tgl_berangkat']));
                                                                } else {
                                                                    echo ".......";
                                                                } ?>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card card-success card-tabs">
                                            <div class="card-header p-0 pt-1">
                                                <ul class="nav nav-tabs" id="" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link text-bold active" id="pil1" data-toggle="pill" href="#tab1" role="tab" aria-controls="custom-tabs-five-normal" aria-selected="false" onclick="fetchDataCustom('kas_pusat', {id_proses: <?php echo $row['id_p'] ?>, cabang_id: 1, tbody: 'tbody1'});">Kas Kantor Pusat</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link text-bold" id="pil2" data-toggle="pill" href="#tab2" role="tab" aria-controls="custom-tabs-five-overlay-dark" aria-selected="false" onclick="fetchDataCustom('kas_cabang', {id_proses: <?php echo $row['id_p']; ?>, tbody: 'tbody2' });">Kas Kantor Cabang</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link text-bold" id="pil3" data-toggle="pill" href="#tab3" role="tab" aria-controls="custom-tabs-five-normal" aria-selected="false" onclick="fetchDataCustom('dok_pendukung', {id_proses: <?php echo $row['id_p']; ?>, tbody: 'tbody3' });">Dok. Pendukung</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link text-bold" id="pil4" data-toggle="pill" href="#tab4" role="tab" aria-controls="custom-tabs-five-normal" aria-selected="false" onclick="fetchDataCustom('fasilitas', {id_proses: <?php echo $row['id_p']; ?>, tbody: 'tbody4' });">Fasilitas</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="card-body">
                                                <div class="tab-content" id="">
                                                    <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="">
                                                        <div class="overlay-wrapper">
                                                            <div class="row col-12">
                                                                <div class="mb-2">
                                                                    <div class="float-left">
                                                                        <button class="btn btn-sm btn-success" onclick="tambahInvoice('tambah_invoice_pusat', {title: 'Tambah Invoice (Pusat)', id_p : <?php echo $row['id_p'] ?>, cabang_id: 1, tbody: 'tbody1'})"><i class="fas fa-plus-square"></i> Tambah</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <section class="col-12">
                                                                    <div class="card">
                                                                        <div class="card-header center">
                                                                            <div class="card-title">
                                                                                <table style="scrollbar-color: blue;">
                                                                                    <tr>
                                                                                        <td>Show : &nbsp;</td>
                                                                                        <td>
                                                                                            <select class="form-control" id="show" onchange="show_dataCustom(this.value, 'kas_pusat', {id_proses: <?php echo $row['id_p'] ?>, cabang_id: 1, tbody:'tbody1'})">
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
                                                                                        <button type="button" class="btn btn-default" onclick="cari_dataCustom('kas_pusat', {id_proses: <?php echo $row['id_p'] ?>, cabang_id: 1, tbody:'tbody1'});">
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
                                                                                        <th>Konfirmasi</th>
                                                                                        <th>No. Invoice</th>
                                                                                        <th>Tanggal</th>
                                                                                        <th>Pembayaran</th>
                                                                                        <th>Nominal</th>
                                                                                        <th>Bank Penerima</th>
                                                                                        <th>Marketing</th>
                                                                                        <th>Keterangan</th>
                                                                                        <td align="center" style="position: sticky; right:0;" class="btn-default justify-content-center text-bold">Aksi</td>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody id="tbody1">
                                                                                    <?php include('loading/loading.php') ?>
                                                                                </tbody>
                                                                                <script>
                                                                                    $(document).ready(function() {
                                                                                        fetchDataCustom('kas_pusat', {
                                                                                            id_proses: <?php echo $row['id_p'] ?>,
                                                                                            cabang_id: 1,
                                                                                            tbody: 'tbody1'
                                                                                        })
                                                                                    });
                                                                                </script>
                                                                            </table>
                                                                        </div>
                                                                        <!-- /.card-body -->
                                                                        <div class="card-header">
                                                                            <div class="col-12 pt-2 pb-2">
                                                                                <table class="w-100">
                                                                                    <tr>
                                                                                        <td width="25%">
                                                                                            <button class="btn btn-sm btn-success" onclick="pagingCustom('prev', 'kas_pusat', {id_proses: <?php echo $row['id_p'] ?>, cabang_id: 1, tbody:'tbody1'})"><span class="fas fa-arrow-circle-left"></span> Prev</button>
                                                                                            <input type="hidden" value="1" id="paging">
                                                                                        </td>
                                                                                        <td align="center">
                                                                                            <div id="jumlah_data1" class="text-bold"></div>
                                                                                        </td>
                                                                                        <td width="25%">
                                                                                            <button class="btn btn-sm btn-success float-right" onclick="pagingCustom('next', 'kas_pusat', {id_proses: <?php echo $row['id_p'] ?>, cabang_id: 1, tbody:'tbody1'})">Next <span class="fas fa-arrow-circle-right"></span></button>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </section>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="">
                                                        <div class="overlay-wrapper">
                                                            <div class="row col-12">
                                                                <div class="mb-2">
                                                                    <div class="float-left">
                                                                        <button class="btn btn-sm btn-success" onclick="tambahInvoice('tambah_invoice_cabang', {title: 'Tambah Invoice (Cabang)', id_p : <?php echo $row['id_p'] ?>})"><i class="fas fa-plus-square"></i> Tambah</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <section class="col-12">
                                                                    <div class="card">
                                                                        <div class="card-header center">
                                                                            <div class="card-title">
                                                                                <table style="scrollbar-color: blue;">
                                                                                    <tr>
                                                                                        <td>Show : &nbsp;</td>
                                                                                        <td>
                                                                                            <select class="form-control" id="show" onchange="show_dataCustom(this.value, 'kas_cabang', {id_proses: <?php echo $row['id_p'] ?>, cabang_id: 2, tbody:'tbody2'})">
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
                                                                                        <button type="button" class="btn btn-default" onclick="cari_dataCustom('kas_cabang', {id_proses: <?php echo $row['id_p'] ?>, cabang_id: 2, tbody:'tbody2'});">
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
                                                                                        <!-- <th>Konfirmasi (Pusat)</th> -->
                                                                                        <th>Mutasi Ke</th>
                                                                                        <th>No. Invoice</th>
                                                                                        <th>Tanggal</th>
                                                                                        <th>Pembayaran</th>
                                                                                        <th>Nominal</th>
                                                                                        <th>Bank Penerima</th>
                                                                                        <th>Marketing</th>
                                                                                        <th>Keterangan</th>
                                                                                        <td align="center" style="position: sticky; right:0;" class="btn-default justify-content-center text-bold">Aksi</td>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody id="tbody2">
                                                                                    <?php include('loading/loading.php') ?>
                                                                                </tbody>
                                                                                <?php if ($_SESSION['role_id'] !== 1) { ?>
                                                                                    <script>
                                                                                        $(document).ready(function() {
                                                                                            fetchDataCustom('kas_cabang', {
                                                                                                id_proses: <?php echo $row['id_p'] ?>,
                                                                                                cabang_id: 1,
                                                                                                tbody: 'tbody2'
                                                                                            })
                                                                                        });
                                                                                    </script>
                                                                                <?php } ?>
                                                                            </table>
                                                                        </div>
                                                                        <!-- /.card-body -->
                                                                        <div class="card-header">
                                                                            <div class="col-12 pt-2 pb-2">
                                                                                <table class="w-100">
                                                                                    <tr>
                                                                                        <td width="25%">
                                                                                            <button class="btn btn-sm btn-success" onclick="pagingCustom('prev', 'kas_cabang', {id_proses: <?php echo $row['id_p'] ?>, cabang_id: 2, tbody:'tbody2'})"><span class="fas fa-arrow-circle-left"></span> Prev</button>
                                                                                            <input type="hidden" value="1" id="paging">
                                                                                        </td>
                                                                                        <td align="center">
                                                                                            <div id="jumlah_data2" class="text-bold"></div>
                                                                                        </td>
                                                                                        <td width="25%">
                                                                                            <button class="btn btn-sm btn-success float-right" onclick="pagingCustom('next', 'kas_cabang', {id_proses: <?php echo $row['id_p'] ?>, cabang_id: 2, tbody:'tbody2'})">Next <span class="fas fa-arrow-circle-right"></span></button>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </section>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="">
                                                        <div class="overlay-wrapper">
                                                            <div class="row col-12">
                                                                <div class="mb-2">
                                                                    <div class="float-left">
                                                                        <button class="btn btn-sm btn-success" onclick="tambahInvoice('tambah_dok_pendukung', {title: 'Tambah Dokumen Pendukung', id_p : <?php echo $row['id_p'] ?>})"><i class="fas fa-plus-square"></i> Tambah</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <section class="col-12">
                                                                    <div class="card">
                                                                        <div class="card-header center">
                                                                            <div class="card-title">
                                                                                <table style="scrollbar-color: blue;">
                                                                                    <tr>
                                                                                        <td>Show : &nbsp;</td>
                                                                                        <td>
                                                                                            <select class="form-control" id="show" onchange="show_dataCustom(this.value, 'dok_pendukung', {id_proses: <?php echo $row['id_p'] ?>, cabang_id: 2, tbody:'tbody3'})">
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
                                                                                        <button type="button" class="btn btn-default" onclick="cari_dataCustom('dok_pendukung', {id_proses: <?php echo $row['id_p'] ?>, cabang_id: 2, tbody:'tbody3'});">
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
                                                                                        <th>Nama Berkas</th>
                                                                                        <th>Status</th>
                                                                                        <td align="center" style="position: sticky; right:0;" class="btn-default justify-content-center text-bold">Aksi</td>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody id="tbody3">
                                                                                    <?php include('loading/loading.php') ?>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                        <!-- /.card-body -->
                                                                        <div class="card-header">
                                                                            <div class="col-12 pt-2 pb-2">
                                                                                <table class="w-100">
                                                                                    <tr>
                                                                                        <td width="25%">
                                                                                            <button class="btn btn-sm btn-success" onclick="pagingCustom('prev', 'dok_pendukung', {id_proses: <?php echo $row['id_p'] ?>, cabang_id: 2, tbody:'tbody3'})"><span class="fas fa-arrow-circle-left"></span> Prev</button>
                                                                                            <input type="hidden" value="1" id="paging">
                                                                                        </td>
                                                                                        <td align="center">
                                                                                            <div id="jumlah_data3" class="text-bold"></div>
                                                                                        </td>
                                                                                        <td width="25%">
                                                                                            <button class="btn btn-sm btn-success float-right" onclick="pagingCustom('next', 'dok_pendukung', {id_proses: <?php echo $row['id_p'] ?>, cabang_id: 2, tbody:'tbody3'})">Next <span class="fas fa-arrow-circle-right"></span></button>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </section>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="tab4" role="tabpanel" aria-labelledby="">
                                                        <div class="card-body table-responsive p-0">
                                                            <table class="table table-hover text-nowrap">
                                                                <thead>
                                                                    <tr>
                                                                        <th>No</th>
                                                                        <th>Nama Fasilitas</th>
                                                                        <td align="center" style="position: sticky; right:0;" class="btn-default justify-content-center text-bold">Aksi</td>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="tbody4">
                                                                    <?php include('loading/loading.php') ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.card -->
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
    <script>
        function batalkanMutasi(objek) {
            if (objek.status_konfirmasi === 0) {
                Swal.fire({
                    title: 'Batalkan Mutasi !',
                    text: "Kamu Yakin Akan Membatalkan Mutasi Invoice Ini ?",
                    icon: 'warning',
                    showCancelButton: true,
                    // confirmButtonColor: '#3085d6',
                    // cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Batalkan'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.post("manum/action/ubah/batalkan_mutasi.php", objek,
                            function(data, textStatus, jqXHR) {
                                if (data === '1') {
                                    Swal.fire(
                                        'Berhasil Tersimpan !',
                                        '',
                                        'success',
                                    )
                                    $('#modalInvoice').modal('hide')
                                    removeClassTab()
                                    $('#pil' + objek.go).addClass('active')
                                    $('#tab' + objek.go).addClass('show active')
                                    fetchDataCustom(objek.kas, {
                                        // id_proses: <?php echo $row['id_p'] ?>,
                                        id_proses: objek.id_proses,
                                        cabang_id: objek.cabang_id,
                                        tbody: 'tbody' + objek.go
                                    })
                                } else {
                                    Swal.fire(
                                        'Gagal Tersimpan !',
                                        '',
                                        'error',
                                    )
                                    $('#modalInvoice').modal('hide')
                                }
                            }
                        );
                    }
                })
            } else {
                Swal.fire(
                    'Tidak Dapat Dibatalkan !',
                    'Sudah Dikonfirmasi Oleh Kantor Pusat / Owner',
                    'error',
                )
            }
        }

        function mutasiData(objek) {
            $.post('manum/content/modal/mutasi_invoice.php', objek,
                function(data) {
                    $('#modal-content-invoice').html(data);
                    $('#modalInvoice').modal('show');
                }
            );
        }

        function updateStatus(id, objek) {
            $.post('manum/content/modal/update_status.php', objek,
                function(data) {
                    $('#modal-content-invoice').html(data);
                    $('#modalInvoice').modal('show');
                }
            );
        }

        // function ubahPaket(id, value) {
        //     Swal.fire({
        //         title: 'Ubah Paket ?',
        //         text: "Kamu Yakin Mengubah Paket Menjadi Yang Dipilih",
        //         icon: 'warning',
        //         showCancelButton: true,
        //         // confirmButtonColor: '#3085d6',
        //         // cancelButtonColor: '#d33',
        //         confirmButtonText: 'Ya',
        //         cancelButtonText: 'Batalkan'
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             loadingToSave(true)
        //             $.post("manum/action/ubah/ubah_paket.php", {
        //                     id: id,
        //                     value: value
        //                 },
        //                 function(data, textStatus, jqXHR) {
        //                     loadingToSave(false)
        //                     if (data == '1') {
        //                         Swal.fire(
        //                             'Berhasil Tersimpan !',
        //                             '',
        //                             'success',
        //                         )
        //                     } else {
        //                         Swal.fire(
        //                             'Gagal Tersimpan !',
        //                             '',
        //                             'error',
        //                         )
        //                     }
        //                     loadContent(url + '_detail', id)
        //                     dropdownOnChange({
        //                         name: 'dropdown_paket',
        //                         table: 'paket',
        //                         field: 'nama_paket',
        //                         where: "WHERE tayang = 1",
        //                         id_proses: id
        //                     })
        //                 }
        //             );
        //         } else {
        //             dropdownOnChange({
        //                 name: 'dropdown_paket',
        //                 table: 'paket',
        //                 field: 'nama_paket',
        //                 where: "WHERE tayang = 1",
        //                 id_proses: id
        //             })
        //         }
        //     })
        // }

        // function ubahMarketing(id, value) {
        //     Swal.fire({
        //         title: 'Ubah Marketing ?',
        //         text: "Kamu Yakin Akan Mengubah Marketing",
        //         icon: 'warning',
        //         showCancelButton: true,
        //         // confirmButtonColor: '#3085d6',
        //         // cancelButtonColor: '#d33',
        //         confirmButtonText: 'Ya',
        //         cancelButtonText: 'Batalkan'
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             loadingToSave(true)
        //             $.post("manum/action/ubah/ubah_marketing.php", {
        //                     id: id,
        //                     value: value
        //                 },
        //                 function(data, textStatus, jqXHR) {
        //                     loadingToSave(false)
        //                     if (data == '1') {
        //                         Swal.fire(
        //                             'Berhasil Tersimpan !',
        //                             '',
        //                             'success',
        //                         )
        //                     } else {
        //                         Swal.fire(
        //                             'Gagal Tersimpan !',
        //                             '',
        //                             'error',
        //                         )
        //                     }
        //                     loadContent(url + '_detail', id)
        //                     dropdownOnChange({
        //                         name: 'dropdown_marketing',
        //                         table: 'marketing',
        //                         field: 'nama_marketing',
        //                         where: "",
        //                         id_proses: id
        //                     })
        //                 }
        //             );
        //         } else {
        //             dropdownOnChange({
        //                 name: 'dropdown_marketing',
        //                 table: 'marketing',
        //                 field: 'nama_marketing',
        //                 where: "",
        //                 id_proses: id
        //             })
        //         }
        //     })
        // }

        // function tambahInvoice(action, objek) {
        //     $.post('manum/content/modal/' + action + '.php', objek,
        //         function(data) {
        //             $('#modal-content-invoice').html(data);
        //             $('#modalInvoice').modal('show');
        //         }
        //     );
        // }

        function removeClassTab() {
            $('#pil1').removeClass('active')
            $('#tab1').removeClass('show active')
            $('#pil2').removeClass('active')
            $('#tab2').removeClass('show active')
            $('#pil3').removeClass('active')
            $('#tab3').removeClass('show active')
            $('#pil4').removeClass('active')
            $('#tab4').removeClass('show active')
        }

        function simpan_data_invoice(page, objek) {
            loadingToSave(true)
            var dataform = $('#formData')[0];
            var data = new FormData(dataform);
            $.ajax({
                type: "POST",
                url: `manum/action/simpan/simpan_${page}.php`,
                data: data,
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                cache: false,
                success: function(data) {
                    loadingToSave(false)
                    if (data == '1') {
                        Swal.fire(
                            'Berhasil Tersimpan !',
                            '',
                            'success',
                        )
                        $('#modalInvoice').modal('hide')
                        removeClassTab()
                        $('#pil' + objek.go).addClass('active')
                        $('#tab' + objek.go).addClass('show active')
                        fetchDataCustom(objek.kas, {
                            // id_proses: <?php echo $row['id_p'] ?>,
                            id_proses: objek.id_proses,
                            cabang_id: objek.cabang_id,
                            tbody: 'tbody' + objek.go
                        })
                    } else if (data == '0') {
                        Swal.fire(
                            'Gagal Tersimpan !',
                            '',
                            'error',
                        )
                        $('#modalInvoice').modal('hide')
                    } else {
                        Swal.fire(
                            'Tidak Dapat Disimpan !',
                            data,
                            'warning'
                        )
                    }
                }
            });
        }

        function simpan_data_status(page, objek) {
            loadingToSave(true)
            var dataform = $('#formData')[0];
            var data = new FormData(dataform);
            $.ajax({
                type: "POST",
                url: `manum/action/ubah/${page}.php`,
                data: data,
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                cache: false,
                success: function(data) {
                    loadingToSave(false)
                    if (data == '1') {
                        Swal.fire(
                            'Berhasil Upgrade Status !',
                            '',
                            'success',
                        )
                        $('#modalInvoice').modal('hide')
                        loadContent(`${url}_detail`, objek.id_proses);
                    } else {
                        Swal.fire(
                            'Gagal Upgrade Status !',
                            '',
                            'error',
                        )
                        $('#modalInvoice').modal('hide')
                        loadContent(`${url}_detail`, objek.id_proses);
                    }
                }
            });
        }
    </script>
</body>

</html>
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
    $sql = "SELECT p.id AS id_p, p.*, j.*, j.id AS id_j, pro.nama_provinsi, k.nama_kabupaten, m.nama_marketing, c.cabang FROM pendaftaran p INNER JOIN jamaah j ON j.id = p.jamaah_id LEFT JOIN provinsi pro ON pro.id = j.provinsi_id LEFT JOIN kabupaten k ON k.id = j.kabupaten_id LEFT JOIN cabang c ON c.id = p.cabang_id LEFT JOIN marketing m ON m.id = p.marketing_id WHERE p.id = $_SESSION[id_ubah]";
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
                        <h1 class="m-0">Detail Data Jamaah</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <section class="col-lg-12">
                        <div class="card card-success">
                            <div class="card-header">
                                <h4>Data Umum</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="card elevation-2" style="height: 205px;">
                                            <div style="background-image: url('manum/file/data_jamaah/<?php echo $row['foto_ktp']; ?>'); background-position: top; height: 100%; background-size: cover; background-repeat: no-repeat">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="card col-lg-12 table-responsive p-0" style="height: 205px; font-size: 12px;">
                                            <table class="table text-bold">
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
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <button class="btn btn-sm btn-default mr-2" type="button" onclick="loadContent(url)"><span class="fas fa-reply"></span> Kembali</button>
                                <button onclick="cekProses({id_pendaftaran: <?php echo $row['id_p'] ?>, id_jamaah: <?php echo $row['id_j'] ?>}); //loadContent(`${url}_proses`, <?php //echo $row['id_p'] ?>);" class="btn btn-sm btn-success m-1"><span class="fas fa-check-circle"></span> Proses</button>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="row">
                    <section class="col-lg-12">
                        <div class="card card-success">
                            <div class="card-header">
                                <div class="card-title">
                                    <h4>Riwayat Jamaah</h4>
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
                                                        <select class="form-control" id="show" onchange="show_dataCustom(this.value, url + '_detail', {id : <?php echo $row['jamaah_id'] ?>})">
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
                                                    <button type="button" class="btn btn-default" onclick="cari_dataCustom(url + '_detail', {id : <?php echo $row['jamaah_id'] ?>});">
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
                                                    <th>Paket</th>
                                                    <th>Tanggal Berangkat</th>
                                                    <th>Kantor Cabang</th>
                                                    <th>Marketing</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody">
                                                <?php include('loading/loading.php') ?>
                                            </tbody>
                                            <script>
                                                $(document).ready(function() {
                                                    fetchDataCustom(url + '_detail', {
                                                        id: <?php echo $row['id_j']; ?>
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
                                                        <button class="btn btn-sm btn-success" onclick="pagingCustom('prev', url + '_detail', {id : <?php echo $row['jamaah_id'] ?>})"><span class="fas fa-arrow-circle-left"></span> Previous</button>
                                                        <input type="hidden" value="1" id="paging">
                                                    </td>
                                                    <td align="center">
                                                        <div id="jumlah_data" class="text-bold"></div>
                                                    </td>
                                                    <td width="25%">
                                                        <button class="btn btn-sm btn-success float-right" onclick="pagingCustom('next', url + '_detail', {id : <?php echo $row['jamaah_id'] ?>})">Next <span class="fas fa-arrow-circle-right"></span></button>
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
    <script>
        function cekProses(params) {
            $.post("manum/action/cekData/cekProses.php", params,
                function(data, textStatus, jqXHR) {
                    if (data >= 1) {
                        Swal.fire(
                            'Tidak Dapat Dilakukan !',
                            'Ada Proses Yang Belum Selesai',
                            'error'
                        )
                    } else {
                        loadContent(`${url}_proses`, params.id_pendaftaran)
                    }
                }
            );
        }
    </script>
</body>

</html>
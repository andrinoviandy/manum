<?php require('../config/koneksi.php'); ?>
<?php
$thnNow = date("Y");
$sql_bar = "SELECT 
(SELECT COUNT(*) FROM proses_jamaah pj INNER JOIN paket p ON p.id = pj.paket_id WHERE TO_CHAR(p.tgl_berangkat, 'YYYY-MM') = '$thnNow-01' AND pj.status_proses = 0) AS jan0, 
(SELECT COUNT(*) FROM proses_jamaah pj INNER JOIN paket p ON p.id = pj.paket_id WHERE TO_CHAR(p.tgl_berangkat, 'YYYY-MM') = '$thnNow-01' AND pj.status_proses = 1) AS jan1, 
(SELECT COUNT(*) FROM proses_jamaah pj INNER JOIN paket p ON p.id = pj.paket_id WHERE TO_CHAR(p.tgl_berangkat, 'YYYY-MM') = '$thnNow-02' AND pj.status_proses = 0) AS feb0, 
(SELECT COUNT(*) FROM proses_jamaah pj INNER JOIN paket p ON p.id = pj.paket_id WHERE TO_CHAR(p.tgl_berangkat, 'YYYY-MM') = '$thnNow-02' AND pj.status_proses = 1) AS feb1, 
(SELECT COUNT(*) FROM proses_jamaah pj INNER JOIN paket p ON p.id = pj.paket_id WHERE TO_CHAR(p.tgl_berangkat, 'YYYY-MM') = '$thnNow-03' AND pj.status_proses = 0) AS mar0, 
(SELECT COUNT(*) FROM proses_jamaah pj INNER JOIN paket p ON p.id = pj.paket_id WHERE TO_CHAR(p.tgl_berangkat, 'YYYY-MM') = '$thnNow-03' AND pj.status_proses = 1) AS mar1, 
(SELECT COUNT(*) FROM proses_jamaah pj INNER JOIN paket p ON p.id = pj.paket_id WHERE TO_CHAR(p.tgl_berangkat, 'YYYY-MM') = '$thnNow-04' AND pj.status_proses = 0) AS apr0, 
(SELECT COUNT(*) FROM proses_jamaah pj INNER JOIN paket p ON p.id = pj.paket_id WHERE TO_CHAR(p.tgl_berangkat, 'YYYY-MM') = '$thnNow-04' AND pj.status_proses = 1) AS apr1, 
(SELECT COUNT(*) FROM proses_jamaah pj INNER JOIN paket p ON p.id = pj.paket_id WHERE TO_CHAR(p.tgl_berangkat, 'YYYY-MM') = '$thnNow-05' AND pj.status_proses = 0) AS mei0, 
(SELECT COUNT(*) FROM proses_jamaah pj INNER JOIN paket p ON p.id = pj.paket_id WHERE TO_CHAR(p.tgl_berangkat, 'YYYY-MM') = '$thnNow-05' AND pj.status_proses = 1) AS mei1, 
(SELECT COUNT(*) FROM proses_jamaah pj INNER JOIN paket p ON p.id = pj.paket_id WHERE TO_CHAR(p.tgl_berangkat, 'YYYY-MM') = '$thnNow-06' AND pj.status_proses = 0) AS jun0, 
(SELECT COUNT(*) FROM proses_jamaah pj INNER JOIN paket p ON p.id = pj.paket_id WHERE TO_CHAR(p.tgl_berangkat, 'YYYY-MM') = '$thnNow-06' AND pj.status_proses = 1) AS jun1,
(SELECT COUNT(*) FROM proses_jamaah pj INNER JOIN paket p ON p.id = pj.paket_id WHERE TO_CHAR(p.tgl_berangkat, 'YYYY-MM') = '$thnNow-07' AND pj.status_proses = 0) AS jul0, 
(SELECT COUNT(*) FROM proses_jamaah pj INNER JOIN paket p ON p.id = pj.paket_id WHERE TO_CHAR(p.tgl_berangkat, 'YYYY-MM') = '$thnNow-07' AND pj.status_proses = 1) AS jul1, 
(SELECT COUNT(*) FROM proses_jamaah pj INNER JOIN paket p ON p.id = pj.paket_id WHERE TO_CHAR(p.tgl_berangkat, 'YYYY-MM') = '$thnNow-08' AND pj.status_proses = 0) AS agu0, 
(SELECT COUNT(*) FROM proses_jamaah pj INNER JOIN paket p ON p.id = pj.paket_id WHERE TO_CHAR(p.tgl_berangkat, 'YYYY-MM') = '$thnNow-08' AND pj.status_proses = 1) AS agu1, 
(SELECT COUNT(*) FROM proses_jamaah pj INNER JOIN paket p ON p.id = pj.paket_id WHERE TO_CHAR(p.tgl_berangkat, 'YYYY-MM') = '$thnNow-09' AND pj.status_proses = 0) AS sep0, 
(SELECT COUNT(*) FROM proses_jamaah pj INNER JOIN paket p ON p.id = pj.paket_id WHERE TO_CHAR(p.tgl_berangkat, 'YYYY-MM') = '$thnNow-09' AND pj.status_proses = 1) AS sep1, 
(SELECT COUNT(*) FROM proses_jamaah pj INNER JOIN paket p ON p.id = pj.paket_id WHERE TO_CHAR(p.tgl_berangkat, 'YYYY-MM') = '$thnNow-10' AND pj.status_proses = 0) AS okt0, 
(SELECT COUNT(*) FROM proses_jamaah pj INNER JOIN paket p ON p.id = pj.paket_id WHERE TO_CHAR(p.tgl_berangkat, 'YYYY-MM') = '$thnNow-10' AND pj.status_proses = 1) AS okt1, 
(SELECT COUNT(*) FROM proses_jamaah pj INNER JOIN paket p ON p.id = pj.paket_id WHERE TO_CHAR(p.tgl_berangkat, 'YYYY-MM') = '$thnNow-11' AND pj.status_proses = 0) AS nov0, 
(SELECT COUNT(*) FROM proses_jamaah pj INNER JOIN paket p ON p.id = pj.paket_id WHERE TO_CHAR(p.tgl_berangkat, 'YYYY-MM') = '$thnNow-11' AND pj.status_proses = 1) AS nov1, 
(SELECT COUNT(*) FROM proses_jamaah pj INNER JOIN paket p ON p.id = pj.paket_id WHERE TO_CHAR(p.tgl_berangkat, 'YYYY-MM') = '$thnNow-12' AND pj.status_proses = 0) AS des0, 
(SELECT COUNT(*) FROM proses_jamaah pj INNER JOIN paket p ON p.id = pj.paket_id WHERE TO_CHAR(p.tgl_berangkat, 'YYYY-MM') = '$thnNow-12' AND pj.status_proses = 1) AS des1 
FROM proses_jamaah ORDER BY id DESC";
$data_bar = $koneksi->prepare($sql_bar);
$data_bar->execute();
$row_bar = $data_bar->fetch();
// $count = $data->rowCount();
// $no = 0;

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Beranda</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <?php
                            $data_paket = $koneksi->prepare("SELECT COUNT(*) AS jumlah_paket FROM paket");
                            $data_paket->execute();
                            $row_paket = $data_paket->fetch();
                            ?>
                            <h3>Paket</h3>
                            <p class="text-bold"><?php echo $row_paket['jumlah_paket'] . " Paket" ?></p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-th"></i>
                        </div>
                        <?php if ($_SESSION['role_id'] == 1) { ?>
                            <a href="javascript:void()" onclick="loadContent('paket_umrah')" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                        <?php } ?>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <?php
                            if ($_SESSION['role_id'] == 1) {
                                $data_jamaah = $koneksi->prepare("SELECT COUNT(*) AS jumlah_jamaah FROM jamaah");
                                $data_jamaah->execute();
                                $row_jamaah = $data_jamaah->fetch();
                            } else {
                                $data_jamaah = $koneksi->prepare("SELECT COUNT(*) AS jumlah_jamaah FROM jamaah j INNER JOIN pendaftaran p ON j.id = p.jamaah_id WHERE p.cabang_id = $_SESSION[cabang_id]");
                                $data_jamaah->execute();
                                $row_jamaah = $data_jamaah->fetch();
                            }
                            ?>
                            <h3>Jamaah</h3>
                            <p class="text-bold"><?php echo $row_jamaah['jumlah_jamaah'] . " Jamaah" ?></p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <?php if ($_SESSION['role_id'] == 1) { ?>
                        <a href="javascript:void()" onclick="loadContent('data_jamaah')" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                        <?php } ?>
                    </div>
                </div>
                <!-- ./col -->
                <?php if ($_SESSION['role_id'] == 1) { ?>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <?php
                                $data_users = $koneksi->prepare("SELECT COUNT(*) AS jumlah_users FROM proses_jamaah pj LEFT JOIN jamaah j ON j.id = pj.jamaah_id LEFT JOIN pendaftaran p ON j.id = p.jamaah_id LEFT JOIN provinsi pro ON pro.id = j.provinsi_id LEFT JOIN kabupaten k ON k.id = j.kabupaten_id LEFT JOIN cabang c ON c.id = p.cabang_id LEFT JOIN marketing m ON m.id = pj.marketing_id LEFT JOIN paket pak ON pak.id = pj.paket_id WHERE TO_CHAR(pak.tgl_berangkat, 'MM-YYYY') = TO_CHAR(CURRENT_DATE, 'MM-YYYY')");
                                $data_users->execute();
                                $row_users = $data_users->fetch();
                                ?>
                                <h3>Berangkat Bulan Ini</h3>
                                <p class="text-bold"><?php echo $row_users['jumlah_users'] . " Jamaah" ?></p>
                            </div>
                            <div class="icon">
                                <i class="fas calendar"></i>
                            </div>
                            <?php if ($_SESSION['role_id'] == 1) { ?>
                                <a href="javascript:void()" onclick="loadContent('on_progress')" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                            <?php } ?>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <?php
                                $data_cabang = $koneksi->prepare("SELECT COUNT(*) AS jumlah_cabang FROM cabang");
                                $data_cabang->execute();
                                $row_cabang = $data_cabang->fetch();
                                ?>
                                <h3>Cabang</h3>
                                <p class="text-bold"><?php echo $row_cabang['jumlah_cabang'] . " Cabang" ?></p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-database"></i>
                            </div>
                            <?php if ($_SESSION['role_id'] == 1) { ?>
                                <a href="javascript:void()" onclick="loadContent('master_cabang')" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                            <?php } ?>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <?php
                                $data_pj = $koneksi->prepare("SELECT (SELECT COUNT(*) FROM proses_jamaah pj LEFT JOIN jamaah j ON j.id = pj.jamaah_id LEFT JOIN pendaftaran p ON j.id = p.jamaah_id WHERE pj.status_proses = 0 AND p.cabang_id = '$_SESSION[cabang_id]') AS masih_proses, (SELECT COUNT(*) FROM proses_jamaah pj LEFT JOIN jamaah j ON j.id = pj.jamaah_id LEFT JOIN pendaftaran p ON j.id = p.jamaah_id WHERE pj.status_proses = 1 AND p.cabang_id = '$_SESSION[cabang_id]') AS selesai_proses FROM proses_jamaah");
                                $data_pj->execute();
                                $row_pj = $data_pj->fetch();
                                ?>
                                <h3>Masih Proses</h3>
                                <p class="text-bold"><?php echo $row_pj['masih_proses'] ?></p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-calendar-times"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>Selesai Proses</h3>
                                <p class="text-bold"><?php echo $row_pj['selesai_proses'] ?></p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <!-- ./col -->
            </div>
            <div id="beranda_paket">
                <?php include('loading/loading.php') ?>
            </div>
            <script>
                $(document).ready(function() {
                    $.get("manum/content/list/beranda_paket.php", {},
                        function(data, textStatus, jqXHR) {
                            $('#beranda_paket').html(data);
                        }
                    );
                });
            </script>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-12 connectedSortable">
                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="d-flex justify-content-center">
                                <h3 class="card-title text-bold">Berangkat Tahun Ini</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="position-relative mb-4">
                                <canvas id="sales-chart" height="200">
                                    <?php include('loading/loading.php') ?>
                                </canvas>
                            </div>
                            <script>
                                $(document).ready(function() {
                                    function barChart() {
                                        var areaChartData = {
                                            labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                                            datasets: [{
                                                    label: 'Selesai',
                                                    backgroundColor: 'RGBA( 0, 128, 0, 1 )',
                                                    borderColor: 'RGBA( 0, 128, 0, 1 )',
                                                    pointRadius: false,
                                                    pointColor: 'RGBA( 0, 128, 0, 1 )',
                                                    pointStrokeColor: 'rgba(60,141,188,1)',
                                                    pointHighlightFill: '#fff',
                                                    pointHighlightStroke: 'rgba(60,141,188,1)',
                                                    data: [
                                                        <?php echo $row_bar['jan1'] ?>,
                                                        <?php echo $row_bar['feb1'] ?>,
                                                        <?php echo $row_bar['mar1'] ?>,
                                                        <?php echo $row_bar['apr1'] ?>,
                                                        <?php echo $row_bar['mei1'] ?>,
                                                        <?php echo $row_bar['jun1'] ?>,
                                                        <?php echo $row_bar['jul1'] ?>,
                                                        <?php echo $row_bar['agu1'] ?>,
                                                        <?php echo $row_bar['sep1'] ?>,
                                                        <?php echo $row_bar['okt1'] ?>,
                                                        <?php echo $row_bar['nov1'] ?>,
                                                        <?php echo $row_bar['des1'] ?>
                                                    ]
                                                },
                                                {
                                                    label: 'Masih Proses',
                                                    backgroundColor: 'RGBA( 255, 215, 0, 1 )',
                                                    borderColor: 'RGBA( 255, 215, 0, 1 )',
                                                    pointRadius: false,
                                                    pointColor: 'RGBA( 255, 215, 0, 1 )',
                                                    pointStrokeColor: '#c1c7d1',
                                                    pointHighlightFill: '#fff',
                                                    pointHighlightStroke: 'rgba(220,220,220,1)',
                                                    data: [
                                                        <?php echo $row_bar['jan0'] ?>,
                                                        <?php echo $row_bar['feb0'] ?>,
                                                        <?php echo $row_bar['mar0'] ?>,
                                                        <?php echo $row_bar['apr0'] ?>,
                                                        <?php echo $row_bar['mei0'] ?>,
                                                        <?php echo $row_bar['jun0'] ?>,
                                                        <?php echo $row_bar['jul0'] ?>,
                                                        <?php echo $row_bar['agu0'] ?>,
                                                        <?php echo $row_bar['sep0'] ?>,
                                                        <?php echo $row_bar['okt0'] ?>,
                                                        <?php echo $row_bar['nov0'] ?>,
                                                        <?php echo $row_bar['des0'] ?>
                                                    ]
                                                },
                                            ]
                                        }
                                        var barChartCanvas = $('#sales-chart').get(0).getContext('2d')
                                        var barChartData = $.extend(true, {}, areaChartData)
                                        var temp0 = areaChartData.datasets[0]
                                        var temp1 = areaChartData.datasets[1]
                                        barChartData.datasets[0] = temp1
                                        barChartData.datasets[1] = temp0

                                        var barChartOptions = {
                                            responsive: true,
                                            maintainAspectRatio: false,
                                            datasetFill: false
                                        }

                                        new Chart(barChartCanvas, {
                                            type: 'bar',
                                            data: barChartData,
                                            options: barChartOptions
                                        })
                                    }
                                    barChart()
                                });
                            </script>
                        </div>
                    </div>
                    <!-- /.card -->
                </section>
                <!-- /.Left col -->
                <!-- right col (We are only adding the ID to make the widgets sortable)-->
                <!-- right col -->
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
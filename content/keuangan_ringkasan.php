<?php require('../config/koneksi.php'); ?>
<?php
$thnNow = date('Y');
$status = '';
if ($_SESSION['role_id'] == 1) {
    $status = 'AND ke.status_konfirmasi = 1';
} else {
    $status = '';
}
$sql_pene = "SELECT kk.*, (SELECT SUM(nominal) FROM keuangan ke INNER JOIN kas k ON k.id = ke.kas_id WHERE ke.kategori_keuangan_id = kk.id AND TO_CHAR(ke.tanggal, 'YYYY') = '$thnNow' AND k.cabang_id = $_SESSION[cabang_id] $status) AS total FROM kategori_keuangan kk WHERE jenis_kategori = 'd' ORDER BY kk.id ASC";
$data_pene = $koneksi->prepare($sql_pene);
$data_pene->execute();
$row_pene = $data_pene->fetchAll();

$sql_peng = "SELECT kk.*, (SELECT SUM(nominal) FROM keuangan ke INNER JOIN kas k ON k.id = ke.kas_id WHERE ke.kategori_keuangan_id = kk.id $status AND TO_CHAR(ke.tanggal, 'YYYY') = '$thnNow' AND k.cabang_id = $_SESSION[cabang_id]) AS total FROM kategori_keuangan kk WHERE jenis_kategori = 'k' ORDER BY kk.id ASC";
$data_peng = $koneksi->prepare($sql_peng);
$data_peng->execute();
$row_peng = $data_peng->fetchAll();

$sql_laba = "SELECT SUM(nominal) AS laba FROM keuangan ke INNER JOIN kas ks ON ks.id = ke.kas_id INNER JOIN kategori_keuangan k2 ON k2.id = ke.kategori_keuangan_id WHERE k2.jenis_kategori = 'd' $status AND TO_CHAR(ke.tanggal, 'YYYY') = '$thnNow' AND ks.cabang_id = $_SESSION[cabang_id]";
$data_laba = $koneksi->prepare($sql_laba);
$data_laba->execute();
$row_laba = $data_laba->fetch();
$sql_rugi = "SELECT SUM(nominal) AS rugi FROM keuangan ke INNER JOIN kas ks ON ks.id = ke.kas_id INNER JOIN kategori_keuangan k2 ON k2.id = ke.kategori_keuangan_id WHERE k2.jenis_kategori = 'k' $status AND TO_CHAR(ke.tanggal, 'YYYY') = '$thnNow' AND ks.cabang_id = $_SESSION[cabang_id]";
$data_rugi = $koneksi->prepare($sql_rugi);
$data_rugi->execute();
$row_rugi = $data_rugi->fetch();
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-12">
                    <h1>Ringkasan Laba Rugi Tahun <?php echo $thnNow ?></h1>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="card">
                        <div class="card-header bg-success text-bold">Penerimaan</div>
                        <div class="card-body">
                            <table class="table border-top-0">
                                <?php
                                foreach ($row_pene as $dt) {
                                ?>
                                    <tr>
                                        <td>
                                            <div class="float-left"><?php echo $dt['nama_kategori']; ?></div>
                                            <div class="float-right"><?php echo number_format($dt['total'],0,',','.'); ?></div>
                                        </td>
                                    </tr>
                                    </tr>
                                <?php } ?>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="card">
                        <div class="card-header bg-warning text-bold">Pengeluaran</div>
                        <div class="card-body">
                            <table class="table border-top-0">
                                <?php
                                foreach ($row_peng as $dt) {
                                ?>
                                    <tr>
                                        <td>
                                            <div class="float-left"><?php echo $dt['nama_kategori']; ?></div>
                                            <div class="float-right"><?php echo number_format($dt['total'],0,',','.'); ?></div>
                                        </td>
                                    </tr>
                                    </tr>
                                <?php } ?>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card bg-info">
                        <div class="card-header text-center">
                            <h4 class="text-bold">
                                Laba : <?php echo number_format($row_laba['laba']-$row_rugi['rugi'],0,',','.') ?></div>
                            </h3>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

</div>
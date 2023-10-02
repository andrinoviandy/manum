<?php
require('../../config/koneksi.php');
// $limit = 10;
// $paging = 0;
// if (isset($_POST['show'])) {
//     $limit = $_POST['show'];
// }
// if (isset($_POST['paging'])) {
//     $paging = ($_POST['paging'] - 1) * $limit;
// }
// $where = '';
// if (isset($_POST['search'])) {
//     $where = $where . "WHERE (LOWER(nama_paket) LIKE LOWER('%" . $_POST['search'] . "%') OR LOWER(harga::VARCHAR) LIKE LOWER('%" . $_POST['search'] . "%') OR LOWER(bulan_berangkat) LIKE LOWER('%" . $_POST['search'] . "%') OR LOWER(asal_keberangkatan) LIKE LOWER('%" . $_POST['search'] . "%') OR LOWER(pesawat) LIKE LOWER('%" . $_POST['search'] . "%') OR LOWER(hotel) LIKE LOWER('%" . $_POST['search'] . "%') OR LOWER(bis) LIKE LOWER('%" . $_POST['search'] . "%'))";
// }
$cab = "";
if ($_SESSION['role_id'] == 1) {
    $cab = "";
} else {
    $cab = "WHERE tayang = 1";
}
$sql = "SELECT COUNT(*) OVER () AS total, row_number() OVER (ORDER BY p.id DESC) AS no, p.*, (SELECT COUNT(*) FROM proses_jamaah WHERE paket_id = p.id) AS jumlah_jamaah FROM paket p $cab ORDER BY p.id DESC LIMIT 20";
// -- $limit OFFSET $paging;

// echo "<script>alert($_POST[show])</script>";

$data = $koneksi->prepare($sql);
$data->execute();
$row = $data->fetchAll();
$count = $data->rowCount();
$no = 0;
if ($count !== 0) { ?>
    <div class="row">
        <div class="col-12 p-0">
            <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-center">
                        <h3 class="card-title text-bold">20 Paket Terbaru</h3>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="table-responsive">
                    <div class="d-flex">
                        <?php
                        foreach ($row as $dt) {
                            $no++;
                        ?>

                            <div class="col-6 col-lg-3 col-md-3 col-sm-4">
                                <div class="card elevation-2" style="border-color: red; background-image: url('manum/file/paket_umrah/<?php echo $dt['flyer'] ?>'); background-repeat: no-repeat; background-position: center; background-size: cover">
                                    <div class="card-body" style="height: 200px;">
                                        <?php if ($_SESSION['role_id'] == 1) { ?>
                                            <div class="ribbon-wrapper ribbon-xl">
                                                <div class="ribbon <?php if ($dt['tayang'] == 0) {
                                                                        echo "bg-warning";
                                                                    } else {
                                                                        echo "bg-success";
                                                                    } ?> text-bold">
                                                    <?php if ($dt['tayang'] == 0) {
                                                        echo "Belum Tayang";
                                                    } else {
                                                        echo "Sudah Tayang";
                                                    } ?>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="card-footer bg-info text-bold text-center p-0" style="height: 50px;">
                                        <?php echo $dt['nama_paket'] . " " . $dt['bulan_berangkat'] ?>
                                        <br>
                                        <?php echo number_format($dt['harga'], 0, ',', '.') ?>
                                    </div>
                                    <div class="card-footer bg-white text-center text-bold" style="height: 50px;">
                                        <i class="fas fa-users"></i> <?php echo $dt['jumlah_jamaah'] ?>
                                    </div>
                                </div>
                            </div>
                        <?php
                        } ?>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
<?php
} ?>
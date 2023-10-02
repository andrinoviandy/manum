<?php
require('../../config/koneksi.php');
$limit = 10;
$paging = 0;
if (isset($_POST['show'])) {
    $limit = $_POST['show'];
}
if (isset($_POST['paging'])) {
    $paging = ($_POST['paging'] - 1) * $limit;
}
$id = $_POST['id'];

$where = '';
if (isset($_POST['search'])) {
    $where = $where . " AND (LOWER(j.nik) LIKE LOWER('%" . $_POST['search'] . "%') OR LOWER(j.nama) LIKE LOWER('%" . $_POST['search'] . "%') OR LOWER(j.tempat_lahir) LIKE LOWER('%" . $_POST['search'] . "%') OR LOWER(j.no_hp) LIKE LOWER('%" . $_POST['search'] . "%') OR LOWER(c.cabang) LIKE LOWER('%" . $_POST['search'] . "%') OR LOWER(m.nama_marketing) LIKE LOWER('%" . $_POST['search'] . "%') OR LOWER(pk.nama_paket) LIKE LOWER('%" . $_POST['search'] . "%'))";
}
$sql = "SELECT COUNT(*) OVER () AS total, row_number() OVER (ORDER BY pj.id DESC) AS no, pk.tgl_berangkat, pk.nama_paket, c.cabang, m.nama_marketing FROM proses_jamaah pj LEFT JOIN paket pk ON pk.id = pj.paket_id LEFT JOIN jamaah j ON j.id = pj.jamaah_id LEFT JOIN pendaftaran pd ON j.id = pd.jamaah_id LEFT JOIN cabang c ON c.id = pd.cabang_id LEFT JOIN marketing m ON m.id = pj.marketing_id WHERE pj.jamaah_id = $id $where ORDER BY pj.tgl_proses DESC LIMIT $limit OFFSET $paging";

// echo "<script>alert($_POST[show])</script>";

$data = $koneksi->prepare($sql);
$data->execute();
$row = $data->fetchAll();
$count = $data->rowCount();
$no = 0;
if ($count !== 0) {
    foreach ($row as $dt) {
        $no++;
?>
        <tr>
            <td><?php echo $dt['no'];
                echo "<script>countData(Math.ceil($dt[total] / $limit), $dt[total])</script>"; ?>
                <!-- <input type="text" id="ceil_data" value="<?php echo ceil($dt['total'] / $limit); ?>"> -->
            </td>
            <td><?php echo $dt['nama_paket']; ?></td>
            <td><?php echo date('d/m/Y', strtotime($dt['tgl_berangkat'])); ?></td>
            <td><?php echo $dt['cabang']; ?></td>
            <td><?php echo $dt['nama_marketing']; ?></td>
        </tr>
    <?php
    }
} else {
    ?>
    <tr>
        <td colspan="10" class="text-center">
            <?php
            if (isset($_POST['search'])) {
                echo "Data Tidak Ditemukan";
            } else {
                echo "Data Kosong";
            }
            ?>
            <?php echo "<script>countData(0, 0)</script>"; ?>
        </td>
    </tr>
<?php } ?>
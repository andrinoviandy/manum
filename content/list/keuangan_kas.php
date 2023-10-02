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
$where = '';
if (isset($_POST['search'])) {
    $where = $where . "AND (LOWER(pemilik_kas) LIKE LOWER('%" . $_POST['search'] . "%') OR LOWER(nama_kas) LIKE LOWER('%" . $_POST['search'] . "%') OR LOWER(cabang) LIKE LOWER('%" . $_POST['search'] . "%') OR LOWER(no_rekening) LIKE LOWER('%" . $_POST['search'] . "%'))";
}

$sql = "SELECT COUNT(*) OVER () AS total, row_number() OVER (ORDER BY k.id DESC) AS no, k.*, c.cabang, (SELECT SUM(nominal) FROM keuangan WHERE kas_id = k.id AND status_konfirmasi = 1) AS saldo FROM kas k LEFT JOIN cabang c ON c.id = k.cabang_id WHERE k.id IS NOT NULL AND k.cabang_id = $_SESSION[cabang_id] $where ORDER BY k.id DESC LIMIT $limit OFFSET $paging";

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
            </td>
            <td><?php echo $dt['nama_kas']; ?></td>
            <td><?php echo $dt['pemilik_kas']; ?></td>
            <td><?php echo $dt['cabang']; ?></td>
            <td><?php echo $dt['no_rekening']; ?></td>
            <!-- <td><?php echo number_format($dt['saldo'], 0, ',', '.'); ?></td> -->
            <td align="center" style="position: sticky; right:0;" class="btn-default justify-content-center">
                <button onclick="loadContent(`${url}_edit`, <?php echo $dt['id'] ?>);" class="btn btn-xs btn-info"><span class="fas fa-edit"></span> Ubah</button>
                <button onclick="alertBeforeDelete(<?php echo $dt['id'] ?>, url, 'kas');" class="btn btn-xs btn-danger"><span class="fas fa-trash"></span> Hapus</button>
            </td>
        </tr>
    <?php
    }
} else {
    ?>
    <tr>
        <td colspan="9" class="text-center">
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
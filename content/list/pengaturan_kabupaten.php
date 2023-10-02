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
    $where = $where . "WHERE LOWER(p.nama_provinsi) LIKE LOWER('%" . $_POST['search'] . "%') OR LOWER(k.nama_kabupaten) LIKE LOWER('%" . $_POST['search'] . "%')";
}
$sql = "SELECT COUNT(*) OVER () AS total, row_number() OVER (ORDER BY k.nama_kabupaten ASC) AS no, p.nama_provinsi, k.* FROM kabupaten k INNER JOIN provinsi p ON p.id = k.provinsi_id $where ORDER BY k.nama_kabupaten ASC LIMIT $limit OFFSET $paging";

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
            <td><?php echo $dt['nama_provinsi']; ?></td>
            <td><?php echo $dt['nama_kabupaten']; ?></td>
            <td align="center" style="position: sticky; right:0;" class="btn-default justify-content-center">
                <button onclick="loadContent(`${url}_edit`, <?php echo $dt['id'] ?>);" class="btn btn-xs btn-info"><span class="fas fa-edit"></span> Ubah</button>
                <button onclick="alertBeforeDelete(<?php echo $dt['id'] ?>, url, 'kabupaten');" class="btn btn-xs btn-danger"><span class="fas fa-trash"></span> Hapus</button>
            </td>
        </tr>
    <?php
    }
} else {
    ?>
    <tr>
        <td colspan="4" class="text-center">
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
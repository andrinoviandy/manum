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
    $where = $where . "WHERE (LOWER(nama_kategori) LIKE LOWER('%" . $_POST['search'] . "%'))";
}
$sql = "SELECT COUNT(*) OVER () AS total, row_number() OVER (ORDER BY k.id ASC) AS no, k.* FROM kategori_keuangan k $where ORDER BY k.id ASC LIMIT $limit OFFSET $paging";

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
            <td><?php echo $dt['nama_kategori']; ?></td>
            <td><?php if ($dt['jenis_kategori'] == 'd') {echo "Penerimaan";} else {echo "Pengeluaran";} ?></td>
            <td align="center" style="position: sticky; right:0;" class="btn-default justify-content-center">
                <button onclick="loadContent(`${url}_edit`, <?php echo $dt['id'] ?>);" class="btn btn-xs btn-info"><span class="fas fa-edit"></span> Ubah</button>
                <!-- <button onclick="alertBeforeDelete(<?php echo $dt['id'] ?>, url, 'kategori_keuangan');" class="btn btn-xs btn-danger"><span class="fas fa-trash"></span> Hapus</button> -->
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
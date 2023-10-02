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
    $where = $where . "WHERE (LOWER(pemilik) LIKE LOWER('%" . $_POST['search'] . "%') OR LOWER(kode) LIKE LOWER('%" . $_POST['search'] . "%') OR LOWER(no_hp) LIKE LOWER('%" . $_POST['search'] . "%') OR LOWER(email) LIKE LOWER('%" . $_POST['search'] . "%') OR LOWER(cabang) LIKE LOWER('%" . $_POST['search'] . "%'))";
}
$sql = "SELECT COUNT(*) OVER () AS total, row_number() OVER (ORDER BY id DESC) AS no, * FROM cabang $where ORDER BY id DESC LIMIT $limit OFFSET $paging";

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
            <td><?php echo $dt['kode']; ?></td>
            <td><?php echo $dt['tgl_daftar']; ?></td>
            <td><?php echo $dt['pemilik']; ?></td>
            <td><?php echo $dt['no_hp']; ?></td>
            <td><?php echo $dt['email']; ?></td>
            <td><?php echo $dt['cabang']; ?></td>
            <td><?php if ($dt['status'] == 1) { ?><span class="badge badge-success">Aktif</span><?php } else { ?><span class="badge badge-danger">Non Aktif</span><?php } ?></td>
            <td align="center" style="position: sticky; right:0;" class="btn-default justify-content-center">
                <?php if ($dt['id'] !== 1) { ?>
                    <button onclick="loadContent(`${url}_edit`, <?php echo $dt['id'] ?>);" class="btn btn-xs btn-info"><span class="fas fa-edit"></span> Ubah</button>
                    <button onclick="alertBeforeDelete(<?php echo $dt['id'] ?>, url, 'cabang');" class="btn btn-xs btn-danger"><span class="fas fa-trash"></span> Hapus</button>
                <?php } else { ?>
                    <button class="btn btn-default btn-sm"><i class="fas fa-ban text-red"></i> NO ACTION</button>
                <?php } ?>
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
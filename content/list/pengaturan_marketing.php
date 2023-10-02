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
    $where = $where . "WHERE LOWER(u.nama_marketing) LIKE LOWER('%" . $_POST['search'] . "%') OR LOWER(u.no_hp) LIKE LOWER('%" . $_POST['search'] . "%') OR LOWER(u.email) LIKE LOWER('%" . $_POST['search'] . "%')";
}
$sql = "SELECT COUNT(*) OVER () AS total, row_number() OVER (ORDER BY u.id DESC) AS no, u.* FROM marketing u $where ORDER BY u.id DESC LIMIT $limit OFFSET $paging";

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
            <td><?php echo $dt['nik']; ?></td>
            <td><?php echo $dt['nama_marketing']; ?></td>
            <td><?php echo $dt['no_hp']; ?></td>
            <td><?php echo $dt['email']; ?></td>
            <td>
                <a href="javascript:void()" onclick="lihatGambar('Preview Photo', 'manum/file/marketing/<?php echo $dt['photo']; ?>');">
                    <img class="img-rounded elevation-2" width="80px" src="manum/file/marketing/<?php echo $dt['photo']; ?>">
                </a>
            </td>
            <td align="center" style="position: sticky; right:0;" class="btn-default justify-content-center">
                <button onclick="loadContent(`${url}_edit`, <?php echo $dt['id'] ?>);" class="btn btn-xs btn-info"><span class="fas fa-edit"></span> Ubah</button>
                <button onclick="alertBeforeDelete(<?php echo $dt['id'] ?>, url, 'marketing');" class="btn btn-xs btn-danger"><span class="fas fa-trash"></span> Hapus</button>
            </td>
        </tr>
    <?php
    }
} else {
    ?>
    <tr>
        <td colspan="7" class="text-center">
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
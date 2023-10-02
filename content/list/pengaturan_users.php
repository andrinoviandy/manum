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
    $where = $where . "AND LOWER(u.nama) LIKE LOWER('%" . $_POST['search'] . "%') OR LOWER(u.username) LIKE LOWER('%" . $_POST['search'] . "%') OR LOWER(c.cabang) LIKE LOWER('%" . $_POST['search'] . "%')";
}
$cabang = '';
if ($_SESSION['role_id'] == 1) {
    $cabang = 'WHERE u.id IS NOT NULL';
} else {
    $cabang = "WHERE u.cabang_id = '$_SESSION[cabang_id]'";
}
$sql = "SELECT COUNT(*) OVER () AS total, row_number() OVER (ORDER BY u.id DESC) AS no, u.*, r.nama_role, c.cabang FROM users u INNER JOIN cabang c ON c.id = u.cabang_id LEFT JOIN role r ON r.id = u.role_id $cabang $where ORDER BY u.id DESC LIMIT $limit OFFSET $paging";

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
            <td><?php echo $dt['nama']; ?></td>
            <td><?php echo $dt['nama_role']; ?></td>
            <td><?php echo $dt['cabang']; ?></td>
            <td><?php echo $dt['username']; ?></td>
            <td><?php if ($dt['enable'] == 1) { ?><span class="badge badge-success">Aktif</span><?php } else { ?><span class="badge badge-danger">Non Aktif</span><?php } ?></td>
            <td align="center" style="position: sticky; right:0;" class="btn-default justify-content-center">
                <button onclick="loadContent(`${url}_edit`, <?php echo $dt['id'] ?>);" class="btn btn-xs btn-info"><span class="fas fa-edit"></span> Ubah</button>
                <?php if ($_SESSION['role_id'] == 1) { ?>
                    <button onclick="alertBeforeDelete(<?php echo $dt['id'] ?>, url, 'users');" class="btn btn-xs btn-danger"><span class="fas fa-trash"></span> Hapus</button>
                <?php } ?>
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
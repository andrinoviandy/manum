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
    $where = $where . " AND (LOWER(j.nik) LIKE LOWER('%" . $_POST['search'] . "%') OR LOWER(j.nama) LIKE LOWER('%" . $_POST['search'] . "%') OR LOWER(j.tempat_lahir) LIKE LOWER('%" . $_POST['search'] . "%') OR LOWER(j.no_hp) LIKE LOWER('%" . $_POST['search'] . "%') OR LOWER(c.cabang) LIKE LOWER('%" . $_POST['search'] . "%') OR LOWER(pro.nama_provinsi) LIKE LOWER('%" . $_POST['search'] . "%') OR LOWER(k.nama_kabupaten) LIKE LOWER('%" . $_POST['search'] . "%') OR LOWER(m.nama_marketing) LIKE LOWER('%" . $_POST['search'] . "%'))";
}
if (isset($_GET['form']) && isset($_GET['to'])) {
    $where = $where . " AND pj.tgl_proses BETWEEN '$_GET[form]' AND '$_GET[to]'";
}
$cabang = '';
if ($_SESSION['role_id'] == 1 || $_SESSION['role_id'] == 4) {
    $cabang = "WHERE p.id IS NOT NULL";
} else {
    $cabang = "WHERE p.cabang_id = $_SESSION[cabang_id]";
}
$sql = "SELECT COUNT(*) OVER () AS total, row_number() OVER (ORDER BY pj.id DESC) AS no, j.*, pj.id AS id_p, pj.*, c.cabang, m.nama_marketing, pro.nama_provinsi, k.nama_kabupaten, pak.nama_paket, pak.tgl_berangkat FROM proses_jamaah pj LEFT JOIN jamaah j ON j.id = pj.jamaah_id LEFT JOIN pendaftaran p ON j.id = p.jamaah_id LEFT JOIN provinsi pro ON pro.id = j.provinsi_id LEFT JOIN kabupaten k ON k.id = j.kabupaten_id LEFT JOIN cabang c ON c.id = p.cabang_id LEFT JOIN marketing m ON m.id = pj.marketing_id LEFT JOIN paket pak ON pak.id = pj.paket_id $cabang $where ORDER BY pj.tgl_proses DESC, pj.id DESC LIMIT $limit OFFSET $paging";

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
            <td>
                <?php if ($dt['status_proses'] == 0) { ?>
                    <div class="badge badge-warning">Masih Proses</div>
                <?php } else { ?>
                    <div class="badge badge-success">Selesai</div>
                <?php } ?>
            </td>
            <td><?php echo date("d/m/Y", strtotime($dt['tgl_proses'])); ?></td>
            <td><?php echo $dt['nama_paket']; ?></td>
            <td><?php echo date("d/m/Y", strtotime($dt['tgl_berangkat'])); ?></td>
            <td><?php echo $dt['nik']; ?></td>
            <td><?php echo $dt['nama']; ?></td>
            <td><?php echo $dt['no_hp']; ?></td>
            <td><?php echo $dt['nama_provinsi']; ?></td>
            <td><?php echo $dt['nama_kabupaten']; ?></td>
            <td><?php echo $dt['cabang']; ?></td>
            <td><?php echo $dt['nama_marketing']; ?></td>
            <td align="center" style="position: sticky; right:0;" class="btn-default justify-content-center">
                <button onclick="loadContent(`${url}_detail`, <?php echo $dt['id_p'] ?>);" class="btn btn-xs btn-warning"><span class="fas fa-eye"></span> Detail</button>
                <?php if ($_SESSION['role_id'] != 4) { ?>
                <button onclick="alertBeforeDelete(<?php echo $dt['id_p'] ?>, url, 'proses_jamaah');" class="btn btn-xs btn-danger m-1"><span class="fas fa-trash"></span> Hapus</button>
                <?php } ?>
            </td>
        </tr>
    <?php
    }
} else {
    ?>
    <tr>
        <td colspan="12" class="text-center">
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
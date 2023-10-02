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
    $where = $where . "WHERE (LOWER(j.nik) LIKE LOWER('%" . $_POST['search'] . "%') OR LOWER(j.nama) LIKE LOWER('%" . $_POST['search'] . "%') OR LOWER(j.tempat_lahir) LIKE LOWER('%" . $_POST['search'] . "%') OR LOWER(j.no_hp) LIKE LOWER('%" . $_POST['search'] . "%') OR LOWER(c.cabang) LIKE LOWER('%" . $_POST['search'] . "%') OR LOWER(pro.nama_provinsi) LIKE LOWER('%" . $_POST['search'] . "%') OR LOWER(k.nama_kabupaten) LIKE LOWER('%" . $_POST['search'] . "%') OR LOWER(m.nama_marketing) LIKE LOWER('%" . $_POST['search'] . "%'))";
}
$sql = "SELECT COUNT(*) OVER () AS total, row_number() OVER (ORDER BY pk.id DESC) AS no, j.*, pd.id AS id_p, pro.nama_provinsi, pd.id AS id_d, k.nama_kabupaten, c.cabang, m.nama_marketing, (SELECT SUM(k.nominal) FROM keuangan k INNER JOIN proses_jamaah pj ON pj.id = k.proses_jamaah_id WHERE pj.jamaah_id = j.id AND pj.paket_id = pk.id) AS saldo FROM paket pk INNER JOIN proses_jamaah pj ON pk.id = pj.paket_id INNER JOIN jamaah j ON j.id = pj.jamaah_id INNER JOIN pendaftaran pd ON j.id = pd.jamaah_id INNER JOIN cabang c ON c.id = pd.cabang_id INNER JOIN marketing m ON m.id = pd.marketing_id INNER JOIN provinsi pro ON pro.id = j.provinsi_id INNER JOIN kabupaten k ON k.id = j.kabupaten_id WHERE pk.id = $_POST[id] $where ORDER BY pj.tgl_proses DESC LIMIT $limit OFFSET $paging";

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
            <td><?php echo $dt['nik']; ?></td>
            <td><?php echo $dt['nama']; ?></td>
            <td><?php echo $dt['jenis_kelamin'] === 'L' ? 'Laki-laki' : 'Perempuan'; ?></td>
            <td><?php echo $dt['no_hp']; ?></td>
            <td><?php echo $dt['nama_provinsi']; ?></td>
            <td><?php echo $dt['nama_kabupaten']; ?></td>
            <td><?php echo $dt['cabang']; ?></td>
            <td><?php echo $dt['nama_marketing']; ?></td>
            <td><?php echo number_format($dt['saldo'],0,',','.'); ?></td>
            <td align="center" style="position: sticky; right:0;" class="btn-default justify-content-center">
                <button onclick="loadContent('data_jamaah_detail', <?php echo $dt['id_p'] ?>);" class="btn btn-xs btn-warning"><span class="fas fa-eye"></span> Detail</button>
                <!-- <button onclick="alertBeforeDelete(<?php echo $dt['id_p'] ?>, url, 'paket');" class="btn btn-sm btn-danger m-1"><span class="fas fa-trash"></span> Hapus</button> -->
            </td>
        </tr>
    <?php
    }
} else {
    ?>
    <tr>
        <td colspan="11" class="text-center">
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
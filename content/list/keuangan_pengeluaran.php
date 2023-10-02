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
    $where = $where . "AND (LOWER(nama_kas) LIKE LOWER('%" . $_POST['search'] . "%') OR LOWER(nominal::VARCHAR) LIKE LOWER('%" . $_POST['search'] . "%') OR LOWER(pembayaran) LIKE LOWER('%" . $_POST['search'] . "%') OR LOWER(nomor) LIKE LOWER('%" . $_POST['search'] . "%') OR LOWER(keterangan) LIKE LOWER('%" . $_POST['search'] . "%'))";
}

$cabang = '';
if ($_SESSION['role_id'] == 1) {
    $cabang = "AND ks.cabang_id = $_SESSION[cabang_id]";
} else {
    $cabang = "AND ks.cabang_id = $_SESSION[cabang_id]";
}
$sql = "SELECT COUNT(*) OVER () AS total, row_number() OVER (ORDER BY k.id DESC) AS no, k.*, ks.nama_kas, kk.nama_kategori FROM keuangan k INNER JOIN kategori_keuangan kk ON kk.id = k.kategori_keuangan_id INNER JOIN kas ks ON ks.id = k.kas_id WHERE kk.jenis_kategori = 'k' AND kk.id != '3' $cabang $where ORDER BY k.id DESC LIMIT $limit OFFSET $paging";

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
            <td><?php echo $dt['nomor']; ?></td>
            <td><?php echo date('d/m/Y', strtotime($dt['tanggal'])); ?></td>
            <td><?php echo $dt['pembayaran']; ?></td>
            <td><?php echo number_format($dt['nominal'], 0, ',', '.'); ?></td>
            <td><?php echo $dt['nama_kategori']; ?></td>
            <td><?php echo $dt['nama_kas']; ?></td>
            <td><?php echo $dt['keterangan']; ?></td>
            <td>
                <?php if ($dt['bukti'] != '') { ?>
                    <a href="javascript:void()" onclick="lihatGambar('Preview Bukti', 'manum/file/keuangan/<?php echo $dt['bukti']; ?>');">
                        <img class="img-rounded elevation-2" width="80px" height="40px" src="manum/file/keuangan/<?php echo $dt['bukti']; ?>">
                    </a>
                <?php } ?>
            </td>
            <!-- <td><?php if ($dt['status'] == 1) { ?><span class="tag tag-success">Aktif</span><?php } else { ?><span class="tag tag-danger">Non Aktif</span><?php } ?></td> -->
            <td align="center" style="position: sticky; right:0;" class="btn-default justify-content-center">
                <button onclick="loadContent(`${url}_edit`, <?php echo $dt['id'] ?>);" class="btn btn-xs btn-info m-1"><span class="fas fa-edit"></span> Ubah</button>
                <button onclick="alertBeforeDelete(<?php echo $dt['id'] ?>, url, 'keuangan');" class="btn btn-xs btn-danger m-1"><span class="fas fa-trash"></span> Hapus</button>
            </td>
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
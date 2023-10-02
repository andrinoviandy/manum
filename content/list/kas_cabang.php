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
$sql = "SELECT COUNT(*) OVER () AS total, row_number() OVER (ORDER BY k.id DESC) AS no, SUM(k.nominal) OVER () AS jumlah, k.*, ks.nama_kas, (SELECT nama_kas FROM keuangan ke INNER JOIN kas ka ON ka.id = ke.kas_id WHERE ke.nomor = k.nomor AND ke.id != k.id) AS mutasi_ke FROM keuangan k INNER JOIN kategori_keuangan kk ON kk.id = k.kategori_keuangan_id INNER JOIN kas ks ON ks.id = k.kas_id WHERE kk.id = 4 AND k.proses_jamaah_id = " . $_POST['id_proses'] . " AND ks.cabang_id != 1 $where ORDER BY k.id DESC LIMIT $limit OFFSET $paging";

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
                echo "<script>countData2(Math.ceil($dt[total] / $limit), $dt[total])</script>"; ?>
                <!-- <input type="text" id="ceil_data" value="<?php echo ceil($dt['total'] / $limit); ?>"> -->
            </td>
            <!-- <td>
                <?php //if ($dt['status_konfirmasi'] == 1) {
                //echo "<div class='badge badge-success'>Terkonfirmasi</div>";
                //} else {
                //echo "<div class='badge badge-warning'>Belum Konfirmasi</div>";
                //} 
                ?>
            </td> -->
            <td>
                <?php echo $dt['mutasi_ke'] ?>
                <!-- <?php if ($dt['status_mutasi'] == 1) {
                            echo "<div class='badge badge-success'>Termutasi</div>";
                        } else {
                            echo "<div class='badge badge-warning'>Belum Mutasi</div>";
                        } ?> -->
            </td>
            <td><?php echo $dt['nomor']; ?></td>
            <td><?php echo date('d/m/Y', strtotime($dt['tanggal'])); ?></td>
            <td><?php echo $dt['pembayaran']; ?></td>
            <td><?php echo number_format($dt['nominal'], 0, ',', '.'); ?></td>
            <td><?php echo $dt['nama_kas']; ?></td>
            <td><?php echo $dt['keterangan']; ?></td>
            <td><?php echo $dt['keterangan']; ?></td>
            <!-- <td><?php if ($dt['status'] == 1) { ?><span class="tag tag-success">Aktif</span><?php } else { ?><span class="tag tag-danger">Non Aktif</span><?php } ?></td> -->
            <td align="center" style="position: sticky; right:0;" class="btn-default justify-content-center">
                <?php if ($_SESSION['role_id'] != 4) { ?>
                    <?php if ($dt['status_mutasi'] == 0) { ?>
                        <a onclick="mutasiData({title: 'Mutasi Invoice', id_p : <?php echo $_POST['id_proses'] ?>, id_k : <?php echo $dt['id'] ?>});" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="left" title="Mutasi"><span class="fas fa-paper-plane"></span></a>
                    <?php } else { ?>
                        <a onclick="batalkanMutasi({id_proses : <?php echo $_POST['id_proses'] ?>, id_keuangan : <?php echo $dt['id'] ?>, nomor: '<?php echo $dt['nomor'] ?>', go:2, kas:'kas_cabang', cabang_id:2, status_konfirmasi: <?php echo $dt['status_konfirmasi'] ?>})" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="left" title="Belum Mutasi"><span class="fas fa-times-circle"></span></a>
                    <?php } ?>
                <?php } ?>
                <a onclick="lihatGambar('Preview Bukti', 'manum/file/keuangan/<?php echo $dt['bukti']; ?>');" class="btn btn-sm btn-secondary" data-toggle="tooltip" data-placement="left" title="Bukti"><span class="fas fa-file-image"></span></a>
                <a target="_blank" href="manum/action/print/invoice.php?id=<?php echo $dt['id'] ?>" class="btn btn-sm btn-primary"><span class="fas fa-print"></span></a>
                <?php if ($_SESSION['role_id'] != 4) { ?>
                    <?php if ($dt['status_konfirmasi'] == 0 && $dt['status_mutasi'] == 0) { ?>
                        <button onclick="alertBeforeDeleteСustom(<?php echo $dt['id'] ?>, 'keuangan', {kas: 'kas_pusat', id_proses: <?php echo $dt['proses_jamaah_id'] ?>, cabang_id: 2, tbody: 'tbody2'});" class="btn btn-sm btn-danger"><span class="fas fa-trash"></span> Hapus</button>
                    <?php } ?>
                <?php } ?>
            </td>
        </tr>
    <?php
    }
    ?>
    <tfooter>
        <tr>
            <td colspan="10"></td>
            <td style="position: sticky; right:0;" class="bg-secondary text-bold" align="center">
                JUMLAH<br>
                <?php echo number_format($row[0]['jumlah'], 0, ',', '.') ?>
            </td>
        </tr>
    </tfooter>
<?php
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
            <?php echo "<script>countData2(0, 0)</script>"; ?>
        </td>
    </tr>
<?php } ?>
<script>
    function alertBeforeDeleteСustom(id, table, objek) {
        Swal.fire({
            title: 'Hapus Data ?',
            text: "Kamu Yakin Menghapus Item Ini",
            icon: 'warning',
            showCancelButton: true,
            // confirmButtonColor: '#3085d6',
            // cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batalkan'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: `manum/action/hapus/hapus.php`,
                    // data: $("#form_" + page).serialize(),
                    data: 'id=' + id + '&table=' + table,
                    success: function(data) {
                        if (data === '1') {
                            Swal.fire(
                                'Berhasil Terhapus !',
                                '',
                                'success',
                            )
                            fetchDataCustom('kas_cabang', {
                                id_proses: objek.id_proses,
                                cabang_id: objek.cabang_id,
                                tbody: objek.tbody
                            })
                        } else {
                            Swal.fire(
                                'Gagal Terhapus !',
                                '',
                                'success',
                            )
                        }
                    }
                });
            }
        })
    }
</script>
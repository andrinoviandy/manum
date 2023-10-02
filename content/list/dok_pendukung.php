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
    $where = $where . "AND (LOWER(nama_berkas) LIKE LOWER('%" . $_POST['search'] . "%'))";
}
$sql = "SELECT COUNT(*) OVER () AS total, row_number() OVER (ORDER BY dj.id DESC) AS no, dj.* FROM dok_jamaah dj WHERE dj.proses_jamaah_id = " . $_POST['id_proses'] . " $where ORDER BY dj.id DESC LIMIT $limit OFFSET $paging";

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
                echo "<script>countData3(Math.ceil($dt[total] / $limit), $dt[total])</script>"; ?>
                <!-- <input type="text" id="ceil_data" value="<?php echo ceil($dt['total'] / $limit); ?>"> -->
            </td>
            <td><?php echo $dt['nama_berkas']; ?></td>
            <td><?php if ($dt['status_valid'] == 1) {
                    echo "<div class='badge badge-success'>Valid</div>";
                } else {
                    echo "<div class='badge badge-warning'>Belum Valid</div>";
                } ?>
            </td>
            <td align="center" style="position: sticky; right:0;" class="btn-default justify-content-center">
                <?php if ($dt['status_valid'] == 0) { ?>
                    <a onclick="verifikasiBerkas(1, {verif: 1, id: <?php echo $dt['id'] ?>, next: {id_proses: <?php echo $_POST['id_proses'] ?>, tbody: 'tbody3'}});" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="left" title="Valid"><span class="fas fa-check-circle"></span></a>
                <?php } else { ?>
                    <a onclick="verifikasiBerkas(0, {verif: 0, id: <?php echo $dt['id'] ?>, next: {id_proses: <?php echo $_POST['id_proses'] ?>, tbody: 'tbody3'}})" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="left" title="Not Valid"><span class="fas fa-times-circle"></span></a>
                <?php } ?>
                <a onclick="lihatGambar('Preview File', 'manum/file/dok_pendukung/<?php echo $dt['file_berkas']; ?>');" class="btn btn-sm btn-secondary" data-toggle="tooltip" data-placement="left" title="Bukti"><span class="fas fa-file-image"></span></a>
                <?php if ($dt['status_valid'] == 0) { ?>
                    <button onclick="alertBeforeDeleteСustom(<?php echo $dt['id'] ?>, 'dok_jamaah', {kas: 'dok_jamaah', id_proses: <?php echo $dt['proses_jamaah_id'] ?>, cabang_id: 2, tbody: 'tbody3'});" class="btn btn-sm btn-danger"><span class="fas fa-trash"></span> Hapus</button>
                <?php } ?>
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
            <?php echo "<script>countData3(0, 0)</script>"; ?>
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
                            fetchDataCustom('dok_pendukung', {
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

    function verifikasiBerkas(action, objek) {
        Swal.fire({
            title: 'Verifikasi Berkas !',
            text: action === 1 ? "Kamu Yakin Akan Mengubah Status Menjadi Valid ?" : "Kamu Yakin Akan Membatalkan Status Valid Berkas Ini ?",
            icon: 'warning',
            showCancelButton: true,
            // confirmButtonColor: '#3085d6',
            // cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batalkan'
        }).then((result) => {
            if (result.isConfirmed) {
                $.post("manum/action/ubah/verifikasi_berkas.php", objek,
                    function(data, textStatus, jqXHR) {
                        if (data == '1') {
                            Swal.fire(
                                'Berhasil Terupdate !',
                                '',
                                'success',
                            )
                            fetchDataCustom('dok_pendukung', {
                                id_proses: objek.next.id_proses,
                                tbody: objek.next.tbody
                            })
                        } else {
                            Swal.fire(
                                'Gagal Terupdate !',
                                '',
                                'error',
                            )
                        }
                    }
                );
            }
        })
    }
</script>
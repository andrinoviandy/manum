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
    $where = $where . " AND (LOWER(nama_paket) LIKE LOWER('%" . $_POST['search'] . "%') OR LOWER(harga::VARCHAR) LIKE LOWER('%" . $_POST['search'] . "%') OR LOWER(bulan_berangkat) LIKE LOWER('%" . $_POST['search'] . "%') OR LOWER(asal_keberangkatan) LIKE LOWER('%" . $_POST['search'] . "%') OR LOWER(pesawat) LIKE LOWER('%" . $_POST['search'] . "%') OR LOWER(hotel) LIKE LOWER('%" . $_POST['search'] . "%') OR LOWER(bis) LIKE LOWER('%" . $_POST['search'] . "%'))";
}
if (isset($_GET['form']) && isset($_GET['to'])) {
    $where = $where . " AND p.tgl_berangkat BETWEEN '$_GET[form]' AND '$_GET[to]'";
}
$sql = "SELECT COUNT(*) OVER () AS total, row_number() OVER (ORDER BY p.id DESC) AS no, p.*, (SELECT COUNT(*) FROM proses_jamaah WHERE paket_id = p.id) AS jumlah_jamaah FROM paket p WHERE p.id IS NOT NULL $where ORDER BY id DESC LIMIT $limit OFFSET $paging";

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
                <?php if ($dt['tayang'] == 0) { ?>
                    <div class="badge badge-warning">Belum Tayang</div>
                <?php } else { ?>
                    <div class="badge badge-success">Sudah Tayang</div>
                <?php } ?>
            </td>
            <td><?php echo $dt['nama_paket']; ?></td>
            <td><?php if ($dt['harga'] != 0) {echo number_format($dt['harga'], 0, ',', '.');} ?></td>
            <td><?php echo $dt['bulan_berangkat']; ?></td>
            <td><?php if ($dt['tgl_berangkat'] != '') { echo date('d/m/Y', strtotime($dt['tgl_berangkat']));} ?></td>
            <td><?php echo $dt['asal_keberangkatan']; ?></td>
            <td><?php echo $dt['jumlah_jamaah']; ?></td>
            <td>
                <a href="javascript:void()" onclick="lihatGambar('Preview Flyer', 'manum/file/paket_umrah/<?php echo $dt['flyer']; ?>');">
                    <img class="img-rounded elevation-2" width="45px" height="60px" src="manum/file/paket_umrah/<?php echo $dt['flyer']; ?>">
                </a>
            </td>
            <!-- <td><?php if ($dt['status'] == 1) { ?><span class="tag tag-success">Aktif</span><?php } else { ?><span class="tag tag-danger">Non Aktif</span><?php } ?></td> -->
            <td align="center" style="position: sticky; right:0;" class="btn-default justify-content-center">
                <button onclick="loadContent(`${url}_detail`, <?php echo $dt['id'] ?>);" class="btn btn-xs btn-warning m-1"><span class="fas fa-eye"></span> Detail</button>
                <?php if ($dt['tayang'] == 0) { ?>
                    <button onclick="tayang('1', `${url}`, <?php echo $dt['id'] ?>);" class="btn btn-xs btn-default m-1"><span class="fas fa-calendar"></span> Tayang</button>
                <?php } ?>
                <?php if ($dt['tayang'] == 1) { ?>
                    <button onclick="tayang('0', `${url}`, <?php echo $dt['id'] ?>);" class="btn btn-xs btn-default m-1"><span class="fas fa-times"></span> Batal Tayang</button>
                <?php } ?>
                <br>
                <button onclick="loadContent(`${url}_edit`, <?php echo $dt['id'] ?>);" class="btn btn-xs btn-info m-1"><span class="fas fa-edit"></span> Ubah</button>
                <button onclick="alertBeforeDelete(<?php echo $dt['id'] ?>, url, 'paket');" class="btn btn-xs btn-danger m-1"><span class="fas fa-trash"></span> Hapus</button>
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
<script>
    function tayang(action, page, id) {
        Swal.fire({
            title: 'Penayangan Paket !',
            text: action == 1 ? "Kamu Yakin Akan Menayangkan Paket Ini ?" : "Kamu Yakin Akan Membatalkan Penayangan Paket Ini ?",
            icon: 'warning',
            showCancelButton: true,
            // confirmButtonColor: '#3085d6',
            // cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batalkan'
        }).then((result) => {
            if (result.isConfirmed) {
                $.post("manum/action/ubah/tayang.php", {
                        action: action,
                        id: id
                    },
                    function(data, textStatus, jqXHR) {
                        if (data == '1') {
                            Swal.fire(
                                'Berhasil Terupdate !',
                                '',
                                'success',
                            )
                            fetchData(page)
                        } else {
                            Swal.fire(
                                'Gagal Terupdate !',
                                'Data Paket Sedang Aktif Digunakan',
                                'error',
                            )
                        }
                    }
                );
            }
        })
    }
</script>
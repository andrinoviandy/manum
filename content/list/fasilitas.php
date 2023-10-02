<?php
require('../../config/koneksi.php');
//passport
$sql = "SELECT fs.* FROM fas_jamaah fs WHERE fs.proses_jamaah_id = " . $_POST['id_proses'] . " AND nama_fasilitas = 'Passport'";
$data = $koneksi->prepare($sql);
$data->execute();
$row = $data->fetch();
$count = $data->rowCount();
//perlengkapan
$sql2 = "SELECT fs.* FROM fas_jamaah fs WHERE fs.proses_jamaah_id = " . $_POST['id_proses'] . " AND nama_fasilitas = 'Perlengkapan Umrah/Haji'";
$data2 = $koneksi->prepare($sql2);
$data2->execute();
$row2 = $data2->fetch();
$count2 = $data2->rowCount();
//manasik
$sql3 = "SELECT fs.* FROM fas_jamaah fs WHERE fs.proses_jamaah_id = " . $_POST['id_proses'] . " AND nama_fasilitas = 'Manasik'";
$data3 = $koneksi->prepare($sql3);
$data3->execute();
$row3 = $data3->fetch();
$count3 = $data3->rowCount();

?>
<tr>
    <td width="5%">1</td>
    <td>Passport</td>
    <td align="center" style="position: sticky; right:0;" class="btn-default justify-content-center">
        <?php if ($_SESSION['role_id'] != 4) { ?>
            <a onclick="tambahInvoice('upload_passport', {title: 'Upload Passport', id_p : <?php echo $_POST['id_proses'] ?>, nama: 'Passport'});" class="btn btn-sm btn-success float-right" data-toggle="tooltip" data-placement="left" title="Upload"><span class="fas fa-upload mr-1"></span> Upload</a>
        <?php } ?>
        <?php if ($count !== 0) { ?>
            <a onclick="lihatGambar('Preview Passport', 'manum/file/fasilitas/<?php echo $row['file']; ?>');" class="btn btn-sm btn-secondary float-left" data-toggle="tooltip" data-placement="left" title="Bukti"><span class="fas fa-file-image"></span></a>
        <?php } else {
            echo "<div class='float-left'>..............</div>";
        } ?>
    </td>
</tr>
<tr>
    <td>2</td>
    <td>Perlengkapan Umrah/Haji</td>
    <td align="center" style="position: sticky; right:0;" class="btn-default justify-content-center">
        <?php if ($_SESSION['role_id'] != 4) { ?>
            <a onclick="tambahInvoice('diterima_tanggal', {title: 'Diterima Tanggal', id_p : <?php echo $_POST['id_proses'] ?>, nama: 'Perlengkapan Umrah/Haji'});" class="btn btn-sm btn-success float-right" data-toggle="tooltip" data-placement="left" title="Diterima Tanggal"><span class="fas fa-calendar-check mr-1"></span> Diterima Tanggal</a>
        <?php } ?>
        <?php if ($count2 !== 0) { ?>
            <div class="text-bold float-left"><span class="fas fa-calendar-check"> <?php echo date('d M Y', strtotime($row2['tgl_diterima'])) ?></span></div>
        <?php } else {
            echo "<div class='float-left'>..............</div>";
        } ?>
    </td>
</tr>
<tr>
    <td>3</td>
    <td>Manasik</td>
    <td align="center" style="position: sticky; right:0;" class="btn-default justify-content-center">
        <?php if ($_SESSION['role_id'] != 4) { ?>
            <a onclick="tambahInvoice('jadwal_manasik', {title: 'Jadwal Manasik', id_p : <?php echo $_POST['id_proses'] ?>, nama: 'Manasik'});" class="btn btn-sm btn-success float-right" data-toggle="tooltip" data-placement="left" title="Atur Jadwal"><span class="fas fa-calendar-check mr-1"></span> Atur Jadwal</a>
        <?php } ?>
        <?php if ($count3 !== 0) { ?>
            <div class="text-bold float-left"><span class="fas fa-calendar-check"> <?php echo date('d M Y', strtotime($row3['jadwal'])) ?></span></div>
        <?php } else {
            echo "<div class='float-left'>..............</div>";
        } ?>
    </td>
</tr>

<script>
    function uploadPassport(action, objek) {
        $.post('manum/content/modal/' + action + '.php', objek,
            function(data) {
                $('#modal-content-invoice').html(data);
                $('#modalInvoice').modal('show');
            }
        );
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
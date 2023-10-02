<?php
require('../../config/koneksi.php');
$sql = "SELECT pj.id, j.nik, j.nama, pj.tgl_proses FROM proses_jamaah pj INNER JOIN jamaah j ON j.id = pj.jamaah_id WHERE pj.status_proses = 0 ORDER BY pj.tgl_proses DESC, pj.id DESC";
$data = $koneksi->prepare($sql);
$data->execute();
$row = $data->fetchAll();
$count = $data->rowCount();
?>
<select <?php echo $_GET['req']; ?> class="form-control select2" id="id_proses" name="id_proses">
    <option value="">...</option>
    <?php
    if ($count !== 0) {
        foreach ($row as $dt) {
    ?>
            <option <?php if ($dt['id'] == $_GET['id']) echo "selected"; ?> value="<?php echo $dt['id'] ?>"><?php echo "NIK : " . $dt['nik'] . "(" . $dt['nama'] . ")" . " - Proses:" . date('d/m/Y', strtotime($dt['tgl_proses'])); ?></option>
    <?php
        }
    }
    ?>
</select>
<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2({
            theme: 'bootstrap4'
        })
    })
    // DropzoneJS Demo Code End
</script>
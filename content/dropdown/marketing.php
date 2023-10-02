<?php
require('../../config/koneksi.php');
$where = '';
if ($_GET['where']) {
    $where = $_GET['where'];
}
$data2 = $koneksi->prepare("SELECT marketing_id FROM proses_jamaah WHERE id = " . $_GET['id_proses'] . "");
$data2->execute();
$row2 = $data2->fetch();

$sql = "SELECT id, " . $_GET['field'] . " AS nama FROM " . $_GET['table'] . " $where ORDER BY " . $_GET['field'] . " ASC";
$data = $koneksi->prepare($sql);
$data->execute();
$row = $data->fetchAll();
$count = $data->rowCount();
?>
<select <?php if ($_SESSION['role_id'] == 4) { echo "disabled"; } ?> onchange="ubahMarketing(<?php echo $_GET['id_proses'] ?>, this.value)" class="form-control select2" id="<?php echo explode("_", $_GET['name'])[1]; ?>" name="<?php echo explode("_", $_GET['name'])[1]; ?>">
    <option value="0">...</option>
    <?php
    if ($count !== 0) {
        foreach ($row as $dt) {
    ?>
            <option <?php if ($dt['id'] == $row2['marketing_id']) echo "selected"; ?> value="<?php echo $dt['id'] ?>"><?php echo $dt['nama'] ?></option>
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
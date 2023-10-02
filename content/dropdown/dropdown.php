<?php
require('../../config/koneksi.php');
$status = '';
if ($_GET['table'] == 'cabang') {
    $status = "WHERE status = 1";
}
if ($_GET['table'] == 'users') {
    $status = "WHERE enable = 1";
}
$where = '';
if ($_GET['where']) {
    $where = $_GET['where'];
}
$id = '';
if ($_GET['idParent'] > 0) {
    if ($_GET['table'] == 'kabupaten') {
        $id = "WHERE provinsi_id = ".$_GET['idParent']."";
    }
}
$sql = "SELECT id, " . $_GET['field'] . " AS nama FROM " . $_GET['table'] . " $status $id $where ORDER BY " . $_GET['field'] . " ASC";
$data = $koneksi->prepare($sql);
$data->execute();
$row = $data->fetchAll();
$count = $data->rowCount();
?>
<select <?php echo $_GET['req']; ?> class="form-control select2" id="<?php echo explode("_", $_GET['name'])[1]; ?>" name="<?php echo explode("_", $_GET['name'])[1]; ?>">
    <option value="">...</option>
    <?php
    if ($count !== 0) {
        foreach ($row as $dt) {
    ?>
            <option <?php if ($dt['id'] == $_GET['id']) echo "selected"; ?> value="<?php echo $dt['id'] ?>"><?php echo $dt['nama'] ?></option>
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
<?php
require('../../config/koneksi.php');
$cabang = "";
if ($_SESSION['cabang_id'] == 1) {
    $cabang = "";
} else {
    $cabang = "WHERE id = $_SESSION[cabang_id]";
}
$sql = "SELECT id, " . $_GET['field'] . " AS nama FROM " . $_GET['table'] . " $cabang ORDER BY " . $_GET['field'] . " ASC";
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
            <option value="<?php echo $dt['id'] ?>"><?php echo $dt['nama'] ?></option>
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
<?php
session_start();
?>
<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title"><?php echo $_POST['title'] ?></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form onsubmit="simpan_data_invoice('keuangan_invoice', {go:2, kas:'kas_cabang', cabang_id:2, id_proses: <?php echo $_POST['id_p'] ?>}); return false" id="formData">
        <div class="modal-body">
            <div class="form-group">
                <input type="hidden" class="form-control" value="<?php echo $_POST['id_p'] ?>" name="id_proses">
                <!-- <input type="hidden" class="form-control" value="0" name="mutasi"> -->
                <label>No. Invoice <font color="red">*</font></label>
                <input type="text" class="form-control" required name="no_invoice">
            </div>
            <div class="form-group">
                <label>Tanggal <font color="red">*</font></label>
                <input type="date" class="form-control" required name="tanggal">
            </div>
            <div class="form-group">
                <label>Pembayaran <font color="red">*</font></label>
                <input type="text" class="form-control" required name="pembayaran">
            </div>
            <div class="form-group">
                <label>Nominal <font color="red">*</font></label>
                <input type="text" class="form-control" required name="nominal" onkeydown="return numbersonly(this, event);" onkeyup="tandaPemisahTitik(this);">
            </div>
            <div class="form-group">
                <label>Bank Penerima <font color="red">*</font></label>
                <div id="dropdown_kas"></div>
                <?php
                if ($_SESSION['role_id'] == 1) {
                    $where = "WHERE cabang_id != 1";
                } else {
                    $where = "WHERE cabang_id = $_SESSION[cabang_id]";
                }
                echo "<script>
                                            let where2 = '$where';
                                            </script>";
                ?>
                <script>
                    dropdown('dropdown_kas', 'kas', 'nama_kas', '', '', where2, 'required')
                </script>
            </div>
            <div class="form-group">
                <label>Keterangan <font color="red">*</font></label>
                <input type="text" class="form-control" required name="keterangan">
            </div>
            <div class="form-group">
                <label>Bukti <font color="red">*</font></label>
                <input type="file" id="bukti" class="form-control" required name="bukti">
            </div>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn bt-sm btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-check-circle mr-1"></i> Simpan</button>
        </div>
    </form>
</div>
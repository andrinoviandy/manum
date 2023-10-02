<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title"><?php echo $_POST['title'] ?></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form onsubmit="simpan_data_status('update_status', {id_proses: <?php echo $_POST['id_p'] ?>}); return false" id="formData">
        <div class="modal-body">
            <div class="form-group">
                Pastikan Pembayaran , Dokumen Pendukung dan Fasilitas Sudah Terisi Dengan Benar !
            </div>
            <div class="form-group">
                <input type="hidden" class="form-control" value="<?php echo $_POST['id_p'] ?>" name="id_proses">
                <select class="form-control select2" name="status">
                    <option <?php if ($_POST['status_proses'] == 0) echo "selected"; ?> value="0">Masih Proses</option>
                    <option <?php if ($_POST['status_proses'] == 1) echo "selected"; ?> value="1">Selesai</option>
                </select>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn bt-sm btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-check-circle mr-1"></i> Simpan</button>
        </div>
    </form>
</div>
<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2({
            theme: 'bootstrap4'
        })
    })
    // DropzoneJS Demo Code End
</script>
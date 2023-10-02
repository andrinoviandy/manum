<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title"><?php echo $_POST['title'] ?></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form onsubmit="simpan_data_invoice('dok_pendukung', {go:3, kas:'dok_pendukung', cabang_id:2, id_proses: <?php echo $_POST['id_p'] ?>}); return false" id="formData">
        <div class="modal-body">
            <div class="form-group">
                <input type="hidden" class="form-control" value="<?php echo $_POST['id_p'] ?>" name="id_proses">
                <label>Nama Berkas <font color="red">*</font></label>
                <input type="text" class="form-control" required name="nama_berkas">
            </div>
            <div class="form-group">
                <label>Upload Berkas <font color="red">*</font></label>
                <input type="file" id="file_berkas" class="form-control" required name="file_berkas">
            </div>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn bt-sm btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-check-circle mr-1"></i> Simpan</button>
        </div>
    </form>
</div>
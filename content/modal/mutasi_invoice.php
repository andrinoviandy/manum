<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title"><?php echo $_POST['title'] ?></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form onsubmit="simpan_data_invoice('mutasi_invoice', {go:2, kas:'kas_cabang', cabang_id:2, id_proses: <?php echo $_POST['id_p'] ?>}); return false" id="formData">
        <div class="modal-body">
            <input type="hidden" class="form-control" value="<?php echo $_POST['id_p'] ?>" name="id_proses">
            <input type="hidden" class="form-control" value="<?php echo $_POST['id_k'] ?>" name="id_keuangan">
            <!-- <input type="hidden" class="form-control" value="1" name="mutasi"> -->
            <div class="form-group">
                <label>Mutasi Ke Kas</label>
                <div id="dropdown_kas"></div>
                <script>
                    dropdown('dropdown_kas', 'kas', 'nama_kas', '', '', 'WHERE cabang_id = 1')
                </script>
            </div>
            <div class="form-group">
                <label>Keterangan</label>
                <input type="text" class="form-control" required name="keterangan">
            </div>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn bt-sm btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-check-circle mr-1"></i> Simpan</button>
        </div>
    </form>
</div>
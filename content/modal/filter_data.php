<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title"><?php echo $_POST['title'] ?></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <!-- onsubmit="simpan_data_invoice('mutasi_invoice', {go:2, kas:'kas_cabang', cabang_id:2, id_proses: <?php echo $_POST['id_p'] ?>}); return false" -->
    <form onsubmit="preview(url, {cabang_id: $('#cabang').val()}); return false">
        <div class="modal-body">
            <!-- <input type="hidden" class="form-control" value="<?php echo $_POST['id_p'] ?>" name="id_proses">
            <input type="hidden" class="form-control" value="<?php echo $_POST['id_k'] ?>" name="id_keuangan"> -->
            <!-- <input type="hidden" class="form-control" value="1" name="mutasi"> -->
            <div class="form-group">
                <label>Cabang</label>
                <div id="dropdown_cabang"></div>
                <script>
                    dropdownCustom({
                        name: 'dropdown_cabang',
                        table: 'cabang',
                        field: 'cabang',
                        req: 'required'
                    })
                </script>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-sm btn-secondary" onclick="exportData(url, '?cabang_id=' + $('#cabang').val())"><i class="fas fa-file"></i> Export</button>
            <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-eye"></i> Preview</button>
        </div>
    </form>
</div>
<script>
    function preview(page, objek) {
        loadingToSave(true)
        fetchData(page, objek)
        $('#modalInvoice').modal('hide')
        loadingToSave(false)
    }
    function exportData(page, params) {
        window.location = "manum/action/export/" + page + ".php" + params;
    }
</script>
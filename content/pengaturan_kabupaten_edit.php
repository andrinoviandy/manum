<?php
require('../config/koneksi.php');
if (isset($_POST['id'])) {
    $_SESSION['id_ubah'] = $_POST['id'];
    $sql = "SELECT * FROM kabupaten WHERE id = " . $_POST['id'] . "";
    $data = $koneksi->prepare($sql);
    $data->execute();
    $row = $data->fetch();
}
if (isset($_SESSION['id_ubah'])) {
    $sql = "SELECT * FROM kabupaten WHERE id = " . $_SESSION['id_ubah'] . "";
    $data = $koneksi->prepare($sql);
    $data->execute();
    $row = $data->fetch();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="m-0">Ubah Kabupaten</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <section class="col-lg-12 connectedSortable">
                        <form onsubmit="ubah_data(url); return false" id="formData">
                            <div class="card">
                                <div class="card-body row">
                                    <div class="card-body col-lg-6">
                                        <input type="hidden" class="form-control" name="id" value="<?php echo $row['id'] ?>">
                                        <div class="form-group">
                                            <label>Nama Provinsi <font color="red">*</font></label>
                                            <div id="dropdown_provinsi"></div>
                                            <script>
                                                dropdown('dropdown_provinsi', 'provinsi', 'nama_provinsi', <?php echo $row['provinsi_id'] ?>,'','','required')
                                            </script>
                                        </div>
                                    </div>
                                    <div class="card-body col-lg-6">
                                        <div class="form-group">
                                            <label>Nama Kabupaten <font color="red">*</font></label>
                                            <input type="text" class="form-control" required name="nama_kabupaten" value="<?php echo $row['nama_kabupaten'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-center">
                                    <div class="">
                                        <button class="btn btn-sm btn-default mr-2" type="button" onclick="loadContent(url)"><span class="fas fa-reply"></span> Kembali</button>
                                        <button type="submit" class="btn btn-sm btn-success"><span class="fas fa-save"></span> Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </section>
    </div>
</body>

</html>
<?php
require('../config/koneksi.php');
if (isset($_POST['id'])) {
    $_SESSION['id_ubah'] = $_POST['id'];
    $sql = "SELECT * FROM marketing WHERE id = " . $_POST['id'] . "";
    $data = $koneksi->prepare($sql);
    $data->execute();
    $row = $data->fetch();
}
if (isset($_SESSION['id_ubah'])) {
    $sql = "SELECT * FROM marketing WHERE id = " . $_SESSION['id_ubah'] . "";
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
                        <h1 class="m-0">Ubah Marketing</h1>
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
                                        <div class="form-group">
                                            <label>NIK <font color="red">*</font></label>
                                            <input type="hidden" class="form-control" name="id" value="<?php echo $row['id'] ?>">
                                            <input type="text" class="form-control" required name="nik" value="<?php echo $row['nik'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Marketing <font color="red">*</font></label>
                                            <input type="text" class="form-control" required name="nama" value="<?php echo $row['nama_marketing'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>No HP <font color="red">*</font></label>
                                            <input type="text" class="form-control" required name="no_hp" value="<?php echo $row['no_hp'] ?>">
                                        </div>
                                    </div>
                                    <div class="card-body col-lg-6">
                                        <div class="form-group">
                                            <label>Email <font color="red">*</font></label>
                                            <input type="email" class="form-control" required name="email" value="<?php echo $row['email'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Photo</label>
                                            <font class="float-right" color="red">*Upload File Jika Ingin Mengubah Photo</font>
                                            <input type="file" id="photo" class="form-control" name="photo">
                                        </div>
                                        <div class="form-group">
                                            <label>Photo Saat Ini</label>
                                            <br>
                                            <img class="img-rounded elevation-2" width="100%" src="manum/file/marketing/<?php echo $row['photo']; ?>">
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
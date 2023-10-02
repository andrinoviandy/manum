<?php
require('../config/koneksi.php');
if (isset($_POST['id'])) {
    $_SESSION['id_ubah'] = $_POST['id'];
    $sql = "SELECT * FROM kas WHERE id = " . $_POST['id'] . "";
    $data = $koneksi->prepare($sql);
    $data->execute();
    $row = $data->fetch();
}
if (isset($_SESSION['id_ubah'])) {
    $sql = "SELECT * FROM kas WHERE id = " . $_SESSION['id_ubah'] . "";
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
                        <h1 class="m-0">Ubah Akun Kas / Bank</h1>
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
                                            <input type="hidden" class="form-control" name="id" value="<?php echo $row['id'] ?>">
                                            <label>Nama Kas / Bank <font color="red">*</font></label>
                                            <input type="text" class="form-control" required name="nama_kas" value="<?php echo $row['nama_kas'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Pemilik <font color="red">*</font></label>
                                            <input type="text" class="form-control" required name="pemilik" value="<?php echo $row['pemilik_kas'] ?>">
                                        </div>
                                    </div>
                                    <div class="card-body col-lg-6">
                                        <div class="form-group">
                                            <label>Cabang <font color="red">*</font></label>
                                            <?php
                                            if ($_SESSION['role_id'] == 1) {
                                                $where = '';
                                                $id = '';
                                            } else {
                                                $where = "AND id = $_SESSION[cabang_id]"; 
                                                $id = $_SESSION['cabang_id'];
                                            }
                                            echo "<script>
                                            let where = '$where'; 
                                            let id = $id;
                                            </script>";
                                            ?>
                                            <div id="dropdown_cabang"></div>
                                            <script>
                                                dropdown('dropdown_cabang', 'cabang', 'cabang', <?php echo $row['cabang_id']; ?>,'',where,'required')
                                            </script>
                                        </div>
                                        <div class="form-group">
                                            <label>No. Rekening <font color="red">*</font></label>
                                            <input type="text" class="form-control" required name="no_rekening" value="<?php echo $row['no_rekening'] ?>">
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
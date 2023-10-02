<?php
require('../config/koneksi.php');
if (isset($_POST['id'])) {
    $_SESSION['id_ubah'] = $_POST['id'];
    $sql = "SELECT * FROM paket WHERE id = " . $_POST['id'] . "";
    $data = $koneksi->prepare($sql);
    $data->execute();
    $row = $data->fetch();
}
if (isset($_SESSION['id_ubah'])) {
    $sql = "SELECT * FROM paket WHERE id = " . $_SESSION['id_ubah'] . "";
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
                        <h1 class="m-0">Ubah Paket</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <section class="col-lg-12 connectedSortable">
                        <form onsubmit="ubah_data(url); return false" id="formData" enctype="multipart/form-data">
                            <div class="card">
                                <div class="card-body row">
                                    <div class="card-body col-lg-6">
                                        <div class="form-group">
                                            <input type="hidden" class="form-control" required name="id" value="<?php echo $row['id']; ?>">
                                            <label>Nama Paket <font color="red">*</font></label>
                                            <input type="text" class="form-control" required name="nama" value="<?php echo $row['nama_paket']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Harga</label>
                                            <input type="text" onkeydown="return numbersonly(this, event);" onkeyup="tandaPemisahTitik(this);" class="form-control" name="harga" value="<?php echo number_format($row['harga'], 0, ',', '.'); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Bulan Berangkat</label>
                                            <input type="text" class="form-control" name="bulan_berangkat" value="<?php echo $row['bulan_berangkat']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Berangkat</label>
                                            <input type="date" class="form-control" name="tgl_berangkat" value="<?php echo $row['tgl_berangkat']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Asal Keberangkatan <font color="red">*</font></label>
                                            <input type="text" class="form-control" required name="asal_keberangkatan" value="<?php echo $row['asal_keberangkatan']; ?>">
                                        </div>
                                    </div>
                                    <div class="card-body col-lg-6">
                                        <div class="form-group">
                                            <label>Pesawat</label>
                                            <input type="text" class="form-control" name="pesawat" value="<?php echo $row['pesawat']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Hotel</label>
                                            <input type="text" class="form-control" name="hotel" value="<?php echo $row['hotel']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Bis</label>
                                            <input type="text" class="form-control" name="bis" value="<?php echo $row['bis']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Pembimbing</label>
                                            <input type="text" class="form-control" name="pembimbing" value="<?php echo $row['pembimbing']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Flyer</label>
                                            <font class="float-right" color="red">*Upload File Jika Ingin Mengubah Flyer</font>
                                            <input type="file" id="flyer" class="form-control" name="flyer">
                                        </div>
                                        <?php if ($row['flyer'] !== '') { ?>
                                        <div class="form-group">
                                            <label>Flyer Saat Ini</label>
                                            <br>
                                            <img class="img-rounded elevation-2" width="100%" src="manum/file/paket_umrah/<?php echo $row['flyer']; ?>">
                                        </div>
                                        <?php } ?>
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
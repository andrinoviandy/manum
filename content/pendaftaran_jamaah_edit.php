<?php
require('../config/koneksi.php');
if (isset($_POST['id'])) {
    $_SESSION['id_ubah'] = $_POST['id'];
    $sql = "SELECT p.*, j.*, p.id AS id_p, j.id AS id_j FROM pendaftaran p INNER JOIN jamaah j ON j.id = p.jamaah_id WHERE p.id = " . $_POST['id'] . "";
    $data = $koneksi->prepare($sql);
    $data->execute();
    $row = $data->fetch();
}
if (isset($_SESSION['id_ubah'])) {
    $sql = "SELECT p.*, j.*, p.id AS id_p, j.id AS id_j FROM pendaftaran p INNER JOIN jamaah j ON j.id = p.jamaah_id WHERE p.id = " . $_SESSION['id_ubah'] . "";
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
                        <h1 class="m-0">Ubah Pendaftaran Jamaah</h1>
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
                                        <input type="hidden" class="form-control" name="id" value="<?php echo $row['id_p'] ?>">
                                        <input type="hidden" class="form-control" name="id_j" value="<?php echo $row['id_j'] ?>">
                                        <div class="form-group">
                                            <label>Tanggal Daftar <font color="red">*</font></label>
                                            <input type="date" class="form-control" required name="tgl_daftar" value="<?php echo $row['tgl_daftar']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>NIK <font color="red">*</font></label>
                                            <input type="text" class="form-control" required name="nik" value="<?php echo $row['nik']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Lengkap <font color="red">*</font></label>
                                            <input type="text" class="form-control" required name="nama" value="<?php echo $row['nama']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Tempat Lahir <font color="red">*</font></label>
                                            <input type="text" class="form-control" required name="tempat_lahir" value="<?php echo $row['tempat_lahir']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Lahir <font color="red">*</font></label>
                                            <input type="date" class="form-control" required name="tgl_lahir" value="<?php echo $row['tgl_lahir']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Jenis Kelamin <font color="red">*</font></label>
                                            <select name="jenis_kelamin" required class="form-control select2">
                                                <option value="">...</option>
                                                <option <?php if ($row['jenis_kelamin'] == 'L') echo "selected"; ?> value="L">Laki-laki</option>
                                                <option <?php if ($row['jenis_kelamin'] == 'P') echo "selected"; ?> value="P">Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>No. HP <font color="red">*</font></label>
                                            <input type="text" class="form-control" required name="no_hp" value="<?php echo $row['no_hp']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Email <font color="red">*</font></label>
                                            <input type="email" class="form-control" required name="email" value="<?php echo $row['email']; ?>">
                                        </div>
                                    </div>
                                    <div class="card-body col-lg-6">
                                        <div class="form-group">
                                            <label>Alamat <font color="red">*</font></label>
                                            <input type="text" class="form-control" required name="alamat" value="<?php echo $row['alamat']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Provinsi <font color="red">*</font></label>
                                            <div id="dropdown_provinsi"></div>
                                            <script>
                                                dropdown('dropdown_provinsi', 'provinsi', 'nama_provinsi', <?php echo $row['provinsi_id']; ?>, '', '', 'required')
                                            </script>
                                        </div>
                                        <div class="form-group">
                                            <label>Kabupaten <font color="red">*</font></label>
                                            <div id="dropdown_kabupaten">
                                                <select class="form-control select2">
                                                    <option value="">...</option>
                                                </select>
                                            </div>
                                            <script>
                                                dropdown('dropdown_kabupaten', 'kabupaten', 'nama_kabupaten', <?php echo $row['kabupaten_id']; ?>, <?php echo $row['provinsi_id']; ?>)
                                            </script>
                                            <script>
                                                $(document).ready(function() {
                                                    $('#dropdown_provinsi').change(function(e) {
                                                        e.preventDefault();
                                                        dropdown('dropdown_kabupaten', 'kabupaten', 'nama_kabupaten', <?php echo $row['kabupaten_id']; ?>, parseInt($('#provinsi').val()), '', 'required')
                                                    });
                                                })
                                            </script>
                                        </div>
                                        <div class="form-group">
                                            <label>Ahli Waris <font color="red">*</font></label>
                                            <input type="text" class="form-control" required name="ahli_waris" value="<?php echo $row['ahli_waris']; ?>">
                                        </div>
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
                                            let id = '$id';
                                            </script>";
                                            ?>
                                            <div id="dropdown_cabang"></div>
                                            <script>
                                                dropdown('dropdown_cabang', 'cabang', 'cabang', <?php echo $row['cabang_id']; ?>, '', where, 'required')
                                            </script>
                                        </div>
                                        <div class="form-group">
                                            <label>Marketing</label>
                                            <div id="dropdown_marketing"></div>
                                            <script>
                                                dropdown('dropdown_marketing', 'marketing', 'nama_marketing', <?php echo $row['marketing_id']; ?>)
                                            </script>
                                        </div>
                                        <div class="form-group">
                                            <label>Upload KTP</label>
                                            <font class="float-right" color="red">*Upload Jika Ingin Mengubah KTP</font>
                                            <input type="file" id="ktp" class="form-control" name="ktp">
                                        </div>
                                        <?php if ($row['foto_ktp'] !== '') { ?>
                                            <div class="form-group">
                                                <label>Foto KTP Saat Ini</label>
                                                <br>
                                                <img class="img-rounded elevation-2" width="100%" src="manum/file/data_jamaah/<?php echo $row['foto_ktp']; ?>">
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
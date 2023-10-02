<?php session_start(); ?>
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
                        <h1 class="m-0">Tambah Pendaftaran Jamaah</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <section class="col-lg-12 connectedSortable">
                        <form onsubmit="simpan_data(url); return false" id="formData">
                            <div class="card">
                                <div class="card-body row">
                                    <div class="card-body col-lg-6">
                                        <div class="form-group">
                                            <label>Tanggal Daftar <font color="red">*</font></label>
                                            <input type="date" class="form-control" required name="tgl_daftar">
                                        </div>
                                        <div class="form-group">
                                            <label>NIK <font color="red">*</font></label>
                                            <input type="text" class="form-control" required name="nik">
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Lengkap <font color="red">*</font></label>
                                            <input type="text" class="form-control" required name="nama">
                                        </div>
                                        <div class="form-group">
                                            <label>Tempat Lahir <font color="red">*</font></label>
                                            <input type="text" class="form-control" required name="tempat_lahir">
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Lahir <font color="red">*</font></label>
                                            <input type="date" class="form-control" required name="tgl_lahir">
                                        </div>
                                        <div class="form-group">
                                            <label>Jenis Kelamin <font color="red">*</font></label>
                                            <select name="jenis_kelamin" required class="form-control select2">
                                                <option value="">...</option>
                                                <option value="L">Laki-laki</option>
                                                <option value="P">Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>No. HP <font color="red">*</font></label>
                                            <input type="text" class="form-control" required name="no_hp">
                                        </div>
                                        <div class="form-group">
                                            <label>Email <font color="red">*</font></label>
                                            <input type="email" class="form-control" required name="email">
                                        </div>
                                    </div>
                                    <div class="card-body col-lg-6">
                                        <div class="form-group">
                                            <label>Alamat <font color="red">*</font></label>
                                            <input type="text" class="form-control" required name="alamat">
                                        </div>
                                        <div class="form-group">
                                            <label>Provinsi <font color="red">*</font></label>
                                            <div id="dropdown_provinsi"></div>
                                            <script>
                                                dropdown('dropdown_provinsi', 'provinsi', 'nama_provinsi','','','','required')
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
                                                $(document).ready(function() {
                                                    $('#dropdown_provinsi').change(function(e) {
                                                        e.preventDefault();
                                                        dropdown('dropdown_kabupaten', 'kabupaten', 'nama_kabupaten', 0, parseInt($('#provinsi').val()), '', 'required')
                                                    });
                                                })
                                            </script>
                                        </div>
                                        <div class="form-group">
                                            <label>Ahli Waris <font color="red">*</font></label>
                                            <input type="text" class="form-control" required name="ahli_waris">
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
                                                dropdown('dropdown_cabang', 'cabang', 'cabang',id,'',where,'required')
                                                // dropdownCustom({
                                                //     name: 'dropdown_cabang',
                                                //     table: 'cabang',
                                                //     field: 'cabang',
                                                //     req: 'required'
                                                // })
                                            </script>
                                        </div>
                                        <div class="form-group">
                                            <label>Marketing</label>
                                            <div id="dropdown_marketing"></div>
                                            <script>
                                                dropdown('dropdown_marketing', 'marketing', 'nama_marketing')
                                            </script>
                                        </div>
                                        <div class="form-group">
                                            <label>Upload KTP <font color="red">*</font></label>
                                            <input type="file" id="ktp" class="form-control" required name="ktp">
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
<?php session_start() ?>
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
                        <h1 class="m-0">Tambah Reimburse</h1>
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
                                            <label>Nomor <font color="red">*</font></label>
                                            <input type="text" class="form-control" required name="nomor">
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal <font color="red">*</font></label>
                                            <input type="date" class="form-control" required name="tanggal">
                                        </div>
                                        <div class="form-group">
                                            <label>Pembayaran <font color="red">*</font></label>
                                            <input type="text" class="form-control" required name="pembayaran">
                                        </div>
                                        <div class="form-group">
                                            <label>Nominal <font color="red">*</font></label>
                                            <input type="text" class="form-control" required name="nominal" onkeydown="return numbersonly(this, event);" onkeyup="tandaPemisahTitik(this);">
                                        </div>
                                    </div>
                                    <div class="card-body col-lg-6">
                                        <div class="form-group">
                                            <label>Akun Kas/Bank <font color="red">*</font></label>
                                            <div id="dropdown_kas"></div>
                                            <?php
                                            if ($_SESSION['role_id'] == 1) {
                                                // $where = "WHERE cabang_id IS NOT NULL";
                                                $where = "WHERE cabang_id = $_SESSION[cabang_id]";
                                            } else {
                                                $where = "WHERE cabang_id = $_SESSION[cabang_id]";
                                            }
                                            echo "<script>
                                            let where2 = '$where';
                                            </script>";
                                            ?>
                                            <script>
                                                dropdown('dropdown_kas', 'kas', 'nama_kas', '', '', where2, 'required')
                                            </script>
                                        </div>
                                        <div class="form-group">
                                            <label>Keterangan <font color="red">*</font></label>
                                            <input type="text" class="form-control" required name="keterangan">
                                        </div>
                                        <div class="form-group">
                                            <label>Bukti</label>
                                            <input type="file" id="bukti" class="form-control" name="bukti">
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
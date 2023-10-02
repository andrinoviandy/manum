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
                        <h1 class="m-0">Tambah Marketing</h1>
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
                                            <label>NIK <font color="red">*</font></label>
                                            <input type="text" class="form-control" required name="nik">
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Marketing <font color="red">*</font></label>
                                            <input type="text" class="form-control" required name="nama">
                                        </div>
                                        <div class="form-group">
                                            <label>No HP <font color="red">*</font></label>
                                            <input type="text" class="form-control" required name="no_hp">
                                        </div>
                                    </div>
                                    <div class="card-body col-lg-6">
                                        <div class="form-group">
                                            <label>Email <font color="red">*</font></label>
                                            <input type="email" class="form-control" required name="email">
                                        </div>
                                        <div class="form-group">
                                        <label>Photo <font color="red">*</font></label>
                                        <input type="file" id="photo" class="form-control" required name="photo">
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
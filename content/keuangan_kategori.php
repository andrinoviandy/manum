<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-8">
                    <h1>Kategori Keuangan</h1>
                </div>
                <div class="col-4">
                    <?php include('btn/add.php') ?>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header center">
                            <?php include('show/show.php') ?>
                            <?php include('search/search.php') ?>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kategori</th>
                                        <th>Jenis</th>
                                        <td width="10%" style="position: sticky; right:0;" class="btn-default text-bold" align="center">Aksi</td>
                                    </tr>
                                </thead>
                                <tbody id="tbody">
                                    <?php include('loading/loading.php') ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <?php include('paging/paging.php') ?>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

</div>
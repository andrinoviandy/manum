<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Manajemen Travel Haji/Umrah | Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- sweetalert2 -->
  <link rel="stylesheet" href="dist/sweetalert2/sweetalert2.min.css">
  <link rel="icon" href="dist/img/ikon.png" class="img-rounded">

  <!-- <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.css"> -->
</head>

<body class="hold-transition lockscreen">
  <div class="d-flex justify-content-center" style="height: 100vh;">
    <div class="col-12 col-lg-6 col-md-6" style="display: flex; align-items:center; background-image: url('dist/img/bg.jpg'); background-size: cover; background-repeat: no-repeat; background-position: center;">
      <div class="lockscreen-wrapper">
        <form onsubmit="login(); return false" id="formData">
          <div class="lockscreen-logo">
            <div class="" style="color: #873e23;"><b>Travel</b> Umrah/Haji Plus</div>
          </div>
          <div class="card p-5" style="background: rgba(255, 255, 255, 0.5);">
            <div class="row mb-1">
              <div class="lockscreen-item col-12">
                <!-- lockscreen image -->
                <div class="lockscreen-image">
                  <img src="dist/img/user.png" alt="User">
                </div>
                <!-- /.lockscreen-image -->

                <!-- lockscreen credentials (contains the form) -->
                <div class="lockscreen-credentials">
                  <div class="input-group">
                    <input type="text" class="form-control" name="username" placeholder="Masukkan Username..." style="height: 40px;">

                    <!-- <div class="input-group-append">
                      <button type="button" class="btn">
                        <i class="fas fa-user text-muted"></i>
                      </button>
                    </div> -->
                  </div>
                </div>
                <!-- /.lockscreen credentials -->

              </div>
            </div>
            <div class="row">
              <div class="lockscreen-item col-12">
                <!-- lockscreen image -->
                <div class="lockscreen-image">
                  <img src="dist/img/password.png" alt="Password">
                </div>
                <!-- /.lockscreen-image -->

                <!-- lockscreen credentials (contains the form) -->
                <div class="lockscreen-credentials">
                  <div class="input-group">
                    <input type="password" class="form-control" name="password" placeholder="Masukkan Password" style="height: 40px;">

                    <!-- <div class="input-group-append">
                      <button type="button" class="btn">
                        <i class="fas fa-arrow-right text-muted"></i>
                      </button>
                    </div> -->
                  </div>
                </div>
                <!-- /.lockscreen credentials -->

              </div>
            </div>
            <div class="row">
              <div class="col-12 text-center">
                <button class="btn btn-primary pr-4 pl-" type="submit"><i class="fas fa-check-circle"></i>&nbsp; Login</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="action/function.js"></script>
  <!-- sweetalert2 -->
  <script src="dist/sweetalert2/sweetalert2.min.js"></script>
</body>

</html>
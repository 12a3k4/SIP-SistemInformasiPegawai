<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= htmlspecialchars($judul) ?></title> <!-- XSS Protection -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <!-- Menyederhanakan path dan memperbaiki urutan -->
  <link rel="stylesheet" href="<?= base_url('template/admin/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('template/admin/bower_components/font-awesome/css/font-awesome.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('template/admin/dist/css/AdminLTE.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('template/admin/plugins/iCheck/square/blue.css') ?>">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  
  <style>
    html, body {
      height: 100%;
      margin: 0;
      overflow-y: auto; /* Untuk handle overflow konten */
    }
    
    .main-container {
      min-height: 100vh;
      display: flex;
      flex-wrap: wrap; /* Untuk responsif mobile */
    }
    
    .left-container {
      flex: 1 1 40%;
      min-height: 400px; /* Height minimum untuk mobile */
      background-image: 
        linear-gradient(to bottom right, rgba(38, 95, 200, 0.6), rgba(0, 0, 0, 0.73)),
        url("<?= base_url('template/4.png') ?>");
      background-size: cover;
      background-position: center;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    
    .right-container {
      flex: 1 1 60%;
      background-color: rgb(38, 94, 137);
      padding: 2rem;
      background-image: 
        url("<?= base_url('template/bg2.jpg') ?>");
      display: flex;
      align-items: center;
      justify-content: center;
    }
    
    .card {
      background: rgb(111, 154, 255);
      border-radius: 20px;
      padding: 30px;
      width: 100%;
      max-width: 600px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      position: relative;
    }
    
    .card-title {
      font-size: 28px; /* Perbesar ukuran judul login */
      font-weight: 800;
      text-align: center; /* Rata tengah */
      margin-bottom: 20px;
    }

    .right-container h5,
    .right-container h4 {
      font-size: 20px;
      font-weight: 600;
      text-align: center;
    }

    .logo {
      display: block;
      margin: 0 auto 20px auto;
      max-width: 120px;
      height: auto;
    }
    
    @media (max-width: 768px) {
      .main-container {
        flex-direction: column;
      }
      .left-container,
      .right-container {
        width: 100%;
        flex-basis: auto;
      }
    }
  </style>
</head>
<body>
  <div class="main-container">
    <div class="left-container">
      <div class="text-container">
      </div>
    </div>
    <div class="right-container">
      <div class="card">
        <img class="logo" src="https://www.setneg.go.id/classic/topbar/assets/images/logo-blue2x.png" alt="Logo Sistem">
        <h5>Selamat Datang di Website SIP (Sistem Informasi Pegawai)</h5>
        <h5>Dewan Pertimbangan Presiden Republik Indonesia</h5>
        <h2 class="card-title">LOGIN</h2>
        <?= $this->session->flashdata('pesan'); ?>
        <form action="" method="post"> <!-- Path login diubah agar sama dengan kode kedua -->         
          <div class="form-group has-feedback">
            <input type="text" class="form-control" name="username" placeholder="Username" required autocomplete="username">
            <span class="fa fa-user form-control-feedback"></span>
          </div>
          
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password" placeholder="Password" required autocomplete="current-password">
            <span class="fa fa-lock form-control-feedback"></span>
          </div>
          
          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox" name="remember"> Ingat Saya
                </label>
              </div>
            </div>
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat" name="login">Masuk</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

<!-- jQuery 3 -->
<script src="<?= base_url('template/admin/') ?>/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= base_url('template/admin/') ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?= base_url('template/admin/') ?>/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
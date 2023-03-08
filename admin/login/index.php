<?php
error_reporting(0);
session_start();

require_once('../config/koneksi.php');
require_once('../modul/database.php');

$koneksi = new Database($host, $user, $pass, $dbase);
include '../login/modlog.php';

$user = new Login($koneksi);
?>




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Adm0n ngodinG</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../css/adminlte.min.css">
  <link rel="icon" href="../img/credit/logotop.svg" type="image/x-icon">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h1"><b>Adm0n</b> ngodinG</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Masuk untuk memulai admin</p>

      <form action="" method="POST" enctype="multipart/form-data">
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" id="email" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="pass" id="pass">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" name="login" value="login" class="btn btn-primary btn-block">Log In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <?php
      if ($_POST['login']) 
      {
        $user1 = $koneksi->con->real_escape_string($_POST['email']);
        $pass = md5($koneksi->con->real_escape_string($_POST['pass']));
        $masuk = $user->loginAdmin($user1, $pass);
        $reslt = $masuk->fetch_object();
        if ($reslt) {
            $_SESSION['loginadmin']=true;
            header('Location:../');
            //echo "<script>window.location='../'</script>;";
            exit;
        }
      }
      ?>

          <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../js/adminlte.min.js"></script>
</body>
</html>

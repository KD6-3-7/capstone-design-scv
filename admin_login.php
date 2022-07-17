<!DOCTYPE html>
<?php session_start(); ?>
<html lang="ko">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Login</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/login.css" rel="stylesheet">
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body>
  <div class="container">
    <img class="mb-4" style="margin-left: auto; margin-right: auto; display: block;" src="logo.png" alt="Logo" width="200" height="200">
    <h3 class="mb-3 form-weight-normal text-center">Silver Care Vision</h3>
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">관리자 로그인</div>
      <div class="card-body">
        <form method="post" action="admin_login_process.php">
          <?php if(!isset($_SESSION['admin_id'])) { ?>
          <div class="form-group">
            <label for="inputID">Admin ID</label>
            <input type="text" id="inputID" class="form-control" name="admin_id" placeholder="아이디" required autofocus>
          </div>
          <div class="form-group">
            <label for="inputPassword">Password</label>
            <input type="password" id="inputPassword" class="form-control" name="user_pw" placeholder="비밀번호" required>
          </div>
          <button class="btn btn-primary btn-block" type="submit">Login
        </form>
        <?php } else {
          echo "<script>location.replace('admin_dashboard.php');</script>";}
        ?>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>
</html>

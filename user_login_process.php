<?php
  $conn = mysqli_connect('localhost','root','password','users_db');
  $username = $_POST['user_id'];
  $password = $_POST['user_pw'];

  $query = "SELECT username, password, email FROM users WHERE username='$username' AND password='$password'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    session_start();
    $_SESSION['user_id']=$username;
    echo("<script>location.replace('user_dashboard.php');</script>");
  }
  else {
    header("Content-Type: text/html; charset=UTF-8");
    echo "<script>alert('아이디 또는 비밀번호가 일치하지 않습니다.');";
    echo "window.location.replace('user_login.php');</script>";
    exit;
  }
?>

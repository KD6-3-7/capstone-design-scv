<?php
  $conn = mysqli_connect('localhost', 'root', 'password', 'scv');
  $sex = $_POST['SEX'];
  $age = $_POST['AGE'];
  $sbp = $_POST['SBP'];
  $dbp = $_POST['DBP'];
  $fbs = $_POST['FBS'];
  $fbs = !empty($fbs) ? "'$fbs'" : "NULL";
  $height = $_POST['height'];
  $weight = $_POST['weight'];
  $bmi = round($weight/($height/100*$height/100),1);

  if($fbs != "NULL") {
    $sql = "UPDATE basic_info SET SEX = '$sex', AGE = '$age', SBP = '$sbp', DBP = '$dbp', FBS = $fbs, BMI = '$bmi', height = '$height', weight = '$weight' WHERE ID = 1";
    $result = mysqli_query($conn, $sql);
  }
  else {
    $fbs_age = "SELECT AVG(FBS) AS FBS_AGE FROM diabetes_all WHERE AGE = '$age'";
    $fbs_age = mysqli_query($conn, $fbs_age);
    $row1 = mysqli_fetch_array($fbs_age);
    $fbs_age = floor($row1['FBS_AGE']);

    $fbs_bmi = "SELECT AVG(FBS) AS FBS_BMI FROM diabetes_all WHERE BMI = '$bmi'";
    $fbs_bmi = mysqli_query($conn, $fbs_bmi);
    $row2 = mysqli_fetch_array($fbs_bmi);
    $fbs_bmi = floor($row2['FBS_BMI']);

    $fbs_agebmi = "SELECT AVG(FBS) AS FBS_AGEBMI FROM diabetes_all WHERE AGE = '$age' AND BMI = '$bmi'";
    $fbs_agebmi = mysqli_query($conn, $fbs_agebmi);
    $row3 = mysqli_fetch_array($fbs_agebmi);
    $fbs_agebmi = floor($row3['FBS_AGEBMI']);

    if($fbs_agebmi != "NULL") {
      $fbs_alt = $fbs_agebmi;
    }
    else {
      if($fbs_age != "NULL" && $fbs_bmi != "NULL"){
        $fbs_alt = floor(($fbs_age+$fbs_bmi)/2);
      }
      else if($fbs_age == "NULL") {
        $fbs_alt = $fbs_bmi;
      }
      else if($fbs_bmi == "NULL") {
        $fbs_alt = $fbs_age;
      }
    }

    $sql = "UPDATE basic_info SET SEX = '$sex', AGE = '$age', SBP = '$sbp', DBP = '$dbp', FBS = '$fbs_alt', BMI = '$bmi', height = '$height', weight = '$weight' WHERE ID = 1";
    $result = mysqli_query($conn, $sql);
  }

  if($result == false) {
    header("Content-Type: text/html; charset=UTF-8");
    echo "<script>alert('저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요.');";
    echo "window.location.replace('user_info.php');</script>";
  }
  else {
    echo("<script>location.replace('user_info.php');</script>");
  }
?>

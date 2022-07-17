<!DOCTYPE html>
<?php
  session_start();
  if(!isset($_SESSION['admin_id'])) {
  echo "<script>alert('로그인이 필요한 서비스 입니다.');</script>";
  echo "<script>location.replace('index.php');</script>";
  exit;
  }
  require_once('view/admin_top.php');
?>

  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="admin_dashboard.php">대시보드</a>
        </li>
        <li class="breadcrumb-item">
          <a href="admin_sleeptime.php">당뇨 예측</a>
        </li>
        <li class="breadcrumb-item active">예측 알고리즘 실행</li>
      </ol>
      <div class="container">
        <div class="card card-register mx-auto mt-auto">
          <div class="card-header">당뇨 예측 진단</div>
          <div class="card-body">
            <form class="text-center">
              <?php
                function Print_Exe_Time($start_time) {
                  $end_time = microtime(); // 종료시간
                  $start_sec = explode(" ",  $start_time); // 초와 마이크로 초를 공백으로 구분
                  $end_sec = explode(" ", $end_time);
                  $rap_micsec = $end_sec[0] - $start_sec[0]; // 실행시간 microsecond
                  $rap_sec = $end_sec[1] - $start_sec[1]; // 실행시간 second
                  $rap = $rap_sec + $rap_micsec;
                  echo("실행시간 $rap 초 \n");
                }

                $start_time = microtime(); // 페이지 상단
                echo "---- 진단 시작 ---- <br>";

                exec('python C:\Bitnami\wampstack-7.1.15-0\apache2\test_layer_180518.py 2>&1 ', $output, $return);
                echo "<br>";

                if (!$return) {
                  echo "계산이 완료되었습니다.";
                  echo "<br>";
                  echo("<br>".$output[15]);
                  echo("<br>".$output[16]);
                  echo("<br>".$output[17]);
                }
                else {
                  echo "오류가 발생하였습니다.";
                }

                echo "<br>";
                echo "<br>---- 전송 완료 ----<br>";
                echo "<br>";
                Print_Exe_Time($start_time); // 페이지 하단
                echo "<br>";
                echo "<br>";
              ?>
              '현재 상태' 페이지가 업데이트되었습니다.<br><br>
              <a class="btn btn-primary btn-block" href="user_dashboard.php">결과 확인하기</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php
  require_once('view/bottom.php');
?>

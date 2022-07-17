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
          <a href="admin_sleeptime.php">수면 모니터링</a>
        </li>
        <li class="breadcrumb-item active">사용자 별 수면 패턴</li>
      </ol>
      <div class="row">
        <div class="col-lg-6">
          <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>
          <?php
            $conn = mysqli_connect("localhost", "root", "password", "scv");
            $sql = "SELECT deep, light, rem, wake FROM sleeptoday WHERE id = 1";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_object($result);
            $deep = htmlspecialchars($row->deep);
            $light = htmlspecialchars($row->light);
            $rem = htmlspecialchars($row->rem);
            $wake = htmlspecialchars($row->wake);
            $total = $deep + $light + $rem + $wake;
          ?>

          <!-- Area Chart Example-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-chart-pie"></i> 수면 패턴 그래프</div>
            <div class="card-body">
              <canvas id="myDoughnutChart" width="100%" height="100"></canvas>
            </div>
          </div>
        </div>

        <script>
          var ctx = document.getElementById("myDoughnutChart");
          var myDoughnutChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
              datasets: [{
                data: [<?php echo $wake; ?>, <?php echo $light; ?>, <?php echo $deep; ?>],
                backgroundColor: ['rgba(213,15,37,0.5)','rgba(250,188,9,0.5)','rgba(22,160,133,0.5)'],
              }],
              labels: ["깨어있음","선잠","숙면"],
            },
          });
        </script>

        <!-- Status Card-->
        <div class="col-lg-6">
          <div class="mb-3">
            <div class="wrimagecard wrimagecard-topimage">
              <div class="wrimagecard-topimage_header" style="background-color:rgba(51, 105, 232, 0.1)">
                <center><div style="font-size:2em; font-weight:bold;"><?php echo $total; ?> 분</div></center>
              </div>
              <div class="wrimagecard-topimage_title">
                <h4><i class="fas fa-user-clock" style="color:#3369e8; font-size:1.5em;"></i>
                  <div class="pull-right badge">총 수면시간</div></h4>
              </div>
            </div>
          </div>
          <div class="mb-3">
            <div class="wrimagecard wrimagecard-topimage">
              <div class="wrimagecard-topimage_header" style="background-color:rgba(213, 15, 37, 0.1)">
                <center><div style="font-size:2em; font-weight:bold;"><?php echo $wake; ?> 분</div></center>
              </div>
              <div class="wrimagecard-topimage_title">
                <h4><i class="fas fa-user-clock" style="color:#d50f25; font-size:1.5em;"></i>
                  <div class="pull-right badge">깨어있음</div></h4>
              </div>
            </div>
          </div>
          <div class="mb-3">
            <div class="wrimagecard wrimagecard-topimage">
              <div class="wrimagecard-topimage_header" style="background-color:rgba(250, 188, 9, 0.1)">
                <center><div style="font-size:2em; font-weight:bold;"><?php echo $light; ?> 분</div></center>
              </div>
              <div class="wrimagecard-topimage_title">
                <h4><i class="fas fa-user-clock" style="color:#fabc09; font-size:1.5em;"></i>
                  <div class="pull-right badge">선잠</div></h4>
              </div>
            </div>
          </div>
          <div class="mb-3">
            <div class="wrimagecard wrimagecard-topimage">
              <div class="wrimagecard-topimage_header" style="background-color:rgba(22, 160, 133, 0.1)">
                <center><div style="font-size:2em; font-weight:bold;"><?php echo $deep; ?> 분</div></center>
              </div>
              <div class="wrimagecard-topimage_title">
                <h4><i class="fas fa-user-clock" style="color:#16A085; font-size:1.5em;"></i>
                  <div class="pull-right badge">숙면</div></h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php
  require_once('view/bottom.php');
?>

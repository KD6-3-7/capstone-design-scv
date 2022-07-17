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
          <a href="admin_state.php">현재 상태</a>
        </li>
        <li class="breadcrumb-item active">사용자 별 상태</li>
      </ol>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>
      <?php
        $conn = mysqli_connect("localhost", "root", "password", "scv");
        $sql = "SELECT * FROM (SELECT * FROM hrtoday ORDER BY id DESC LIMIT 300) t ORDER BY id ASC";
        $result = mysqli_query($conn, $sql);
        $HIS = '';
        $rate = '';
        while ($array = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
          $HIS .= '"' . $array['time'] . '"' . ',';
          $rate .= $array['HR'] . ',';
        }
      ?>

      <!-- Line Chart -->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fas fa-chart-line"></i> 심박수 그래프</div>
        <div class="card-body">
          <canvas id="myLineChart" width="100%" height="30"></canvas>
        </div>
      </div>

      <script>
        var ctx = document.getElementById("myLineChart");
        var myLineChart = new Chart(ctx, {
          type: 'line',
          data: {
            labels: [<?php echo $HIS; ?>],
            datasets: [{
              label: "Heart Rate",
              lineTension: 0.3,
              backgroundColor: "rgba(2,117,216,0.2)",
              fill: false,
              borderColor: "rgba(75,192,192,1)",
              borderWidth: 5,
              pointRadius: 0,
              pointBackgroundColor: "rgba(75,192,192,1)",
              pointBorderColor: "rgba(255,255,255,0.8)",
              pointHoverRadius: 7,
              pointHoverBackgroundColor: "rgba(75,192,192,1)",
              pointHoverBorderColor: "rgba(255,255,255,1)",
              pointHitRadius: 20,
              pointBorderWidth: 2,
              data: [<?php echo $rate; ?>],
            }],
          },
          options: {
            scales: {
              xAxes: [{
                time: {
                  unit: 'date'
                },
                gridLines: {
                  display: false
                },
                ticks: {
                  maxTicksLimit: 15
                },
              }],
              yAxes: [{
                ticks: {
                  min: 50,
                  max: 130,
                  maxTicksLimit: 6
                },
                gridLines: {
                  color: "rgba(0, 0, 0, .125)",
                }
              }],
            },
            legend: {
              display: false
            }
          }
        });
      </script>

      <!-- Status Card-->
      <div class="container-fluid">
      	<div class="row">

          <?php
            $sql = "SELECT AVG(HR) AS HeartRate FROM hrtoday";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);
            $avg = round($row['HeartRate'], 0);
          ?>

          <div class="col-xl-4 col-sm-6 mb-3">
            <div class="wrimagecard wrimagecard-topimage">
              <div class="wrimagecard-topimage_header" style="background-color:rgba(187, 120, 36, 0.1)">
                <center><div style="font-size:2em; font-weight:bold;"><?php echo $avg; ?> bpm</div></center>
              </div>
              <div class="wrimagecard-topimage_title">
                <h4><i class="fas fa-file-medical-alt" style="color:#BB7824; font-size:1.5em;"></i>
                <div class="pull-right badge">평균 심박수</div></h4>
              </div>
            </div>
          </div>

          <?php
            $sql = "SELECT HR FROM hrtoday ORDER BY id DESC LIMIT 1";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);
          ?>

          <div class="col-xl-4 col-sm-6 mb-3">
            <div class="wrimagecard wrimagecard-topimage">
              <div class="wrimagecard-topimage_header" style="background-color:rgba(51, 105, 232, 0.1)">
                <center><div style="font-size:2em; font-weight:bold;"><?php echo $row['HR']; ?> bpm</div></center>
              </div>
              <div class="wrimagecard-topimage_title">
                <h4><i class="fa fa-heartbeat" style="color:#3369e8; font-size:1.5em;"></i>
                <div class="pull-right badge">현재 심박수</div></h4>
              </div>
            </div>
        	</div>

          <?php
            $sql = "SELECT SBP, DBP FROM basic_info WHERE ID = 1";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_object($result);
            $sbp = htmlspecialchars($row->SBP);
            $dbp = htmlspecialchars($row->DBP);
          ?>

          <div class="col-xl-4 col-sm-6 mb-3">
            <div class="wrimagecard wrimagecard-topimage">
              <div class="wrimagecard-topimage_header" style="background-color:rgba(22, 160, 133, 0.1)">
                <center><div style="font-size:2em; font-weight:bold;"><?php echo $sbp; ?> / <?php echo $dbp; ?></div></center>
              </div>
              <div class="wrimagecard-topimage_title">
                <h4><i class="fa fa-stethoscope" style="color:#16A085; font-size:1.5em;"></i>
                <div class="pull-right badge">최고 / 최저 혈압</div></h4>
              </div>
            </div>
          </div>

          <?php
            $sql = "SELECT hypothesis, dis FROM accuracy WHERE ID = 1";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_object($result);
            $hyp = htmlspecialchars($row->hypothesis);
            $dis = htmlspecialchars($row->dis);
            $percent = round($hyp*100,2);
          ?>

          <div class="col-xl-4 col-sm-6 mb-3">
            <div class="wrimagecard wrimagecard-topimage">
              <div class="wrimagecard-topimage_header" style="background-color:rgba(250, 188, 9, 0.1)">
                <center><div style="font-size:2em; font-weight:bold;"><?php if ($dis == "0") echo "정상"; else if ($dis == "1") echo "위험"; else if ($dis == NULL) echo "null"; ?></div>
                </center>
              </div>
              <div class="wrimagecard-topimage_title">
                <h4><i class="fas fa-notes-medical" style="color:#fabc09; font-size:1.5em;"></i>
                <div class="pull-right badge">당뇨 위험 예측</div></h4>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-sm-6 mb-3">
            <div class="wrimagecard wrimagecard-topimage">
              <div class="wrimagecard-topimage_header" style="background-color:rgba(250, 188, 9, 0.1)">
                <div style="font-size:2em; font-weight:bold;">
                  <span class="iGraph">
                    <span class="gBar">
                      <span class="gAction" style="width:<?php echo $percent; ?>%;"></span>
                    </span>
                  </span>
                </div>
              </div>
              <div class="wrimagecard-topimage_title">
                <h4><i class="fas fa-notes-medical" style="color:#fabc09; font-size:1.5em;"></i>
                <div class="pull-right badge">위험도: <?php echo $percent; ?>%</div></h4>
              </div>
            </div>
          </div>

          <?php
            $sql = "SELECT SUM(step) AS TotalSteps FROM steptoday";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);
          ?>

          <div class="col-xl-4 col-sm-6 mb-3">
            <div class="wrimagecard wrimagecard-topimage">
              <div class="wrimagecard-topimage_header" style="background-color:rgba(213, 15, 37, 0.1)">
                <center><div style="font-size:2em; font-weight:bold;"><?php echo $row['TotalSteps']; ?> 보</div></center>
              </div>
              <div class="wrimagecard-topimage_title">
                <h4><i class="fas fa-shoe-prints" style="color:#d50f25; font-size:1.5em;"></i>
                <div class="pull-right badge">일일 걸음수</div></h4>
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

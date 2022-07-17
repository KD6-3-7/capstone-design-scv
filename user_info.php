<!DOCTYPE html>
<?php
  session_start();
  if(!isset($_SESSION['user_id'])) {
  echo "<script>alert('로그인이 필요한 서비스 입니다.');</script>";
  echo "<script>location.replace('index.php');</script>";
  exit;
  }
  require_once('view/user_top.php');
?>

  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="container">
        <div class="card card-register mx-auto mt-auto">
          <div class="card-header">사용자 기본 정보</div>
          <div class="card-body">
            <form>
              <?php
                $conn = mysqli_connect("localhost", "root", "password", "scv");
                $sql = "SELECT * FROM basic_info WHERE ID = 1";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_object($result);
                $sex = htmlspecialchars($row->SEX);
                $age = htmlspecialchars($row->AGE);
                $sbp = htmlspecialchars($row->SBP);
                $dbp = htmlspecialchars($row->DBP);
                $fbs = htmlspecialchars($row->FBS);
                $bmi = htmlspecialchars($row->BMI);
                $height = htmlspecialchars($row->height);
                $weight = htmlspecialchars($row->weight);
              ?>
              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-6">
                    <label for="SEX">성별</label>
                    <div class="form-group">
                      <input class="form-control" id="SEX" type="text" placeholder="" <?php if ($sex == "1") echo "value=\"남\""; else if ($sex == "2") echo "value=\"여\""; ?> readonly/> <!-- 1 = male, 2 = female -->
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label for="AGE">연령</label>
                    <div class="form-group">
                      <input class="form-control" id="AGE" type="text" placeholder=""
                      <?php
                        if ($age == "1") echo "value=\"20-24\"";
                        else if ($age == "2") echo "value=\"25-26\"";
                        else if ($age == "3") echo "value=\"27-28\"";
                        else if ($age == "4") echo "value=\"29-30\"";
                        else if ($age == "5") echo "value=\"31-32\"";
                        else if ($age == "6") echo "value=\"33-34\"";
                        else if ($age == "7") echo "value=\"35-36\"";
                        else if ($age == "8") echo "value=\"37-38\"";
                        else if ($age == "9") echo "value=\"39-40\"";
                        else if ($age == "10") echo "value=\"41-42\"";
                        else if ($age == "11") echo "value=\"43-44\"";
                        else if ($age == "12") echo "value=\"45-46\"";
                        else if ($age == "13") echo "value=\"47-48\"";
                        else if ($age == "14") echo "value=\"49-50\"";
                        else if ($age == "15") echo "value=\"51-52\"";
                        else if ($age == "16") echo "value=\"53-54\"";
                        else if ($age == "17") echo "value=\"55-56\"";
                        else if ($age == "18") echo "value=\"57-58\"";
                        else if ($age == "19") echo "value=\"59-60\"";
                        else if ($age == "20") echo "value=\"61-62\"";
                        else if ($age == "21") echo "value=\"63-64\"";
                        else if ($age == "22") echo "value=\"65-66\"";
                        else if ($age == "23") echo "value=\"67-68\"";
                        else if ($age == "24") echo "value=\"69-70\"";
                        else if ($age == "25") echo "value=\"71-72\"";
                        else if ($age == "26") echo "value=\"73-74\"";
                        else if ($age == "27") echo "value=\"75-\"";
                      ?> readonly/>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-4">
                    <label for="SBP">최대 혈압</label>
                    <div class="form-group">
                      <input class="form-control" id="SBP" type="number" placeholder="예시) 110" value="<?=$sbp?>" readonly/>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <label for="DBP">최소 혈압</label>
                    <div class="form-group">
                      <input class="form-control" id="DBP" type="number" placeholder="예시) 70" value="<?=$dbp?>" readonly/>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <label for="FBS">공복 혈당</label>
                    <div class="form-group">
                      <input class="form-control" id="FBS" type="number" placeholder="모르실 경우 공백으로 비워주세요." value="<?=$fbs?>" readonly/>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-4">
                    <label for="height">신장 (cm)</label>
                    <div class="form-group">
                      <input class="form-control" id="height" type="number" placeholder="예시) 170" value="<?=$height?>" readonly/>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <label for="weight">몸무게 (kg)</label>
                    <div class="form-group">
                      <input class="form-control" id="weight" type="number" placeholder="예시) 60" value="<?=$weight?>" readonly/>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <label for="BMI">체질량지수 (BMI)</label>
                    <div class="form-group">
                      <input class="form-control" type="number" id="bmi" placeholder="BMI" value="<?=$bmi?>" readonly/>
                    </div>
                  </div>
                </div>
              </div>
              * 공복 혈당 란을 공백으로 비워둘 시 자동으로 입력되는 값은 공공데이터에 기반하여 추산한 값이기에 실제와 다소 차이가 있을 수 있습니다. <br><br>
              <a class="btn btn-primary btn-block" href="user_info_update.php">기본 정보 수정하기</a>
            </form>
          </div>
        </div>
      </div>
    </div>
    <br>
  </div>

<?php
  require_once('view/bottom.php');
?>

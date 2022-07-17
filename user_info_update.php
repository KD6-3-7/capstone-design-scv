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
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="user_info.php">사용자 기본 정보</a>
        </li>
        <li class="breadcrumb-item active">입력 정보 수정</li>
      </ol>

      <div class="container">
        <div class="card card-register mx-auto mt-auto">
          <div class="card-header">사용자 기본 정보 입력</div>
          <div class="card-body">
            <form action="user_info_update_process.php" method="POST">
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
                      <select class="form-control" id="sex" name="SEX">
                        <option value="1" <?php if ($sex == "1") echo "selected"; ?>>남</option> <!-- 1 = male, 2 = female -->
                        <option value="2" <?php if ($sex == "2") echo "selected"; ?>>여</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label for="AGE">연령</label>
                    <div class="form-group">
                      <select class="form-control" id="age" name="AGE">
                        <option value="1" <?php if ($age == "1") echo "selected"; ?>>20-24</option>
                        <option value="2" <?php if ($age == "2") echo "selected"; ?>>25-26</option>
                        <option value="3" <?php if ($age == "3") echo "selected"; ?>>27-28</option>
                        <option value="4" <?php if ($age == "4") echo "selected"; ?>>29-30</option>
                        <option value="5" <?php if ($age == "5") echo "selected"; ?>>31-32</option>
                        <option value="6" <?php if ($age == "6") echo "selected"; ?>>33-34</option>
                        <option value="7" <?php if ($age == "7") echo "selected"; ?>>35-36</option>
                        <option value="8" <?php if ($age == "8") echo "selected"; ?>>37-38</option>
                        <option value="9" <?php if ($age == "9") echo "selected"; ?>>39-40</option>
                        <option value="10" <?php if ($age == "10") echo "selected"; ?>>41-42</option>
                        <option value="11" <?php if ($age == "11") echo "selected"; ?>>43-44</option>
                        <option value="12" <?php if ($age == "12") echo "selected"; ?>>45-46</option>
                        <option value="13" <?php if ($age == "13") echo "selected"; ?>>47-48</option>
                        <option value="14" <?php if ($age == "14") echo "selected"; ?>>49-50</option>
                        <option value="15" <?php if ($age == "15") echo "selected"; ?>>51-52</option>
                        <option value="16" <?php if ($age == "16") echo "selected"; ?>>53-54</option>
                        <option value="17" <?php if ($age == "17") echo "selected"; ?>>55-56</option>
                        <option value="18" <?php if ($age == "18") echo "selected"; ?>>57-58</option>
                        <option value="19" <?php if ($age == "19") echo "selected"; ?>>59-60</option>
                        <option value="20" <?php if ($age == "20") echo "selected"; ?>>61-62</option>
                        <option value="21" <?php if ($age == "21") echo "selected"; ?>>63-64</option>
                        <option value="22" <?php if ($age == "22") echo "selected"; ?>>65-66</option>
                        <option value="23" <?php if ($age == "23") echo "selected"; ?>>67-68</option>
                        <option value="24" <?php if ($age == "24") echo "selected"; ?>>69-70</option>
                        <option value="25" <?php if ($age == "25") echo "selected"; ?>>71-72</option>
                        <option value="26" <?php if ($age == "26") echo "selected"; ?>>73-74</option>
                        <option value="27" <?php if ($age == "27") echo "selected"; ?>>75-</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>

              <script>
                //maxlength 체크
                function maxLengthCheck(object){
                  if (object.value.length > object.maxLength){
                    object.value = object.value.slice(0, object.maxLength);
                  }
                }
              </script>

              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-4">
                    <label for="SBP">최대 혈압</label>
                    <div class="form-group">
                      <input class="form-control" id="sbp" name="SBP" type="number" placeholder="예시) 110" min="0" max="999" maxlength="3" oninput="maxLengthCheck(this)" value="<?=$sbp?>">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <label for="DBP">최소 혈압</label>
                    <div class="form-group">
                      <input class="form-control" id="dbp" name="DBP" type="number" placeholder="예시) 70" min="0" max="999" maxlength="3" oninput="maxLengthCheck(this)" value="<?=$dbp?>">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <label for="FBS">공복 혈당</label>
                    <div class="form-group">
                      <input class="form-control" id="fbs" name="FBS" type="number" placeholder="모르실 경우 공백으로 비워주세요." min="0" max="999" maxlength="3" oninput="maxLengthCheck(this)" value="<?=$fbs?>">
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-2">
                    <label for="height">신장 (cm)</label>
                    <div class="form-group">
                      <input class="form-control" id="height" name="height" type="number" placeholder="예시) 170" min="0" max="999" maxlength="3" oninput="maxLengthCheck(this)" value="<?=$height?>">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <label for="weight">몸무게 (kg)</label>
                    <div class="form-group">
                      <input class="form-control" id="weight" name="weight" type="number" placeholder="예시) 60" min="0" max="999" maxlength="3" oninput="maxLengthCheck(this)" value="<?=$weight?>">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <label for="BMI">w/h^2</label>
                    <div class="form-group">
                      <input class="btn btn-outline-info btn-block" type="button" value="계산" onClick="calculateBmi()">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <label for="BMI">체질량지수 (BMI)</label>
                    <div class="form-group">
                      <input class="form-control" type="number" id="bmi" name="bmi" placeholder="계산 버튼을" readonly/>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <label for="status">상태</label>
                    <div class="form-group">
                      <input class="form-control" type="text" id="meaning" name="meaning" placeholder="클릭해주세요." readonly/>
                    </div>
                  </div>
                </div>
              </div>
              <button class="btn btn-outline-primary btn-block" type="submit">기본 정보 저장하기</button>
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

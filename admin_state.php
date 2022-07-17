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
        <li class="breadcrumb-item active">현재 상태</li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> 사용자 리스트</div>
        <?php
          //Change the password to match your configuration
          $link = mysqli_connect("localhost", "root", "password", "scv");
          // Check connection
          if($link === false)
          {
            die("ERROR: Could not connect. " . mysqli_connect_error());
          }
          echo "<br>";

          $sql = "SELECT id, name, birth, address, phone, status FROM user";
          $result = $link->query($sql);

          echo "<div class='card-body'>";
          	echo "<div class='table-responsive'>";
        			echo "<table class='table table-bordered table-hover' id='dataTable' width='100%'' cellspacing='0'>";
              echo "<thead class='thead-dark'>";
        			echo "<tr>";
              echo "<th>식별 코드</th>";
              echo "<th>이름</th>";
              echo "<th>생년월일</th>";
              echo "<th>주소</th>";
              echo "<th>전화번호</th>";
              echo "<th>현재 상태</th>";
        			echo "</tr>";
              echo "</thead>";

        			if ($result->num_rows > 0) {
        				// output data of each row
        				while($row = $result->fetch_assoc()) {
        					echo "<tr style=\"cursor: pointer;\" onClick=\"location.href='user_state.php?id=" .$row["id"]. "'\" onMouseOver=\"window.status='user_state.php?id=" .$row["id"]. "'\">";
        					echo "<td>" . $row["id"] . "</td>";
        					echo "<td>" . $row["name"] . "</td>";
        					echo "<td>" . $row["birth"] . "</td>";
                  echo "<td>" . $row["address"] . "</td>";
                  echo "<td>" . $row["phone"] . "</td>";
        					echo "<td>" . $row["status"] . "</td>";
        					echo "</tr>";
        				}
        			} else {
        				echo "0 results";
        			}
        			echo "</table>";
        		echo "</div>";
        	echo "</div>";

          // Close connection
          mysqli_close($link);
        ?>
      </div>
    </div>

<?php
  require_once('view/bottom.php');
?>

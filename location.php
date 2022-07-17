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
      <div id="map_container">
        <div id="map">
          <script async defer
          src="">
          </script>
          <?php
            $conn = mysqli_connect("localhost", "root", "password", "gps");
            $sql = "SELECT cur_lat, cur_lng FROM gps_info ORDER BY cur_time DESC LIMIT 1";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_object($result);
          ?>
          <script>
            function initialize() {
              var myLatlng = new google.maps.LatLng(<?php echo "$row->cur_lat"; ?>, <?php echo "$row->cur_lng"; ?>), mapOptions = {
                zoom: 17,
                center: myLatlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
              }
              var map = new google.maps.Map(document.getElementById('map'), mapOptions),
              contentString = '사용자의 현위치',
              infowindow = new google.maps.InfoWindow({
                content: contentString,
                maxWidth: 500
              });

              var marker = new google.maps.Marker({
                position: myLatlng,
                map: map
              });

              google.maps.event.addListener(marker, 'click', function() {
                infowindow.open(map,marker);
              });

              google.maps.event.addDomListener(window, "resize", function() {
                var center = map.getCenter();
                google.maps.event.trigger(map, "resize");
                  map.setCenter(center);
                });
              }

            google.maps.event.addDomListener(window, 'load', initialize);
          </script>
        </div>
      </div>
    </div>

<?php
  require_once('view/bottom.php');
?>

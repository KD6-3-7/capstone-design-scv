<?php
    session_start();
    if(isset($_SESSION['user_id'])) {
      unset($_SESSION['user_id']);
    }
    else if(isset($_SESSION['admin_id'])) {
      unset($_SESSION['admin_id']);
    }
?>
<meta http-equiv="refresh" content="0;url=index.php" />

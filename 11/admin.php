<?php
require_once 'inc/config.php';

print_r($_SESSION);
if (isset($_SESSION['userRole']) && $_SESSION['userRole'] == 'admin'){
  echo 'vous etes bien admin';
}
else {
  echo 'FBI STRIKE - yo mama will be called soon';
}
 ?>

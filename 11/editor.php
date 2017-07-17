<?php
require_once 'inc/config.php';

print_r($_SESSION);
if (isset($_SESSION['userRole']) && ($_SESSION['userRole'] == 'admin' || $_SESSION['userRole'] == 'editor')){
  echo 'vous etes bien admin ou editeur';
}
else {
  header('HTTP/1.0 403 Forbidden');
  echo '403';
}
 ?>

<?php
require_once "../inc/config.php";
require_once '../view/header.php';
require_once '../inc/functions.php';
require_once '../inc/def.php';
/* ----------------------------------------------------------------------------/
DEBUT DU CODE
------------------------------------------------------------------------------*/
if(!empty($_POST)){
psem($pdo);
}

/* ----------------------------------------------------------------------------/
FIN DU CODE
------------------------------------------------------------------------------*/
require '../view/signin.php';
require '../view/footer.php';
 ?>

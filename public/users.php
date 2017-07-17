<?php
require_once "../inc/config.php";
require_once "../inc/function.php";
require '../view/header.php';
/* ----------------------------------------------------------------------------/
DEBUT DU CODE
------------------------------------------------------------------------------*/
$usersArray = requeteSql($usersSQL,"fetchAll",$tokensArray,$pdo);
//Liste les users et leurs donnees en DB
echo "<h4>Utilisateurs</h4>";
foreach ($usersArray as $usr){
  echo "<h5>{$usr['sig_email']}</h5>";
  foreach ($usr as $key => $value){
    echo "{$key} => {$value}<br />";
  }
}
/* ----------------------------------------------------------------------------/
FIN DU CODE
------------------------------------------------------------------------------*/
require '../view/footer.php';
 ?>

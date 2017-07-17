<?php
require_once "../inc/config.php";
require_once '../view/header.php';
require_once '../inc/functions.php';
require_once '../inc/def.php';

/* ----------------------------------------------------------------------------/
DEBUT DU CODE
------------------------------------------------------------------------------*/

if(!empty($_GET)){
  if(isset($_GET['token'])){
    $tokenRecu = $_GET['token'];

    $sql = 'SELECT * FROM signup WHERE sig_token=:token';
    $pdoStatement = $pdo->prepare($sql);
    $pdoStatement->bindValue(':token', $tokenRecu);
    if ($pdoStatement->execute() === false) {
      print_r($pdoStatement->errorInfo());
    }
    // Si aucun erreur SQL
    else {
      $resultat = $pdoStatement->fetch(PDO::FETCH_ASSOC);
      print_r($resultat);
      echo "ca marche";
    }
  }
}//FIN

if(!empty($_POST)){
  print_r($_POST);
  $password = $_POST['password'];
  $id = $_POST['id'];
  $formValid=true;
  // if (empty($password) || empty($verif_password)) {
	// 	$formValid = false;
	// 	$errorList['password'][] = 'Le password est vide';
	// }
	// if ($password !== $verif_password) {
	// 	$formValid = false;
	// 	$errorList['password'][] = 'Les passwords sont différents';
	// }
	// if (strlen($password) < 8 || strlen($verif_password) < 8) {
	// 	$formValid = false;
	// 	$errorList['password'][] = 'Le password doit faire au moins 8 caractères';
	// }
  // $arrayPassword = str_split($password);
  // $checkPass = false;
  // $verificator = false;
  // foreach ($arrayPassword as $value){
  //   if ((ord($value) >= ord('A')) && (ord($value) <= ord('Z'))){
  //     $checkPass = true;
  //   }
  //   if ($value >= '0' && $value <= '9'){
  //     $verificator = true;
  //   }
  // }
  // if(!$checkPass){
  //   $formValid = false;
  //   $errorList['password'][] = 'Le password doit contenir une majuscule';
  // }
  // if(!$verificator){
  //   $formValid = false;
  //   $errorList['password'][] = 'Le password doit contenir un chiffre';
  // }
  if ($formValid) {

		$sql = "UPDATE signup SET sig_password = :password WHERE sig_id = :id";

    $pdoStatement = $pdo->prepare($sql);
    $pdoStatement->bindValue(':password', $password);
    $pdoStatement->bindValue(':id', $_POST['id']);

    if ($pdoStatement->execute() === false) {
      print_r($pdoStatement->errorInfo());
    }
    // Si aucun erreur SQL
    else {
      $resultat = $pdoStatement->fetch(PDO::FETCH_ASSOC);
      print_r($resultat);
    }
  }
}
/* ----------------------------------------------------------------------------/
FIN DU CODE
------------------------------------------------------------------------------*/
require '../view/reset_password.php';
require '../view/footer.php';
 ?>

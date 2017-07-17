<?php
require_once "../inc/config.php";
require_once '../view/header.php';
require_once '../inc/functions.php';
require_once '../inc/def.php';

/* ----------------------------------------------------------------------------/
DEBUT DU CODE
------------------------------------------------------------------------------*/

if(!empty($_POST)){
  // Récupération & Traitement des données
  $email = isset($_POST['email']) ? strip_tags(trim($_POST['email'])) : '';
  $password = isset($_POST['password']) ? trim($_POST['password']) : '';
  $verif_password = isset($_POST['verif_password']) ? trim($_POST['verif_password']) : '';

  // Validation des données
	$formValid = true;
  if (empty($email)) {
		$formValid = false;
		$errorList['email'][] = 'L\'email est vide';
	}
	else if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
		$formValid = false;
		$errorList['email'][] = 'L\'email est invalide';
	}

	if (empty($password) || empty($verif_password)) {
		$formValid = false;
		$errorList['password'][] = 'Le password est vide';
	}
	if ($password !== $verif_password) {
		$formValid = false;
		$errorList['password'][] = 'Les passwords sont différents';
	}
	if (strlen($password) < 8 || strlen($verif_password) < 8) {
		$formValid = false;
		$errorList['password'][] = 'Le password doit faire au moins 8 caractères';
	}
  $arrayPassword = str_split($password);
  $checkPass = false;
  $verificator = false;
  foreach ($arrayPassword as $value){
    if ((ord($value) >= ord('A')) && (ord($value) <= ord('Z'))){
      $checkPass = true;

    }
    if ($value >= '0' && $value <= '9'){
      $verificator = true;
    }
  }
  if(!$checkPass){
    $formValid = false;
    $errorList['password'][] = 'Le password doit contenir une majuscule';
  }
  if(!$verificator){
    $formValid = false;
    $errorList['password'][] = 'Le password doit contenir un chiffre';
  }
if ($formValid) {

		$sql = "
			INSERT INTO signup (sig_email, sig_password, sig_date)
			VALUES (:email, :password, NOW())
		";
    $pdoStatement = $pdo->prepare($sql);
    $hashedPassword = password_hash($password,PASSWORD_BCRYPT);
    $pdoStatement->bindValue(':email', $email);
    $pdoStatement->bindValue(':password', $hashedPassword);

    if ($pdoStatement->execute() === false) {
			print_r($pdoStatement->errorInfo());
		}
		// Si aucun erreur SQL
		else {
			$successTxt = 'Votre inscription a bien été prise en compte';
      $_SESSION['id_user'] = $email;
      $_SESSION['ip_user'] = $_SERVER['REMOTE_ADDR'];
      header('Location: http://projet-toto.dev/index.php');
		}
}


}//FIN DU IF EMPTY POST

/* ----------------------------------------------------------------------------/
FIN DU CODE
------------------------------------------------------------------------------*/
require '../view/login.php';
require '../view/footer.php';
 ?>

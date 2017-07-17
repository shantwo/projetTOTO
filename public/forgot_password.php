<?php
require_once "../inc/config.php";
require_once '../view/header.php';
require_once '../inc/functions.php';
require_once '../inc/def.php';
/* ----------------------------------------------------------------------------/
DEBUT DU CODE
------------------------------------------------------------------------------*/
if(isset($_POST)){
  $email = isset($_POST['email']) ? strip_tags(trim($_POST['email'])) : '';
  $formValid = true;
  if (empty($email)) {
    $formValid = false;
    $errorList['email'][] = 'L\'email est vide';
  }
  else if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    $formValid = false;
    $errorList['email'][] = 'L\'email est invalide';
  }
  if ($formValid) {
    $sql='SELECT * FROM signup WHERE sig_email = :email';
    $pdoStatement = $pdo->prepare($sql);
    $pdoStatement->bindValue(':email', $email);
    if ($pdoStatement->execute() === false) {
      print_r($pdoStatement->errorInfo());
    }
    // Si aucun erreur SQL
    else {
      $resultat = $pdoStatement->fetch(PDO::FETCH_ASSOC);
      $id=$resultat['sig_id'];
      $token=(md5($resultat['sig_id']."NeverNeverGiveYouUp?!evereverletyoudown!!"));

      $sql='UPDATE signup SET sig_token = :token WHERE sig_id=:id';
      $pdoStatement = $pdo->prepare($sql);
      $pdoStatement->bindValue(':token', $token);
      $pdoStatement->bindValue(':id', $id);
      if ($pdoStatement->execute() === false) {
        print_r($pdoStatement->errorInfo());
      }
      else {
        $expediteur = "admin@projettoto.danstoto";
        $recipient = "mrshantwo@gmail.com";
        $objet = "quand on est con, on le reste";
        $body = "<a href='127.0.0.1/projet_toto/public/reset_password.php?token=".$token."'>Reset ton password mon con</a>";
        sendAnEmail($expediteur,$recipient,$objet,$body);
      }
    }
  }
}

/* ----------------------------------------------------------------------------/
FIN DU CODE
------------------------------------------------------------------------------*/
require '../view/forgot_password.php';
require '../view/footer.php';
 ?>

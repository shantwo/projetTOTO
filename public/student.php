<?php
require_once "../inc/config.php";
require_once '../view/header.php';
require '../inc/function.php';
require '../inc/Definitions.php';
/* ----------------------------------------------------------------------------/
DEBUT DU CODE
------------------------------------------------------------------------------*/
if(!empty($_GET)){
    
    $resultat = requeteSql($studentIdentification,"fetch",$student_Id,$pdo);
    $id = $resultat['stu_id'];
    $nom = $resultat['stu_lastname'];
    $prenom = $resultat['stu_firstname'];
    $dateDeNaissance = $resultat['stu_birthdate'];
    $email = $resultat['stu_email'];
    $sympathie = $resultat['stu_friendliness'];
    $session = $resultat['ses_number'];
    $pays = $resultat['cou_name'];
    $ville = $resultat['cit_name'];
}
else{
  echo "-- ERREUR A LA RECUPERATION DES DONNEES --";
}
if(!empty($_GET)){
  $imageArray = requeteSql($studentPictureSQL,"fetchAll",$student_Id,$pdo);
  // $Array=array();
  // print_r($allResult);
  foreach($imageArray as $key => $value){
    $image = $value['stu_picture'] ;
  }
}
/* ----------------------------------------------------------------------------/
FIN DU CODE
------------------------------------------------------------------------------*/
require '../view/student.php';
require '../view/footer.php';
 ?>

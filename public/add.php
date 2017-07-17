<?php
require_once "../inc/config.php";
require_once '../view/header.php';
require_once '../inc/functions.php';
require_once '../inc/def.php';

/* ----------------------------------------------------------------------------/
DEBUT DU CODE
------------------------------------------------------------------------------*/

//----------MODIFICATION ------------------------------------------------------/
if(isset($_GET["modif"])){
  $id=isset($_POST["id"])? $_POST["id"] : "";
  $res = Modificator($pdo,$modifUpdateBind);
  if($res){
    header("Location: student.php?id={$id}");
  }else {
    print_r($pdoStatement->errorInfo());
  }
}
//-----------CREATION D UN NOUVEL ETUDIANT ------------------------------------/
else if(!empty($_POST) && !isset($_GET["modif"])){
  //RETOURNE FALSE SI UN CHAMP EST VIDE
  if(checkVar($AddBind)){
    foreach ($AddBind as $key => $value){
      ${$key} = $value;
    };
    $res = AddStudent($pdo,$AddBind);
  	if($res){
      $id=$pdo->lastInsertId();
  		header("Location: student.php?id={$id}");
  	}else {
  		print_r($pdoStatement->errorInfo());
  	}
  }
}
//------------- RECUPERATION DES DONNEES DE VILLE ET SESSION ------------------/
$villeArray = Recupere($pdo,$recupereVille,"cit_name","cit_id");
$sessionArray = Recupere($pdo,$recupereSession,"ses_number","ses_id");

//PREREMPLISSAGE
if(!empty($_GET)){
  $identifiant = isset($_GET["id"])? strip_tags(strtoupper(trim($_GET["id"]))) : "";
  $pdoStatement = Preremplis($pdo);
  $pdoStatement->bindValue(':identifiant', $identifiant,PDO::PARAM_INT);
  if ($pdoStatement -> execute() == false){
    print_r($pdoStatement->errorInfo());
  }
  else {
    $allResult = $pdoStatement->fetch(PDO::FETCH_ASSOC);
  }
  if (isset($_SESSION['user_role']) && authLevel($_SESSION['user_role']) !== "1"){
    foreach($allResult as $key => $value){
      if ($key == "stu_firstname"){
        $modifPrenom = $value;
      }
      else if ($key == "stu_lastname"){
        $modifNom = $value;
      }
      else if ($key == "stu_birthdate") {
        $modifDate=date("d/m/Y",strtotime('$allResult['.$value.']'));
      }
      else if ($key == "stu_email"){
        $modifEmail = $value;
      }
      else if ($key == "stu_friendliness"){
        $modifSympa = $value;
      }
      else if ($key == "ses_number"){
        $modifSession = $value;
      }
      else if ($key == "cit_name"){
        $modifVille = $value;
      }
    }
  }
}
//------------- UPLOAD D IMAGES  ----------------------------------------------/
if (!empty($_POST) && !empty($_FILES))
{
  define('__UPLOAD_DIR__', dirname(__FILE__).DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR);
  $ext_auth=array("jpg","svg","png","gif","jpeg");
  foreach($_FILES as $inputName => $fileData)
  {
    $tmpExplode = explode('.',$fileData['name']);
    $extension = end($tmpExplode);
    if(in_array($extension,$ext_auth)){
      $fileName = md5('toto'.$fileData['name']).".".$extension;
      $uploadedFileName = __UPLOAD_DIR__ .$fileName;
      if(move_uploaded_file($fileData['tmp_name'], $uploadedFileName))
      {
        echo "Upload OK";
        $sql='UPDATE student
        SET stu_picture = :file
        WHERE stu_id = :id';
        $pdoStatement = $pdo -> prepare($sql);
        $pdoStatement->bindValue(':file', $fileName);
        $pdoStatement->bindValue(':id', $id);
        $pdoStatement->execute();
      }
      else{echo "erreur d upload";}
    }
    else{
      echo"fichier invalide";exit;
    }
  }
}

/* ----------------------------------------------------------------------------/
FIN DU CODE
------------------------------------------------------------------------------*/
require '../view/add.php';
require '../view/footer.php';
 ?>

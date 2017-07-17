<?php
require_once "../inc/config.php";
require '../view/header.php';
/* ----------------------------------------------------------------------------/
DEBUT DU CODE
------------------------------------------------------------------------------*/


/******************************************************************************/
/******************************************************************************/
$valeurOffset=0;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$maxpages=0;

/* RECHERCHE D ELEMENTS */
if(!empty($_GET) && isset($_GET["recherche"]))
{
  $pagetesteur=true;
  $recherche=isset($_GET["recherche"])? strip_tags(strtoupper(trim($_GET["recherche"]))) : "";
  $pdoStatement = SearchList($pdo);
  $pdoStatement->bindValue(':recherche', "%".$recherche."%");
}
/* AFFICHAGE PARTICULIER (ville, date, session etc...) */
else if(!empty($_GET) && isset($_GET["ref"]))
{
  $reference=isset($_GET["ref"])? strip_tags(trim($_GET["ref"])) : "";
  $valeur=isset($_GET["valeur"])? strip_tags(trim($_GET["valeur"])) : "";

  $requeteSql = 'SELECT stu_id, stu_lastname, stu_firstname, cou_name, cit_name, stu_friendliness,stu_birthdate, stu_email,ses_number,tra_name,ses_start_date,ses_end_date,loc_name
              FROM student
              LEFT JOIN session ON session.ses_id = student.session_ses_id
              LEFT JOIN city ON city.cit_id = student.city_cit_id
              LEFT JOIN country ON country.cou_id = city.country_cou_id
              LEFT JOIN location ON session.location_loc_id = location.loc_id
              LEFT JOIN training ON session.training_tra_id = training.tra_id
              WHERE '.$reference.' = "'.$valeur.'"';

  $pdoStatement = $pdo->prepare($requeteSql);
}
else
{
  $requeteSqltest = 'SELECT stu_id, stu_lastname, stu_firstname, cou_name, cit_name, stu_friendliness,stu_birthdate, stu_email,ses_number
                    FROM student
                    LEFT JOIN session ON session.ses_id = student.session_ses_id
                    LEFT JOIN city ON city.cit_id = student.city_cit_id
                    LEFT JOIN country ON country.cou_id = city.country_cou_id
                    ORDER BY stu_lastname ASC
                    ';
  $pdoStatementtest = $pdo->prepare($requeteSqltest);

  if ($pdoStatementtest->execute() === false ) { // Si erreur
    print_r($pdoStatementtest->errorInfo());
  }
  else {
    $resultat = $pdoStatementtest->fetchAll(PDO::FETCH_ASSOC);
    $compteurPage = count($resultat);
    $maxpages=$compteurPage / 5 ;
  }

  $valeurOffset = $page * 5 - 5;
  $requeteSql = 'SELECT stu_id, stu_lastname, stu_firstname, cou_name, cit_name, stu_friendliness,stu_birthdate, stu_email,ses_number
                FROM student
                LEFT JOIN session ON session.ses_id = student.session_ses_id
                LEFT JOIN city ON city.cit_id = student.city_cit_id
                LEFT JOIN country ON country.cou_id = city.country_cou_id
                ORDER BY stu_lastname ASC
                LIMIT 5
                OFFSET :valeurOffset
                ';

  $pdoStatement = $pdo->prepare($requeteSql);
  $pdoStatement->bindValue(':valeurOffset', $valeurOffset,PDO::PARAM_INT);
}

if ($pdoStatement->execute() === false ) { // Si erreur
  print_r($pdoStatement->errorInfo());
}
else {
  $allResults = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
  $compteurPage = count($allResults);

  foreach($allResults as $key => $value){
    $studentListing[]=array(
    'id' => $value['stu_id'],
    'nom' => $value['stu_lastname'],
    'prenom' => $value['stu_firstname'],
    'dateDeNaissance' => $value['stu_birthdate'],
    'email' => $value['stu_email'],
    'sympathie' => $value['stu_friendliness'],
    'session' => $value['ses_number'],
    'pays' => $value['cou_name'],
    'ville' => $value['cit_name']);
  }
}

if(!empty($_GET) && isset($_GET["id"])){
  $sql='DELETE FROM student WHERE stu_id= :id';
  $pdoStatement = $pdo->prepare($sql);
  $pdoStatement->bindValue(':id', $_GET["id"],PDO::PARAM_INT);
  if ($pdoStatement->execute() === false ) { // Si erreur
    print_r($pdoStatement->errorInfo());
  }
  else {
    header('Location: '.$_SERVER['PHP_SELF']);
  }
}
/* ----------------------------------------------------------------------------/
FIN DU CODE
------------------------------------------------------------------------------*/
require '../view/list.php';
require '../view/footer.php';
 ?>

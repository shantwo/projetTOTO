<?php
require_once "../inc/config.php";
require '../view/header.php';
/* ----------------------------------------------------------------------------/
DEBUT DU CODE
------------------------------------------------------------------------------*/
$requeteSql = 'SELECT * FROM session
              LEFT JOIN training ON training.tra_id = session.training_tra_id
              LEFT JOIN location ON location.loc_id = session.location_loc_id
              ORDER BY loc_name
              ';

$pdoStatement = $pdo -> prepare($requeteSql);
if ($pdoStatement -> execute() == false) {
	print_r($pdoStatement->errorInfo());
}
else {
	$allResult = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
  foreach ($allResult as $key => $value){
    $sessionListing[]=array(
    'nom' => $nom = $value['tra_name'],
    'numero' => $numeroSession = $value['ses_number'],
    'debut' => $debut = $value['ses_start_date'],
    'fin' => $fin = $value['ses_end_date'],
    'lieu' => $lieu = $value['loc_name']);
  }
}

$sql='SELECT cit_name, COUNT(*) AS count  FROM student LEFT JOIN city ON city.cit_id = student.city_cit_id GROUP BY cit_name ORDER BY count DESC' ;
$pdoStatement = $pdo -> prepare($sql);
if ($pdoStatement -> execute() == false) {
	print_r($pdoStatement->errorInfo());
}
else {
  $studentbycity = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
}
/* ----------------------------------------------------------------------------/
FIN DU CODE
------------------------------------------------------------------------------*/

require '../view/home.php';
require '../view/footer.php';

 ?>

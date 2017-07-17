<?php
require_once dirname(dirname(dirname(__FILE__)))."/inc/config.php";
require dirname(dirname(dirname(__FILE__))).'/inc/function.php';
require dirname(dirname(dirname(__FILE__))).'/inc/Definitions.php';
$id=$_POST['id'];

$student_sql =
        'SELECT stu_id, stu_lastname, stu_firstname, cou_name, cit_name, stu_friendliness,stu_birthdate, stu_email,ses_number
        FROM student
        LEFT JOIN session ON session.ses_id = student.session_ses_id
        LEFT JOIN city ON city.cit_id = student.city_cit_id
        LEFT JOIN country ON country.cou_id = city.country_cou_id
        WHERE stu_id = :id
        ORDER BY stu_lastname ASC';

$pdoStatement = $pdo -> prepare($sql);
$pdoStatement->bindValue(':id',$id,PDO::PARAM_INT);
if($pdoStatement->execute()){
      $resultat =   $pdoStatement->fetch(PDO::FETCH_ASSOC);
}



  $id = $resultat['stu_id'];
  $nom = $resultat['stu_lastname'];
  $prenom = $resultat['stu_firstname'];
  $dateDeNaissance = $resultat['stu_birthdate'];
  $email = $resultat['stu_email'];
  $sympathie = $resultat['stu_friendliness'];
  $session = $resultat['ses_number'];
  $pays = $resultat['cou_name'];
  $ville = $resultat['cit_name'];
  $imageArray = requeteSql($studentPictureSQL,"fetchAll",$student_Id,$pdo);
  foreach($imageArray as $key => $value){
    $image = $value['stu_picture'] ;
  }

  if (empty($image)){
    $image = 'default.jpg';
  }

  $response='<ul>
        <li><img src="/files/'.$image.'" width="100"></li>
      <li><strong>NOM :</strong>'.$nom.'</li>
      <li><strong>PRENOM :</strong>'.$prenom.'</li>
      <li><strong>DATE DE NAISSANCE :</strong>'.$dateDeNaissance.'</li>
      <li><strong>E-MAIL :</strong>'.$email.'</li>
      <li><strong>VILLE :</strong>'.$ville.'</li>
      <li><strong>PAYS :</strong>'.$pays.'</li>
      <li><strong>SESSION :</strong>'.$session.'</li>
      <li><strong>INDICE DE SYMPATHIE :</strong>'.$sympathie.'</li>
    </ul>';

print_r($response);

?>

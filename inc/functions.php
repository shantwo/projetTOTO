<?php

/* -----------------------------------------------------------------------------
-------------------- CONSTRUCTEUR SQL ------------------------------------------
------------------------------------------------------------------------------*/

/* Cette fonction lance un appel sql en bindant a la volee les tokens */

//$tableau : tableau de requetes SQL
//$identifiant : id de la requeteSql
//$pdo a joindre a tout appel
//$fetchtype est une option pour le type de fetch, pour un fetchall ne rien mettre
function constructeurSql($tableau,$identifiant,$pdo,$fetchtype=""){
  //parcours le tableau
  foreach($tableau as $key => $value){
    //on parcourt le tableau de requete et si l identifiant est trouve dans le tableau
    if ($value['ID'] == $identifiant){
      //on attribue la requete sql
      $sql = $value['sql'];
      //on prepare la requete
      $pdoStatement = $pdo -> prepare($sql);
      //pour chaque token enregistre
      foreach($value['tokens'] as $idTokens => $valeurTokens){
        //identifie le token
        if ($idTokens == 'token'){
          $tokenRequete = $valeurTokens;
        }
        //identifie la valeur
        if ($idTokens == 'valeur'){
          $valeurTokenRequete = $valeurTokens;
        }
        //si le token est un int, choisi le parametre sinon non
        if($idTokens == 'type' && $valeurTokens == "int"){
          $parametre = PDO::PARAM_INT;
        }
        else {
          $parametre = PDO::PARAM_STR;
        }
      }
      //binding du token actuel
      $pdoStatement->bindValue($tokenRequete, $valeurTokenRequete,$parametre);
    }
  }
  //execution de la requete sql
  if($pdoStatement->execute()){
    //en fonction du type de fetch precise, renvoi le resultat voulu
    if ($fetchtype !== "" && $fetchtype == "fetch"){
      return $pdoStatement->fetch(PDO::FETCH_ASSOC);
    }
    else if ($fetchtype !== "" && $fetchtype == "fetchAll"){
      return $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    }
  }
  else{
    print_r($pdoStatement->errorInfo());
  }
}
// FONCTION DE RECHERCHE --------------------------------------------------/
function SearchList($pdo){
  $requeteSql = 'SELECT stu_id, stu_lastname, stu_firstname,
                        cou_name, cit_name,
                        stu_friendliness,stu_birthdate,
                        stu_email,ses_number
                FROM student
                LEFT JOIN session ON session.ses_id = student.session_ses_id
                LEFT JOIN city ON city.cit_id = student.city_cit_id
                LEFT JOIN country ON country.cou_id = city.country_cou_id
                WHERE stu_firstname LIKE :recherche
                OR stu_lastname LIKE :recherche
                OR stu_email LIKE :recherche
                OR cit_name LIKE :recherche
                ORDER BY stu_lastname ASC ';

  return $pdoStatement = $pdo->prepare($requeteSql);
}

//FONCTION DE CHAIN BINDING -----------------------------------------------/
function BindThisModif($tableau,$pdoStatement){
  foreach ($tableau as $key => $value){
    $pdoStatement->bindValue(':'.$key, $value);
  }
}
//FONCTION DE CHAIN DECLARATION et VERIFICATION
function checkVar($tableau){
  $checkvalide=true;
  foreach ($tableau as $key => $value){
    if(empty($value) && $key !== "id"){
      echo "le champ ".$key." est obligatoire<br />";
      $checkvalide=false;
    }
  }
  return $checkvalide;
}

//FONCTION SQL DE MODIFICATION D ETUDIANT
function Modificator($pdo,$tableau){
  $sql = 'UPDATE student
          SET stu_lastname = :nom,stu_firstname = :prenom,
              stu_birthdate = :naissance,stu_email = :email,
              stu_friendliness = :sympa, session_ses_id = :session,
              city_cit_id = :ville
          WHERE stu_id = :id';


  $pdoStatement = $pdo -> prepare($sql);
  //Chain binding des tokens --- TABLEAU dans DEF
  BindThisModif($tableau,$pdoStatement);
  return $res = $pdoStatement->execute();
}

//AJOUT D ETUDIANTS
function AddStudent($pdo,$tableau){
  $sql = 'INSERT INTO student(stu_lastname,stu_firstname,stu_birthdate,stu_email,stu_friendliness,session_ses_id,city_cit_id)
  VALUES (:nom,:prenom,:naissance,:email,:sympa,:session,:ville)';

  $pdoStatement = $pdo -> prepare($sql);
  //CHAIN BINDING
  BindThisModif($tableau,$pdoStatement);

  return $pdoStatement->execute();
}

//RECUPERATION DE DONNEES DANS UNE TABLE
function Recupere($pdo,$requete,$champ1,$champ2){
  $pdoStatement = $pdo -> prepare($requete);
  if ($pdoStatement -> execute() == false){
    print_r($pdoStatement->errorInfo());
  }
  else {
    $allResult = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    $Array=array();
    // print_r($allResult);
    foreach($allResult as $key => $value){
      $Array[$value[$champ2]]=$value[$champ1];
    }
    return $Array;
  }
}

//PREREMPLISSAGE
function PRVar($tableau){
  $Array=array();
  foreach($tableau as $key => $value){
    if ($key !== "Date"){
    print_r($Array['$modif'.$key]='$allResult['.$value.']');

    }
    else {
      $Array['$modif'.$key]=date("d/m/Y",strtotime('$allResult['.$value.']'));
    }
  }
  return $Array;
}

function Preremplis($pdo){
    $sql='SELECT stu_id, stu_lastname, stu_firstname, cou_name, cit_name, stu_friendliness,stu_birthdate, stu_email,ses_number
          FROM student
          LEFT JOIN session ON session.ses_id = student.session_ses_id
          LEFT JOIN city ON city.cit_id = student.city_cit_id
          LEFT JOIN country ON country.cou_id = city.country_cou_id
          WHERE stu_id LIKE :identifiant';

    return $pdo -> prepare($sql);
}

function checkIP($session,$ip){
  if($session['ip_user'] !== $_SERVER['REMOTE_ADDR']){
    $_SESSION=[];
  }
}

function psem($pdo){
  $email = isset($_POST['email']) ? strip_tags(trim($_POST['email'])) : '';
  $password = isset($_POST['password']) ? trim($_POST['password']) : '';
  $keep = isset($_POST['keep']) ? true : '';

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
  if (strlen($password) < 8) {
    $formValid = false;
    $errorList['password'][] = 'Le password doit faire au moins 8 caractères';
  }

  $sql = 'SELECT * FROM signup WHERE sig_email = :email';

  $pdoStatement = $pdo->prepare($sql);
  $pdoStatement->bindValue(':email', $email);
  if ($pdoStatement->execute() === false) {
    print_r($pdoStatement->errorInfo());
  }
  // Si aucun erreur SQL
  else {
    $resultat = $pdoStatement->fetch(PDO::FETCH_ASSOC);
    if(password_verify($password,$resultat['sig_password'])){
      $_SESSION['id_user'] = $resultat['sig_email'];
      $_SESSION['ip_user'] = $_SERVER['REMOTE_ADDR'];
      $_SESSION['user_role'] = $resultat['sig_role'];
      if($keep){

        		$sql = "
        			UPDATE signup
              SET expiration = :expiration
              WHERE sig_email = :email
        		";
            $pdoStatement = $pdo->prepare($sql);
            $time = (time() + 3600*24*21);
            $pdoStatement->bindValue(':expiration', $time);
            $pdoStatement->bindValue(':email', $email);
            if ($pdoStatement->execute() === false) {
        			print_r($pdoStatement->errorInfo());
        		}
        		// Si aucun erreur SQL
        		else {
              $sql = 'SELECT * FROM signup WHERE sig_email = :email';

              $pdoStatement = $pdo->prepare($sql);
              $pdoStatement->bindValue(':email', $email);
              if ($pdoStatement->execute() === false) {
                print_r($pdoStatement->errorInfo());
              }
              // Si aucun erreur SQL
              else {
                $resultat = $pdoStatement->fetch(PDO::FETCH_ASSOC);
                $_SESSION['duree_de_vie'] = $resultat['expiration'];
                setcookie('projet_toto', $email, time() + 365*24*3600, null, null, false, true);
              }
            }
      }
      header('Location: http://projet-toto.dev/index.php');
    }

  }

}

function sendAnEmail($expediteur,$recipient,$objet,$body){
  $mail = new PHPMailer;

  // $mail->SMTPDebug = 3;                               // Enable verbose debug output

  $mail->isSMTP();                                      // Set mailer to use SMTP
  $mail->Host = 'smtp.gmail.com;';  // Specify main and backup SMTP servers
  $mail->SMTPAuth = true;                               // Enable SMTP authentication
  $mail->Username = 'shanygames@gmail.com';                 // SMTP username
  $mail->Password = 'madmonkmadmonk';                           // SMTP password
  $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
  $mail->Port = 587;                                    // TCP port to connect to

  $mail->setFrom($expediteur, 'Mailer');
  $mail->addAddress($recipient, 'Moi');     // Add a recipient
  // $mail->addAddress('ellen@example.com');               // Name is optional
  // $mail->addReplyTo('info@example.com', 'Information');
  // $mail->addCC('cc@example.com');
  // $mail->addBCC('bcc@example.com');

  // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
  // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
  $mail->isHTML(true);                                  // Set email format to HTML

  $mail->Subject = $objet;
  $mail->Body    = $body;
  $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

  if(!$mail->send()) {
      echo 'Message could not be sent.';
      echo 'Mailer Error: ' . $mail->ErrorInfo;
  } else {
      echo 'Message envoye';
  }
}

function getExpDate($email,$objetpdo){
  $sql = 'SELECT * FROM signup WHERE sig_email = :email';

  $pdoStatement = $objetpdo->prepare($sql);
  $pdoStatement->bindValue(':email', $email);
  if ($pdoStatement->execute() === false) {
    print_r($pdoStatement->errorInfo());
  }
  // Si aucun erreur SQL
  else {
    $resultat = $pdoStatement->fetch(PDO::FETCH_ASSOC);
  }
  return array('expiration' => $resultat['expiration'], 'user' => $resultat['sig_email']);
}

function authLevel($auth){
  if ($auth == "admin"){
    return "1";
  }
  else if ($auth == "user"){
    return "2";
  }
  else {return "0";}
}

 ?>

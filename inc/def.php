<?php
require_once "functions.php";
require_once "config.php";
require_once "db.php";

//POUR FUNCTION SQLCONSTRUCTOR
$RequeteStudent =
        'SELECT stu_id, stu_lastname, stu_firstname, cou_name, cit_name, stu_friendliness,stu_birthdate, stu_email,ses_number
        FROM student
        LEFT JOIN session ON session.ses_id = student.session_ses_id
        LEFT JOIN city ON city.cit_id = student.city_cit_id
        LEFT JOIN country ON country.cou_id = city.country_cou_id
        WHERE stu_id = :identifiant
        ORDER BY stu_lastname ASC';

$Requetes=array(
        array('ID'  => 1,
        'sql' => $RequeteStudent,
        'tokens' => [
                'token' => ':identifiant' ,
                'valeur'=> isset($_GET["id"])?$_GET["id"]:"" ,
                'type'  => 'int']
        )
);

//TABLEAU POUR LES MODIFICATIONS D ETUDIANTS
$modifUpdateBind=array(
        'nom'=>isset($_POST["nom"])? strip_tags(strtoupper(trim($_POST["nom"]))) : "",
        'prenom' => isset($_POST["prenom"])? strip_tags(trim($_POST["prenom"])) : "",
        'naissance' => date("Y-m-d",strtotime(isset($_POST["naissance"])? strip_tags(trim($_POST["naissance"])) : "")),
        'email' => isset($_POST["email"])? strip_tags(trim($_POST["email"])) : "",
        'sympa'=> isset($_POST["sympa"])? strip_tags(trim($_POST["sympa"])) : "",
        'session'=> isset($_POST["session"])? strip_tags(trim($_POST["session"])) : "",
        'ville' => isset($_POST["ville"])? strip_tags(trim($_POST["ville"])) : "",
        'id' => isset($_POST["id"])? $_POST["id"] : ""
);

//TABLEAU POUR LES AJOUTS D ETUDIANTS
$AddBind=array(
        'nom'=>isset($_POST["nom"])? strip_tags(strtoupper(trim($_POST["nom"]))) : "",
        'prenom' => isset($_POST["prenom"])? strip_tags(trim($_POST["prenom"])) : "",
        'naissance' => date("Y-m-d",strtotime(isset($_POST["naissance"])? strip_tags(trim($_POST["naissance"])) : "")),
        'email' => isset($_POST["email"])? strip_tags(trim($_POST["email"])) : "",
        'sympa'=> isset($_POST["sympa"])? strip_tags(trim($_POST["sympa"])) : "",
        'session'=> isset($_POST["session"])? strip_tags(trim($_POST["session"])) : "",
        'ville' => isset($_POST["ville"])? strip_tags(trim($_POST["ville"])) : "",
);

//SQL POUR RECUPERER LES VILLES
$recupereVille =
        'SELECT cit_name,cit_id
        FROM city';

//SQL POUR RECUPERER LES SESSIONS
$recupereSession =
        'SELECT ses_number,ses_id
        FROM session';

//TABLEAU POUR LE PREREMPLISSAGE DE LA PARTIE add
$AddArray = array(
        'Nom' => 'stu_lastname',
        'Prenom' => 'stu_firstname',
        'Date' => 'stu_birthdate',
        'Email' => 'stu_email',
        'Sympa' => 'stu_friendliness',
        'Session' => 'ses_number',
        'Ville' => 'cit_name',
        'ID' => 'stu_id');
 ?>

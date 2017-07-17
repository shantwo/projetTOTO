<?php
//ARRAY DE TOKENS -------------------------------------------------------------//
/*
Modele type
$modele = array(
  array(
    nom => "nom_du_token",
    variable => "variable_associee_au_token",
    token => ":token",
    isINT => "true or false"
  ),
);
*/
//VALEUR INITIALE
$tokensArray=array();
//TABLEAU DE LA PAGE STUDENT.PHP
$student_Id = array(
        array(
                'nom' => 'IDENTIFIANT',
                'variable' => '$id',
                'token' => ':id',
                'isINT' => true
        )
);
//-----------------------------------------------------------------------------//
//REQUETES SQL ----------------------------------------------------------------//
//-----------------------------------------------------------------------------//
$usersSQL =
        "SELECT * FROM signup";

$studentPictureSQL =
        'SELECT stu_picture
        FROM student
        WHERE stu_id = :id';

$studentIdentification =
        'SELECT stu_id, stu_lastname, stu_firstname, cou_name, cit_name, stu_friendliness,stu_birthdate, stu_email,ses_number
        FROM student
        LEFT JOIN session ON session.ses_id = student.session_ses_id
        LEFT JOIN city ON city.cit_id = student.city_cit_id
        LEFT JOIN country ON country.cou_id = city.country_cou_id
        WHERE stu_id = :id
        ORDER BY stu_lastname ASC';

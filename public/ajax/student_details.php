<?php
require_once dirname(dirname(dirname(__FILE__)))."/inc/config.php";
require dirname(dirname(dirname(__FILE__))).'/inc/function.php';
require dirname(dirname(dirname(__FILE__))).'/inc/Definitions.php';

$id=$_POST['id'];

$student_details_sql =
        'SELECT stu_id, stu_lastname, stu_firstname, cou_name, cit_name, stu_friendliness,stu_birthdate, stu_email,ses_number
        FROM student
        LEFT JOIN session ON session.ses_id = student.session_ses_id
        LEFT JOIN city ON city.cit_id = student.city_cit_id
        LEFT JOIN country ON country.cou_id = city.country_cou_id
        WHERE stu_id = :id
        ORDER BY stu_lastname ASC';

$student_details_valuesToBind = array(
        ':id' => $id
);



$resultat = studentDetails($student_details_sql,$pdo,$student_details_valuesToBind);

print_r(json_encode($resultat));

?>

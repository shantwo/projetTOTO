<?php
require_once dirname(dirname(dirname(__FILE__)))."/inc/config.php";
require dirname(dirname(dirname(__FILE__))).'/inc/function.php';
require dirname(dirname(dirname(__FILE__))).'/inc/Definitions.php';

foreach($_POST as $key => $data){
        ${$key}=$data;
}

$add_sql=
        'INSERT INTO student
        (stu_lastname,stu_firstname,stu_birthdate,
        stu_email,stu_friendliness,session_ses_id,
        city_cit_id)
        VALUES (.nom, :prenom, :naissance,
        :email, :sympa, :session, :ville)';

$add_valuesToBind = array(
        [':nom'=>$nom],
        [':prenom'=>$prenom],
        [':naissance'=>$naissance],
        [':email'=>$email],
        [':sympa'=>$sympa],
        [':session'=>$session],
        [':ville',$ville]
)

AddAStudent($add_sql,$pdo,$add_valuesToBind);

print_r('enregistrement effectue');

?>

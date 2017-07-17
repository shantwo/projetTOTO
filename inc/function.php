<?php
require_once "config.php";
require_once "db.php";
require_once "definitions.php";
//-----------------------------------------------------------------------------//
//FONCTION DE REQUETE SERVEUR SQL ---------------------------------------------//
//-----------------------------------------------------------------------------//
function requeteSql($requete,$fetchtype="fetchAll",$tableauTokens,$objetPDO){
        $pdoStatement = $objetPDO -> prepare($requete);
        //DETECTION DE TOKENS
        if(!empty($tableauTokens)){
                foreach ($tableauTokens as $tokenBinder){
                        //BINDING SELON LE TYPE INT OU NON
                        if ($tokenBinder['isINT']){
                                $pdoStatement->bindValue($tokenBinder['token'],$tokenBinder['variable'],PDO::PARAM_INT);
                        }
                        else{
                                $pdoStatement->bindValue($tokenBinder['token'],$tokenBinder['variable']);
                        }
                }
        }
        //EXECUTION DE LA REQUETE SQL
        if($pdoStatement->execute()){
                if ($fetchtype == "fetch"){
                        return $pdoStatement->fetch(PDO::FETCH_ASSOC);
                }
                else if ($fetchtype == "fetchAll"){
                        return $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
                }
                else{
                        //SI LE MAUVAIS TYPE DE FETCH EST ENTRE
                        echo "-- ERREUR DANS LA FONCTION --";
                }
        }
        else{
                print_r($pdoStatement->errorInfo());
        }
}
//-----------------------------------------------------------------------------//
function AddAStudent($sql,$pdo,$tableau){
        $pdoStatement = $pdo -> prepare($sql);
        foreach($tableau as $key => $value){
                if (is_int($value)){
                        $pdoStatement->bindValue($key,$value,PDO::PARAM_INT);
                }
                else{
                        $pdoStatement->bindValue($key,$value);
                }
        }
        $pdoStatement->execute();
}
//-----------------------------------------------------------------------------//
function studentDetails($sql, $pdo, $tableau){
        $pdoStatement = $pdo -> prepare($sql);
        foreach($tableau as $key => $value){
                if (is_int($value)){
                        $pdoStatement->bindValue($key,$value,PDO::PARAM_INT);
                }
                else{
                        $pdoStatement->bindValue($key,$value);
                }
        }
        if($pdoStatement->execute()){
                return $pdoStatement->fetch(PDO::FETCH_ASSOC);
        }
}

//-----------------------------------------------------------------------------//
?>

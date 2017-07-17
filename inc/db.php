<?php
//CONFIGURATION DES DONNEES SERVEUR POUR PDO ----------------------------------//
$dsn = "mysql:dbname={$config['database']};host={$config['host']};charset=UTF8";

//INSTANCIE UN NOUVEAU PDO ----------------------------------------------------//
try{
        $pdo = new PDO($dsn,$config['username'],$config['password']);
        $pdo ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

//RETOURNE LES ERREURS PDO ----------------------------------------------------//
catch (exception $e){
  echo $e->getMessage();
}
?>

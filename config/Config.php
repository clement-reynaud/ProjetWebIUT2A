<?php

require_once ("Connection.php");

//BDD


$user= 'root';
$pass='';
$dsn='mysql:host=localhost;dbname=projet';
try{
    $con=new Connection($dsn,$user,$pass);
}
catch( PDOException $Exception ) {
    echo 'erreur';
    echo $Exception->getMessage();
    exit();
}
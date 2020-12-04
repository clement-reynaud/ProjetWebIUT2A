<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="erreur.css">
    <title>ERREUR</title>
</head>
<body>
<div>
    <h1>
        ERREUR :
    </h1>
<?php

if(isset($dVueErreur)){
    foreach ($dVueErreur as $val){
        echo $val . "<br/>";

    }
    echo "<form>
        <input type=\"button\" value=\"Retour\" onclick=\"history.go(-1)\">
    </form>";
    exit(1);
}
?>


</div>
</body>
</html>

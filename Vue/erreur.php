<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>ERREUR</title>
</head>
<body>
<div>
    <p>
        ERREUR :
    </p>
<?php

if(isset($dVueErreur)){
    foreach ($dVueErreur as $val){
        echo $val . "<br/>";
    }

    exit(1);
}
?>

</div>
</body>
</html>

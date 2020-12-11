<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ajout d'un commentaire</title>
</head>
<body>
    <h2>Ajout d'un commentaire :</h2>
    <form action="index.php" method="post">
    <div>
        <label>Contenu du commentaire</label>
        <input type="text" name="contenu">
    </div>
    <div>
        <input type="submit" value="Submit">
        <input type="reset" value="Reset">
    </div>
    <input type="hidden" name="action" value="add_comm">

    <input type="button" value="Retour" onclick="history.go(-1)">

</form>
</body>
</html>
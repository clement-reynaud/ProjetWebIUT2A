<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AjoutNews</title>
</head>
<body>
    <h2>Ajout d'une news :</h2>
    <form action="index.php" method="post">
        <div>
            <label>Titre</label>
            <input type="text" name="titre">
        </div>
        <div>
            <label>Contenu</label>
            <input type="text" name="contenu">
        </div>
        <div>
            <input type="submit" value="Submit">
            <input type="reset" value="Reset">
        </div>

        <input type="button" value="Retour" onclick="history.go(-1)">

    </form>
</body>
</html>
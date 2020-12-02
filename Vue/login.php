<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion :</title>
</head>
<body>
<div>
    <h2>Connexion :</h2>
    <form action="index.php" method="post">
        <div>
            <label>Login</label>
            <input type="text" name="pseudo">
        </div>
        <div>
            <label>MDP</label>
            <input type="password" name="mdp">
        </div>
        <div>
            <input type="submit" value="Submit">
            <input type="reset" value="Reset">
        </div>

        <input type="hidden" name="action" value="validation_login">
    </form>
    <p>Pas de compte, créer en un <a href="index.php?action=add_utilisateur">ici</a></p>
</div>
</body>
</html>
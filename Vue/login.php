<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion :</title>
</head>
<body>
<div>
    <h2>Connexion :</h2>
    <form action="../config/validation_connexion_utilisateur.php" method="post">
        <div>
            <label>Login</label>
            <input type="text" name="login">
        </div>
        <div>
            <label>MDP</label>
            <input type="password" name="mdp">
        </div>
        <div>
            <input type="submit" value="Submit">
            <input type="reset" value="Reset">
        </div>

        <input type="hidden" name="action" value="validation_connexion_utilisateur">
    </form>
</div>
</body>
</html>
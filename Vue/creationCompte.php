<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Creation de Compte</title>
</head>
<body>
<div>
    <h2>Creation de compte :</h2>
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
            <label>Confirmer MDP</label>
            <input type="password" name="confirm_mdp">
        </div>
        <div>
            <input type="submit" value="Submit">
            <input type="reset" value="Reset">
        </div>

        <input type="hidden" name="action" value="validation_add_utilisateur">
    </form>
</div>
</body>
</html>
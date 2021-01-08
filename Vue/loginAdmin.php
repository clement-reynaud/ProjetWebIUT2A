<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion Admin:</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body style="padding-top: 55px;">
<nav class="navbar navbar-dark bg-dark navbar-expand-lg navbar-light bg-light fixed-top">
    <a class="navbar-brand" href="index.php">Accueil</a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <?php
            if(isset($user) && $user->getRole() == "Admin") {
                print "<li class='nav-item active'>
                        <a class='nav-link' href='index.php?action=page_add_news'>Ajouter News<span class='sr-only'>(current)</span></a>
                    </li>";
            }
            ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Compte
                </a>
                <?php
                if(!isset($user)){
                    print "
                        <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
                            <a class='ml-4 mt-2' href='index.php?action=login'>Login</a>
                        </div>";
                }
                else{
                    print "
                        <div class='dropdown-menu' aria-labelledby='navbarDropdown'>

                            <p class='ml-4 mt-2'>Pseudo: " . $user->getPseudo() . "</p>
                            <p class='ml-4 mt-2'>ID: " . $user->getId() ."</p>
                            <div class='dropdown-divider'></div>
                            <a class='ml-4 mt-2' href='index.php?action=deconnexion'>Deconnexion</a>
                        </div>";
                }
                ?>
            </li>
        </ul>
        <ul class="navbar-nav mr-auto">
            <?php
            if(isset($titrepage)){
                print "<h3 style='color: white;' class='nav-text'><u>" . $titrepage . "</u></h3>";
            }
            else{
                print "";
            }
            ?>
        </ul>
        <form  class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="date" name="date">
            <input class="btn btn-outline-success my-2 my-sm-0" type="submit" value="Rechercher">
            <input type="hidden" name="action" value="rech_date">
        </form>
    </div>
</nav>
<main class="container-fluid">
    <form class="form-group" action="index.php" method="post">
        <div class="mt-2">
            <label>Login</label>
            <input class="form-control" type="text" name="pseudo">
        </div>
        <div>
            <label>Mot De Passe</label>
            <input class="form-control" type="password" name="mdp">
        </div>
        <div class="mt-2">
            <input class="btn btn-primary mr-3" type="submit" value="Connexion">
            <input class="btn btn-warning" type="reset" value="Reset">
        </div>
        <input type="hidden" name="action" value="login_admin">
    </form>
    <form>
        <input class="btn btn-danger" type="button" value="Retour" onclick="history.go(-1)">
    </form>
</main>
</body>
</html>
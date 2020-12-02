<?php
require_once ("../config/Config.php");
require_once("../Modèle/NewsGateway.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="PagePrincipale.css">
    <meta charset="UTF-8">
    <title>Best News</title>
</head>
<body>
    <header>
        <ul class="bandeau">
            <li>
                <a>Dernières news</a>
            </li>
            <?php
            if(!isset($_SESSION["pseudo"])){
               print "<li>
                        <a href=\"login.php\">Login</a>
                    </li>";
            }
            ?>
            <li>
                <a>Recherche</a>
            </li>
            <?php
            if(isset($_SESSION["pseudo"])){
                print "<li>
                        <a href=\"deconnexion.php\">Deconnexion</a>
                    </li>";
            }
            ?>
        </ul>
    </header>
    <div id="page">
        <p>e
            f
            zef

            ezf
            ezf
            zef
            ezf
            ze
            fez
            fze
            f
            ezf
            ef
            ef
            hé <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>test
        </p>
    </div>
    <footer>
        <p>Vos messages :</p>

        <p>Messages de la communauté :
            <?php
                $ngt= new NewsGateway($con);
                echo $ngt->NbNews();
            ?>
        </p>
    </footer>
</body>
</html>
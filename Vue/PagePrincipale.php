<?php
require_once ("../config/Config.php");
require_once("../DAL/Gateway/NewsGateway.php");

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
                        <a href=\"index.php?action=login\">Login</a>
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
        <?php
        foreach ($news as $val)
        print "
        <p style='border: solid'>
            " . $val["titre"] . " | " . $val["date_cree"] . "<br>
            " . $val["contenu"] . "
        </p>"
        ?>
    </div>
    <footer>
        <p>Vos messages :</p>

        <p>Messages de la communauté :
            <?php
                echo $nbNews;
            ?>
        </p>
    </footer>
</body>
</html>
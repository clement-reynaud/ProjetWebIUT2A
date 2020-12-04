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
        <ul id="bandeau">
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
                <a>
                    <form action="index.php">
                        <input type="date" name="date">
                        <input type="submit">
                        <input type="hidden" name="action" value="rech_date">
                    </form>
                </a>
            </li>
            <li>

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
        print $titrepage;
        foreach ($news as $val)
        print "
        <div style='border: solid'>
            <h2 id='titreNews'>
            " . $val["titre"] . "
             </h2>
             <p>
             " . $val["date_cree"] . "<br>
             </p>
             <p>
            " . $val["contenu"] . "
            </p>
        </div>
        <button><a href='ajoutNews.php'></a> </button>"
        ?>
    </div>
    <footer>
        <p>Vos messages :</p>

        <p>News :
            <?php
                echo $nbNews;
            ?>
        </p>
    </footer>
</body>
</html>
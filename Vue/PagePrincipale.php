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
                <a href="index.php?action=">Acceuil</a>
            </li>
            <li>
                <a>
                    <form action="index.php">
                        <input type="date" name="date">
                        <input type="submit">
                        <input type="hidden" name="action" value="rech_date">
                    </form>
                </a>
            </li>
            <?php
            if(!isset($_SESSION["pseudo"])){
                print "<li>
                        <a href=\"index.php?action=login\">Login</a>
                    </li>";
            }
            else{
                print "<li>
                        <a href='index.php?action=deconnexion'>Deconnexion</a>
                    </li>";
            }
            ?>
        </ul>
        <?php
        if(isset($_SESSION["pseudo"])){
            print "Connecté en tant que :" . $_SESSION["pseudo"];
        }
        else{
            print "test";
        }
        ?>
    </header>
    <div id="page">
        <?php
        print "<h1>" . $titrepage . "</h1>";

        //Boucle d'affichage des news actuelles
        foreach ($news as $val){
            print "
            <div style='border: solid; margin: 10px'>
                <h2 id='titreNews'>
                " . $val->getTitre() . "
                 </h2>
                 <p>
                 " . $val->getDateCree() . "<br>
                 </p>
                 <p>
                " . $val->getContenu() . "
                </p>";


            if(!isset($_REQUEST["newsid"])){
                print "<a href='index.php?action=voir_commentaire&newsid=". $val->getId() ."'>voir commentaire</a>";
            }

            print "</div>";

            if(isset($comm)){
                if($comm != null){
                    foreach ($comm as $val){
                        print "<u><b>" . $val->getAuteur() . "</u></b>" . ": " . $val->getContenu();
                    }
                }
                else{
                    print "Pas encore de commentaire";
                }
            }
        }
        ?>
        <button><a href='ajoutNews.php'>Ajouter News</a> </button>
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
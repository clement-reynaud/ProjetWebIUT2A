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
                <a href="index.php?action=">Accueil</a>
            </li>
            <li>
                <a>
                    <form action="index.php">
                        <input type="date" name="date">
                        <input type="submit" value="Rechercher">
                        <input type="hidden" name="action" value="rech_date">
                    </form>
                </a>
            </li>
            <?php
            if(!isset($user)){
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
            <li>
                <?php
                if(isset($user))
                print "<p> Connecté en tant que:" . $_SESSION["pseudo"] . " " . $_SESSION["id"] . "</p>";
                ?>
            </li>
        </ul>
    </header>
    <div id="page">
        <?php
        if(isset($titrepage)){
            print "<h1>" . $titrepage . "</h1>";
        }
        else{
            print "Page d'acceuil";
        }

        //Boucle d'affichage des news actuelles
        if(isset($news) && $news != null){
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
                    print "<form action='index.php?action=add_comm' method='post'>
                            <div>
                                <label>Commentaire :</label>
                                <input type='text' name='contenu'>
                                <input type='submit' value='Submit'>
                                <input type='hidden' name='newsid' value='" . $val->getId() . "'
                            </div><br>";
                    if($comm != null){
                        foreach ($comm as $val){
                            print "<u><b>" . $val->getAuteur() . "</u></b>" . ": " . $val->getContenu();
                        }
                    }
                    else{
                        print "Pas encore de commentaire <br>";
                    }
                }
            }
            print "<button><a href='index.php?action=page_add_comm'>Ajouter Commentaires</a> </button>";
        }
        if(!isset($comm)){
            print "<button><a href='index.php?action=page_add_news'>Ajouter News</a> </button>";
        }
        else{
            print "Pas de News <br>";
        }
        ?>
    </div>
    <footer>
        <p>Vos messages :</p>

        <p>News :
            <?php
                if(isset($nbNews)){
                    print $nbNews;
                }
                else{
                    print "0";
                }
            ?>
        </p>
    </footer>
</body>
</html>
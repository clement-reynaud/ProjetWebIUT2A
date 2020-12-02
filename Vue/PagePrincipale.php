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
            <li>
                <a href="">Login</a>
            </li>
            <li>
                <a>Recherche</a>
            </li>
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
            require_Once("../Contrôleur/NewsGateway.php");
            $user= 'root';
            $pass='';
            $dsn='mysql:host=localhost;dbname=projet';
            try{
                $con=new Connection($dsn,$user,$pass);
            }
            catch( PDOException $Exception ) {
                echo 'erreur';
                echo $Exception->getMessage();
            }
            $ngt=new NewsGateway($con);
            echo $ngt->NbNews();
            ?>
        </p>
    </footer>
</body>
</html>
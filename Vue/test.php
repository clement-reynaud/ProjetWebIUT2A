<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Best News</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body style="padding-top: 55px;">
<nav class="navbar navbar-dark bg-dark navbar-expand-lg navbar-light bg-light fixed-top">
    <a class="navbar-brand" href="index.php">Accueil</a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="index.php?action=page_add_news">Ajouter News<span class="sr-only">(current)</span></a>
            </li>
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
    <?php
    if(isset($news) && $news != null) {
        foreach ($news as $val) {
            print "
            <div class='card border-dark mt-3'>
                <div class='card-header'>
                    <h5 class='card-title'>" . $val->getTitre() ."</h5>
                </div>
                <div class='card-body'>
                    <h6 class='card-subtitle mb-2 text-muted'>" . $val->getDateCree() . "</h6>
                    <p class='card-text'>" . $val->getContenu() . "</p>
            ";

            if(!isset($_REQUEST["newsid"])){
                print "<a href='index.php?action=voir_commentaire&newsid=". $val->getId() ."'>Voir commentaire</a>";
            }

            print"
                    <button class='btn btn-dark float-right'>Supprimer</button>
                </div>
            </div>
            ";

            if(isset($comm)){
                if(isset($user)){
                    print "
                        <div class='card border-dark mt-5'>
                            <form action='index.php?action=add_comm' method='post' class='form-inline'>
                                <div>
                                    <input class='form-control my-3 ml-2' type='text' name='contenu' placeholder='Commentaire' style='max-width: 300px'>
                                    <input class='btn btn-success inline-button' type='submit' value='Envoyer'>
                                    <input type='hidden' name='newsid' value='" . $val->getId() . "'
                                </div><br>
                            </form>
                        </div>";
                }
                else{
                    print "
                        <div class='card border-dark mt-5'>
                            <form action='index.php?action=add_comm' method='post' class='form-inline'>
                                <div>
                                    <input class='form-control my-3 ml-2' type='text' name='contenu' placeholder='Commentaire' style='max-width: 300px'>
                                    <input class='btn btn-success inline-button' type='submit' value='Envoyer' disabled>
                                    <input type='hidden' name='newsid' value='" . $val->getId() . "'
                                </div><br>
                            </form>
                        </div>";
                }

                if($comm != null){
                    foreach ($comm as $val){
                        print "<div class='alert alert-dark m-2'>
                                    <u><b>" . $val->getAuteur() . "</u></b>" . ": " . $val->getContenu();

                        if(isset($user) && $user->getId() == $val->getAuteurid()){


                        print       "<a class='btn btn-danger' href='index.php?action=supp_comm&newsid=" . $_REQUEST["newsid"] . "&commid=" . $val->getId() . "' style='float: right; max-height: 35px'>
                                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill mb-2' viewBox='0 0 16 16'>
                                                <path fill-rule='evenodd' d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z'/>
                                        </svg>
                                    </a>";

                        }
                        print       "</div>";
                    }
                }
                else{
                    print "<div class='m-3'>Pas encore de commentaire <br></div>";
                }
            }
        }
    }
    else{
        print "<div class='card border-dark mt-5'>
                            <form action='index.php?action=add_comm' method='post' class='form-inline'>
                                <div>
                                    <h4 class='ml-3 my-3'><i>Pas de news</i></h4>
                                </div><br>
                            </form>
                        </div>";
    }
    ?>

</main>
</body>
</html>
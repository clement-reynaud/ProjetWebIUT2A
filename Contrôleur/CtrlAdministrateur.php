<?php

require_once ("../Modèle/ModeleNews.php");
require_once ("../Modèle/ModeleUtilisateur.php");
require_once("../config/Validation.php");

class CtrlAdministrateur extends CtrlUtilisateur
{
    /**
     * CtrlAdministrateur constructor.
     */
    public function __construct()
    {
        try{
            $dVueErreur=array();
            if(isset($_REQUEST['action'])){
                $action=$_REQUEST['action'];
            }
            else{
                $action = null;
            }

            switch ($action){
                case null:
                    $this->pagePrincipale();
                    break;
                case "supp_comm":
                    $this->suppCommentaire();
                    break;
                case "add_news":
                    $this->addNews();
                    break;
                case "page_add_news":
                    $this->pageAddNews();
                    break;
                case "supp_news":
                    $this->suppNews();
                    break;
                default:
                    $dVueErreur[] = "erreur appel php (ctrl admin)";
                    require ("../Vue/erreur.php");
            }
        }
        catch (PDOException $e){
            $dVueErreur[] = "Erreur BD levé: <br>" . $e->getMessage();
            require ("../Vue/erreur.php");
        }
        catch (Exception $e){
            $dVueErreur[] = "erreur inatendu";
            require ("../Vue/erreur.php");
        }

        exit(0);
    }



    private function addNews()
    {

        if(isset($_POST["titre"]) && isset($_POST["contenu"])){
            $m=new ModeleNews();
            $m->addNews($_POST["titre"], $_POST["contenu"]);
            header("location: ../Vue/index.php");
        }
        else{
            $titrepage="Ajout News:";
            require ("ajoutNews.php");
        }
    }

    private function suppNews()
    {
        $mn=new ModeleNews();
        $mc=new ModeleCommentaire();
        $mc->suppCommentaireByNewsId($_REQUEST["newsid"]);
        $mn->suppNews($_REQUEST["newsid"]);
        header("location: ../Vue/index.php");
    }

     function pageAddNews()
    {
        $titrepage = "Ajout d'une news :";
        require ("ajoutNews.php");
    }

    function pagePrincipale(){

        $m = new ModeleNews();

        if(isset($_SESSION["pseudo"]) && $_SESSION["pseudo"] != null){
            $user = new Utilisateur($_SESSION["id"],$_SESSION["pseudo"],'');
        }

        $titrepage = "Toutes les news:";
        $nbNews = $m->getNbNews();
        $news = $m->getNews();

        require("../Vue/PagePrincipale.php");
    }

}
<?php

require_once ("../Modèle/ModeleNews.php");
require_once ("../Modèle/ModeleUtilisateur.php");
require_once ("../Modèle/ModeleCommentaire.php");
require_once("../config/Validation.php");

class CtrlUtilisateur
{
    private $pagePrincipale = "../Vue/PagePrincipale.php";

    function __construct(){
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
                case "add_comm":
                    $this->addCommentaire();
                    break;
                case "deconnexion":
                    $this->deconnexion();
                    break;
                case "supp_comm":
                    $this->suppCommentaire();
                    break;
                default:
                    $dVueErreur[] = "erreur appel php (crtl utilisateur)";
                    require ("../Vue/erreur.php");
            }
        }
        catch (PDOException $e){

            $dVueErreur[] = "erreur BD levé: <br>" . $e->getMessage();
            require ("../Vue/erreur.php");
        }
        catch (Exception $e){
            $dVueErreur[] = "erreur inatendu";
            require ("../Vue/erreur.php");
        }

        exit(0);
    }

    function pagePrincipale(){

        $m = new ModeleNews();

        if(isset($_SESSION["pseudo"]) && $_SESSION["pseudo"] != null){
            $user = new Utilisateur($_SESSION["id"],$_SESSION["pseudo"],$_SESSION["role"]);
        }

        $titrepage = "Toutes les news:";
        $nbNews = $m->getNbNews();
        $news = $m->getNews();

        require("../Vue/PagePrincipale.php");
    }

    function addCommentaire(){
        $m=new ModeleCommentaire();

        $m->addCommentaire($_SESSION["id"], $_POST["newsid"], $_POST["contenu"]);
        CtrlVisiteur::voirCommentaire();

    }

    private function deconnexion()
    {
        unset($_SESSION["pseudo"]);
        unset($_SESSION["id"]);
        unset($_SESSION["role"]);
        session_unset();
        session_destroy();
        $_SESSION = array();

        $this->pagePrincipale();
    }

    function suppCommentaire()
    {
        $m=new ModeleCommentaire();
        $m->suppCommentaire($_REQUEST["commid"]);
        CtrlVisiteur::voirCommentaire();
    }

}
<?php

require_once ("../Modèle/ModeleNews.php");
require_once ("../Modèle/ModeleUtilisateur.php");
require_once ("../Modèle/ModeleCommentaire.php");
require_once("../config/Validation.php");

class CtrlVisiteur
{
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
                case "rech_date":
                    $this->rechDate();
                    break;
                case "login":
                    $this->login();
                    break;
                case "add_utilisateur":
                    $this->addUtilisateur();
                    break;
                case "voir_commentaire":
                    $this->voirCommentaire();
                    break;
                default:
                    $dVueErreur[] = "erreur appel php";
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
        $cookie=$_COOKIE[$_SESSION["pseudo"]."nbCom"];
        require ("../Vue/test.php");
    }

    function rechDate(){

        if(isset($_SESSION["pseudo"]) && $_SESSION["pseudo"] != null){
            $user = new Utilisateur($_SESSION["id"],$_SESSION["pseudo"],$_SESSION["role"]);
        }

        $m = new ModeleNews();
        if(isset($_REQUEST["date"])){
            $date = $_REQUEST["date"];


            $titrepage = "Resultat Recherche :";
            $nbNews = $m->getNbNews();
            $news = $m->getNewsAtDate($date);

            require ("../Vue/test.php");
        }
        else{
            $dVueErreur[] = "erreur date";
            require ("../Vue/erreur.php");
        }
    }

    function addUtilisateur(){
        if(isset($_POST["pseudo"]) && isset($_POST["mdp"])){
            $m = new ModeleUtilisateur();
            $m->addUtilisateur($_POST["pseudo"],$_POST["mdp"],$_POST["confirm_mdp"]);
            header("location: ../Vue/index.php");
        }
        else{
            $titrepage = "Creation de compte:";
            require ("../Vue/creationCompte.php");
        }

    }

    private function login()
    {
        if(isset($_POST["pseudo"]) && isset($_POST["mdp"])){
            $m = new ModeleUtilisateur();
            $m->connexionUtilisateur($_REQUEST["pseudo"],$_REQUEST["mdp"]);
            header("location: ../Vue/index.php");
        }
        else{
            $titrepage="Connexion:";
            require ("login.php");
        }
    }

    public static function voirCommentaire()
    {
        if(isset($_SESSION["pseudo"]) && $_SESSION["pseudo"] != null){
            $user = new Utilisateur($_SESSION["id"],$_SESSION["pseudo"],$_SESSION["role"]);
        }

        $m1 = new ModeleNews();
        $m2 = new ModeleCommentaire();

        $n = $m1->getNewsById($_REQUEST["newsid"]);
        $titrepage = "Commentaires :";
        $nbNews = $m1->getNbNews();
        $news[] = $n;
        $comm = $m2->getComm($n->getId());


        require ("../Vue/test.php");

    }
}
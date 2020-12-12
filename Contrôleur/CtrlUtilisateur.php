<?php

require_once ("../Modèle/ModeleNews.php");
require_once ("../Modèle/ModeleUtilisateur.php");
require_once ("../Modèle/ModeleCommentaire.php");
require_once ("../config/ValidationForm.php");

class CtrlUtilisateur
{
    private $pagePrincipale = "../Vue/test.php";

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
                case "page_add_comm":
                    $this->pageAddCommentaire();
                    break;
                case "rech_date":
                    $this->rechDate();
                    break;
                case "login":
                    $this->login();
                    break;
                case "validation_login":
                    $this->validateLogin();
                    require ("../Vue/erreur.php");
                    break;
                case "deconnexion":
                    $this->deconnexion();
                    break;
                case "add_utilisateur":
                    $this->addUtilisateur();
                    break;
                case "validation_add_utilisateur":
                    $this->validateaddUtilisateur();
                    break;
                case "supp_comm":
                    $this->suppCommentaire();
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
            $user = new Utilisateur($_SESSION["id"],$_SESSION["pseudo"]);
        }

        $titrepage = "Toutes les news:";
        $nbNews = $m->getNbNews();
        $news = $m->getNews();

        require ("../Vue/test.php");
    }

    function rechDate(){

        if(isset($_SESSION["pseudo"]) && $_SESSION["pseudo"] != null){
            $user = new Utilisateur($_SESSION["id"],$_SESSION["pseudo"]);
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

    function addCommentaire(){
        $m=new ModeleCommentaire();
        $m->addCommentaire($_SESSION["id"], $_POST["newsid"], $_POST["contenu"]);
        $this->voirCommentaire();

    }

    function addUtilisateur(){
        $titrepage = "Creation de compte:";
        require ("../Vue/creationCompte.php");
    }

    function validateaddUtilisateur()
    {
        ValidationForm::validate();

        $m = new ModeleUtilisateur();

        $m->addUtilisateur($_POST["pseudo"],$_POST["mdp"]);
        print ("compte crée");
    }

    private function login()
    {
        $titrepage="Connexion:";
        require ("login.php");
    }

    private function validateLogin()
    {
        ValidationForm::validate();

        $m = new ModeleUtilisateur();
        $u = $m->getUti($_REQUEST["pseudo"]);

        $_SESSION["pseudo"] = $u->getPseudo();
        $_SESSION["id"] = $u->getId();

        header("location: ../Vue/index.php");
    }

    private function deconnexion()
    {
        unset($_SESSION["pseudo"]);
        unset($_SESSION["id"]);
        session_destroy();

        $this->pagePrincipale();
    }

    function suppCommentaire()
    {
        $m=new ModeleCommentaire();
        $m->suppCommentaire($_POST["id"]);
        print("Commentaire supprimé");
    }

    private function voirCommentaire()
    {
        if(isset($_SESSION["pseudo"]) && $_SESSION["pseudo"] != null){
            $user = new Utilisateur($_SESSION["id"],$_SESSION["pseudo"]);
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

    private function pageAddCommentaire()
    {
        require ("ajoutCommentaire.php");
    }


}
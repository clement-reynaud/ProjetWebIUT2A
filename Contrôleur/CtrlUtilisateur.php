<?php

require_once ("../Modèle/ModeleNews.php");
require_once ("../Modèle/ModeleUtilisateur.php");
require_once ("../Modèle/ModeleCommentaire.php");
require_once ("../config/ValidationForm.php");

class CtrlUtilisateur
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
                case "add_comm":
                    $this->addCommentaire();
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

        $titrepage = "Toutes les news:";
        $nbNews = $m->getNbNews();
        $news = $m->getNews();

        require ("../Vue/PagePrincipale.php");
    }

    function rechDate(){

        $m = new ModeleNews();
        if(isset($_REQUEST["date"])){
            $date = $_REQUEST["date"];


            $titrepage = "Resultat Recherche :";
            $nbNews = $m->getNbNews();
            $news = $m->getNewsAtDate($date);

            require ("../Vue/PagePrincipale.php");
        }
        else{
            $dVueErreur[] = "erreur date";
            require ("../Vue/erreur.php");
        }
    }

    function addCommentaire(){
        ValidationForm::validate();

        $m=new ModeleCommentaire();
        $m->addCommentaire($_POST["auteurid"], $_POST["newsid"], $_POST["contenu"]);
        print("Commentaire ajouté");

    }

    function addUtilisateur(){
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
        require ("login.php");
    }

    private function validateLogin()
    {
        ValidationForm::validate();

        $_SESSION["pseudo"] = $_POST["pseudo"];
        $_SESSION["mdp"] = $_POST["mdp"];

        $this->pagePrincipale();
    }

    private function deconnexion()
    {
        unset($_SESSION["pseudo"]);
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
        $m1 = new ModeleNews();
        $m2 = new ModeleCommentaire();

        $n = $m1->getNewsById($_REQUEST["newsid"]);
        $titrepage = "Commentaire :";
        $nbNews = $m1->getNbNews();
        $news[] = $n;
        $comm = $m2->getComm($n->getId());


        require ("../Vue/PagePrincipale.php");

    }


}
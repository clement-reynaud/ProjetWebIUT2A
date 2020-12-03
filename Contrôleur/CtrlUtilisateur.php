<?php

require_once ("../Modèle/ModeleNews.php");
require_once ("../Modèle/ModeleUtilisateur.php");
require_once ("../config/ValidationForm.php");

class CtrlUtilisateur
{
    function __construct(){
        session_start();
        session_unset();
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
                case "add_utilisateur":
                    $this->addUtilisateur();
                    break;
                case "validation_add_utilisateur":
                    $this->validateaddUtilisateur();
                    break;
                default:
                    $dVueErreur[] = "erreur appel php";
                    require ("../Vue/erreur.php");
            }
        }
        catch (PDOException $e){
            $dVueErreur[] = "erreur BD levé";
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
        $nbNews = $m->getNbNews();
        $news = $m->getNews();

        require ("../Vue/PagePrincipale.php");
    }

    function rechDate(){

    }

    function addCommentaire(){

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

        print("loged in" . $_POST["pseudo"] . " " . $_POST["mdp"]);
        //Login as utilisateur
    }

}
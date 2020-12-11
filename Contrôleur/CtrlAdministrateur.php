<?php

require_once ("../Modèle/ModeleNews.php");
require_once ("../Modèle/ModeleUtilisateur.php");
require_once ("../config/ValidationForm.php");

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
                case "supp_comm":
                    $this->suppCommentaire();
                    break;
                case "add_news":
                    $this->addNews();
                    break;
                case "page_add_news":
                    $this->pageAddNews();
                case "supp_news":
                    $this->suppNews();
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



    private function addNews()
    {

        ValidationForm::validate();

        $m=new ModeleNews();
        $m->addNews($_POST["titre"], $_POST["contenu"]);
        print("News ajoutée");
        require ("ajoutNews.php");
    }

    private function suppNews()
    {
        $m=new ModeleNews();
        $m->suppNews($_POST["id"]);
        print("News supprimée");
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

     function pageAddNews()
    {
        require ("ajoutNews.php");
    }

}
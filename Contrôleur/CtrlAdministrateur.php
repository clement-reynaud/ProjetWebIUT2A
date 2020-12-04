<?php


class CtrlAdministrateur extends CtrlUtilisateur
{

    /**
     * CtrlAdministrateur constructor.
     */
    public function __construct()
    {
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
                case "add_news":
                    $this->addNews();
                    break;
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
        print("News Ajoutée");
    }

    private function suppNews()
    {
        $m=new ModeleNews();
        $m->suppNews($_POST["id"]);
        print("News Supprimée");
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
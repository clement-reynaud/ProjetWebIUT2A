<?php


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
                case "add_utilisateur":
                    $this->addUtilisateur();
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
        require ("../Vue/PagePrincipale.php");
    }

    function rechDate(){

    }

    function addCommentaire(){

    }

    private function addUtilisateur(){

    }

}
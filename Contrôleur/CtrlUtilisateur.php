<?php


class CtrlUtilisateur
{
    function __construct(){
        try{
            $dVueErreur=array();

            $action=$_REQUEST['action'];

            switch ($action){
                case NULL:
                    $this->pagePrincipale();
                    break;
                case "add_comm":
                    $this->addCommentaire();
                    break;
                case "rech_date":
                    $this->rechDate();
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

    }

    function rechDate(){

    }

    function addCommentaire(){

    }

}
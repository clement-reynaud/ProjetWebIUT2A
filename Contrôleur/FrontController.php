<?php

require_once("../Contrôleur/CtrlUtilisateur.php");
require_once ("../Contrôleur/CtrlAdministrateur.php");
require_once ("../Contrôleur/CtrlVisiteur.php");
require_once ("../Modèle/ModeleAdmin.php");
require_once ("../Modèle/ModeleUtilisateur.php");

class FrontController
{
    private $actionAdmin = ["supp_comm","add_news","page_add_news","supp_news"];
    private $actionUti = ["add_comm","deconnexion","supp_comm"];

    public function __construct(){

        $ma = new ModeleAdmin();
        $mu = new ModeleUtilisateur();

        if(isset($_REQUEST['action'])){
            $action=$_REQUEST['action'];
        }
        else{
            $action = null;
        }

        if(in_array($action,$this->actionAdmin)){
            if($ma->isAdmin()){
                $ctrl = new CtrlAdministrateur();
            }
            else{
                $_REQUEST["action"] = "login_admin";
                $ctrl = new CtrlVisiteur();
            }
        }
        elseif(in_array($action,$this->actionUti)){
            if($mu->isUtilisateur()){
                $ctrl = new CtrlUtilisateur();
            }
            else{
                $_REQUEST["action"] = "login";
                $ctrl = new CtrlVisiteur();
            }
        }
        else{
            $ctrl = new CtrlVisiteur();
        }
    }


}
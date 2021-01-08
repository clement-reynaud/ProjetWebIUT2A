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
            $ctrl = new CtrlAdministrateur();
        }
        elseif(in_array($action,$this->actionUti)){
            $ctrl = new CtrlUtilisateur();
        }
        else{
            $ctrl = new CtrlVisiteur();
        }
    }


}
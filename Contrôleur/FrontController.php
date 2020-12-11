<?php

require_once("../Contrôleur/CtrlUtilisateur.php");
require_once ("../Contrôleur/CtrlAdministrateur.php");

class FrontController
{
    private $actionAdmin = ["supp_comm","add_news","page_add_news","supp_news"];

    public function __construct(){

        if(isset($_REQUEST['action'])){
            $action=$_REQUEST['action'];
        }
        else{
            $action = null;
        }

        if(in_array($action,$this->actionAdmin)){
            $ctrl = new CtrlAdministrateur();
        }
        else{
            $ctrl = new CtrlUtilisateur();
        }
    }


}
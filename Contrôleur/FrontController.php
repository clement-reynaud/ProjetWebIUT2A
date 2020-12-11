<?php

require_once("../Contrôleur/CtrlUtilisateur.php");
require_once ("../Contrôleur/CtrlAdministrateur.php");

class FrontController
{
    private $actionAdmin = ["supp_comm","add_news","page_add_news","supp_news"];

    public function __construct(){
        if(in_array($_REQUEST["action"],$this->actionAdmin) && isset($_REQUEST["action"])){
            $ctrl = new CtrlAdministrateur();
        }
        else{
            $ctrl = new CtrlUtilisateur();
        }
    }


}
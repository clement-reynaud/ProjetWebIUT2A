<?php

require_once ("../DAL/Gateway/AdminGateway.php");

class ModeleAdmin
{
    public $agt;

    public function __construct(){
        require ("../config/Config.php");
        $this->ugt = new UtilisateurGateway($con);
    }

    function verifyPseudo($pseudo){
        return $this->ugt->verifyPseudo($pseudo);
    }

    public function verifyMdp($mdp)
    {
        return $this->ugt->verifyMdp($mdp);
    }

    public function getUti($pseudo){
        return $this->ugt->getAdm($pseudo);
    }
}
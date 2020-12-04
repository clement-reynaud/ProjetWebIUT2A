<?php

require_once ("../DAL/Gateway/NewsGateway.php");

class ModeleUtilisateur{
    public $ugt;

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

    public function addUtilisateur($pseudo,$login){
        $this->ugt->addUtilisateur($pseudo,$login);
    }

}
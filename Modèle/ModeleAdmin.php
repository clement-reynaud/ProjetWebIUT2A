<?php

require_once ("../DAL/Gateway/AdminGateway.php");

class ModeleAdmin
{
    public $agt;

    public function __construct(){
        require ("../config/Config.php");
        $this->agt = new AdminGateway($con);
    }

    function verifyPseudo($pseudo){
        return $this->agt->verifyPseudo($pseudo);
    }

    public function verifyMdp($mdp)
    {
        return $this->agt->verifyMdp($mdp);
    }

    public function getUti($pseudo){
        return $this->agt->getAdm($pseudo);
    }

    public function verifyConnexion($pseudo,$mdp){
        return $this->agt->verifyConnexion($pseudo,$mdp);
    }

    public function addAdmin($pseudo,$mdp,$confirm_mdp){
        $m = new ModeleAdmin();

        if(!$m->verifyPseudo($pseudo)){
            $dVueErreur[] = "Ce login existe deja.";
        }
        if ($mdp != $confirm_mdp) {
            $dVueErreur[] = "Confirmation mot de passe invalide.";
        }

        if (Validation::is_string_null($pseudo)) {
            $dVueErreur[] = "Veuillez entrer un pseudo.";
        }
        if(!Validation::validate_string($pseudo)){
            $dVueErreur[] = "Login erroné";
        }

        if (Validation::is_string_null($mdp)) {
            $dVueErreur[] = "Veuillez insérer votre mot de passe.";
        }

        if(isset($dVueErreur[0])){
            require("../Vue/erreur.php");
        }

        $param_mdp = password_hash($mdp, PASSWORD_DEFAULT);


        $this->agt->addAdmin($pseudo,$param_mdp);
    }

    public function connexionAdmin($pseudo,$mdp){
        if (Validation::is_string_null($pseudo)) {
            $dVueErreur[] = "Veuillez entrer un pseudo.";
        }
        if(!Validation::validate_string($pseudo)){
            $dVueErreur[] = "Login erroné";
        }

        if (Validation::is_string_null($mdp)) {
            $dVueErreur[] = "Veuillez entrer un mot de passe.";
        }
        if(!Validation::validate_string($mdp)) {
            $dVueErreur[] = "Mdp erroné";
        }

        if(!$this->verifyConnexion($pseudo,$mdp)){
            $dVueErreur[] = "La combinaison du pseudo et du mot de passe n'existe pas";
        }

        if(isset($dVueErreur[0])){
            require("../Vue/erreur.php");
        }

        $u = $this->getUti($_REQUEST["pseudo"]);

        $_SESSION["role"] = "Admin";
        $_SESSION["pseudo"] = $u->getPseudo();
        $_SESSION["id"] = $u->getId();
    }

    function isAdmin() : bool{
        if(isset($_SESSION['login']) && isset($_SESSION['role']) && $_SESSION['role'] == "Admin"){
            return true;
        }
        return false;
    }
}
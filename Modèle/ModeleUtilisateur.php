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

    public function verifyConnexion($pseudo,$mdp){
        return $this->ugt->verifyConnexion($pseudo,$mdp);
    }

    public function addUtilisateur($pseudo,$mdp,$confirm_mdp){
        $m = new ModeleUtilisateur();

        if(!$m->verifyPseudo($pseudo)){
            $dVueErreur[] = "Ce login existe deja.";
        }
        if ($mdp != $confirm_mdp) {
            $dVueErreur[] = "Confirmation mot de passe invalide.";
        }

        if ($pseudo == "" || !isset($pseudo)) {
            $dVueErreur[] = "Veuillez entrer un pseudo.";
        }
        if(!Validation::validate_string($pseudo)){
            $dVueErreur[] = "Login erroné";
        }

        if ($mdp == "" || !isset($mdp)) {
            $dVueErreur[] = "Veuillez insérer votre mot de passe.";
        }

        if(isset($dVueErreur[0])){
            require("../Vue/erreur.php");
        }

        $param_mdp = password_hash($mdp, PASSWORD_DEFAULT);

        $this->ugt->addUtilisateur($pseudo,$param_mdp);
    }

    public function getUti($pseudo){
        return $this->ugt->getUti($pseudo);
    }

    public function connexionUtilisateur($pseudo,$mdp){
        if ($pseudo == "" || !isset($pseudo)) {
            $dVueErreur[] = "Veuillez entrer un pseudo.";
        }
        if(!Validation::validate_string($pseudo)){
            $dVueErreur[] = "Login erroné";
        }

        if ($mdp == "" || !isset($mdp)) {
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

        $_SESSION["role"] = "Utilisateur";
        $_SESSION["pseudo"] = $u->getPseudo();
        $_SESSION["id"] = $u->getId();
    }

}
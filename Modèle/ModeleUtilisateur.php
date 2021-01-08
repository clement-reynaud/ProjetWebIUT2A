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

        $this->ugt->addUtilisateur($pseudo,$param_mdp);
    }

    public function getUti($pseudo){
        return $this->ugt->getUti($pseudo);
    }
/*
    function incCookie(): int
    {
        if (isset ($_COOKIE["nbCo"])){
            $nCo=filter_var($_COOKIE["nbCo"], FILTER_SANITIZE_NUMBER_INT);
            $nCo=$nCo+1;
        }
        else{
            $nCo=1;
        }
        setcookie("nbCo", $nCo, time()+3600);
        return $nCo;
    }*/

    function nbComCookie()
    {
        if(isset($_SESSION["pseudo"])) {
            Validation::validate_string($_SESSION["pseudo"]);
            $nomCookie = $_SESSION['pseudo'] . "nbCom";
            $cookie=$_COOKIE[$nomCookie];
            if (isset($cookie)) {
                Validation::validate_string($cookie);
                $cookie++;
            }
            else{
                $cookie=1;
            }
            setcookie($nomCookie, $cookie, time()+365*24*3600);

        }

    }

    public function connexionUtilisateur($pseudo,$mdp){
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

        $_SESSION["role"] = "Utilisateur";
        $_SESSION["pseudo"] = $u->getPseudo();
        $_SESSION["id"] = $u->getId();
    }

    function isUtilisateur() : bool{
        if(isset($_SESSION['role']) && $_SESSION['role'] == "Utilisateur"){
            return true;
        }
        return false;
    }

}
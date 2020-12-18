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

}
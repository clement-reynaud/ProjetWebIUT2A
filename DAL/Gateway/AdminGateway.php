<?php

require_once("../Modèle/Métier/Utilisateur.php");
require_once("../config/Connection.php");

class AdminGateway
{
    protected $con;

    /**
     * UtilisateurGateway constructor.
     * @param $con
     */
    public function __construct($con)
    {
        $this->con = $con;
    }

    public function verifyPseudo(string $pseudo) : bool{

        $query="SELECT COUNT(*) FROM `admin` WHERE :pseudo=pseudo ";
        $this->con->executeQuery($query, array(
            ':pseudo'=>array($pseudo, PDO::PARAM_STR),
        ));

        if(intval($this->con->getResults()[0]['COUNT(*)']) == 0){
            return true;
        }
        else{
            return false;
        }
    }

    public function verifyMdp(string $mdp) : bool{
        $query="SELECT COUNT(*) FROM `admin` WHERE :mdp=mdp";
        $this->con->executeQuery($query, array(
            ':mdp'=>array($mdp,PDO::PARAM_STR),
        ));

        if(intval($this->con->getResults()[0]['COUNT(*)']) == 0){
            return true;
        }
        else{
            return false;
        }
    }

    public function addUtilisateur(string $pseudo, string $mdp){
        $query="INSERT INTO `admin` (`pseudo`, `mdp`) VALUES (:pseudo,:mdp)";
        $this->con->executeQuery($query,array(
            ':pseudo'=>array($pseudo,PDO::PARAM_STR),
            ':mdp'=>array($mdp,PDO::PARAM_STR)
        ));
    }

    public function getAdm(string $pseudo)
    {
        $query="SELECT * FROM `admin` WHERE pseudo=:pseudo";
        $this->con->executeQuery($query,array(
            ':pseudo'=>array($pseudo,PDO::PARAM_STR),
        ));

        $u = $this->con->getResults()[0];

        return new Utilisateur($u["id"],$u["pseudo"]);
    }
}
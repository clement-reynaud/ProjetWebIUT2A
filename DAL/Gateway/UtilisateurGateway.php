<?php

require_once("../Modèle/Utilisateur.php");
require_once("../config/Connection.php");

class UtilisateurGateway
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

    /**
     * @return mixed
     */
    public function getCon()
    {
        return $this->con;
    }

    /**
     * @param mixed $con
     */
    public function setCon($con)
    {
        $this->con = $con;
    }

    public function verifyPseudo(string $pseudo) : bool{

        $query="SELECT COUNT(*) FROM UTILISATEURS WHERE :pseudo=pseudo ";
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

    public function verifMdp(string $mdp) : bool{
        $query="SELECT COUNT(*) FROM UTILISATEURS WHERE :mdp=mdp";
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
        $query="INSERT INTO UTILISATEURS (`pseudo`, `mdp`) VALUES (:pseudo,:mdp)";
        $this->con->executeQuery($query,array(
            ':pseudo'=>array($pseudo,PDO::PARAM_STR),
            ':mdp'=>array($mdp,PDO::PARAM_STR)
        ));
    }
}
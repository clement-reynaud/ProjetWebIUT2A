<?php

require_once("Utilisateur.php");
require_once("../../config/Connection.php");

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
}
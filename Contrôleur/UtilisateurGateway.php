<?php

require_once("../Modèle/Utilisateur.php");
require_once("../Modèle/Connection.php");

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
}
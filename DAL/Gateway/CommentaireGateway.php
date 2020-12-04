<?php

require_once("../Modèle/Commentaire.php");
require_once("../config/Connection.php");

class CommentaireGateway
{
    protected $con;

    /**
     * CommentaireGateway constructor.
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
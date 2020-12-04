<?php

require_once("../Modèle/Métier/Commentaire.php");
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

    public function addCommentaire(int $auteurid, int $newsid, string $contenu){
        $query="INSERT INTO COMMENTAIRES (`auteurid`, `newsid`, `contenu`) VALUES (:auteurid,:newsid,:contenu)";
        $this->con->executeQuery($query,array(
            ':auteurid'=>array($auteurid,PDO::PARAM_INT),
            ':newsid'=>array($newsid,PDO::PARAM_INT),
            ':contenu'=>array($contenu,PDO::PARAM_STR)
        ));
    }

    public function suppCommentaire(int $id){
        $query="DELETE FROM COMMENTAIRES WHERE :id=id";
        $this->con->executeQuery($query,array(
            ':id'=>array($id,PDO::PARAM_INT)
        ));
    }

}
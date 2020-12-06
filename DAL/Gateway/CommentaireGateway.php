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

    public function getCommByNewsId($id){
        $query="SELECT * FROM `commentaires` WHERE newsid = :id";
        $this->con->executeQuery($query,array(
            ':id'=>array($id,PDO::PARAM_INT)
        ));

        $res = [];

        foreach ($this->con->getResults() as $val){
            $res[] = new Commentaire($val["id"],$val["contenu"],$val["newsid"],$val["auteurid"],$this->getCommAuthor($val["auteurid"]));
        }

        return $res;

    }

    public function getCommAuthor($id){
        $query="SELECT u.pseudo FROM commentaires c,utilisateurs u WHERE c.auteurid = u.id AND c.auteurid=:id";
        $this->con->executeQuery($query,array(
            ':id'=>array($id,PDO::PARAM_INT)
        ));

        return $this->con->getResults()[0]["pseudo"];
    }

}
<?php

require_once ("../DAL/Gateway/CommentaireGateway.php");

class ModeleCommentaire
{
    public $cgt;

    /**
     * ModeleCommentaire constructor.
     * @param $cgt
     */
    public function __construct()
    {
        require ("../config/Config.php");
        $this->cgt = new CommentaireGateway($con);
    }

    function addCommentaire(int $auteurid, int $newsid, string $contenu){
        $this->cgt->addCommentaire($auteurid, $newsid, $contenu);
    }

    function suppCommentaire(int $id){
        $this->cgt->suppCommentaire($id);
    }

    function getComm($newsid){
        return $this->cgt->getCommByNewsId($newsid);
    }

}
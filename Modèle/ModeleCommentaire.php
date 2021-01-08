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
        $u=new ModeleUtilisateur();

        if(Validation::is_string_null($contenu)){
            $dVueErreur[] = "Veuillez entrer un commentaire.";
        }

        if (!Validation::validate_string($contenu)) {
            $dVueErreur[] = "Ce commentaire est erroné.";
        }

        if(isset($dVueErreur[0])){
            require("../Vue/erreur.php");
        }

        $this->cgt->addCommentaire($auteurid, $newsid, $contenu);
        $u->nbComCookie();
    }

    function suppCommentaire(int $id){
        $this->cgt->suppCommentaire($id);
    }

    function suppCommentaireByNewsId($newsid){
        foreach ($this->getComm($newsid) as $val){
            $this->suppCommentaire($val->getId());
        }
    }

    function getComm($newsid){
        return $this->cgt->getCommByNewsId($newsid);
    }

}
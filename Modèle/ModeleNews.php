<?php

require_once ("../DAL/Gateway/NewsGateway.php");

class ModeleNews{

    public $ngt;

    /**
     * ModeleNews constructor.
     * @param NewsGateway $ngt
     */
    public function __construct()
    {
        require ("../config/Config.php");
        $this->ngt = new NewsGateway($con);
    }

    function getNbNews(){
        return $this->ngt->NbNews();
    }

    function getNews(){
        return $this->ngt->getAllNews();
    }

    function getNewsAtDate($date){
        return $this->ngt->getNewsAtDate($date);
    }

<<<<<<< Updated upstream
    function getNewsById($id){
        return $this->ngt->getNewsById($id);
=======
    function addNews($titre, $contenu){
        $this->ngt->addNews($titre, $contenu);
    }

    function suppNews($id){
        $this->ngt->supprNews($id);
>>>>>>> Stashed changes
    }
}


?>
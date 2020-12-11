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
        //Manipulation du format des dates
        $date1 = $date = date("Y-m-d H:i:s",strtotime($date));
        $date2 = $date = date("Y-m-d H:i:s",strtotime($date));
        $date2 = new DateTime($date2);
        date_modify($date2,"+1 day");
        $date2 = date_format($date2,"Y-m-d H:i:s");

        return $this->ngt->getNewsAtDate($date1,$date2);
    }

    function getNewsById($id)
    {
        return $this->ngt->getNewsById($id);
    }

    function addNews($titre, $contenu){
        $this->ngt->addNews($titre, $contenu);
    }

    function suppNews($id){
        $this->ngt->supprNews($id);
    }
}
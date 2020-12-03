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
}


?>
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

        if(Validation::is_string_null($titre)){
            $dVueErreur[] = "Veuillez entrer un titre.";
        }

        if (!Validation::validate_string($titre)) {
            $dVueErreur[] = "Le titre est erroné.";
        }

        if(Validation::is_string_null($contenu)){
            $dVueErreur[] = "Veuillez entrer un contenu.";
        }

        if (!Validation::validate_string($contenu)) {
            $dVueErreur[] = "Le contenu est erroné.";
        }

        if(isset($dVueErreur[0])){
            require("../Vue/erreur.php");
        }

        $this->ngt->addNews($titre, $contenu);
    }

    function suppNews($id){
        $this->ngt->supprNews($id);
    }
}
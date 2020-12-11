<?php

require_once("../Modèle/Métier/News.php");
require_once("../config/Config.php");

class NewsGateway
{
    protected $con;

    /**
     * NewsGateway constructor.
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

    public function addNews($titre,$contenu){
        $query = "INSERT INTO news (`titre`, `contenu`) VALUES (:titre,:contenu)";
        $this->con->executeQuery($query,array(
           ":titre"=>array($titre,PDO::PARAM_STR),
           ":contenu"=>array($contenu,PDO::PARAM_STR)
        ));
    }

    public function supprNews($id){
        $query = "DELETE FROM `news` WHERE id=:id";
        $this->con->executeQuery($query,array(
            ":id"=>array($id,PDO::PARAM_STR)
        ));
    }

    public function NbNews():int{
        $query="SELECT COUNT(*) FROM NEWS";
        $this->con->executeQuery($query, array());
        return intval($this->con->getResults()[0]['COUNT(*)']);
    }

    public function getAllNews() : array{

        $query="SELECT * FROM NEWS";
        $this->con->executeQuery($query, array());

        $res = [];

        foreach ($this->con->getResults() as $val){
          $res[] = new News($val["id"],$val["titre"],$val["contenu"],$val["date_cree"]);
        }

        Return $res;
    }

    public function getNewsAtDate($date) : array{

        $query="SELECT * FROM `news` WHERE `date_cree` BETWEEN :date1 AND :date2 ";

        //Manipulation du format des dates
        $date1 = $date = date("Y-m-d H:i:s",strtotime($date));
        $date2 = $date = date("Y-m-d H:i:s",strtotime($date));
        $date2 = new DateTime($date2);
        date_modify($date2,"+1 day");
        $date2 = date_format($date2,"Y-m-d H:i:s");


        $this->con->executeQuery($query,array(
            ":date1"=>array($date1,PDO::PARAM_STR),
            ":date2"=>array($date2,PDO::PARAM_STR)
        ));

        $res=[];

        foreach ($this->con->getResults() as $val){
            $res[] = new News($val["id"],$val["titre"],$val["contenu"],$val["date_cree"]);
        }

        return $res;
    }

    public function getNewsById($id) : News{
        $query="SELECT * FROM news WHERE id=:id";

        $this->con->executeQuery($query,array(
            ":id"=>array($id,PDO::PARAM_INT)
        ));

        $n = $this->con->getResults()[0];

        return new News($n["id"],$n["titre"],$n["contenu"],$n["date_cree"]);
    }
}
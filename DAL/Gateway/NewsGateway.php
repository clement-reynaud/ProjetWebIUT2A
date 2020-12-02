<?php

require_once("../Modèle/News.php");
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

    public function NbNews():int{
        $query="SELECT COUNT(*) FROM NEWS";
        $this->con->executeQuery($query, array());
        return intval($this->con->getResults()[0]['COUNT(*)']);
    }

    public function getNews(int $premiereNews, int $NbNews) : array{

        $query="SELECT * FROM NEWS ORDER BY DATE_CREE DESC LIMIT :first, :last ";
        $this->con->executeQuery($query, array(
            ':first'=>array($premiereNews, PDO::PARAM_STR),
            ':last'=>array($NbNews, PDO::PARAM_STR)
        ));

        $res=$this->con->getResult();
        Return $res;
    }
}
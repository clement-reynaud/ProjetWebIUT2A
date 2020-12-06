<?php


class Commentaire
{
    protected $id;
    protected $contenu;
    protected $newsid;
    protected $auteurid;
    protected $auteur;

    /**
     * Commentaire constructor.
     * @param $id
     * @param $contenu
     * @param $newsid
     * @param $auteurid
     * @param $auteur
     */
    public function __construct($id, $contenu, $newsid, $auteurid, $auteur)
    {
        $this->id = $id;
        $this->contenu = $contenu;
        $this->newsid = $newsid;
        $this->auteurid = $auteurid;
        $this->auteur = $auteur;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * @param mixed $contenu
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    }

    /**
     * @return mixed
     */
    public function getNewsid()
    {
        return $this->newsid;
    }

    /**
     * @param mixed $newsid
     */
    public function setNewsid($newsid)
    {
        $this->newsid = $newsid;
    }

    /**
     * @return mixed
     */
    public function getAuteurid()
    {
        return $this->auteurid;
    }

    /**
     * @param mixed $auteurid
     */
    public function setAuteurid($auteurid)
    {
        $this->auteurid = $auteurid;
    }

    /**
     * @return mixed
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * @param mixed $auteur
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;
    }


}
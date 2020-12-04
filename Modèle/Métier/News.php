<?php


class News
{
    protected $id;
    protected $titre;
    protected $contenu;
    protected $date_cree;

    /**
     * News constructor.
     * @param $id
     * @param $titre
     * @param $contenu
     * @param $date_cree
     */
    public function __construct($id, $titre, $contenu, $date_cree)
    {
        $this->id = $id;
        $this->titre = $titre;
        $this->contenu = $contenu;
        $this->date_cree = $date_cree;
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
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param mixed $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
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
    public function getDateCree()
    {
        return $this->date_cree;
    }

    /**
     * @param mixed $date_cree
     */
    public function setDateCree($date_cree)
    {
        $this->date_cree = $date_cree;
    }
}
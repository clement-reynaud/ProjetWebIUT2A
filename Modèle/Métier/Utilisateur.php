<?php


class Utilisateur
{
    protected $id;
    protected $pseudo;

    /**
     * Utilisateur constructor.
     * @param $id
     * @param $pseudo
     */
    public function __construct($id, $pseudo)
    {
        $this->id = $id;
        $this->pseudo = $pseudo;
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
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * @param mixed $pseudo
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
    }

}
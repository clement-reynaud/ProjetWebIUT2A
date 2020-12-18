<?php


class Admin
{
    protected $id;
    protected $pseudo;
    protected $role;

    /**
     * Utilisateur constructor.
     * @param $id
     * @param $pseudo
     * @param $role
     */
    public function __construct($pseudo, $role)
    {
        $this->role = $role;
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
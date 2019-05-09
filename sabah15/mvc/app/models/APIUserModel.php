<?php

class APIUserModel
{
    public $idUser;
    public $uidUser;

    public function __construct($idUser, $uidUser)
    {
        $this->idUser = $idUser;
        $this->uidUser = $uidUser;
    }
}
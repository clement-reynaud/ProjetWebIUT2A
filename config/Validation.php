<?php

require_once ("../config/Connection.php");
require_once("../DAL/Gateway/UtilisateurGateway.php");
require_once ("../Contrôleur/CtrlUtilisateur.php");
require_once ("../Contrôleur/CtrlAdministrateur.php");
require_once ("../Modèle/ModeleUtilisateur.php");

class Validation
{
    static function validate_string($str){
        if ($str != filter_var($str, FILTER_SANITIZE_STRING)) {
            return false;
        }
        else{
            return true;
        }
    }

    static function is_string_null($str){
        if($str == "" || !isset($str)){
            return true;
        }
        else{
            return false;
        }
    }

}
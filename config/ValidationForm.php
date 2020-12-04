<?php

require_once ("../config/Connection.php");
require_once("../DAL/Gateway/UtilisateurGateway.php");
require_once ("../Contrôleur/CtrlUtilisateur.php");
require_once ("../Modèle/ModeleUtilisateur.php");

class ValidationForm
{

    static function action(){
        return $action = $_POST['action'] ?? "error";
    }

    static function validate(){
        $action = ValidationForm::action();

        switch ($action){
            case "validation_add_utilisateur":
                self::validate_add_utilisateur();
                break;
            case "validation_login":
                self::validate_connexion_utilisateur();
                break;
            default:
                $dVueErreur[] = "ValidationForm incorectement utilisé";
                require("../Vue/erreur.php");
        }
    }

    static function validate_add_utilisateur(){
        $m = new ModeleUtilisateur();

        if(!$m->verifyPseudo($_POST["pseudo"])){
            $dVueErreur[] = "Ce login existe deja.";
        }

        if ($_POST["mdp"] != $_POST["confirm_mdp"]) {
            $dVueErreur[] = "Veuillez confirmer votre mot de passe.";
        }

        if ($_POST["pseudo"] == "" || !isset($_POST["pseudo"])) {
            $dVueErreur[] = "Veuillez entrer un pseudo.";
        }

        if ($_POST["pseudo"] != filter_var($_POST["pseudo"], FILTER_SANITIZE_STRING)) {
            $dVueErreur[] = "Ce pseudo est erroné.";
        }

        if ($_POST["mdp"] == "" || !isset($_POST["mdp"])) {
            $dVueErreur[] = "Veuillez insérer votre mot de passe.";
        }

        if ($_POST["mdp"] != filter_var($_POST["mdp"], FILTER_SANITIZE_STRING)) {
            $dVueErreur[] = "Ce mot de passe est erroné.";
        }

        if(isset($dVueErreur[0])){
            require("../Vue/erreur.php");
        }
    }

    static function validate_connexion_utilisateur(){
        $m = new ModeleUtilisateur();

        if ($_POST["pseudo"] == "" || !isset($_POST["pseudo"])) {
            $dVueErreur[] = "Veuillez entrer un pseudo.";
        }

        if ($_POST["pseudo"] != filter_var($_POST["pseudo"], FILTER_SANITIZE_STRING)) {
            $dVueErreur[] = "Ce pseudo est erroné.";
        }

        if ($_POST["mdp"] == "" || !isset($_POST["mdp"])) {
            $dVueErreur[] = "Veuillez entrer votre mot de passe.";
        }

        if ($_POST["mdp"] != filter_var($_POST["mdp"], FILTER_SANITIZE_STRING)) {
            $dVueErreur[] = "Ce mot de passe est erroné";
        }

        if($m->verifyPseudo($_POST["pseudo"])&&$m->verifyMdp($_POST["mdp"])){
            $dVueErreur[] = "La combinaison du pseudo et du mot de passe n'existe pas";
        }

        if(isset($dVueErreur[0])){
            require("../Vue/erreur.php");
        }
    }

}
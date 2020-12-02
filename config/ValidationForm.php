<?php

require_once ("../config/Connection.php");
require_once ("../Modèle/UtilisateurGateway.php");

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
            case "validation_connexion_utilisateur":
                self::validate_connexion_utilisateur();
                break;
            default:
                $dVueErreur[] = "ValidationForm incorectement utilisé";
                require("../Vue/erreur.php");
        }
    }

    static function validate_add_utilisateur(){

        $ugt = new UtilisateurGateway($con);

        if(!$ugt->verifyPseudo($_POST["pseudo"])){
            $dVueErreur[] = "login deja existant";
        }

        if ($_POST["mdp"] != $_POST["confirm_mdp"]) {
            $dVueErreur[] = "mot de passe non confirmé";
        }

        if ($_POST["pseudo"] == "" || !isset($_POST["pseudo"])) {
            $dVueErreur[] = "pas de nom";
        }

        if ($_POST["pseudo"] != filter_var($_POST["pseudo"], FILTER_SANITIZE_STRING)) {
            $dVueErreur[] = "pseudo erroné";
        }

        if ($_POST["mdp"] == "" || !isset($_POST["pseudo"])) {
            $dVueErreur[] = "pas de mdp";
        }

        if ($_POST["mdp"] != filter_var($_POST["mdp"], FILTER_SANITIZE_STRING)) {
            $dVueErreur[] = "mdp erroné";
        }

        require("../Vue/erreur.php");

        $_POST["action"] = "add_utilisateur";
        //$ctrl = new CtrlBase();

        header("location: ../Vue/PagePrincipale.php");
    }

    static function validate_connexion_utilisateur(){

    }

}

ValidationForm::validate();
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

    static function validate_connexion_utilisateur($pseudo,$mdp){
        $m = new ModeleUtilisateur();

        if ($pseudo == "" || !isset($pseudo)) {
            $dVueErreur[] = "Veuillez entrer un pseudo.";
        }

        if ($pseudo != filter_var($pseudo, FILTER_SANITIZE_STRING)) {
            $dVueErreur[] = "Ce pseudo est erroné.";
        }

        if ($mdp == "" || !isset($mdp)) {
            $dVueErreur[] = "Veuillez entrer votre mot de passe.";
        }

        if ($mdp != filter_var($mdp, FILTER_SANITIZE_STRING)) {
            $dVueErreur[] = "Ce mot de passe est erroné";
        }

        if($m->verifyPseudo($pseudo)&&$m->verifyMdp($mdp)){
            $dVueErreur[] = "La combinaison du pseudo et du mot de passe n'existe pas";
        }

        if(isset($dVueErreur[0])){
            require("../Vue/erreur.php");
        }
    }

    public static function validate_comm($commentaire)
    {
        if($commentaire == "" || !isset($commentaire)){
            $dVueErreur[] = "Veuillez entrer un commentaire.";       
        }

        if ($commentaire != filter_var($commentaire, FILTER_SANITIZE_STRING)) {
            $dVueErreur[] = "Ce commentaire est erroné.";
        }

        if(isset($dVueErreur[0])){
            require("../Vue/erreur.php");
        }
    }

    public static function validate_news($titre,$contenu){
        if($titre == "" || !isset($commentaire)){
            $dVueErreur[] = "Veuillez entrer un titre.";
        }

        if ($titre != filter_var($titre, FILTER_SANITIZE_STRING)) {
            $dVueErreur[] = "Le titre est erroné.";
        }

        if($contenu == "" || !isset($commentaire)){
            $dVueErreur[] = "Veuillez entrer un contenu.";
        }

        if ($contenu != filter_var($contenu, FILTER_SANITIZE_STRING)) {
            $dVueErreur[] = "Le contenu est erroné.";
        }

        if(isset($dVueErreur[0])){
            require("../Vue/erreur.php");
        }
    }

}
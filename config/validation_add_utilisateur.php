<?php

if($_POST["mdp"] != $_POST["confirm_mdp"]){
    $dVueErreur[] = "mot de passe non confirmé";
}

if ($_POST["login"] == ""||!isset($_POST["login"])) {
    $dVueErreur[] =	"pas de nom";
}

if ($_POST["login"] != filter_var($_POST["login"], FILTER_SANITIZE_STRING))
{
    $dVueErreur[] =	"login erroné";
}

if ($_POST["mdp"] == ""||!isset($_POST["login"])) {
    $dVueErreur[] =	"pas de mdp";
}

if ($_POST["mdp"] != filter_var($_POST["mdp"], FILTER_SANITIZE_STRING))
{
    $dVueErreur[] =	"mdp erroné";
}

require("../Vue/erreur.php");

//AJOUT NOUVELLE UTILISATEUR BDD

header ("location: ../Vue/PagePrincipale.php");


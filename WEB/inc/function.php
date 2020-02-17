<?php

require "./bdd/connexionBd.php";

$db = connectDB();

if (session_status() == PHP_SESSION_NONE)
{
  session_start();
}
function addUser($nom,$prenom,$email,$pwd,$pseudo)
{
    global $bdd;
    $password = $prenomStagiaire.$nomStagiaire;

    $insertStagiaire = $bdd->prepare("INSERT INTO stagiaires(FIRSTNAME, LASTNAME, EMAIL, PSWD, PRIVATE_PHONE, SCHOOL_NAME, SCHOOL_DEGREE, REMARKS, ROLES_CODE) VALUES(?,?,?,?,?,?,?,?,?)");
    $insertStagiaire->execute(array($prenomStagiaire,$nomStagiaire,$emailStagiaire,$telephoneStagiaire,$nomEcoleStagiaire,$degreStagiaire));
}
?>
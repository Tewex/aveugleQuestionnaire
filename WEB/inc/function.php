<?php

require "./bdd/connexionBd.php";

$bdd = connectDB();

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

function selectQuestionAleatoire(){
  global $bdd;
  $totalQuestion = $bdd->query('select COUNT(questionId) as total from question');
  $totalQuestion = $totalQuestion->fetch();
  $totalQuestion = $totalQuestion['total'];
 
  $nbrIdQuestion= rand(1, $totalQuestion);
  $res = $bdd->query("SELECT * FROM `question` WHERE questionId = $nbrIdQuestion");
 
 
  $donnees=$res->fetch();
  return $donnees['questionId'];
}

/*function selectQuestions($nbQuestion){
    global $bdd;

    $reqQuest = $bdd->prepare("");
    $reqQuest->execute(array());
    $quest = $reqQuest->fetch();

    return $quest;
}*/
?>
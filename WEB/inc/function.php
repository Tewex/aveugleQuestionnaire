<?php

require "./bdd/connexionBd.php";

$db = UserDbConnection();

if (session_status() == PHP_SESSION_NONE)
{
  session_start();
}

//Function servant a verifier si on est log ou non
function isLogged()
{
    return isset($_SESSION['connect']);
}

// Fonction ajoutant un user a la base.
function addUser($nom,$prenom,$email,$pwd,$pseudo)
{
    global $db;

    $insertNewMember = $db->prepare("INSERT INTO user(name,surname,nickname,email,saltedPwd) VALUES(?,?,?,?,?)");
    $insertNewMember->execute(array($nom,$prenom,$pseudo,$email,$pwd));
}

// Fonction qui hash et salt le password.
function hashPassword($email,$pwd)
{
  $email = md5($email);
  $hashedPwd = md5($email.$pwd);
  return $hashedPwd;
}

// Fonction verifiant si un compte éxiste déjà ou non.
function verifyIfEmailExists($email)
{
  global $db;

  $requser = $db->prepare("SELECT * FROM user WHERE email = ?");
  $requser->execute(array($email));
  $userexist = $requser->rowCount();

  if($userexist == 1)
  {
      return true;
  }
  else
  {
      return false;
  }
}

// Fonction verifiant si un compte éxiste déjà avec ce pseudo ou non.
function verifyIfPseudoExists($pseudo)
{
  global $db;

  $requser = $db->prepare("SELECT * FROM user WHERE nickname = ?");
  $requser->execute(array($pseudo));
  $userexist = $requser->rowCount();

  if($userexist == 1)
  {
      return true;
  }
  else
  {
      return false;
  }

}

// Fonction servant a connecté l'user a la base.
function connectUser($email,$pwd)
{
  global $db;

  $requser = $db->prepare("SELECT * FROM user WHERE email = ? AND saltedPwd = ?");
  $requser->execute(array($email,$pwd));
  $userexist = $requser->rowCount();

  if($userexist == 1)
  {
      return true;
  }
  else
  {
      return false;
  }
}

// Fonction servant a verifier si un nom ou un prénom est valide.
function verifyName($givenName)
{
  if(preg_match("/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/u",$givenName)){
    return true;
  }
  else
  {
    return false;
  }
  
}

// Fonction servant a verifier si un pseudo est valide.
function verifyNickname($givenNick)
{
  if(preg_match("/^[A-Za-z][A-Za-z0-9_]{3,15}$/",$givenNick)){
    return true;
  }
  else
  {
    return false;
  }
}

/*function selectQuestionAleatoire(){
  global $bdd;
  $totalQuestion = $bdd->query('select COUNT(questionId) as total from question');
  $totalQuestion = $totalQuestion->fetch();
  $totalQuestion = $totalQuestion['total'];
 
  $nbrIdQuestion= rand(1, $totalQuestion);
  $res = $bdd->query("SELECT * FROM `question` WHERE questionId = $nbrIdQuestion");
 
 
  $donnees=$res->fetch();
  return $donnees['questionId'];
}
*/
/*function selectQuestions($nbQuestion){
    global $bdd;

    $reqQuest = $bdd->prepare("");
    $reqQuest->execute(array());
    $quest = $reqQuest->fetch();

    return $quest;
}*/

?>
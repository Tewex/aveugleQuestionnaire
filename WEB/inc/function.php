<?php

require "./bdd/connexionBd.php";

$db = UserDbConnection();
setlocale(LC_ALL, "fr_FR.utf8", 'fra');

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

function nbQuestionTotal($nbQuestion){
  $array = array();

  for ($i=0; $i < $nbQuestion; $i++) { 
    $idQuestion = selectQuestionAleatoire();
    if (in_array($idQuestion, $array)) {
      $i--;
    }else{
      array_push($array,$idQuestion);
    }
  }
  return $array;
}

function afficherTableQuestion($array){
 foreach ($array as $key => $value) {
  $question = selectQuestions($value);
 echo '
      <tr>
      <td colspan="2" align="center"><p>'.$question["question"].'</p></td>
      </tr>
      <tr>
        <td><input type="radio" name="reponse'.$key.'" value="'.$question["answer"].'">'.$question["answer"].'</td>
        <td><input type="radio" name="reponse'.$key.'" value="2">Reponse 2</td>
      </tr>
      <tr>
        <td><input type="radio" name="reponse'.$key.'" value="3">Reponse 3</td>
        <td><input type="radio" name="reponse'.$key.'" value="4">Reponse 4</td>     
      </tr>';


 }
}
function selectQuestionAleatoire(){
  global $db;
  $totalQuestion = $db->query('select COUNT(questionId) as total from question');
  $totalQuestion = $totalQuestion->fetch();
  $totalQuestion = $totalQuestion['total'];
 
  $nbrIdQuestion= rand(1, $totalQuestion);
  $res = $db->query("SELECT * FROM `question` WHERE questionId = $nbrIdQuestion");
 
 
  $donnees=$res->fetch();
  return $donnees['questionId'];
}

function selectQuestions($nbQuestion){
    global $db;

    $reqQuest = $db->prepare("SELECT * FROM `question` WHERE questionId = ?");
    $reqQuest->execute(array($nbQuestion));
    $quest = $reqQuest->fetch();

    return $quest;
}

function showBestScoresHTML()
{
  $place = 1;
  $data = getBestScores();
  $joueurs = "";
  foreach ($data as $d) {
    $joueurs.= "
    <tr>
      <td>$place</td>
      <td>".$d{"nickname"}."</td>
      <td>".$d{"score"}."</td>
      <td>".changeDateFormat($d{"dateScore"})."</td>
    </tr>
    ";
    $place++;
  }
  $scores = "
  <table class='table table-hover' >
  <thead class='thead-light'>
      <tr>
      <th scope='col'>Place</th>
      <th scope='col'>Pseudo</th>
      <th scope='col'>Score</th>
      <th scope='col'>Date</th>
      </tr>
  </thead>
  <tbody> 
  $joueurs
  </tbody>
  </table>
  ";

  return $scores;
}

function getBestScores()
{
  global $db;
  $requser = $db->query('SELECT score,dateScore,nickname FROM classement,user WHERE user.userId = classement.userId ORDER BY score DESC');
  $userinfo = $requser->fetchAll();
  return $userinfo;
}

function changeDateFormat($date)
{
    return utf8_encode(strftime("%A %d %B %Y ", strtotime($date)));
}


?>
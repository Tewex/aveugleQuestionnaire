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


//Ajoute le nombre de question que l'on veut dans un tableau et le retourne
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
//permet de retourner la bonne reponse et les trois fausses réponses dans le désordre
function retourneReponses($idQuestion){
  $array = [];
  $placeBonneReponse = rand(0,3);


  for ($i=0; $i < 4; $i++) { 
    $reponseAleatoire = selectQuestionAleatoire();
    if ($i == $placeBonneReponse) {
      array_push($array,selectQuestions($idQuestion)['answer']);
    }elseif (in_array(selectQuestions($reponseAleatoire)['answer'], $array) == FALSE && $reponseAleatoire != $idQuestion) {
      array_push($array,selectQuestions($reponseAleatoire)['answer']);
    }else{
      $i--;
    }
  }

  return $array;
}

// prend en parametre un tableau de question et en fait un tableau HTML et l'affiche
function afficherTableQuestion($array){
 foreach ($array as $key => $value) {
  $question = selectQuestions($value);
  $reponses = retourneReponses($question['questionId']);

 echo '
      <tr>
      <td colspan="2" align="center"><p>'.$question["question"].'</p></td>
      </tr>
      <tr>
        <td><input type="radio" name="reponse'.$key.'" value="'.$reponses[0].'" required>'.$reponses[0].'</td>
        <td><input type="radio" name="reponse'.$key.'" value="'.$reponses[1].'" required>'.$reponses[1].'</td>
      </tr>
      <tr>
        <td><input type="radio" name="reponse'.$key.'" value="'.$reponses[2].'" required>'.$reponses[2].'</td>
        <td><input type="radio" name="reponse'.$key.'" value="'.$reponses[3].'" required>'.$reponses[3].'</td>
      </tr>';


 }
}
//Rends des questions aléatoire 
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

//selectionne toute les données d'une question (reponse, question,image)
function selectQuestions($nbQuestion){
    global $db;

    $reqQuest = $db->prepare("SELECT * FROM `question` WHERE questionId = ?");
    $reqQuest->execute(array($nbQuestion));
    $quest = $reqQuest->fetch();

    return $quest;
}

function bonneReponses($allQuestions){
  global $db;
  $bonneReponse = [];

    foreach ($allQuestions as $value) {
      $reqQuest = $db->prepare("SELECT * FROM `question` WHERE questionId = ?");
      $reqQuest->execute(array($value));
      $quest = $reqQuest->fetch();

      array_push($bonneReponse, $quest['answer']);
    }

    return $bonneReponse;
}

// Return le tableau des scores
function showBestScoresHTML($nbAffiche = 10)
{
  $place = 1;
  $data = getBestScores($nbAffiche);
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

// Return les scores par odre du meilleur
function getBestScores($nbAffiche)
{
  global $db; 
  $requser = $db->query('SELECT score,dateScore,nickname FROM classement,user WHERE user.userId = classement.userId ORDER BY score DESC limit '.$nbAffiche);
  $userinfo = $requser->fetchAll();
  return $userinfo;
}

// Change le format de la date
function changeDateFormat($date)
{
  return strftime("%e %B %Y &agrave; %kh%M ", strtotime($date));
}

// Connecte l'utilisateur et rentre ces infos en session
function connecterUser($email)
{
  $_SESSION['connect'] = True;
  $user = getUserInfoByEmail($email);
  foreach ($user as $u) 
  {
    $_SESSION["pseudo"] = $u["nickname"];
    $_SESSION["email"] = $email;
    $_SESSION["userId"] = $u["userId"];
    $_SESSION["nom"] = $u["name"];
    $_SESSION["prenom"] = $u["surname"];
  }
  header("Location: index.php");
}

// Return les infos de l'user depuis son email
function getUserInfoByEmail($email)
{
  global $db;

  $reqUserInfo = $db->prepare("SELECT userId,name,nickname,surname FROM `user` WHERE email = ?");
  $reqUserInfo->execute(array($email));
  $dataUser = $reqUserInfo->fetchAll();

  return $dataUser;
}
//Ajoute le score dans la base de donnée après que la partie sois jouée
function insertScore($points,$idUser){
  global $db;

  $insertScore = $db->prepare("INSERT INTO `classement`(`userId`, `score`) VALUES (?,?)");
  $insertScore->execute(array($idUser,$points));
}


?>
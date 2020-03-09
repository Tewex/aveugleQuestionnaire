<!--
  Auteur : Loic Métrailler
  Date : 17.02.2020
  Projet : Aveugle questionnaire
  Description : projet de groupe sur un site de questions
  -->
  <?php
  require "inc/function.php";

    if (isLogged()==false) {
      header("Location: index.php");
    }
   
    $reponses = [];
  

    for ($i=0; $i < $_SESSION['nbQuestion']; $i++) { 
      $tmp = filter_input(INPUT_POST, 'reponse'.$i, FILTER_SANITIZE_STRING);
      if (isset($tmp)) {
        array_push($reponses,$tmp);
      }else{
          header("Location: index.php");
          exit;
      }
      
    }


    

?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Question</title>
  <link rel="stylesheet" href="style/style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
<?php 
    if (isLogged())
    {
        include "inc/navbar/navbarLogged.php";
    }
    else
    {
        include "inc/navbar/navbarNotLogged.php";
    }
    ?>
    <div style="margin-left:500px;">
    <?php 
    $score = 0;
    $question = 1;
    for ($i=0; $i < $_SESSION['nbQuestion']; $i++) { 
        
        echo "La question ".$question. " est une : ";
        if($reponses[$i]==$_SESSION['bonneReponses'][$i]){
            echo "bonne reponse</br>";
            $score++;
        }else {
            echo "mauvaise reponse </br>";
        }
        $question++;
    }
    insertScore($score,$_SESSION["userId"]);
    echo "votre score est de : ".$score;
    ?>
    <h2><a href="question.php">Rejouer</a><a href="classement.php"> Voir le classement</a></h2>
    </div>
</body>
</html>
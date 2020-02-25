<!--
  Auteur : Loic Métrailler
  Date : 17.02.2020
  Projet : Aveugle questionnaire
  Description : projet de groupe sur un site de questions
  -->
<?php
  require "inc/function.php";


    $nbQuestion =  5;
    $_POST['allQuestion'] = nbQuestionTotal($nbQuestion);
    $bonneReponses = bonneReponses($_POST['allQuestion']);
    $reponses = [];
  
  var_dump($bonneReponses);
  if(filter_has_var(INPUT_POST, 'submit')){

    for ($i=0; $i < $nbQuestion; $i++) { 
      $tmp = filter_input(INPUT_POST, 'reponse'.$i, FILTER_SANITIZE_STRING);
      array_push($reponses,$tmp);
    }
    var_dump($reponses);
    echo "<br/>";
    
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
<?php include "inc/navbar/navbarNotLogged.php";?>
<div style="margin-left:500px;">

  <form action="" method="POST">
    <table>      

      <?php
        afficherTableQuestion($_POST['allQuestion']);
      ?>      

      <tr>
      <td colspan="2" align="center"><input type="submit" value="confirmer" name="submit"></td>
      </tr>
      </table>
    </form>
    </div>
</body>
</html>
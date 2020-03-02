<!--
  Auteur : Loic Métrailler
  Date : 17.02.2020
  Projet : Aveugle questionnaire
  Description : projet de groupe sur un site de questions
  -->
<?php
  require "inc/function.php";


    $_SESSION['nbQuestion'] =  5;
    $_SESSION['allQuestion'] = nbQuestionTotal($_SESSION['nbQuestion']);
    $_SESSION['bonneReponses'] = bonneReponses($_SESSION['allQuestion']);
  
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

  <form action="resultat.php" method="POST">
    <table>      

      <?php
        afficherTableQuestion($_SESSION['allQuestion']);
        retourneReponses(1);
      ?>      

      <tr>
      <td colspan="2" align="center"><input type="submit" value="confirmer" name="submit"></td>
      </tr>
      </table>
    </form>
    </div>
</body>
</html>
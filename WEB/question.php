<!--
  Auteur : Loic Métrailler
  Date : 17.02.2020
  Projet : Aveugle questionnaire
  Description : projet de groupe sur un site de questions
  -->
<?php
  require "inc/fuinction.php";

  

  if(filter_has_var(INPUT_POST, 'submit')){
    $reponseUser = filter_input(INPUT_POST, 'reponse', FILTER_SANITIZE_STRING);

    echo $reponseUser;
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
  <p>question ?</p>

  <form action="" method="POST">
    <table>
      <tr>
        <td><input type="radio" name="reponse" value="1">Reponse 1</td>
        <td><input type="radio" name="reponse" value="2">Reponse 2</td>
      </tr>
      <tr>
        <td><input type="radio" name="reponse" value="3">Reponse 3</td>
        <td><input type="radio" name="reponse" value="4">Reponse 4</td>
      </tr>
      <tr>
      <td colspan="2" align="center"><input type="submit" value="confirmer" name="submit"></td>
      </tr>
      </table>
    </form>
    </div>
</body>
</html>
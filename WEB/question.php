<!--
  Auteur : Loic Métrailler
  Date : 17.02.2020
  Projet : Aveugle questionnaire
  Description : projet de groupe sur un site de questions
  -->
<?php
  require "inc/function.php";

  $allQuestion = nbQuestionTotal(1);
  

  if(filter_has_var(INPUT_POST, 'submit')){
   /* $reponseUser = filter_input(INPUT_POST, 'reponse', FILTER_SANITIZE_STRING);

    if($question1['answer']==$reponseUser){
      echo "bonne reponse";
    }else{
      echo "mauvaise reponse";
    }*/
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
        afficherTableQuestion($allQuestion);
      ?>      

      <tr>
      <td colspan="2" align="center"><input type="submit" value="confirmer" name="submit"></td>
      </tr>
      </table>
    </form>
    </div>
</body>
</html>
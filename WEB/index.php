<?php
//Page necessaire au fonctionnement.
require_once "inc/function.php";

//Affiche les erreurs si il y en a
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Salu - indexent</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="style/style.css">
    </head>
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
    <body>
    
    <?php 
    if (isLogged())
    {
        echo '<h1><a href="question.php">Jouer</a></h1>';
    }
    else
    {
        echo '<h1><a href="connexion.php">Connectez-vous pour jouer</a></h1>';
    }
    ?>
    </body>
</html>
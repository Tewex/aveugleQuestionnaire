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


        <div class="container">
            <div class="row">
                <div class="col-lg-12 mb-5">
                    <div class="shadow-lg card text-dark" style="background-color: #EEEEEE;">             
                        <?php if(isLogged()) : ?>
                            <div class="alert alert-success" role="alert">
                                <h3 class="alert-heading pb-0">Jouer :</h3>
                                <hr>                
                                <p>Pour jouer, cliquer : <strong><a href="question.php">ICI</a></strong>.</p>
                                <p>Pour voir le classement, cliquer : <strong><a href="classement.php">ICI</a></strong>.</p>
                              
                            </div>
                        <?php else : ?>
                            <div class="alert alert-danger" role="alert">
                                <h3 class="alert-heading">Vous n'êtes pas connecter.</h3>
                                <hr> 
                                <p>Pour pouvoir jouer, connectez vous en cliquant : <strong><a href="connexion.php">ICI</a></strong>.</p>
                                <p>Ou alors, crée vous un compte en cliquant : <strong><a href="inscription.php">ICI</a></strong>.</p>
                            </div>
                        <?php endif; ?>                                  
                    </div>        
                </div>
            </div>
        </div>
             

        
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shadow-lg card text-dark" style="background-color: #EEEEEE;">             
                        <div class="card-header text-light p-3 pl-4" style="background-color: #35393C"><h4>Les 3 meilleurs scores</h4></div>
                        <div class="card-body p-0 m-0">
                            <?php
                            echo showBestScoresHTML(3);
                            ?>
                        </div>
                    </div>        
                </div>
            </div>
        </div>
    </body>
</html>
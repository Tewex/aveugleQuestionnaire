<?php
//Page necessaire au fonctionnement.
require_once "inc/function.php";
header('Content-Type: text/html; charset=UTF-8');
//Affiche les erreurs si il y en a
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Salu - classeument</title>
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
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card text-dark" style="background-color: #EEEEEE;">             
                        <div class="card-header p-3  pl-4 text-light" style="background-color: #70CE9B;">
                            <h3>Les meilleurs scores</h3>
                        </div>
                        <div class="card-body p-0">
                        <?php
                        echo showBestScoresHTML();
                        ?>
                        
                        </div>
                    </div>        
                </div>
            </div>
        </div> 
    </body>
</html>
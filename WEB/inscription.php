<?php
/*
*     Auteur              :  RUSSOTTI Leandro.
*     Projet              :  AveugleQuestionnaire.
*     Page                :  Inscription.
*     Date début projet   :  17.02.2020.
*/

//Page necessaire au fonctionnement.
require_once "inc/function.php";

//Affiche les erreurs si il y en a
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Ouvre la session
if (session_status() == PHP_SESSION_NONE)
{
    session_start();
}

$logged = isset($_SESSION["logged"]);

//Affiche une navbar selon si on est log ou non.
if ($logged) // on féf après
{
    header("Location: .\index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="FR" dir="ltr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="style/style.css">
    <title>Inscription</title>
</head>
<body>
<?php
include "inc/navbar/navbarNotLogged.php";
?>
    <div id="formulaireStagiaire">
        <?php
        include "inc/form/formulaireInscription.php";
        ?>
    </div>
</body>
</html>

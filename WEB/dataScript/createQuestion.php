<?php
require_once("../Database.php");
if(isset($_REQUEST['question']) && isset($_REQUEST['answer']) && isset($_REQUEST['imgPath']))
{  
    if($_REQUEST['question'] != "" && $_REQUEST['answer'] != "" && $_REQUEST['imgPath'] != "")
    {
        $imgPath = $_REQUEST['imgPath'];
        $question = $_REQUEST['question'];
        $answer = $_REQUEST['answer'];

        $query = "INSERT INTO question (imgPath, question, answer) VALUES($imgPath,$question,$answer)";
        try{
            $bdd = Database::getInstance();
            $statement = $bdd->prepare($query);
            $statement->execute();
            print_r($statement->fetchAll(PDO::FETCH_ASSOC));
        }
        catch(Exception $e)
        {
            echo "Error : ".$e;
        }
    }
}
?>
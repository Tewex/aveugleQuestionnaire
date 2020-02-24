<?php
require_once("../bdd/connexionBd.php");
if(isset($_REQUEST['question']) && isset($_REQUEST['answer']) && isset($_REQUEST['imgPath']))
{  
    if($_REQUEST['question'] != "" && $_REQUEST['answer'] != "" && $_REQUEST['imgPath'] != "")
    {
        $imgPath = $_REQUEST['imgPath'];
        $question = $_REQUEST['question'];
        $answer = $_REQUEST['answer'];

        $query = "INSERT INTO question (imgPath, question, answer) VALUES ('-','-','-')";
        try{
            $statement = BDD::prepare($query);
            $statement->execute();
        }
        catch(Exception $e)
        {
            echo "Error : ".$e;
        }
    }
}
?>
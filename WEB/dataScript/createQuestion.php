<?php
require_once("../bdd/connexionBd.php");
if(isset($_REQUEST['question']) && isset($_REQUEST['answer']))
{  
    if($_REQUEST['question'] != "" && $_REQUEST['answer'] != "")
    {
        $question = $_REQUEST['question'];
        $answer = $_REQUEST['answer'];

        $query = "INSERT INTO question (question, answer) VALUES ('$question','$answer')";
        try{
            $statement = UserDbConnection()->prepare($query);
            $statement->execute();
        }
        catch(Exception $e)
        {
            echo "Error : ".$e;
        }
    }
}
?>
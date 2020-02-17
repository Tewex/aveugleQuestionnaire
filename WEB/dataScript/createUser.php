<?php
if(isset($_REQUEST['question']) && isset($_REQUEST['answer']) && $_REQUEST['imgPath'] && $_FILES['img'])
{
    if($_REQUEST['question'] != "" && $_REQUEST['answer'] != "" && $_REQUEST['imgPath'] != "")
    {
        $query = "INSERT INTO question (imgPath,question,answer) VALUES(".$_REQUEST['imgPath'].",".$_REQUEST['question'].",".$_REQUEST['question'].")";
        try{
            $bdd;
            $bdd->prepare($query);
        }
        catch(Exception $e)
        {
            echo "Error : ".$e;
        }
    }
}
?>
<?php
session_start();
require("../Database.php");
if(isset($_REQUEST["subject"]) && isset($_REQUEST["message"]) && isset($_REQUEST["student_id"]))
{
    $id = $_REQUEST["student_id"];
    $subject = $_REQUEST["subject"];
    $message = $_REQUEST["message"];
    $sql = "select serial from complain";
        
    $arr = getDataFromDB($sql);

    $counter = 1;

    foreach($arr as $row)
    {
        $counter++;
    }
    if($counter < 100 && $counter >= 10)
    {
        $ID =  "CMP0".$counter;
    }
    else if($counter < 10 && $counter >= 1)
    {
        $ID =  "CMP00".$counter;
    }
    else
    {
        $ID = "CMP".$counter; 
    }
    
    $sql = "insert into complain values(null,'".$ID."','".$_SESSION["logger_id"]."','".$id."','".$subject."','".$message."','Pending')";
    updateDB($sql);
    header("Location: Teacher_Complain.php?info=1");
}
else
{
    header("Location: Teacher_Complain.php?info=2");
}
?>

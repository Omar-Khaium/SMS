<?php
session_start();
require("../Database.php");
if(isset($_REQUEST["subject"]) && isset($_REQUEST["message"]))
{
    $subject = $_REQUEST["subject"];
    $message = $_REQUEST["message"];
    $sql = "select serial from applcation";
        
    $arr = getDataFromDB($sql);

    $counter = 1;

    foreach($arr as $row)
    {
        $counter++;
    }
    if($counter < 100 && $counter >= 10)
    {
        $ID =  "ACT0".$counter;
    }
    else if($counter < 10 && $counter >= 1)
    {
        $ID =  "ACT00".$counter;
    }
    else
    {
        $ID = "ACT".$counter; 
    }
    
    $sql = "insert into applcation values(null,'".$ID."','".$_SESSION["logger_id"]."','".$subject."','".$message."','Pending')";
    updateDB($sql);
    header("Location: Teacher_Application.php?info=1");
}
else
{
    header("Location: Teacher_Application.php?info=2");
}
?>

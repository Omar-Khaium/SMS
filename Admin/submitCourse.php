<?php
session_start();
require("Database.php");
$ID = $_REQUEST['course_id'];
$Name = $_REQUEST['course_name'];
$Class = $_REQUEST['course_class'];
$Batch = $_REQUEST['course_batch'];
$Teacher = $_REQUEST['course_teacher'];
$Time = $_REQUEST['course_time'];

if( strlen($ID) != 0 && $Class != 0 && strlen($Batch) != 0 && $Time != 0 && strlen($Name) != 0)
{   
    $sql = "insert into course values(null,'".$ID."','".$Name."','".$Class."','".$Teacher."','".$Batch."','".$Time."');";

    if(updateDB($sql))
    {
        $_SESSION["crs_id"] = $ID;
        header("Location: Admin_Add_Course.php?error=Successfull");
    }
    else
    {
        header("Location: Admin_Add_Course.php?error=Failed");
    }
}
else
{
    header("Location: Admin_Add_Course.php?error=input_error");
}
/*
echo "<pre>";
print_r($GLOBALS);
echo "</pre>";
*/
?>

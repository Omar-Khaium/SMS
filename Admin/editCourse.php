<?php
session_start();
require("Database.php");
$ID = $_REQUEST['course_id'];
$_SESSION["crs_id"] = $ID;
$Name = $_REQUEST['course_name'];
$Class = $_REQUEST['course_class'];
$Batch = $_REQUEST['course_batch'];
$Teacher = $_REQUEST['course_teacher'];
$Time = $_REQUEST['course_time'];


        $sql = "UPDATE course SET `Name`='".$Name."',`Class`='".$Class."',`Batch Id`='".$Batch."',`Teacher Id`='".$Teacher."',`Slot`='".$Time."' WHERE `Course Id`='".$ID."'";
        echo $sql;
        if(updateDB($sql))
        {
            header("Location: Admin_Edit_Course.php?error=Successfull");
        }
        else
        {
            header("Location: Admin_Edit_Course.php?error=Failed");
        }

?>

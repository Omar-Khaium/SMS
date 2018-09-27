<?php
require("Database.php");
if(isset($_REQUEST['course_id']) && $_REQUEST['course_id'] != "")
{
    $ID = $_REQUEST['course_id'];


        $sql = "DELETE FROM course WHERE `Course Id`='".$ID."'";
        echo $sql;
        if(updateDB($sql))
        {
            header("Location: Admin_Delete_Course.php?error=Successfull");
        }
        else
        {
            header("Location: Admin_Delete_Course.php?error=Failed");
        }
}
        else
        {
            header("Location: Admin_Delete_Course.php?error=input_error");
        }
?>

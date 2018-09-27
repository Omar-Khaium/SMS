<?php
require("Database.php");
$ID = $_REQUEST['student_id'];


        $sql = "DELETE FROM std_profile WHERE `Std_id`='".$ID."'";
        echo $sql;
        if(updateDB($sql))
        {
            $sql = "DELETE FROM login WHERE `id`='".$ID."'";
            if(updateDB($sql))
            {
                header("Location: Admin_Delete_Student.php?error=Successfull");
            }
        }
        else
        {
            header("Location: Admin_Delete_Student.php?error=Failed");
        }

?>

<?php
require("Database.php");
if(isset($_REQUEST['tcr_id']) && $_REQUEST['tcr_id'] != "")
{
    $ID = $_REQUEST['tcr_id'];


        $sql = "DELETE FROM tcr_profile WHERE `Id`='".$ID."'";
        echo $sql;
        if(updateDB($sql))
        {
            $sql = "DELETE FROM login WHERE `id`='".$ID."'";
            if(updateDB($sql))
            {
                header("Location: Admin_Delete_Teacher.php?error=Successfull");
            }
        }
        else
        {
            header("Location: Admin_Delete_Teacher.php?error=Failed");
        }
}
        else
        {
            header("Location: Admin_Delete_Teacher.php?error=input_error");
        }
?>

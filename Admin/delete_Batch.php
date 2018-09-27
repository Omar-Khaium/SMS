<?php
require("Database.php");
if(isset($_REQUEST['batch_id']) && $_REQUEST['batch_id'] != "")
{
    $ID = $_REQUEST['batch_id'];


        $sql = "DELETE FROM batch WHERE `Batch ID`='".$ID."'";
        echo $sql;
        if(updateDB($sql))
        {
            header("Location: Admin_Delete_Batch.php?error=Successfull");
        }
        else
        {
            header("Location: Admin_Delete_Batch.php?error=Failed");
        }
}
        else
        {
            header("Location: Admin_Delete_Batch.php?error=input_error");
        }
?>

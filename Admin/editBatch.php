<?php
session_start();
require("Database.php");
$ID = $_REQUEST['batch_id'];
$_SESSION['btc_id'] = $_REQUEST['batch_id'];
$Name = $_REQUEST['batch_name'];
$Class = $_REQUEST['batch_class'];


        $sql = "UPDATE batch SET `BatchName`='".$Name."',`Class`='".$Class."' WHERE `Batch ID`='".$ID."'";
        echo $sql;
        if(updateDB($sql))
        {
            header("Location: Admin_Edit_Batch.php?error=Successfull");
        }
        else
        {
            header("Location: Admin_Edit_Batch.php?error=Failed");
        }

?>

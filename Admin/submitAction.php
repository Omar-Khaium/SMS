<?php
require("Database.php");
    if(isset($_REQUEST['id']))
    {
        if($_REQUEST['status'] == 1)
        {
            $sql = "UPDATE applcation SET `Status`='Approved' WHERE `Application Id`='".$_REQUEST['id']."'";            
            if(updateDB($sql))
            {
                echo $_REQUEST['status'];
            }
        }
        else if($_REQUEST['status'] == 2)
        {
            $sql = "UPDATE applcation SET `Status`='Rejected' WHERE `Application Id`='".$_REQUEST['id']."'";            
            if(updateDB($sql))
            {
                echo $_REQUEST['status'];
            }
        }
    }
?>

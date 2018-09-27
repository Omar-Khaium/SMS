<?php
require("Database.php");
    if(isset($_REQUEST['id']))
    {
        if($_REQUEST['status'] == 1)
        {
            $sql = "UPDATE complain SET `Status`='Approved' WHERE `Complain Id`='".$_REQUEST['id']."'";            
            if(updateDB($sql))
            {
                echo $_REQUEST['status'];
            }
        }
        else if($_REQUEST['status'] == 2)
        {
            $sql = "UPDATE complain SET `Status`='Rejected' WHERE `Complain Id`='".$_REQUEST['id']."'";            
            if(updateDB($sql))
            {
                echo $_REQUEST['status'];
            }
        }
    }
?>

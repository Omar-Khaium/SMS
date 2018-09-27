<?php
session_start();
require("Database.php");
$ID = $_REQUEST['batch_id'];
$Name = $_REQUEST['batch_name'];
$Class = $_REQUEST['batch_class'];

if( strlen($Name) != 0 && $Class != 0 && strlen($ID) != 0)
{   
    $sql = "insert into batch values(null,'".$ID."','".$Name."','".$Class."');";

    if(updateDB($sql))
    {
        $_SESSION['btc_id'] = $_REQUEST['batch_id'];
        header("Location: Admin_Add_Batch.php?error=Successfull");
    }
    else
    {
        header("Location: Admin_Add_Batch.php?error=Failed");
    }
}
else
{
    header("Location: Admin_Add_Batch.php?error=input_error");
}

?>

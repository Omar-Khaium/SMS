<?php 
require("Database.php");
    if(isset($_REQUEST['id']))
    {
        $sql = "select Description from complain where Serial=".$_REQUEST['id'];
        if(getDataFromDB($sql))
        {
            $arr = getDataFromDB($sql);
            echo $arr[0]["Description"];
        }
    }
?>

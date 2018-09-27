<?php 
require("../Database.php");
    if(isset($_REQUEST['id']) && isset($_REQUEST['type']) && $_REQUEST['type']=="Class")
    {
        $sql = "select * from batch where `Class`='".$_REQUEST['id']."'";
        if(getJSONFromDB($sql))
        {
            $a=getJSONFromDB($sql);
            echo $a;
        }
    }
    else if(isset($_REQUEST['id']) && isset($_REQUEST['type']) && $_REQUEST['type']=="ClassSTD")
    {
        $sql = "select * from std_profile where `Class`='".$_REQUEST['id']."'";
        if(getJSONFromDB($sql))
        {
            $a=getJSONFromDB($sql);
            echo $a;
        }
    }
?>

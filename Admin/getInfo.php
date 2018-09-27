<?php 
require("Database.php");
    if(isset($_REQUEST['id']) && isset($_REQUEST['type']) && $_REQUEST['type']=="Batch")
    {
        $sql = "select * from std_profile where Batch='".$_REQUEST['id']."'";
        if(getJSONFromDB($sql))
        {
            $a=getJSONFromDB($sql);
            echo $a;
        }
    }
    else if(isset($_REQUEST['id']) && isset($_REQUEST['type']) && $_REQUEST['type']=="Class")
    {
        $sql = "select * from std_profile where Class='".$_REQUEST['id']."'";
        if(getJSONFromDB($sql))
        {
            $a=getJSONFromDB($sql);
            echo $a;
        }
    }
    else if(isset($_REQUEST['id']) && isset($_REQUEST['type']) && $_REQUEST['type']=="Department")
    {
        $sql = "select * from tcr_profile where Department='".$_REQUEST['id']."'";
        if(getJSONFromDB($sql))
        {
            $a=getJSONFromDB($sql);
            echo $a;
        }
    }
    else if(isset($_REQUEST['id']) && isset($_REQUEST['type']) && $_REQUEST['type']=="Designation")
    {
        $sql = "select * from tcr_profile where Designation='".$_REQUEST['id']."'";
        if(getJSONFromDB($sql))
        {
            $a=getJSONFromDB($sql);
            echo $a;
        }
    }
    else if(isset($_REQUEST['id']) && isset($_REQUEST['type']) && $_REQUEST['type']=="Student")
    {
        $sql = "select * from std_profile where Std_Id='".$_REQUEST['id']."'";
        if(getJSONFromDB($sql))
        {
            $a=getJSONFromDB($sql);
            echo $a;
        }
    }
    else if(isset($_REQUEST['id']) && isset($_REQUEST['type']) && $_REQUEST['type']=="Teacher")
    {
        $sql = "select * from tcr_profile where Id='".$_REQUEST['id']."'";
        if(getJSONFromDB($sql))
        {
            $a=getJSONFromDB($sql);
            echo $a;
        }
    }
?>

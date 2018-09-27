<?php
session_start();
require("../Database.php");
$id = $_REQUEST["id"];
$type = $_REQUEST["type"];
if(isset($_REQUEST["id"]) && $type==1)
{
    $sql = "select * from complain where `Complain Id`='".$id."'";
    $result = getJSONFromDB($sql);
    echo $result;
}
else if(isset($_REQUEST["id"]) && $type==2)
{
    $sql = "select * from applcation where `Application Id`='".$id."'";
    $result = getJSONFromDB($sql);
    echo $result;
}
else if(isset($_REQUEST["id"]) && $type==3)
{
    $sql = "insert into notice values(null,'".$_SESSION["logger_id"]."','".$id."','".$_REQUEST["subject"]."','".$_REQUEST["description"]."','".date("Y-m-d")."')";
    if(updateDB($sql))
    {
        echo 1;
    }
    else
    {
        echo 2;
    }
}
?>

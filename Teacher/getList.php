<?php
require("../Database.php");
$id = $_REQUEST["id"];
$sql = "select * from course where `Batch Id`='".$id."'";
$course = getDataFromDB($sql);
$sql = "select * from std_profile";
$Stduent = getDataFromDB($sql);
$std = array();
foreach($course as $crs)
{
    foreach($Stduent as $Std)
    {
        if($crs["Batch Id"]==$Std["Batch"])
        {
            $std[] = $Std;
        }
    }
}
echo json_encode($std);
?>

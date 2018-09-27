<?php
session_start();
require("../Database.php");
if(isset($_REQUEST["Class"]) && isset($_REQUEST["Batch"]) && isset($_REQUEST["Course"]))
{
    $CourseID = $_REQUEST["Course"];
    foreach($_POST as $key => $value)
    {
        if($key!="Class" && $key!="Batch" && $key!="Course")
        {
            $sql = "insert into attendence values(null,'".$CourseID."','".$key."','".$value."','".date("Y-m-d")."')";
            updateDB($sql);
        }
    }
    header("Location: Attendence_Form.php?info=1");
}
else
{
    header("Location: Attendence_Form.php?info=2");
}
?>

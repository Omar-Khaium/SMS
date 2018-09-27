<?php
session_start();
require("../Database.php");
if(isset($_REQUEST["Class"]) && isset($_REQUEST["Batch"]) && isset($_REQUEST["Course"]) && isset($_REQUEST["Exam"]))
{
    $CourseID = $_REQUEST["Course"];
    $ExamID = $_REQUEST["Exam"];
    foreach($_POST as $key => $value)
    {
        if($key!="Class" && $key!="Batch" && $key!="Course" && $key!="Exam")
        {
            $sql = "insert into exam values(null,'".$ExamID."','".$CourseID."','".$key."','".$value."')";
            updateDB($sql);
        }
    }
    header("Location: Teacher_Grade.php?info=1");
}
else
{
    header("Location: Teacher_Grade.php?info=2");
}
?>

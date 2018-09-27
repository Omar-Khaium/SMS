<?php

session_start();
require("../Database.php");
/*echo "<pre>";
print_r($GLOBALS);
echo "</pre>";*/
$courseID = $_REQUEST["courseid"];
$FileName = $_REQUEST["filename"];
  
$s=$_FILES['fileToUpload']['tmp_name'];
$n=$_FILES['fileToUpload']['name'];
$size=$_FILES['fileToUpload']['size'];
$size = $size / 1000000;

if(file_exists("../resource/file/".$n)){
    //echo "Filename exists : ".$n;
   header("Location: Teacher_Single_Course.php?error=2&id=".$courseID);
}
else
{
    if(move_uploaded_file($s,"../resource/file/".$n))
    {
        $sql = "insert into file values(null,'".$_SESSION["logger_id"]."','".$courseID."','".$FileName."','../resource/file/.$n','".date("Y-m-d")."','".$size."')";
        if(updateDB($sql)){
        header("Location: Teacher_Single_Course.php?error=3&id=".$courseID);
        }                
        else
        {
            header("Location: Teacher_Single_Course.php?error=4&id=".$courseID);
        }
    }
    else
    {
        header("Location: Teacher_Single_Course.php?error=5&id=".$courseID);
    }
}
?>

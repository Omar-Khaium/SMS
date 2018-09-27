<?php
session_start();
require("Database.php");
$ID = $_REQUEST['student_id'];
$_SESSION["std_id"] = $ID;
$Name = $_REQUEST['student_name'];
$Father = $_REQUEST['student_father_name'];
$Mother = $_REQUEST['student_mother_name'];
$Email = $_REQUEST['student_email'];
$Roll = $_REQUEST['student_roll'];
$Class = $_REQUEST['student_class'];
$Batch = $_REQUEST['student_batch'];
$DOB = $_REQUEST['student_dob'];
$BG = $_REQUEST['blood_group'];
$Gender = $_REQUEST['STD_Gender'];
$Religion = $_REQUEST['religion'];
$Ballance = $_REQUEST['student_ballance'];
$Address = $_REQUEST['student_address'];
/*
echo "<pre>";
    print_r($GLOBALS);
echo "</pre>";*/
        if($_FILES['photoUpload']['size'] != 0)
        {
            $s=$_FILES['photoUpload']['tmp_name'];
            $n=$_FILES['photoUpload']['name'];

            $ar=explode("/",$_FILES['photoUpload']['type']);

            if($ar[0]!="image"){
                //echo "Filetype not supported";
                header("Location: Admin_Edit_Student.php?error=1");
            }
            else if(file_exists("uploads/".$n)){
                //echo "Filename exists : ".$n;
               header("Location: Admin_Edit_Student.php?error=2");
            }
            else{
                if(move_uploaded_file($s,"../resource/image/student/".$n))
                {
                    $sql = "UPDATE std_profile SET `Std_Name`='".$Name."',`Std_Father_Name`='".$Father."',`Std_Mother_Name`='".$Mother."',`Email`='".$Email."',`Roll`='".$Roll."',`Class`='".$Class."',`Batch`='".$Batch."',`DOB`='".$DOB."',`BG`='".$BG."',`Address`='".$Address."',`Religion`='".$Religion."',`Gender`='".$Gender."',`Current Balance`='".$Ballance."',`Photo`='../resource/image/student/".$n."' WHERE `Std_id`='".$ID."'";
                    if(updateDB($sql))
                    {
                        header("Location: Admin_Edit_Student.php?error=Successfull");
                    }
                    else
                    {
                        header("Location: Admin_Edit_Student.php?error=Failed");
                    } 
                }
                else
                {
                    header("Location: Admin_Edit_Student.php?error=input_error");
                }
            }
        }
        else
        {
            $sql = "UPDATE std_profile SET `Std_Name`='".$Name."',`Std_Father_Name`='".$Father."',`Std_Mother_Name`='".$Mother."',`Email`='".$Email."',`Roll`='".$Roll."',`Class`='".$Class."',`Batch`='".$Batch."',`DOB`='".$DOB."',`BG`='".$BG."',`Address`='".$Address."',`Religion`='".$Religion."',`Gender`='".$Gender."',`Current Balance`='".$Ballance."' WHERE `Std_id`='".$ID."'";
            if(updateDB($sql))
            {
                header("Location: Admin_Edit_Student.php?error=Successfull");
            }
            else {
                header("Location: Admin_Edit_Student.php?error=Failed");
            }
        }
?>

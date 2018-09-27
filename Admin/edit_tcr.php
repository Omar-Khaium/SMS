<?php
session_start();
require("Database.php");
$ID = $_REQUEST['tcr_id'];
$_SESSION["tcr_id"] = $ID;
$Name = $_REQUEST['tcr_name'];
$Email = $_REQUEST['tcr_email'];
$Mobile = $_REQUEST['tcr_mobile'];
$Department = $_REQUEST['tcr_department'];
$Designation = $_REQUEST['tcr_designation'];
$Salary = $_REQUEST['tcr_salary'];
$DOB = $_REQUEST['tcr_dob'];
$BG = $_REQUEST['tcr_bg'];
$Address = $_REQUEST['tcr_address'];
$Religion = $_REQUEST['tcr_religion'];
$Gender = $_REQUEST['tcr_gender'];
$Ballance = $_REQUEST['tcr_ballance'];
/*
echo "<pre>";
print_r($GLOBALS);
echo "</pre>";
*/
if($_FILES['photoUpload']['error'] == 0)
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
                if(move_uploaded_file($s,"../resource/image/teacher/".$n))
                {
                    $sql = "UPDATE tcr_profile SET `Name`='".$Name."',`Email`='".$Email."',`Mobile`='".$Mobile."',`Department`='".$Department."',`Designation`='".$Designation."',`Salary`='".$Salary."',`DOB`='".$DOB."',`Blood group`='".$BG."',`Address`='".$Address."',`Religion`='".$Religion."',`Gender`='".$Gender."',`Current Balance`='".$Ballance."',`Photo`='../resource/image/teacher/".$n."' WHERE `Id`='".$ID."'";
                    if(updateDB($sql))
                    {
                        header("Location: Admin_Edit_Teacher.php?error=Successfull");
                    }
                    else
                    {
                        header("Location: Admin_Edit_Teacher.php?error=Failed");
                    } 
                }
                else
                {
                    header("Location: Admin_Edit_Teacher.php?error=input_error");
                }
            }
        }
        else
        {
            $sql = "UPDATE tcr_profile SET `Name`='".$Name."',`Email`='".$Email."',`Mobile`='".$Mobile."',`Department`='".$Department."',`Designation`='".$Designation."',`Salary`='".$Salary."',`DOB`='".$DOB."',`Blood group`='".$BG."',`Address`='".$Address."',`Religion`='".$Religion."',`Gender`='".$Gender."',`Current Balance`='".$Ballance."' WHERE `Id`='".$ID."'";
            if(updateDB($sql))
            {
                header("Location: Admin_Edit_Teacher.php?error=Successfull");
            }
            else
            {
                header("Location: Admin_Edit_Teacher.php?error=Failed");
            }

        }

        
?>

<?php

session_start();
require("Database.php");
$ID = $_REQUEST['teacher_id'];
$Password = md5($_REQUEST['teacher_password']);
$Name = $_REQUEST['teacher_name'];
$Email = $_REQUEST['teacher_email'];
$Mobile = $_REQUEST['teacher_mobile'];
$Desg = $_REQUEST['teacher_designation'];
$Dept = $_REQUEST['teacher_department'];
$Salary = $_REQUEST['teacher_salary'];
$DOB = $_REQUEST['teacher_dob'];
$BG = $_REQUEST['blood_group'];
$Gender = $_REQUEST['gender'];
$Religion = $_REQUEST['religion'];
$Ballance = $_REQUEST['teacher_ballance'];
$Address = $_REQUEST['teacher_address'];

if(strlen($_REQUEST['teacher_password'])!=0 && strlen($Name) != 0 && strlen($Mobile) != 0  && strlen($Email) != 0 && $Salary != 0 && $Desg != 0 && $Dept != 0 &&  $BG != 0 && $Religion != 0 && strlen($Address) != 0)
{
   if(strlen($_REQUEST['teacher_password']) < 8)
    {
        header("Location: Admin_Add_Teacher.php?error=input_error");
    }  
    else if(str_word_count($Name) < 2)
    {
        header("Location: Admin_Add_Teacher.php?error=input_error");
    }
    else if(str_word_count($Address) < 2)
    {
        header("Location: Admin_Add_Teacher.php?error=input_error");
    }
    else if(strpos($Email,"@") > strpos($Email,"."))
    {
        header("Location: Admin_Add_Teacher.php?error=input_error");
    }
   /*
   if(strlen($_REQUEST['student_password']) < 8)
    {
        header("Location: Admin_Add_Student.php?error=Password&Error");
    }  
    else if(str_word_count($Name) < 2)
    {
        header("Location: Admin_Add_Student.php?error=Name&Error");
    }
    else if(str_word_count($Father) < 2)
    {
        header("Location: Admin_Add_Student.php?error=Father&Error");
    }
    else if(str_word_count($Mother) < 2)
    {
        header("Location: Admin_Add_Student.php?error=Mother&Error");
    }
    else if(str_word_count($Address) < 2)
    {
        header("Location: Admin_Add_Student.php?error=Address&Error");
    }
    else if(strpos($Email,"@") > strpos($Email,"."))
    {
        header("Location: Admin_Add_Student.php?error=Email&Error");
    }
    */
    else
    {
        
        $s=$_FILES['photoUpload']['tmp_name'];
        $n=$_FILES['photoUpload']['name'];

        $ar=explode("/",$_FILES['photoUpload']['type']);

        if($ar[0]!="image"){
            //echo "Filetype not supported";
            header("Location: Admin_Add_Teacher.php?error=1");
        }
        else if(file_exists("uploads/".$n)){
            //echo "Filename exists : ".$n;
           header("Location: Admin_Add_Teacher.php?error=2");
        }
        else{
            if(move_uploaded_file($s,"../resource/image/teacher/".$n)){
                $sql = "insert into tcr_profile values(null,'".$ID."','".$Name."','".$Email."','".$Mobile."','".$Dept."','".$Desg."','".$Salary."','".$DOB."','".$BG."','".$Address."','".$Religion."','".$Gender."','../resource/image/teacher/".$n."','".$Ballance."');";
                if(updateDB($sql))
                {
                    $sql = "insert into login values(null,'".$ID."','".$Password."','Teacher');";
                    if(updateDB($sql))
                    {
                        $_SESSION["tcr_id"] = $ID;
                        header("Location: Admin_Add_Teacher.php?error=Successfull");
                    }
                }
                else{
                    header("Location: Admin_Add_Teacher.php?error=input_error");
                }
            }
            else{
                header("Location: Admin_Add_Teacher.php?error=input_error");
            }
        }
    }
}
else
{
    header("Location: Admin_Add_Teacher.php?error=input_error");
}
/*
echo "<pre>";
print_r($GLOBALS);
echo "</pre>";
*/
?>

<?php

session_start();
require("Database.php");
$ID = $_REQUEST['student_id'];
$Password = md5($_REQUEST['student_password']);
$Name = $_REQUEST['student_name'];
$Father = $_REQUEST['student_father_name'];
$Mother = $_REQUEST['student_mother_name'];
$Email = $_REQUEST['student_email'];
$Roll = $_REQUEST['student_roll'];
$Class = $_REQUEST['student_class'];
$Batch = $_REQUEST['student_batch'];
$DOB = $_REQUEST['student_dob'];
$BG = $_REQUEST['blood_group'];
$Gender = $_REQUEST['gender'];
$Religion = $_REQUEST['religion'];
$Ballance = $_REQUEST['student_ballance'];
$Address = $_REQUEST['student_address'];

if(strlen($_REQUEST['student_password'])!=0 && strlen($Name) != 0 && strlen($Father) != 0 && strlen($Mother) != 0 && strlen($Email) != 0 && strlen($Roll) != 0 && $Class && strlen($Batch) != 0 &&  $BG != 0 && $Religion != 0 && strlen($Address) != 0)
{
   if(strlen($_REQUEST['student_password']) < 8)
    {
        header("Location: Admin_Add_Student.php?error=inpur_error");
    }  
    else if(str_word_count($Name) < 2)
    {
        header("Location: Admin_Add_Student.php?error=inpur_error");
    }
    else if(str_word_count($Father) < 2)
    {
        header("Location: Admin_Add_Student.php?error=inpur_error");
    }
    else if(str_word_count($Mother) < 2)
    {
        header("Location: Admin_Add_Student.php?error=inpur_error");
    }
    else if(str_word_count($Address) < 2)
    {
        header("Location: Admin_Add_Student.php?error=inpur_error");
    }
    else if(strpos($Email,"@") > strpos($Email,"."))
    {
        header("Location: Admin_Add_Student.php?error=inpur_error");
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
            header("Location: Admin_Add_Student.php?error=1");
        }
        else if(file_exists("uploads/".$n)){
            //echo "Filename exists : ".$n;
           header("Location: Admin_Add_Student.php?error=2");
        }
        else
        {
            if(move_uploaded_file($s,"../resource/image/student/".$n))
            {
                $sql = "insert into std_profile values(null,'".$ID."','".$Name."','".$Father."','".$Mother."','".$Email."','".$Roll."','".$Class."','".$Batch."','".$DOB."','".$BG."',null,'".$Address."','".$Religion."','".$Gender."','".$Ballance."','../resource/image/student/".$n."');";
                if(updateDB($sql)){
                    $sql = "insert into login values(null,'".$ID."','".$Password."','Student');";
                    if(updateDB($sql))
                    {
                        $_SESSION["std_id"] = $ID;
                        header("Location: Admin_Add_Student.php?error=3");
                    }                
                    else
                    {
                        header("Location: Admin_Add_Student.php?error=4");
                    }
            }
            else
            {
                header("Location: Admin_Add_Student.php?error=5");
            }
        }
    }
    }
}
else
{
    header("Location: Admin_Add_Student.php?error=6");
}

?>

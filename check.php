<?php
    $user = $_REQUEST['username'];
    $pass = md5($_REQUEST['password']);
$auth = array();
require("Database.php");
session_start();
	if(isset($user) && isset($pass))
	{
        $sql = "select * from login where id='".$user."'";
        if(getDataFromDB($sql))
        {
            $auth = getDataFromDB($sql);
            foreach($auth as $row)
            {
                if($row["id"]==$user && $row["Password"]==$pass)
                {
                    if($row["Type"] == "Admin")
                    {
                        $_SESSION["flag"] = "success";
                        header("Location: Admin/Admin_Dashboard.php");
                    }
                    else if($row["Type"] == "Student")
                    {
                        $_SESSION["flag"] = "success";
                        $_SESSION["logger_id"] = $user;
                        header("Location: Student/Student_Dashboard.php");
                    }
                    else if($row["Type"] == "Teacher")
                    {
                        $_SESSION["flag"] = "success";
                        $_SESSION["logger_id"] = $user;
                        header("Location: Teacher/Teacher_Dashboard.php");
                    }
                }
                else
                {
                    header("Location: index.html?error=wrong&info");        
                }
            }
        }
        else
        {
            header("Location: index.html?error=invalid info");        
        }
	}
	else
	{
		header("Location: index.html?error=invalid info");        
	}
?>

<?php
require("db_rw.php");

$s=$_FILES['fileToUpload']['tmp_name'];
$n=$_FILES['fileToUpload']['name'];

$ar=explode("/",$_FILES['fileToUpload']['type']);


if($ar[0]!="image"){
	echo "Filetype .$ar[0]. is not supported";
    echo "<hr>";
    echo '<h3><a href="dashboard.php">Go Back</a></h3>';
}
else if(file_exists("image/".$n)){
	echo "Filename exists : ".$n;
}
else{
	if(move_uploaded_file($s,"image/".$n))
    {
        session_start(); 
        $s="update profile SET name='".$n."',image='image/".$n."' where id='".$_SESSION['user_serial']."'";
        
		if(updateSQL($s)){
			echo "Data Inserted into DB";
            
            header("Location: dashboard.php?");
		}
		else{
			echo "DB Error!";
		}
	}
	else{
 echo"File upload error";
	}
}	
?>

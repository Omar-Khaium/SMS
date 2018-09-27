<?php
require("Database.php");
print_r($GLOBALS);

$s=$_FILES['photoUpload']['tmp_name'];
$n=$_FILES['photoUpload']['name'];

$ar=explode("/",$_FILES['photoUpload']['type']);

if($ar[0]!="image"){
	//echo "Filetype not supported";
	echo 1;
}
else if(file_exists("uploads/".$n)){
	//echo "Filename exists : ".$n;
	echo 2;
}
else{
	if(move_uploaded_file($s,"../resource/image/student/".$n)){
		$s="insert into photo values(null,'".$n."','../resource/image/student/".$n."')";
		echo $s;
		if(updateDB($s)){
			$s="select path from photo where Name='".$n."'";
            $path = getDataFromDB($s);
            echo $path[0]["Path"]
		}
		else{
			echo "DB Error!";
		}
	}
	else{
		echo "File upload error";
	}
}	
?>

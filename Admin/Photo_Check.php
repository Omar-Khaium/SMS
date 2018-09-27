<?php

$s=$_REQUEST['id']['tmp_name'];
$n=$_REQUEST['id']['name'];
print_r(GLOBALS);
$ar=explode("/",$_FILES['profile_picture']['type']);


if($ar[0]!="image"){
	echo "Filetype .$ar[0]. is not supported";
    echo "<hr>";
    echo '<h3><a href="dashboard.php">Go Back</a></h3>';
}
else if(file_exists("../resource/image/student/".$n)){
	echo "Filename exists : ".$n;
}
else{
	if(move_uploaded_file($s,"../resource/image/student/".$n))
    {
        echo $s;
	}
	else{
 echo"File upload error";
	}
}	
?>

<?php
require("Database.php");
if(isset($_REQUEST['id']) && strlen($_REQUEST['id'])>0){
	$sq="select * from course where `Course Id`='".$_REQUEST['id']."'";
	$a=getJSONFromDB($sq);
	echo $a;
	}

?>

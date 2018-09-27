<?php
require("Database.php");
if(isset($_REQUEST['id']) && strlen($_REQUEST['id'])>0){
	$sq="select * from batch where `Batch ID`='".$_REQUEST['id']."'";
	$a=getJSONFromDB($sq);
	echo $a;
	}

?>

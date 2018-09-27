<?php
require("Database.php");
if(isset($_REQUEST['id']) && strlen($_REQUEST['id'])>0){
	$sq="select * from tcr_profile where Id='".$_REQUEST['id']."'";
	$a=getJSONFromDB($sq);
	echo $a;
	}

?>

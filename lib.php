<?php
	function loadArray()
	{
		global $auth;
		$myfile = fopen("record.txt","r") or die ("Unable to open file !"); 
		while($c=fgets($myfile)) 
		{
			$a=explode("-",trim($c));
			$auth[$a[0]]=$a[1];
		}
		fclose($myfile);
	}
	function loadType()
	{
		global $type;
		$myfile = fopen("type.txt","r") or die ("Unable to open file !"); 
		while($c=fgets($myfile)) 
		{
			$a=explode("-",trim($c));
			$type[$a[0]]=$a[1];
		}
		fclose($myfile);
	}
?>

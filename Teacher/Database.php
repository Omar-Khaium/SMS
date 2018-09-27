<?php
function updateDB($sql){
	$conn = mysqli_connect("localhost", "root", "", "coaching");
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	if(mysqli_query($conn, $sql)) {
		return "true";
	}
	else{
		return "false";
	}
}
function getDataFromDB($sql){
	$conn = mysqli_connect("localhost", "root", "","coaching");
	$result = mysqli_query($conn, $sql)or die(mysqli_error($conn));
	$arr=array();
	while($row = mysqli_fetch_assoc($result)) {
		$arr[]=$row;
	}
	return $arr;
}
?>

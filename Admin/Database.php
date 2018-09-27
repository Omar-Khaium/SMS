<?php
function updateDB($sql){
	$conn = mysqli_connect("localhost", "root", "", "coaching");
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	if(mysqli_query($conn, $sql)) {
		echo "New records updated successfully";
        return true;
	}
	else{
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        return false;
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
function getJSONFromDB($sql){
	$conn = mysqli_connect("localhost", "root", "","coaching");
	//echo $sql;
	$result = mysqli_query($conn, $sql)or die(mysqli_error($conn));
	$arr=array();
	//print_r($result);
	while($row = mysqli_fetch_assoc($result)) {
		$arr[]=$row;
	}
	return json_encode($arr);
}
?>

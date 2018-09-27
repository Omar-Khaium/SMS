<?php
require("Database.php");
$ID = $_REQUEST['user_id'];
$category = $_REQUEST['payment_category'];
$Discount = $_REQUEST['discount_amount'];
$TotalAmount = $_REQUEST['total_amount'];
$AmountPaid = $TotalAmount - ($TotalAmount* ($Discount/100));
$Date = date('Y-m-d');
/*
echo "<pre>";
print_r($GLOBALS);
echo "</pre>";
*/

$sql = "insert into payment values(null,'".$ID."','".$AmountPaid."','".$Discount."','".$category."','".$Date."')";
if(updateDB($sql))
{
    $sql = "select * from payment";        
    $arr = getDataFromDB($sql);
    $counter = 1;
    foreach($arr as $row)
    {
        $counter++;
    }
    header("Location: Admin_Payment_Transaction.php?info=Successfull");
}
else
{
    header("Location: Admin_Payment_Transaction.php?info=failed");
}
?>

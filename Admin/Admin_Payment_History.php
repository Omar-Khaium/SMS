<?php
require("Database.php");
session_start();
    if(isset($_SESSION["flag"]) && $_SESSION["flag"]=="success"){
        $sql = "select * from payment;";
        $result = getDataFromDB($sql);
        
    echo '<!DOCTYPE html>
<html>
<title>Payment History</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>

    body {
        background-color: whitesmoke;
    }   
    
    .box
    {
        margin:0 auto;
        margin-top:5%;
        padding : 0;
        width:75%;
    }

</style>

<body>
    <!-------------------------------navigation start--------------------------------------->
    <div class="w3-top">
        <div class="w3-bar w3-red">
            <a href="Admin_Dashboard.php" class="w3-bar-item w3-button">Home</a>
            <a href="../logout.php" class="w3-bar-item w3-button w3-hide-small w3-right w3-dark-grey">Logout</a>
            <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium" onclick="myFunction()">&#9776;</a>
        </div>
    </div>
    <!-------------------------------navigation end--------------------------------------->
        <div class="w3-container box w3-card w3-border">
                    <div class="w3-container w3-blue">
                        <h4>Financial History</h4>
                    </div>
                    <div class="w3-container w3-border w3-padding-16">
                        <table class="w3-table-all">
                            <tr class="w3-gray">
                                <th>ID</th>
                                <th>Personnel</th>
                                <th>Type</th>
                                <th>Discount</th>
                                <th>Amount Paid</th>
                                <th>Date</th>
                            </tr>';
        foreach($result as $row)
        {            
            $uStype = explode("TD",$row["User Id"]); $uTtype = explode("CR",$row["User Id"]);
            if($uStype[0]=="S"){
                $type = "Student";
                if($row["Payment Type"]==1)
                {
                    $category = "Admission Fee";
                }
                else if($row["Payment Type"]==2)
                {
                    $category = "Tution Fee";
                }
                else if($row["Payment Type"]==3)
                {
                    $category = "Exam Fee";
                }
            }else if($uTtype[0]=="T"){
                $type = "Teacher";
                if($row["Payment Type"]==1)
                {
                    $category = "Salary";
                }
                else if($row["Payment Type"]==2)
                {
                    $category = "Bonus";
                }
            }
            
            echo '<tr>
            <td>'.$row["User Id"].'</td>
            <td>'.$type.'</td>
            <td>'.$category.'</td>
            <td>'.$row["Discount"].'%</td>
            <td>'.$row["Ammount"].'</td>
            <td>'.$row["Date"].'</td>
            </tr>';
        }
        echo '
                            
                        </table>
                    </div>
        </div>
    <!--For Top Navigation-->
    <script>
        function myFunction() {
            var x = document.getElementById("mobile");
            if (x.className.indexOf("w3-show") == -1) {
                x.className += " w3-show";
            } else {
                x.className = x.className.replace(" w3-show", "");
            }
        }

    </script>
    <!--For Accordion-->
    <script>
        function myAccFunc1() {
            var x = document.getElementById("demoAcc1");
            if (x.className.indexOf("w3-show") == -1) {
                x.className += " w3-show";
                x.previousElementSibling.className += " w3-blue";
            } else {
                x.className = x.className.replace(" w3-show", "");
                x.previousElementSibling.className =
                    x.previousElementSibling.className.replace(" w3-blue", "");
            }
        }

    </script>
    <script>
        function myAccFunc2() {
            var x = document.getElementById("demoAcc2");
            if (x.className.indexOf("w3-show") == -1) {
                x.className += " w3-show";
                x.previousElementSibling.className += " w3-blue";
            } else {
                x.className = x.className.replace(" w3-show", "");
                x.previousElementSibling.className =
                    x.previousElementSibling.className.replace(" w3-blue", "");
            }
        }

    </script>
    <script>
        function myAccFunc3() {
            var x = document.getElementById("demoAcc3");
            if (x.className.indexOf("w3-show") == -1) {
                x.className += " w3-show";
                x.previousElementSibling.className += " w3-blue";
            } else {
                x.className = x.className.replace(" w3-show", "");
                x.previousElementSibling.className =
                    x.previousElementSibling.className.replace(" w3-blue", "");
            }
        }

    </script>
    <script>
        function myAccFunc4() {
            var x = document.getElementById("demoAcc4");
            if (x.className.indexOf("w3-show") == -1) {
                x.className += " w3-show";
                x.previousElementSibling.className += " w3-blue";
            } else {
                x.className = x.className.replace(" w3-show", "");
                x.previousElementSibling.className =
                    x.previousElementSibling.className.replace(" w3-blue", "");
            }
        }

    </script>
</body>

</html>
';
}
else{
	header("Location: ../index.html?error=access restricted");
}
?>

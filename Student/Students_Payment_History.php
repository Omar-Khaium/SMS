<?php
require("../Database.php");
session_start();
    if(isset($_SESSION["flag"]) && $_SESSION["flag"]=="success"){
        $sql = "select * from payment where `User Id`='".$_SESSION["logger_id"]."';";
        $result = getDataFromDB($sql);
    echo '<!DOCTYPE html>
<html>
<title>Payment History</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
    td {
        padding: 1px 35px;
    }

    table.card {
        border: .5px solid gray;
    }

    table.card td {
        padding: 10px 50px;
        width: 50px;
    }

    body {
        background-color: whitesmoke;
    }

    a {
        color: deepskyblue;
        text-decoration: none;
    }

</style>

<body>
    <!-------------------------------navigation start--------------------------------------->
    <div class="w3-top">
        <div class="w3-bar w3-red">
            <span><img src="../images/favicon.png" style="width:36px;height:36px;float:left;"></span>
            <a href="Student_Dashboard.php" class="w3-bar-item w3-button">Home</a>
            <a href="Student_All_Courses.php" class="w3-bar-item w3-button w3-hide-small">Courses</a>
            <a href="Teachers_List.php" class="w3-bar-item w3-button w3-hide-small">Teacher</a>
            <a href="../logout.php" class="w3-bar-item w3-button w3-hide-small w3-right w3-dark-grey">Logout</a>
            <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium" onclick="myFunction()">&#9776;</a>
        </div>
    </div>
    <!-------------------------------navigation end--------------------------------------->
    <table style="margin-top: 50px;margin-left: 50px;">

        <div class="w3-container w3-card w3-content w3-border-left" style="max-width:500px">
            <tr>
              <!------------------Accordion Start------------------------->
                <td class="w3-cell-top">

                    <div class="w3-sidebar w3-bar-block w3-light-grey w3-card" style="margin-left:-50px;width:200px;height:400px;">
                        <div class="w3-container w3-blue">
                            <h4>Dashboard</h4>
                        </div>
                        <a href="Student_Profile.php">
                            <div class="w3-bar-item w3-button">
                                Profile <i class="fa fa-caret-right"></i></div>
                        </a>
                        <div class="w3-bar-item w3-button" onclick="myAccFunc1()">
                            Course <i class="fa fa-caret-down"></i></div>
                        <div id="demoAcc1" class="w3-hide w3-white w3-card-4 w3-grey">
                            <a href="Student_All_Courses.php" class="w3-bar-item w3-button">Details</a>
                            <a href="Teachers_List.php" class="w3-bar-item w3-button">Teachers</a>
                        </div>
                        <div class="w3-bar-item w3-button" onclick="myAccFunc2()">
                            Academics <i class="fa fa-caret-down"></i></div>
                        <div id="demoAcc2" class="w3-hide w3-white w3-card-4 w3-grey">
                            <a href="Students_Result.php" class="w3-bar-item w3-button">Result</a>
                            <a href="Students_Attendence.php" class="w3-bar-item w3-button">Attendence</a>
                        </div>
                        <a href="Students_Payment_History.php" style="color:black;">
                            <div class="w3-bar-item w3-button">
                                Financial <i class="fa fa-caret-right"></i></div>
                        </a>
                        <a href="Students_Notices.php" style="color:black;">
                            <div class="w3-bar-item w3-button">
                                Notices <i class="fa fa-caret-right"></i></div>
                        </a>
                    </div>

                </td>
                <!-----------------------------Acordion End------------------------->
                <td class="w3-cell-top" style="padding-left:150px;width:100%">
                    <div class="w3-container w3-blue">
                        <h4>Financial History</h4>
                    </div>
                    <div class="w3-container w3-border w3-padding-16">
                        <table class="w3-table-all">
                            <tr class="w3-gray">
                                <th>Transaction Type</th>
                                <th>Total Paid</th>
                                <th>Discount</th>
                                <th>Total Amount To Be Paid</th>
                                <th>Date</th>
                            </tr>';
        foreach($result as $row)
        {
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
            $total = $row["Ammount"] + ($row["Ammount"] * ((float)($row["Discount"]/100)));
            echo '<tr>
            <td>'.$category.'</td>
            <td>'.$row["Ammount"].'</td>
            <td>'.$row["Discount"].'%</td>
            <td>'.$total.'</td>
            <td>'.$row["Date"].'</td>
            </tr>';
        }
        echo '</table>
                    </div>
                </td>
            </tr>
        </div>
    </table>
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

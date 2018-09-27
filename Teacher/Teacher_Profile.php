<?php
require("../Database.php");
session_start();
    if(isset($_SESSION["flag"]) && $_SESSION["flag"]=="success" && isset($_SESSION["logger_id"])){
        $sql = "select * from tcr_profile where Id='".$_SESSION["logger_id"]."'";
        $result = getDataFromDB($sql);
    echo '../logout.php!DOCTYPE html>
<html>
<title>Teacher Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    td {
        padding: 3px 25px;
    }

    body {
        background-color: whitesmoke;
    }

    img {
        margin-top: 25px;
        margin-right: 25;
    }

    hr {
        border: 0.5px solid gray;
        margin-top: auto;
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
            <a href="Teacher_Dashboard.php" class="w3-bar-item w3-button">Home</a>
            <a href="Teacher_Courses.php" class="w3-bar-item w3-button w3-hide-small">Courses</a>
            <a href="Students_List.php" class="w3-bar-item w3-button w3-hide-small">Student</a>
            <a href="../logout.php" class="w3-bar-item w3-button w3-hide-small w3-right w3-dark-grey">Logout</a>
            <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium" onclick="myFunction()">&#9776;</a>
        </div>
    </div>
    <!-------------------------------navigation end--------------------------------------->
    <table style="margin-top: 50px;margin-left: 50px;">

        <div class="w3-container w3-card w3-content w3-border-left" style="max-width:250px">
            <tr>
               <!------------------Accordion Start------------------------->
                <td class="w3-cell-top" style="float:left;padding-left:75px;">

                    <div class="w3-sidebar w3-bar-block w3-light-grey w3-card" style="margin-left:-50px;width:200px;height:400px;">
                        <div class="w3-container w3-blue">
                            <h4>Dashboard</h4>
                        </div>
                        <a href="Teacher_Profile.php">
                            <div class="w3-bar-item w3-button" onclick="#">
                                Profile <i class="fa fa-caret-right"></i></div>
                        </a>
                        <div class="w3-bar-item w3-button" onclick="myAccFunc1()">
                            Course <i class="fa fa-caret-down"></i></div>
                        <div id="demoAcc1" class="w3-hide w3-white w3-card-4 w3-grey">
                            <a href="Teacher_Courses.php" class="w3-bar-item w3-button">Details</a>
                            <a href="Students_List.php" class="w3-bar-item w3-button">Student</a>
                        </div>
                        <div class="w3-bar-item w3-button" onclick="myAccFunc2()">
                            Academics <i class="fa fa-caret-down"></i></div>
                        <div id="demoAcc2" class="w3-hide w3-white w3-card-4 w3-grey">
                            <a href="Teacher_Grade.php" class="w3-bar-item w3-button">Grade</a>
                            <a href="Attendence_Form.php" class="w3-bar-item w3-button">Attendence</a>
                        </div>
                        <div class="w3-bar-item w3-button" onclick="myAccFunc4()">
                            Others <i class="fa fa-caret-down"></i></div>
                        <div id="demoAcc4" class="w3-hide w3-white w3-card-4 w3-grey">
                            <a href="Teacher_Application.php" class="w3-bar-item w3-button">Application</a>
                            <a href="Teacher_Complain.php" class="w3-bar-item w3-button">Complains</a>
                        </div>
                    </div>

                </td>
                <!-----------------------------Acordion End------------------------->

                <!-------------------------Routine start------------------------------->
                <td class="w3-cell-top" style="padding-left:15%;width:100%;">
                    <div class="w3-container w3-blue" style="width:100%;">
                        <h4>Profile</h4>
                    </div>
                    <table class="profile w3-border" style="width:100%;">
                        <tr>
                            <td style="width:10%;">
                                ID
                            </td>
                            <td style="width:1%;">
                                :
                            </td>
                            <td style="padding-left:5%;width:30%;">'.$result[0]["Id"].'<hr>
                            </td>
                            <td rowspan="3">
                                <div class="w3-card-1" style="float:right">
                                    <img src="'.$result[0]["Photo"].'" alt="Profile Picture" style="width:100px;height:100px;">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:10%;">
                                Name
                            </td>
                            <td style="width:1%;">
                                :
                            </td>
                            <td style="padding-left:5%;width:30%;">'.$result[0]["Name"].'<hr>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:10%;">
                                Email
                            </td>
                            <td style="width:1%;">
                                :
                            </td>
                            <td style="padding-left:5%;width:30%;">'.$result[0]["Email"].'<hr>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:10%;">
                                Moblie
                            </td>
                            <td style="width:1%;">
                                :
                            </td>
                            <td style="padding-left:5%;width:30%;">'.$result[0]["Mobile"].'<hr>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:10%;">
                                Department
                            </td>
                            <td style="width:1%;">
                                :
                            </td>
                            <td style="padding-left:5%;width:30%;">';
                            switch($result[0]["Department"])
                            {
                                case 1:
                                    echo 'Bangla';
                                    break;
                                case 2:
                                    echo 'English';
                                    break;
                                case 3:
                                    echo 'Mathematics';
                                    break;
                                case 4:
                                    echo 'Science';
                                    break;
                                case 5:
                                    echo 'Commerce';
                                    break;
                                case 6:
                                    echo 'Arts';
                                    break;
                            }
                                echo '<hr>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:10%;">
                                Designation
                            </td>
                            <td style="width:1%;">
                                :
                            </td>
                            <td style="padding-left:5%;width:30%;">';
                            switch($result[0]["Designation"])
                            {
                                case 1:
                                    echo 'Senior Teacher';
                                    break;
                                case 2:
                                    echo 'Junior Teacher';
                                    break;
                                case 3:
                                    echo 'Part-time Teacher';
                                    break;
                                case 4:
                                    echo 'Guest Teacher';
                                    break;
                            }
                                echo '<hr>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:10%;">
                                Salary
                            </td>
                            <td style="width:1%;">
                                :
                            </td>
                            <td style="padding-left:5%;width:30%;">'.$result[0]["Salary"].'<hr>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:10%;">
                                Gender
                            </td>
                            <td style="width:1%;">
                                :
                            </td>
                            <td style="padding-left:5%;width:30%;">'.ucfirst($result[0]["Gender"]).'<hr>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:20%;">
                                Date Of Birth
                            </td>
                            <td style="width:1%;">
                                :
                            </td>
                            <td style="padding-left:5%;width:60%;">'.date("d-M-Y", strtotime($result[0]["DOB"])).'<hr>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:15%;">
                                Blood Group
                            </td>
                            <td style="width:1%;">
                                :
                            </td>
                            <td style="padding-left:5%;width:30%;">';
                            switch($result[0]["Blood group"])
                            {
                                case 1:
                                    echo 'A positive';
                                    break;
                                case 2:
                                    echo 'A negetive';
                                    break;
                                case 3:
                                    echo 'B positive';
                                    break;
                                case 4:
                                    echo 'B negetive';
                                    break;
                                case 5:
                                    echo 'AB positive';
                                    break;
                                case 6:
                                    echo 'AB negetive';
                                    break;
                                case 7:
                                    echo 'O positive';
                                    break;
                                case 8:
                                    echo 'O negetive';
                                    break;
                            }
                                echo '<hr>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:15%;">
                                Religion
                            </td>
                            <td style="width:1%;">
                                :
                            </td>
                            <td style="padding-left:5%;width:30%;">';
                            switch($result[0]["Religion"])
                            {
                                case 1:
                                    echo 'Islam';
                                    break;
                                case 2:
                                    echo 'Hindu';
                                    break;
                                case 3:
                                    echo 'Buddhist';
                                    break;
                                case 4:
                                    echo 'Christian';
                                    break;
                            }
                                echo '<hr>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:15%;">
                                Current Balance
                            </td>
                            <td style="width:1%;">
                                :
                            </td>
                            <td style="padding-left:5%;width:30%;">'.$result[0]["Current Balance"].'<hr>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:15%;">
                                Address
                            </td>
                            <td style="width:1%;">
                                :
                            </td>
                            <td style="padding-left:5%;width:30%;">'.$result[0]["Address"].'<hr>
                            </td>
                        </tr>
                    </table>
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
>';
}
else{
	header("Location: ../index.html?error=access restricted");
}
?>

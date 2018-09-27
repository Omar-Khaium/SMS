<?php
session_start();
    if(isset($_SESSION["flag"]) && $_SESSION["flag"]=="success"){
    echo '<!DOCTYPE html>
<html>
<title>Application</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
            <a href="Teacher_Dashboard.php" class="w3-bar-item w3-button">Home</a>
            <a href="Teacher_Courses.php" class="w3-bar-item w3-button w3-hide-small">Courses</a>
            <a href="Students_List.php" class="w3-bar-item w3-button w3-hide-small">Student</a>
            <a href="../logout.php" class="w3-bar-item w3-button w3-hide-small w3-right w3-dark-grey">Logout</a>
            <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium" onclick="myFunction()">&#9776;</a>
        </div>
    </div>
    <!-------------------------------navigation end--------------------------------------->
    <table style="margin-top: 50px;margin-left: 50px;">

        <div class="w3-container w3-card w3-content w3-border-left" style="max-width:500px">
            <tr>
            <td colspan="3">';
                if(isset($_REQUEST["info"]))
                {
                    switch($_REQUEST["info"])
                    {
                        case 1:                    
                            echo '<div align="center">
                                <h6 id="msg" style="color:green;">*Aplication submited successfully</h6>
                            </div>';
                            break;
                        case 2:                    
                            echo '<div align="center">
                                <h6 id="msg" style="color:orangered;">*Aplication submission failed</h6>
                            </div>';
                            break;
                    }
                }
                else
                {            
                    echo '<div align="center">
                        <h6 id="msg"></h6>
                    </div>';
                }
                echo '
            </td>
            <tr>
            </tr>
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
                <td class="w3-cell-top" style="padding-left:150px;width:100%">
                    <div class="w3-container w3-blue">
                        <h4>Application</h4>
                    </div>
                    <div class="w3-container w3-border w3-padding-16">
                        <br>

                        <form action="submitApplication.php" class="w3-container w3-card-4 w3-light-grey w3-text-blue w3-margin">

                            <div class="w3-row w3-section">
                                <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-envelope-o"></i></div>
                                <div class="w3-rest">
                                    <input class="w3-input w3-border" name="subject" id="subject" type="text" placeholder="Subject">
                                </div>
                            </div>

                            <div class="w3-row w3-section">
                                <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-pencil"></i></div>
                                <div class="w3-rest">
                                    <input class="w3-input w3-border" id="message" name="message" type="text" placeholder="Description">
                                </div>
                            </div>

                            <input type="submit" onclick="return check()" class="w3-button w3-block w3-section w3-blue w3-ripple w3-padding" value="Submit Application">

                        </form>
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
        function check() {
            var desc = document.getElementById("message").value.length;
            var sub = document.getElementById("subject").value.length;
            if(desc > 0 && sub > 0)
            {
                return true;
            }
            else
            {
                return false;
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

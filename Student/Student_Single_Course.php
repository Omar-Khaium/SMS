<?php
require("../Database.php");
session_start();
    if(isset($_SESSION["flag"]) && $_SESSION["flag"]=="success"){
        $sql = "select * from course where `Course Id`='".$_REQUEST["id"]."'";
        $Course = getDataFromDB($sql);
        $sql = "select * from tcr_profile where `Id`='".$Course[0]["Teacher Id"]."'";
        $Teacher = getDataFromDB($sql);
        $sql = "select * from slot where `Serial`='".$Course[0]["Slot"]."'";
        $slot = getDataFromDB($sql);
        $day = explode(", ",$slot[0]["Day"]);
    echo '<!DOCTYPE html>
<html>
<title>Course Details to Student</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
    td {
        padding: 1px 35px;
    }

    table.routine {
        width: 100%;
        border-collapse: collapse;
    }

    table.routine td,
    th {
        width: 100px;
        border: 1px solid grey;
    }

    body {
        background-color: whitesmoke;
    }

    hr {
        border: 0.5px solid gray;
        margin: auto;
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
                <td class="w3-cell-top" style="padding-left:150px;">
                    <div class="w3-container w3-blue">
                        <h4>'.$Course[0]["Name"].'</h4>
                    </div>
                    <div class="w3-container w3-border w3-padding-16">
                        <!-------------------------Course start------------------------------->
                        <table>
                            <tr>
                                <td rowspan="3" colspan="3">
                                    <div class="w3-round">
                                        <img src='.$Teacher[0]["Photo"].' class="w3-circle" alt="Profile Picture" style="width:100px;height:100px;">
                                    </div>
                                </td>
                                <td class="w3-left-align" rowspan="3" colspan="9">'.$Teacher[0]["Name"].'</td>
                                <td rowspan="3" colspan="6">
                                    <table class="routine">
                                        <tr>
                                            <th style="width:250px;">'.$day[0].'</th>
                                            <th style="width:250px;">'.$day[1].'</th>
                                        </tr>
                                        <tr>
                                            <td>'.$slot[0]["Time"].'</td>
                                            <td>'.$slot[0]["Time"].'</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                            </tr>
                            <tr>
                                <br>
                            </tr>
                            <tr>
                                <td rowspan="10" colspan="18">

                                    <!---------------For Tabs-------------------------->
                                    <div class="w3-container">
                                        <div class="w3-row">
                                            <a href="javascript:void(0)" onclick="openCity(event, \'Files\');">
                                                <div class="w3-third tablink w3-bottombar w3-hover-grey w3-padding">Notes</div>
                                            </a>
                                            <a href="javascript:void(0)" onclick="openCity(event, \'Notices\');">
                                                <div class="w3-third tablink w3-bottombar w3-hover-grey w3-padding">Notices</div>
                                            </a>
                                        </div>

                                        <div id="Files" class="w3-container city" style="display:none">
                                            <h2>Notes<br><hr></h2>';
        $sql = "select * from file where `Course id`='".$_REQUEST["id"]."'";
        $fileResult = getDataFromDB($sql);
        echo '<table>
        <tr>
            <th style="width:400px;">File name</th>
            <th style="width:100px;">Size</th>
            <th style="width:200px;">Upload  Time</th>
        </tr>';
        foreach($fileResult as $row)
        {
            echo '<tr>';
            echo '<td style="width:400px;">'.$row["File Name"].'</td>';
            echo '<td style="width:100px;">'.$row["Size"].'MB</td>';
            echo '<td style="width:200px;">'.date("d-M-Y", strtotime($row["Upload Time"])).'</td>';
            echo '</tr>';
        }
        
        
        
                                            echo '</table>
                                        </div>

                                        <div id="Notices" class="w3-container city" style="display:none">
                                            <h2>Notice<br><hr></h2>';
        $sql = "select * from notice where `Course id`='".$_REQUEST["id"]."'";
        $noticeResult = getDataFromDB($sql);
        echo '<table style="width:100%;border:0px solid  black;">
        <tr>
            <th style="width:400px;">Subject</th>
            <th style="width:200px;">Upload  Time</th>
        </tr>';
        foreach($noticeResult as $row)
        {
            echo '<tr>';
            echo '<td><span onclick="show(this)" id="'.$row["Description"].'"><b>'.$row["Subject"].'</b></span></td>';
            echo '<td>'.date("d-M-Y", strtotime($row["Upload Time"])).'</td>';
            echo '</tr>';
        }
        
        
        
                                            echo '</table>
                                        </div>
                                    </div>
                                </td>

                                <!---------------Tabs Ends-------------------------->

                            </tr>
                        </table>
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
    <!--for tabs--><script>
    function openCity(evt, cityName) {
        var i, x, tablinks;
        x = document.getElementsByClassName("city");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablink");
        for (i = 0; i < x.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" w3-border-red", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.firstElementChild.className += " w3-border-red";
    }
        function show(element) {
        alert(element.id);
        }
</script>


</body>

</html>';
}
else{
	header("Location: ../index.html?error=access restricted");
}
?>

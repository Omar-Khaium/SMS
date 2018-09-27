<?php
require("Database.php");
session_start();
    if(isset($_SESSION["flag"]) && $_SESSION["flag"]=="success"){
    echo '<!DOCTYPE html>
<html>
<title>Complain History</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    td {
        padding: 1px 25px;
    }

    body {
        background-color: whitesmoke;
    }

    select {
        width:30%;
        height:35px;
        margin-left:35%;
        margin-bottom:20px;
    }

    a {
        color: deepskyblue;
        text-decoration: none;
    }
    #title
    {
        font-size:20px;
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
                        <h4>Complain History</h4>
                    </div>
                    <div class="w3-container w3-border w3-padding-16">
                        <select id="complainBox" class="w3-round w3-border" onchange="update()">
                        <option value="0" selected disabled>Choose  an option';
            $sql = "select * from complain where `Teacher Id`='".$_SESSION["logger_id"]."'";
            $resultComp = getDataFromDB($sql);
            foreach($resultComp as $data)
            {
                echo '<option value="'.$data["Complain Id"].'">'.$data["Subject"];
            }
                
                        echo '</select>
                        <div class="w3-container w3-center w3-large" style="width:50%;margin: 0 auto;">
                        ';
        if(isset($_REQUEST["id"]))
        {
        $sql = "select * from complain where `Complain Id`='".$_REQUEST["id"]."'";
        $result = getDataFromDB($sql);
        $sql = "select * from std_profile where `Std_id`='".$result[0]["Student Id"]."'";
        $std = getDataFromDB($sql);
            
        if($result[0]["Status"]=="Approved")
        {
            echo '<div class="w3-container w3-green">
              <h4>Complain History</h4>
            </div>';
        }
        else if($result[0]["Status"]=="Pending")
        {
            echo '<div class="w3-container w3-blue">
              <h4>Complain History</h4>
            </div>';
        }
        else if($result[0]["Status"]=="Rejected")
        {
            echo '<div class="w3-container w3-red">
              <h4>Complain History</h4>
            </div>';
        }
        echo '

        <div class="w3-container w3-border">
          <table>
          <tr>
            <td><span id="subject">Subject</span></td>
            <td style="padding-left:5px;"><span id="colon1">:</span></td>
            <td style="padding-left:5px;text-align:left;"><span id="subjectValue">'.$result[0]["Subject"].'</span></td>
          </tr>
          <tr>
            <td><span id="student">Student</span></td>
            <td style="padding-left:5px;"><span id="colon2">:</span></td>
            <td style="padding-left:5px;text-align:left;"><span id="studentValue">'.$std[0]["Std_Name"].'</span></td>
          </tr>
          <tr>
            <td><span id="description">Description</span></td>
            <td style="padding-left:5px;"><span id="colon3">:</span></td>
            <td style="padding-left:5px;text-align:left;"><span id="descriptionValue">'.$result[0]["Description"].'</span></td>
          </tr>
          <tr>
            <td><span id="status">Status</span></td>
            <td style="padding-left:5px;"><span id="colon4">:</span></td>
            <td style="padding-left:5px;text-align:left;"><span id="statusValue">'.$result[0]["Status"].'</span></td>
          </tr>
          </table>
        </div>';
        }
        else
        {
            echo '
            <div class="w3-container w3-blue">
              <h4>Complain History<h4>
            </div>
            <div class="w3-container w3-border">
              <table>
              <tr>
                <td><span id="subject"></span></td>
                <td style="padding-left:5px;"><span id="colon1"></span></td>
                <td style="padding-left:5px;text-align:left;"><span id="subjectValue"></td>
              </tr>
              <tr>
                <td><span id="student"></span></td>
                <td style="padding-left:5px;"><span id="colon2"></span></td>
                <td style="padding-left:5px;text-align:left;"><span id="studentValue"></span></td>
              </tr>
              <tr>
                <td><span id="description"></span></td>
                <td style="padding-left:5px;"><span id="colon3"></span></td>
                <td style="padding-left:5px;text-align:left;"><span id="descriptionValue"></span></td>
              </tr>
              <tr>
                <td><span id="status"></span></td>
                <td style="padding-left:5px;"><span id="colon4"></span></td>
                <td style="padding-left:5px;text-align:left;"><span id="statusValue"></span></td>
              </tr>
              </table>
            </div>';
        }
                        echo '</div>
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
        function update()
        {
            var x = document.getElementById("complainBox").value;
            
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var record = JSON.parse(this.responseText);
                document.getElementById("subject").innerHTML = "Subject";
                document.getElementById("colon1").innerHTML = ":";
                document.getElementById("subjectValue").innerHTML = record[0]["Subject"];
                document.getElementById("student").innerHTML = "Student";
                document.getElementById("colon2").innerHTML = ":";
                document.getElementById("studentValue").innerHTML = record[0]["Student Id"];
                document.getElementById("description").innerHTML = "Description";
                document.getElementById("colon3").innerHTML = ":";
                document.getElementById("descriptionValue").innerHTML = record[0]["Description"];
                document.getElementById("status").innerHTML = "Status";
                document.getElementById("colon4").innerHTML = ":";
                document.getElementById("statusValue").innerHTML = record[0]["Status"];
            }
            };
            var url = "Crud_Action.php?id="+x+"&type=1";
            xhttp.open("GET", url, true);
            xhttp.send();
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

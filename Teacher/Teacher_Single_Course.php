<?php
require("../Database.php");
session_start();
    if(isset($_SESSION["flag"]) && $_SESSION["flag"]=="success" && isset($_SESSION["logger_id"]) && isset($_REQUEST["id"])){
        $sql = "select * from course where `Course Id`='".$_REQUEST["id"]."'";
        $result = getDataFromDB($sql);
        $sql = "select * from batch where `Batch ID`='".$result[0]["Batch Id"]."'";
        $resultBatch = getDataFromDB($sql);
        $sql = "select * from slot where `Serial`='".$result[0]["Slot"]."'";
        $slot = getDataFromDB($sql);
        $day = explode(", ",$slot[0]["Day"]);
    echo '<!DOCTYPE html>
<html>
<title>Course Details to Student</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

    button {
        background-color: lightgray;
        font-style: bold;
        color: aqua;
        align-content: center;
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
            <a href="Teacher_Dashboard.php" class="w3-bar-item w3-button">Home</a>
            <a href="Teacher_Courses.php" class="w3-bar-item w3-button w3-hide-small">Courses</a>
            <a href="Students_List.php" class="w3-bar-item w3-button w3-hide-small">Student</a>
            <a href="../logout.php" class="w3-bar-item w3-button w3-hide-small w3-right w3-dark-grey">Logout</a>
            <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium" onclick="myFunction()">&#9776;</a>
        </div>
    </div>
    <!-------------------------------navigation end--------------------------------------->
    <table style="margin-top: 50px;margin-left: 50px;">
    <tr>
    <td colspan="3" align="center">'; 
        if(isset($_REQUEST["error"]))
        {
            switch($_REQUEST["error"])
            {
                case 6:                    
                    echo '<div align="center">
                        <h6 id="msg" style="color:orangered;">*Fill all the fields correctly</h6>
                    </div>';
                    break;
                case 3:                    
                    echo '<div align="center">
                        <h6 id="msg" style="color:limegreen;">*File Uploaded Successfully</h6>
                    </div>';
                    break;
                case 4:                    
                    echo '<div align="center">
                        <h6 id="msg" style="color:orangered;">*File Upload Failed</h6>
                    </div>';
                    break;
                case 5:                    
                    echo '<div align="center">
                        <h6 id="msg" style="color:orangered;">*Database Error</h6>
                    </div>';
                    break;
                case 2:                    
                    echo '<div align="center">
                        <h6 id="msg" style="color:orangered;">*Uploaded File is already exists</h6>
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
        echo '</td>
    </tr>

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
                <td class="w3-cell-top" style="padding-left:150px;">
                    <div class="w3-container w3-blue">
                        <h4>Course Details</h4>
                    </div>
                    <div class="w3-container w3-border w3-padding-16">
                        <!-------------------------Course start------------------------------->
                        <table>
                            <tr>
                                <td>
                                    <div class="w3-round">
                                        <span><b>'.$result[0]["Name"].'</b></span>
                                    </div>
                                </td>
                                <td class="w3-left-align"><span><b>'.$resultBatch[0]["BatchName"].'</b></span></td>
                                <td>
                                    <table class="routine" style="width:200px;">
                                        <tr>
                                            <th>'.$day[0].'</th>
                                            <th>'.$day[1].'</th>
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
                                            <hr>
                                            <a href="javascript:void(0)" onclick="openCity(event, \'Notices\');">
                                                <div class="w3-third tablink w3-bottombar w3-hover-grey w3-padding">Notices</div>
                                            </a>
                                        </div>

                                        <div id="Files" class="w3-container city" style="display:none">
                                            <h2>Notes</h2>
                                            <hr>';
        $sql = "select * from file where `Course id`='".$_REQUEST["id"]."'";
        $fileResult = getDataFromDB($sql);
        echo '<table>
        <tr>
            <th>File name</th>
            <th>Size</th>
            <th>Upload  Time</th>
        </tr>';
        foreach($fileResult as $row)
        {
            echo '<tr>';
            echo '<td style="width:400px;">'.$row["File Name"].'</td>';
            echo '<td style="width:100px;">'.$row["Size"].'MB</td>';
            echo '<td style="width:200px;">'.date("d-M-Y", strtotime($row["Upload Time"])).'</td>';
            echo '</tr>';
        }
        
        
        
                                            echo '</table><hr>
                                            <br>
                                    <form name="myForm" action="fileAction.php" method="post" enctype="multipart/form-data">   
                                            <input name="courseid" id="courseid" type="text" style="display:none;" value='.$_REQUEST["id"].'>
                                            <input name="filename" id="filename" class="w3-input w3-border w3-round" type="text" placeholder="Enter File Name">
                                            <br>
                                            <input id="fileToUpload" name="fileToUpload" type="file" id="tohide" />
                                            <br>
                                            <br>
                                            <input type="submit" onclick="return check();" value="Upload File" class="w3-button w3-blue w3-round" style="margin-left: 40%;">
                                        </div>
                                    </form>
                                        <div id="Notices" class="w3-container city" style="display:none">
                                            <h2>Notice</h2>
                                            <hr>';
        $sql = "select * from notice where `Course id`='".$_REQUEST["id"]."'";
        $noticeResult = getDataFromDB($sql);
        echo '<table style="width:100%;">
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
        
        
        
                                            echo '</table><hr>
                                            <br>
                                            <input name="course_id" id="course_id" type="text" style="display:none;" value='.$_REQUEST["id"].'>
                                            <input id="subject" class="w3-input w3-border w3-round" type="text" placeholder="Write your Notice\'s Subject Here"><br>
                                            <input id="description" class="w3-input w3-border w3-round" type="text" placeholder="Write your Notice\'s Description Here"><br>
                                            <button onclick="submitNotice()" class="w3-button w3-blue w3-round">Post Notice</button>
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
        function show(element) {
        alert(element.id);
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
    <!--for tabs-->
    <script>
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

    </script>
    
    
    <script>
        function submitNotice()
        {
            var course = document.getElementById("course_id").value;
            var subject = document.getElementById("subject").value;
            var description = document.getElementById("description").value;
            
            if(subject.length > 0 && description.length > 0)
            {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    if(this.responseText.length>1)
                    {
                        alert("Notice Posted");
                    }
                    else
                    {
                        alert("Notice Posting Failed");
                    }
                }
                };
                var url = "Crud_Action.php?id="+course+"&subject="+subject+"&description="+description+"&type=3";
                xhttp.open("GET", url, true);
                xhttp.send();
            }
        }

    </script>
    
    
    <script>
        function check()
        {
            var name = document.getElementById("filename").value;
            var id = document.getElementById("courseid").value;
            var file = document.getElementById("fileToUpload").value;
            if(name.length == 0 && id!=0)
            {
                document.getElementById("msg").innerHTML = "*File name can not be empty";
                document.getElementById("msg").style.color = "red";
                return false;
            }
            else if(file == "" && id!=0)
            {
                document.getElementById("msg").innerHTML = "*Choose a File to procced";
                document.getElementById("msg").style.color = "red";
                return false;
            }
            else
            {
                return true;
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

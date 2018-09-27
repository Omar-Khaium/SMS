<?php
require("../Database.php");
session_start();
    if(isset($_SESSION["flag"]) && isset($_REQUEST["Class"]) && $_SESSION["flag"]=="success"){
        if(isset($_REQUEST["Class"]) && isset($_REQUEST["Batch"]))
        {
            $sql = "select * from batch where Class='".$_REQUEST["Class"]."';";
            $resultBatch = getDataFromDB($sql);
            $sql = "select * from std_profile where Class='".$_REQUEST["Class"]."' AND  Batch='".$_REQUEST["Batch"]."';";
            $student = getDataFromDB($sql);
            $sql = "select * from course where `Teacher Id`='".$_SESSION["logger_id"]."';";
            $resultCourse = getDataFromDB($sql);
        }
        else if(isset($_REQUEST["Class"]))
        {
            $sql = "select * from batch where Class='".$_REQUEST["Class"]."';";
            $resultBatch = getDataFromDB($sql);
            $sql = "select * from std_profile where Class='".$_REQUEST["Class"]."';";
            $student = getDataFromDB($sql);
            $sql = "select * from course where `Teacher Id`='".$_SESSION["logger_id"]."';";
            $resultCourse = getDataFromDB($sql);
        }
        else if(isset($_REQUEST["Batch"]))
        {
            $sql = "select * from batch where `Batch ID`='".$_REQUEST["Batch"]."';";
            $resultBatch = getDataFromDB($sql);
            $sql = "select * from std_profile where Batch='".$_REQUEST["Batch"]."';";
            $student = getDataFromDB($sql);
            $sql = "select * from course where `Teacher Id`='".$_SESSION["logger_id"]."';";
            $resultCourse = getDataFromDB($sql);
        }
        else
        {            
            $sql = "select * from batch";
            $resultBatch = getDataFromDB($sql);
            $sql = "select * from std_profile";
            $student = getDataFromDB($sql);
            $sql = "select * from course where `Teacher Id`='".$_SESSION["logger_id"]."';";
            $resultCourse = getDataFromDB($sql);
        }
    echo '<!DOCTYPE html>
<html>
<title>Grade Submission</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    td {
        padding: 1px 25px; 
    }
    table.myTable td {
        padding-left: 0px;
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

    input {
        font-style: bold;
        padding: 10px;
        margin: 10px;
        border-radius: 5px;
        border: .5px solid gray;
        background-color: snow;
        width: 150%;
    }

    select {
        font-style: bold;
        padding: 10px;
        margin: 5px;
        border-radius: 5px;
        border: .5px solid gray;
        background-color: snow;
        width: 100%;
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
    <table style="margin-top: 50px;margin-left: 50px;width:90%">

    <form action="gradeSubmit.php" method="post">
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
                        <h4>Grade Submission</h4>
                    </div>
                    <div class="w3-container w3-border w3-padding-16">
                        <!-------------------------Course start------------------------------->
                        <table class="grade" style="width=600px;">
                            <tr>
                                <td style="width=200px;">
                                    <select id="Class" name="Class" onchange="updateBatch(this)">
                                        <option value="0" selected disabled>Choose a Class</option>';
        if($_REQUEST["Class"]==6)
        {
            echo '<option value="6" selected>Class 06</option>
                    <option value="7">Class 07</option>
                    <option value="8">Class 08</option>
                    <option value="9">Class 09</option>
                    <option value="10">Class 10</option>';
        }
        if($_REQUEST["Class"]==7)
        {
            echo '<option value="6">Class 06</option>
                    <option value="7" selected>Class 07</option>
                    <option value="8">Class 08</option>
                    <option value="9">Class 09</option>
                    <option value="10">Class 10</option>';
        }
        if($_REQUEST["Class"]==8)
        {
            echo '<option value="6">Class 06</option>
                    <option value="7">Class 07</option>
                    <option value="8" selected>Class 08</option>
                    <option value="9">Class 09</option>
                    <option value="10">Class 10</option>';
        }
        if($_REQUEST["Class"]==9)
        {
            echo '<option value="6">Class 06</option>
                    <option value="7">Class 07</option>
                    <option value="8">Class 08</option>
                    <option value="9" selected>Class 09</option>
                    <option value="10">Class 10</option>';
        }
        if($_REQUEST["Class"]==10)
        {
            echo '<option value="6">Class 06</option>
                    <option value="7">Class 07</option>
                    <option value="8">Class 08</option>
                    <option value="9">Class 09</option>
                    <option value="10" selected>Class 10</option>';
        }
                                        
                                    echo '</select>
                                </td>
                                <td style="width=100%;">
                                <select style="width:200px;" onchange="updateClass(this)" class="w3-select w3-border w3-round" id="Batch" name="Batch">'; 
        echo '<option value="0" disabled selected>Choose a Batch</option>';        
        foreach($resultBatch as $data)
        {
            if(isset($_REQUEST["Batch"]) && $_REQUEST["Batch"]==$data["Batch ID"])
            {
                echo '<option value='.$data["Batch ID"].' selected>'.$data["BatchName"].'</option>';
            }
            else
            {
                echo '<option value='.$data["Batch ID"].'>'.$data["BatchName"].'</option>';
            }
            
        }
        
        echo '</select>
                                </td>
                                <td style="width=100%;">
                                <select style="width:200px;" class="w3-select w3-border w3-round" id="Course" name="Course">'; 
        echo '<option value="0" disabled selected>Choose a Course</option>';        
        foreach($resultCourse as $data)
        {
            echo '<option value='.$data["Course Id"].'>'.$data["Name"].' | (Class : '.$data["Class"].')</option>';
        }
        
        echo '</select>
                                </td>
                                <td style="width=150px;">
                                    <select id="Exam" name="Exam">
                                        <option value="0" selected disabled>Exam Name</option>
                                        <option value="1">Quiz 1</option>
                                        <option value="2">Quiz 2</option>
                                        <option value="3">Quiz 3</option>
                                        <option value="4">Mid Term</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <hr>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <table>
                                        <tr>
                                            <td colspan="2">
                                                <div class="w3-container w3-border">
                                                    <div class="w3-container">
                                                        <table id="myTable" style="width:100%;">';
        if(count($student)==0)
        {
            echo '<tr">
                <td colspan="3" style="width:500px;">No Student Found</td></tr>';
        }
        foreach($student as $std)
        {
            echo '<tr">
                <td style="width:50px;"><img src="'.$std["Photo"].'" class="w3-bar-item w3-circle w3-hide-small" style="width:50px;"><td>
                <td style="width:300px;padding-left:0px;"><div class="w3-bar-item">
                    <span class="w3-large">'.$std["Std_Name"].'</span><br>
                    <span>ID : '.$std["Std_id"].'</span>
                </div></td>
                <td style="width:100px;"><div>
                    <input type="number" name="'.$std["Std_id"].'" placeholder="Marks"></div></td></tr>';
        }
                                                        echo '</table>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                </td>
                                <td style="flaot:right;">
                                    <input type="submit" onclick="return Check()" class="w3-button w3-blue" value="Upload Grades">
                                </td>
                                <td>
                                </td>
                            </tr>

                        </table>
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
        
        function updateBatch(element)
        {
            var ClassValue = element.value;
            var BatchValue = document.getElementById("Batch").value;
            if(BatchValue!=0)
            {
                window.location = "Teacher_Grade_Class.php?Class="+ClassValue+"&Batch="+BatchValue;;
            }
            else
            {
                window.location = "Teacher_Grade_Class.php?Class="+ClassValue;
            }
            
        }
        
        function updateClass(element)
        {
            var BatchValue = element.value;
            var ClassValue = document.getElementById("Class").value;
            if(BatchValue!=0)
            {
                window.location = "Teacher_Grade_Class.php?Class="+ClassValue+"&Batch="+BatchValue;;
            }
            else
            {
                window.location = "Teacher_Grade_Class.php?Batch="+BatchValue;
            }
        }
        function  Check()
        {
            var class_id = document.getElementById("Class");
            var batch_id = document.getElementById("Batch");
            var course_id = document.getElementById("Course");
            var exam_id = document.getElementById("Exam");
            if(class_id.value == 0)
            {
                return false;
            }
            else if(batch_id.value == 0)
            {
                return false;
            }
            else if(course_id.value == 0)
            {
                return false;
            }
            else if(exam_id.value == 0)
            {
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

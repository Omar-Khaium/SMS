<?php
require("Database.php");
session_start();
    if(isset($_SESSION["flag"]) && $_SESSION["flag"]=="success"){
        
        $sql = "select * from Slot;";
        $resultSlot = getDataFromDB($sql);
        
        $sql = "select * from tcr_profile;";
        $resultTeacher = getDataFromDB($sql);
        
        $sql = "select * from batch;";
        $resultBatch = getDataFromDB($sql);
        
        $sql = "select * from course;";
        $resultCourse = getDataFromDB($sql);
        if(isset($_SESSION['crs_id']))
        {
            $sql = "SELECT * FROM course where `Course Id`='".$_SESSION["crs_id"]."';";
            $resultInfo = getDataFromDB($sql);
            echo "Found";
        }
        
    echo '<!DOCTYPE html>
<html>
<title>Delete Course</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    td {
        padding: 5px 35px;
        width: 100%;
    }

    table.card {
        border: .5px solid gray;
        width: 100%;
    }

    table.card td {
        padding: 10px 50px;
        width: 100%;
        margin: 50px;
    }

    body {
        background-color: whitesmoke;
    }

    a {
        color: deepskyblue;
        text-decoration: none;
    }


    hr {
        border: 0.5px solid gray;
        margin-top: auto;
    }
    input {
        width: 100%;
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
    <table style="margin-top: 5%;width:100%;">
        <form action="delete_Course.php" method="post">
        <div class="w3-container w3-card w3-content w3-border-left" style="width:100%;">
            <tr>
                <td class="w3-cell-top" style="padding: 1% 15%;width:100%">
                <div>
                    <input style="margin: 0 auto;width:25%;" name="search" id="search" onkeyup="showData(this)" class="w3-input w3-border w3-round" type="text" placeholder="Enter a Course ID to search">
                </div>'; 
        if(isset($_REQUEST["error"]))
        {
            switch($_REQUEST["error"])
            {
                case "input_error":                    
                    echo '<div align="center">
                        <h6 id="msg" style="color:orangered;">*Fill all the fields correctly</h6>
                    </div>';
                    break;
                case "Successfull":                    
                    echo '<div align="center">
                        <h6 id="msg" style="color:limegreen;">*Course Deleted Successfully</h6>
                    </div>';
                    break;
                case "Failed":                    
                    echo '<div align="center">
                        <h6 id="msg" style="color:orangered;">*Course Deletion Failed</h6>
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
                    <div class="w3-container w3-red">
                        <h4>Delete Course</h4>
                    </div>
                    <table class="profile" style="border:1px solid grey;width:100%;">
                        <tr>
                            <td colspan="3">
                            <select onchange="getData()" class="w3-select w3-border w3-round" name="course" id="course">
                                    <option value="0" disabled selected>Choose a Course</option>';        
        foreach($resultCourse as $data)
        {
            echo '<option value='.$data["Course Id"].'>'.$data["Name"].' (Class : '.$data["Class"].' | Batch : '.$data["Batch Id"].')</option>';
        }
        
        echo '</select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3"><hr>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:5%;">ID</td>
                            <td style="width:2%;">:</td>
                            <td style="width:50%;"><input type="text" id="course_id" name="course_id" class="w3-input w3-border w3-round" style="width:100%;" readonly></td>
                        </tr>
                        <tr>
                            <td style="width:5%;">Name</td>
                            <td style="width:2%;">:</td>
                            <td style="width:50%;"><input type="text" id="course_name" name="course_name" class="w3-input w3-border w3-round" style="width:100%;" placeholder="Enter ther Course Name Here."></td>
                        </tr>
                        <tr>
                            <td style="width:5%;">Class</td>
                            <td style="width:2%;">:</td>
                            <td style="width:50%;">
                            <select class="w3-select w3-border w3-round" name="course_class" id="course_class">
                                    <option value="0" disabled selected>Choose a Class</option>
                                    <option value="6">Class 06</option>
                                    <option value="7">Class 07</option>
                                    <option value="8">Class 08</option>
                                    <option value="9">Class 09</option>
                                    <option value="10">Class 10</option>                                  
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:5%;">Batch</td>
                            <td style="width:2%;">:</td>
                            <td style="width:50%;">
                            <select class="w3-select w3-border w3-round" name="course_batch" id="course_batch">
                                    <option value="0" disabled selected>Choose a batch</option>';        
        foreach($resultBatch as $data)
        {
            echo '<option value='.$data["Batch ID"].'>'.$data["BatchName"].'</option>';
        }
        
        echo '</select>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:5%;">Teacher</td>
                            <td style="width:2%;">:</td>
                            <td style="width:50%;">
                            <select class="w3-select w3-border w3-round" name="course_teacher" id="course_teacher">
                                    <option value="0" disabled selected>Choose a Teacher</option>';        
        foreach($resultTeacher as $data)
        {
            echo '<option value='.$data["Id"].'>'.$data["Name"].'</option>';
        }
        
        echo '</select>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:5%;">Time</td>
                            <td style="width:2%;">:</td>
                            <td style="width:50%;">
                            <select class="w3-select w3-border w3-round" name="course_time" id="course_time">
                                    <option value="0" disabled selected>Choose a Time</option>';        
        foreach($resultSlot as $data)
        {
            echo '<option value='.$data["Serial"].'>'.$data["Day"].'('.$data["Time"].')</option>';
        }
        
        echo '</select>
                            </td>
                        </tr>
                        <tr>
                            <td align="center" onclick="return check()" colspan="3" style="width:100%;"><input type="submit" id="batch_submit" name="batch_submit" class="w3-input w3-border w3-round w3-red" style="width:100%;" value="Delete">
                            </td>
                        </tr>
                    </table>
            </tr>
        </div>
        </form>
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
    <script>
        function getData() {
            
            var id = document.getElementById("course").value;
            var url = "serverCourse.php?id="+id;
        
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                
                var record = JSON.parse(this.responseText);
                document.getElementById("course_id").value = record[0]["Course Id"];
                document.getElementById("course_name").value = record[0]["Name"];
                document.getElementById("course_class").value=record[0]["Class"];
                document.getElementById("course_batch").value=record[0]["Batch Id"];
                document.getElementById("course_teacher").value=record[0]["Teacher Id"];
                document.getElementById("course_time").value=record[0]["Slot"];
            }
            };
            xhttp.open("GET", url, true);
            xhttp.send();
        }
        function check()
        {
            var flag = false;
            var id = document.getElementById("course_id").value.length;
            var name = document.getElementById("course_name").value.length;
            var Class = document.getElementById("course_class").value;
            var batch = document.getElementById("course_batch").value;
            var teacher = document.getElementById("course_teacher").value;
            var time = document.getElementById("course_time").value;
            if(id==0)
            {
                document.getElementById("msg").innerHTML = "*Choose a Class to Generate ID";
                document.getElementById("msg").style.color = "red";
                flag = false;
            }
            else if(name==0)
            {
                document.getElementById("msg").innerHTML = "*Name cannot be empty";
                document.getElementById("msg").style.color = "red";
                flag = false;
            }
            else if(Class==0)
            {
                document.getElementById("msg").innerHTML = "*Choose a Class";
                document.getElementById("msg").style.color = "red";
                flag = false;
            }
            else if(batch==0)
            {
                document.getElementById("msg").innerHTML = "*Choose a Batch";
                document.getElementById("msg").style.color = "red";
                flag = false;
            }
            else if(teacher==0)
            {
                document.getElementById("msg").innerHTML = "*Choose a Teacher";
                document.getElementById("msg").style.color = "red";
                flag = false;
            }
            else if(time==0)
            {
                document.getElementById("msg").innerHTML = "*Choose a Time";
                document.getElementById("msg").style.color = "red";
                flag = false;
            }
            else
            {
                if(confirm("Are you sure ???"))
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
            return flag;
        }
    
    </script>
    <script>
        function showData(element) {

        var id = element.value;
        var url = "serverCourse.php?id=" + id;

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var record = JSON.parse(this.responseText);
                if (record.length > 0) {
                    document.getElementById("course_id").value = record[0]["Course Id"];
                    document.getElementById("course_name").value = record[0]["Name"];
                    document.getElementById("course_class").value=record[0]["Class"];
                    document.getElementById("course_batch").value=record[0]["Batch Id"];
                    document.getElementById("course_teacher").value=record[0]["Teacher Id"];
                    document.getElementById("course_time").value=record[0]["Slot"];
                } else {

                    document.getElementById("course_id").value = "";
                    document.getElementById("course_name").value = "";
                    document.getElementById("course_class").value=0;
                    document.getElementById("course_batch").value=0;
                    document.getElementById("course_teacher").value=0;
                    document.getElementById("course_time").value=0;
                    document.getElementById("course").options[0].selected = true;
                }
            }
        };
        xhttp.open("GET", url, true);
        xhttp.send();
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

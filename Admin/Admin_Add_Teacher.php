<?php
require("Database.php");
session_start();
    if(isset($_SESSION["flag"]) && $_SESSION["flag"]=="success"){
        $sql = "select * from batch;";
        $result = getDataFromDB($sql);
        if(isset($_SESSION["tcr_id"]))
        {
            $sql = "select * from tcr_profile where Id='".$_SESSION["tcr_id"]."';";
            $resultTCR = getDataFromDB($sql);
        }
        
    echo '<!DOCTYPE html>
<html>
<title>Add Teacher</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style.css">
<style>
    td {
        padding: 1px 25px;
    }

    body {
        background-color: whitesmoke;
    }

    table.profile td {
        width: 100%;
    }

    img {
        margin-top: 2.5%;
        padding-right: 2.5%;
    }

    hr {
        border: 0.5px solid gray;
        margin-top: auto;
    }

    table.profile td {
        width: 400px;
        height: 30px;
    }

    input[type=button],input[type=submit] {
        background-color: lightblue;
        color: white;
        margin-top: 10px;
        border-radius: 5px;
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
    <table style="margin-top: 5%;margin-left: 5%;width:90%;">
        <form name="myForm" action="check_tcr.php" method="post" enctype="multipart/form-data">        
        <div class="w3-container w3-card w3-content w3-border-left" style="max-width:250px">
            <tr>
                <!-------------------------Routine start------------------------------->
                <td class="w3-cell-top" style="margin: 0 auto;">'; 
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
                        <h6 id="msg" style="color:limegreen;">*Teacher Inserted Successfully</h6>
                    </div>';
                    break;
                case "Failed":                    
                    echo '<div align="center">
                        <h6 id="msg" style="color:orangered;">*Teacher Insertion Failed</h6>
                    </div>';
                    break;
                case 1:                    
                    echo '<div align="center">
                        <h6 id="msg" style="color:orangered;">*Uploaded file is not Image</h6>
                    </div>';
                    break;
                case 2:                    
                    echo '<div align="center">
                        <h6 id="msg" style="color:orangered;">*Uploaded image is already exists</h6>
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
                    <div class="w3-container w3-blue">
                        <h4>Add Teacher</h4>
                    </div>
                    <table class="profile" style="border:1px solid grey;">
                        <tr>
                            <td style="width:20%;">
                                ID
                            </td>
                            <td style="width:10%;">
                                :
                            </td>
                            <td style="width:100%;">'; 
        if(isset($_SESSION["tcr_id"]))
        {
            echo '<input name="teacher_id" id="teacher_id" class="w3-input w3-border w3-round" type="text" value='.$resultTCR[0]["Id"].' readonly>';
        }
        else
        {
            echo'<input name="teacher_id" id="teacher_id" class="w3-input w3-border w3-round" type="text" readonly>';
        }
                            echo '</td>
                            <td rowspan="6" style="padding-left:.5%;width:50%;">
                                <div class="w3-card-1">'; 
        if(isset($_SESSION["tcr_id"]))
        {
            echo '<img src='.$resultTCR[0]["Photo"].' alt="Profile Picture" style="width:100px;height:100px;" name="profile_picture">';
        }
        else
        {
            echo'
                                    <img src="../images/img_avatar3.png" alt="Profile Picture" style="width:100px;height:100px;" name="profile_picture">';
        }
            echo '<br><br>
                                    
                                    <input type="file" style="width:100px;" name="photoUpload" id="photoUpload">                                    
                                    
                                    <input type="submit" onclick="return check()" class="w3-button w3-green" style="width: 100px;" name="submit" value="Submit">
                                    <br>
                                    <button type="button" id="cmd">Generate PDF</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:20%;">
                                Password
                            </td>
                            <td style="width:10%;">
                                :
                            </td>
                            <td style="width:100%;">
                                <input class="w3-input w3-border w3-round" type="text" name="teacher_password" id="teacher_password" onkeyup="validation(this)">
                            </td>
                        </tr>
                        <tr>
                            <td style="width:20%;">
                                Name
                            </td>
                            <td style="width:10%;">
                                :
                            </td>
                            <td style="width:100%;">'; 
        if(isset($_SESSION["tcr_id"]))
        {
            echo '
                                <input class="w3-input w3-border w3-round" type="text" name="teacher_name" id="teacher_name" onkeyup="validation(this)" value='.$resultTCR[0]["Name"].'>';
        }
        else
        {
            echo'   <input class="w3-input w3-border w3-round" type="text" name="teacher_name" id="teacher_name" onkeyup="validation(this)">';
        }
            echo '
                            </td>
                        </tr>
                        <tr>
                            <td style="width:20%;">
                                Email
                            </td>
                            <td style="width:10%;">
                                :
                            </td>
                            <td style="width:100%;">'; 
        if(isset($_SESSION["tcr_id"]))
        {
            echo '
                                <input class="w3-input w3-border w3-round" type="email" name="teacher_email" id="teacher_email" onkeyup="validation(this)" value='.$resultTCR[0]["Email"].'>';
        }
        else
        {
            echo'   <input class="w3-input w3-border w3-round" type="email" name="teacher_email" id="teacher_email" onkeyup="validation(this)">';
        }
            echo '
                            </td>
                        </tr>
                        <tr>
                        <td style="width:20%;">
                        Mobile
                        </td>
                        <td style="width:10%;">
                        :
                        </td>
                        <td style="width:100%;">'; 
                        if(isset($_SESSION["tcr_id"])) 
                        {
                            echo '<input class="w3-input w3-border w3-round" type="text" name="teacher_mobile" id="teacher_mobile" onkeyup="validation(this)" value='.$resultTCR[0]["Mobile"].'>';
                        }
                        else
                        {
                            echo' <input class="w3-input w3-border w3-round" type="text" name="teacher_mobile" id="teacher_mobile" onkeyup="validation(this)">';
                        } echo '
                        </td>
                        </tr>
                        <tr>
                            <td style="width:20%;">
                                Designation
                            </td>
                            <td style="width:10%;">
                                :
                            </td>
                            <td style="width:25%;">'; 
        if(isset($_SESSION["tcr_id"]))
        {
            echo '
                                <select class="w3-select w3-border w3-round"  name="teacher_designation"  id="teacher_designation">
                                
                                    <option value="0" disabled selected>Choose a Designation</option>';
                                    switch($resultTCR[0]["Designation"])
                                    {
                                        case 1:
                                            echo '<option value="1" selected>Senior Teacher</option>
                                            <option value="2">Junior Teacher</option>
                                            <option value="3">Part-time Teacher</option>
                                            <option value="4">Guest Teacher</option>
                                            </select>';
                                            break;
                                        case 2:
                                            echo '<option value="1" selected>Senior Teacher</option>
                                            <option value="2" selected>Junior Teacher</option>
                                            <option value="3">Part-time Teacher</option>
                                            <option value="4">Guest Teacher</option>
                                            </select>';
                                            break;
                                        case 3:
                                            echo '<option value="1" selected>Senior Teacher</option>
                                            <option value="2">Junior Teacher</option>
                                            <option value="3" selected>Part-time Teacher</option>
                                            <option value="4">Guest Teacher</option>
                                            </select>';
                                            break;
                                        case 4:
                                            echo '<option value="1" selected>Senior Teacher</option>
                                            <option value="2">Junior Teacher</option>
                                            <option value="3">Part-time Teacher</option>
                                            <option value="4" selected>Guest Teacher</option>
                                            </select>';
                                            break;
                                    }
                                    
        }
        else
        {
        echo'                   <select class="w3-select w3-border w3-round"  name="teacher_designation"  id="teacher_designation">
                                    <option value="0" disabled selected>Choose a Designation</option>
                                    <option value="1">Senior Teacher</option>
                                    <option value="2">Junior Teacher</option>
                                    <option value="3">Part-time Teacher</option>
                                    <option value="4">Guest Teacher</option>
                                </select>';
        }
            echo '
                            </td>
                        </tr>
                        <tr>
                            <td style="width:20%;">
                                Department
                            </td>
                            <td style="width:10%;">
                                :
                            </td>
                            <td style="width:25%;">'; 
                            if(isset($_SESSION["tcr_id"]))
                            {
                                echo '
                                <select onchange="getData()" class="w3-select w3-border w3-round"  name="teacher_department" id="teacher_department">'; 
                                echo '<option value="0" disabled selected>Choose a Department</option>';        
                                
                                switch($resultTCR[0]["Department"])
                                    {
                                        case 1:
                                            echo '<option value="1" selected>Bangla</option>
                                            <option value="2">English</option>
                                            <option value="3">Mathematics</option>
                                            <option value="4">Science</option>
                                            <option value="5">Commerce</option>
                                            <option value="6">Arts</option>
                                            </select>';
                                            break;
                                        case 2:
                                            echo '<option value="1">Bangla</option>
                                            <option value="2" selected>English</option>
                                            <option value="3">Mathematics</option>
                                            <option value="4">Science</option>
                                            <option value="5">Commerce</option>
                                            <option value="6">Arts</option>
                                            </select>';
                                            break;
                                        case 3:
                                            echo '<option value="1" selected>Bangla</option>
                                            <option value="2">English</option>
                                            <option value="3" selected>Mathematics</option>
                                            <option value="4">Science</option>
                                            <option value="5">Commerce</option>
                                            <option value="6">Arts</option>
                                            </select>';
                                            break;
                                        case 4:
                                            echo '<option value="1" selected>Bangla</option>
                                            <option value="2">English</option>
                                            <option value="3">Mathematics</option>
                                            <option value="4" selected>Science</option>
                                            <option value="5">Commerce</option>
                                            <option value="6">Arts</option>
                                            </select>';
                                            break;
                                        case 5:
                                            echo '<option value="1" selected>Bangla</option>
                                            <option value="2">English</option>
                                            <option value="3">Mathematics</option>
                                            <option value="4">Science</option>
                                            <option value="5" selected>Commerce</option>
                                            <option value="6">Arts</option>
                                            </select>';
                                            break;
                                        case 6:
                                            echo '<option value="1" selected>Bangla</option>
                                            <option value="2">English</option>
                                            <option value="3">Mathematics</option>
                                            <option value="4">Science</option>
                                            <option value="5">Commerce</option>
                                            <option value="6" selected>Arts</option>
                                            </select>';
                                            break;
                                    }
                            }
                            else
                            {
                                echo '
                                <select onchange="getData()" class="w3-select w3-border w3-round"  name="teacher_department" id="teacher_department">
                                <option value="0" disabled selected>Choose a Department</option>
                                <option value="1">Bangla</option>
                                <option value="2">English</option>
                                <option value="3">Mathematics</option>
                                <option value="4">Science</option>
                                <option value="5">Commerce</option>
                                <option value="6">Arts</option>';
                            }
                                echo '</select>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:20%;">
                                Salary
                            </td>
                            <td style="width:10%;">
                                :
                            </td>
                            <td style="width:100%;">'; 
        if(isset($_SESSION["tcr_id"]))
        {
            echo '
                                <input class="w3-input w3-border w3-round" type="number" name="teacher_salary" id="teacher_salary" onkeyup="validation(this)" value='.$resultTCR[0]["Salary"].'>';
        }
        else
        {
            echo'   <input class="w3-input w3-border w3-round" type="text" name="teacher_salary" id="teacher_salary" onkeyup="validation(this)">';
        }
            echo '
                            </td>
                        </tr>
                        <tr>
                            <td style="width:20%;">
                                DOB
                            </td>
                            <td style="width:10%;">
                                :
                            </td>
                            <td style="width:25%;">'; 
                            if(isset($_SESSION["tcr_id"]))
                            {
                                echo '
                                <input name="teacher_dob" id="teacher_dob" class="w3-input w3-border w3-round" type="date" max="01-01-2012" value='.$resultTCR[0]["DOB"].'>';
                            }
                            else
                            {
                                echo'<input name="teacher_dob" id="teacher_dob" class="w3-input w3-border w3-round" type="date" max="01-01-2012">';
                            }
                            echo '
                            </td>
                        </tr>
                        <tr>
                            <td style="width:20%;">
                                Blood Group
                            </td>
                            <td style="width:10%;">
                                :
                            </td>
                            <td style="width:25%;">'; 
                            if(isset($_SESSION["tcr_id"]))
                            {
                                echo '<select class="w3-select w3-border w3-round" name="blood_group" id="blood_group">
                                    <option value="0" disabled selected>Choose a Blood Group</option>';
                                switch($resultTCR[0]["Blood group"])
                                {
                                    case 1:
                                        echo '<option value="1" selected>A positive</option>
                                        <option value="2">A negetive</option>
                                        <option value="3">B positive</option>
                                        <option value="4">B negetive</option>
                                        <option value="5">AB positive</option>
                                        <option value="6">AB negetive</option>
                                        <option value="7">O positive</option>
                                        <option value="8">O negetive</option>
                                        </select>';
                                        break;
                                    case 2:
                                        echo '<option value="1">A positive</option>
                                        <option value="2" selected>A negetive</option>
                                        <option value="3">B positive</option>
                                        <option value="4">B negetive</option>
                                        <option value="5">AB positive</option>
                                        <option value="6">AB negetive</option>
                                        <option value="7">O positive</option>
                                        <option value="8">O negetive</option>
                                        </select>';
                                        break;
                                    case 3:
                                        echo '<option value="1">A positive</option>
                                        <option value="2">A negetive</option>
                                        <option value="3" selected>B positive</option>
                                        <option value="4">B negetive</option>
                                        <option value="5">AB positive</option>
                                        <option value="6">AB negetive</option>
                                        <option value="7">O positive</option>
                                        <option value="8">O negetive</option>
                                        </select>';
                                        break;
                                    case 4:
                                        echo '<option value="1">A positive</option>
                                        <option value="2">A negetive</option>
                                        <option value="3">B positive</option>
                                        <option value="4" selected>B negetive</option>
                                        <option value="5">AB positive</option>
                                        <option value="6">AB negetive</option>
                                        <option value="7">O positive</option>
                                        <option value="8">O negetive</option>
                                        </select>';
                                        break;
                                    case 5:
                                        echo '<option value="1">A positive</option>
                                        <option value="2">A negetive</option>
                                        <option value="3">B positive</option>
                                        <option value="4">B negetive</option>
                                        <option value="5" selected>AB positive</option>
                                        <option value="6">AB negetive</option>
                                        <option value="7">O positive</option>
                                        <option value="8">O negetive</option>
                                        </select>';
                                        break;
                                    case 6:
                                        echo '<option value="1">A positive</option>
                                        <option value="2">A negetive</option>
                                        <option value="3">B positive</option>
                                        <option value="4">B negetive</option>
                                        <option value="5">AB positive</option>
                                        <option value="6" selected>AB negetive</option>
                                        <option value="7">O positive</option>
                                        <option value="8">O negetive</option>
                                        </select>';
                                        break;
                                    case 7:
                                        echo '<option value="1">A positive</option>
                                        <option value="2">A negetive</option>
                                        <option value="3">B positive</option>
                                        <option value="4">B negetive</option>
                                        <option value="5">AB positive</option>
                                        <option value="6">AB negetive</option>
                                        <option value="7" selected>O positive</option>
                                        <option value="8">O negetive</option>
                                        </select>';
                                        break;
                                    case 8:
                                        echo '<option value="1">A positive</option>
                                        <option value="2">A negetive</option>
                                        <option value="3">B positive</option>
                                        <option value="4">B negetive</option>
                                        <option value="5">AB positive</option>
                                        <option value="6">AB negetive</option>
                                        <option value="7">O positive</option>
                                        <option value="8" selected>O negetive</option>
                                        </select>';
                                        break;                                        
                            }
                            }
                            else
                            {
                                echo'
                                <select class="w3-select w3-border w3-round" name="blood_group" id="blood_group">
                                    <option value="0" disabled selected>Choose a Blood Group</option>
                                    <option value="1">A positive</option>
                                    <option value="2">A negetive</option>
                                    <option value="3">B positive</option>
                                    <option value="4">B negetive</option>
                                    <option value="5">AB positive</option>
                                    <option value="6">AB negetive</option>
                                    <option value="7">O positive</option>
                                    <option value="8">O negetive</option>
                                </select>';
                            }
                            echo '
                            </td>
                        </tr>
                        <tr>
                            <td style="width:20%;">
                                Gender
                            </td>
                            <td style="width:10%;">
                                :
                            </td>
                            <td style="width:25%;">'; 
                            if(isset($_SESSION["tcr_id"]))
                            {
                                if($resultTCR[0]["Gender"]=="male")
                                {
                                    echo '<input class="w3-radio" type="radio" name="gender" value="male" checked>
                                    <label>Male</label>

                                    <input class="w3-radio" type="radio" name="gender" value="female">
                                    <label>Female</label>';
                                }
                                else
                                {
                                    
                                    echo '<input class="w3-radio" type="radio" name="gender" value="male">
                                    <label>Male</label>

                                    <input class="w3-radio" type="radio" name="gender" value="female" checked>
                                    <label>Female</label>';
                                }
                            }
                            else
                            {
                                echo '
                                <input class="w3-radio" type="radio" name="gender" value="male" checked>
                                <label>Male</label>

                                <input class="w3-radio" type="radio" name="gender" value="female">
                                <label>Female</label>';
                            }
                            echo '
                            </td>
                        </tr>
                        <tr>
                            <td style="width:20%;">
                                Religion
                            </td>
                            <td style="width:10%;">
                                :
                            </td>
                            <td style="width:25%;">'; 
                            if(isset($_SESSION["tcr_id"]))
                            {
                                echo '
                                <select class="w3-select w3-border w3-round" name="religion" id="religion">
                                    <option value="0" disabled selected>Choose a Religion</option>';
                                switch($resultTCR[0]["Religion"])
                                {
                                    case 1:
                                        echo '
                                        <option value="1" selected> Islam</option>
                                        <option value="2"> Hindu</option>
                                        <option value="3"> Buddhist</option>
                                        <option value="4"> Christian</option>
                                        </select>';
                                        break;
                                    case 2:
                                        echo '
                                        <option value="1"> Islam</option>
                                        <option value="2" selected> Hindu</option>
                                        <option value="3"> Buddhist</option>
                                        <option value="4"> Christian</option>
                                        </select>';
                                        break;
                                    case 3:
                                        echo '
                                        <option value="1"> Islam</option>
                                        <option value="2"> Hindu</option>
                                        <option value="3" selected> Buddhist</option>
                                        <option value="4"> Christian</option>
                                        </select>';
                                        break;
                                    case 4:
                                        echo '
                                        <option value="1"> Islam</option>
                                        <option value="2"> Hindu</option>
                                        <option value="3"> Buddhist</option>
                                        <option value="4" selected> Christian</option>
                                        </select>';
                                        break;
                                }
                            }
                            else
                            {
                                echo '
                                <select class="w3-select w3-border w3-round" name="religion" id="religion">
                                    <option value="0" disabled selected>Choose a Religion</option>
                                    <option value="1"> Islam</option>
                                    <option value="2"> Hindu</option>
                                    <option value="3"> Buddhist</option>
                                    <option value="4"> Christian</option>
                                </select>';
                            }
                                echo '
                            </td>
                        </tr>
                        <tr>
                            <td style="width:20%;">
                                Current Balance
                            </td>
                            <td style="width:10%;">
                                :
                            </td>
                            <td style="width:25%">'; 
                            if(isset($_SESSION["tcr_id"]))
                            {
                                echo '
                                <input class="w3-input w3-border w3-round" type="number" id="teacher_ballance" name="teacher_ballance" value='.$resultTCR[0]["Current Balance"].'>';
                            }
                            else
                            {
                                echo '<input class="w3-input w3-border w3-round" type="number" id="teacher_ballance" name="teacher_ballance">';
                            }
                            echo '
                            </td>
                        </tr>
                        <tr>
                            <td style="width:20%;">
                                Address
                            </td>
                            <td style="width:10%;">
                                :
                            </td>
                            <td style="width:25%">'; 
                            if(isset($_SESSION["tcr_id"]))
                            {
                                echo '
                                <input class="w3-input w3-border w3-round" type="text" name="teacher_address" id="teacher_address" value='.$resultTCR[0]["Address"].'>';
                                unset($_SESSION['tcr_id']);
                            }
                            else
                            {
                                echo '<input class="w3-input w3-border w3-round" type="text" name="teacher_address" id="teacher_address">';
                            }
                            echo '
                            </td>
                        </tr>
                    </table>
                    <div id="content" hidden>
                        <h1 id="save_id"></h1>
                        <h1 id="save_password"></h1>
                    </div>
                    <div id="editor"></div>
                    <!--Add External Libraries - JQuery and jspdf 
                    check out url - https://scotch.io/@nagasaiaytha/generate-pdf-from-html-using-jquery-and-jspdf
                    -->
                    <script src="https://code.jquery.com/jquery-1.12.3.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/0.9.0rc1/jspdf.min.js"></script>
                </td>
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
            var dept_id = document.getElementById("teacher_department").value;
            var tcrID = "TCR0"+dept_id;
            document.getElementById("teacher_id").value = tcrID;
            
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                tcrID = tcrID + this.responseText;
                document.getElementById("teacher_id").value = tcrID;
                document.getElementById("save_id").innerHTML = "Teacher ID : " + document.getElementById("teacher_id").value;
            }
            };
            var url = "Crud_Action.php?id=2";
            xhttp.open("GET", url, true);
            xhttp.send();
        }
    </script>

    <script>
        function validation(element) {
            switch (element.name) {

                case "teacher_password":
                    var length = element.value.length;
                    if (length < 8) {
                        element.style.color = "red";
                        element.style.border = "1px solid red";
                    } else {
                        element.style.color = "grey";
                        element.style.border = "1px solid lightgrey";
                        document.getElementById("save_password").innerHTML = "Teacher Password : " + document.getElementById("teacher_password").value;
                    }
                    break;

                case "teacher_name":
                    var matches = element.value.match(/\d+/g);
                    if (matches == null) {
                        element.style.color = "grey";
                        element.style.border = "1px solid lightgrey";
                    } else {
                        element.style.color = "red";
                        element.style.border = "1px solid red";
                    }
                    break;

                case "teacher_mobile":
                    var length = element.value.length;
                    if (length < 11) {
                        element.style.color = "red";
                        element.style.border = "1px solid red";
                    } else {
                        element.style.color = "grey";
                        element.style.border = "1px solid lightgrey";
                    }
                    break;

                case "teacher_email":
                    var val = element.value;
                    var atPos = val.indexOf("@");
                    var dotPos = val.indexOf(".");
                    if (atPos < dotPos) {
                        element.style.color = "grey";
                        element.style.border = "1px solid lightgrey";
                    } else {
                        element.style.color = "red";
                        element.style.border = "1px solid red";
                    }
                    break;

                case "teacher_address":
                    var val = element.value.length;
                    if (val > 0) {
                        element.style.color = "grey";
                        element.style.border = "1px solid lightgrey";
                    } else {
                        element.style.color = "red";
                        element.style.border = "1px solid red";
                    }
                    break;

                case "teacher_salary":
                    var val = element.value.length;
                    if (val > 0) {
                        element.style.color = "grey";
                        element.style.border = "1px solid lightgrey";
                    } else {
                        element.style.color = "red";
                        element.style.border = "1px solid red";
                    }
                    break;
            }
        }

    </script>
    <script>
        function check()
        {
            var flag = false;
            var id = document.getElementById("teacher_id").value.length;
            var password = document.getElementById("teacher_password").value.length;
            var name = document.getElementById("teacher_name").value.length;
            var email = document.getElementById("teacher_email").value.length;
            var email2 = document.getElementById("teacher_email").value;
            var mobile = document.getElementById("teacher_mobile").value.length;
            var salary = document.getElementById("teacher_salary").value;
            var department = document.getElementById("teacher_department");
            var designation = document.getElementById("teacher_designation");
            var batch = document.getElementById("teacher_batch");
            var dob = document.getElementById("teacher_dob").value.length;
            var bg = document.getElementById("blood_group");
            var religion = document.getElementById("religion");
            var address = document.getElementById("teacher_address").value.length;
            
            if(id == 0)
            {
                document.getElementById("msg").innerHTML = "*Select a Department to generate ID";
                document.getElementById("msg").style.color = "red";
                return false;
            }
            else if(password <= 7)
            {
                document.getElementById("msg").innerHTML = "*password should be consist of atleast 8 character";
                document.getElementById("msg").style.color = "red";
                return false;
            }
            else if(name == 0)
            {
                document.getElementById("msg").innerHTML = "*Name cannot be empty";
                document.getElementById("msg").style.color = "red";
                return false;
            }
            else if(email == 0)
            {
                document.getElementById("msg").innerHTML = "*Email cannot be empty";
                document.getElementById("msg").style.color = "red";
                return false;
            }
            else if(email2.indexOf("@") > email2.indexOf(".") || email2.indexOf("@") < 0 || email2.indexOf(".") < 0)
            {
                document.getElementById("msg").innerHTML = "*Invalid Email Address";
                document.getElementById("msg").style.color = "red";
                return false;
            }
            else if(mobile < 11)
            {
                document.getElementById("msg").innerHTML = "*Mobile Number should be consist of atleast 11 character";
                document.getElementById("msg").style.color = "red";
                return false;
            }
            else if(department.value==0)
            {
                document.getElementById("msg").innerHTML = "*Choose a Department";
                document.getElementById("msg").style.color = "red";
                return false;
            }
            else if(designation.value==0)
            {
                document.getElementById("msg").innerHTML = "*Choose a Designation";
                document.getElementById("msg").style.color = "red";
                return false;
            }
            else if(salary==0)
            {
                document.getElementById("msg").innerHTML = "*Input Salary properly";
                document.getElementById("msg").style.color = "red";
                return false;
            }
            else if(dob==0)
            {
                document.getElementById("msg").innerHTML = "*Choose a Date of Birth";
                document.getElementById("msg").style.color = "red";
                return false;
            }
            else if(bg.value==0)
            {
                document.getElementById("msg").innerHTML = "*Choose a Blood Group";
                document.getElementById("msg").style.color = "red";
                return false;
            }
            else if(religion.value==0)
            {
                document.getElementById("msg").innerHTML = "*Choose a Religion";
                document.getElementById("msg").style.color = "red";
                return false;
            }
            else if(address==0)
            {
                document.getElementById("msg").innerHTML = "*Choose a proper Contact Address";
                document.getElementById("msg").style.color = "red";
                return false;
            }
            else
            {
                return true;
            }
        }
    </script>
    <script>
        var doc = new jsPDF();
        var specialElementHandlers = {
        "#editor": function (element, renderer) {
            return true;
        }
        };

        $("#cmd").click(function () {   
        doc.fromHTML($("#content").html(), 15, 15, {
            "width": 170,
                "elementHandlers": specialElementHandlers
        });
        doc.save("teacher-credential.pdf");
    });

    </script>

</body>

</html>
';
}
else{
	header("Location: ../index.html?error=access restricted");
}
?>

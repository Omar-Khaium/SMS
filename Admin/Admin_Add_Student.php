<?php
require("Database.php");
session_start();
    if(isset($_SESSION["flag"]) && $_SESSION["flag"]=="success"){
        $sql = "select * from batch;";
        $result = getDataFromDB($sql);
        if(isset($_SESSION["std_id"]))
        {
            $sql = "select * from std_profile where Std_id='".$_SESSION["std_id"]."';";
            $resultSTD = getDataFromDB($sql);
        }
        
    echo '<!DOCTYPE html>
<html>
<title>Add Student</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style.css">
<head>
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
</head>

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
        <form name="myForm" action="check.php" method="post" enctype="multipart/form-data">        
        <div class="w3-container w3-card w3-content w3-border-left" style="max-width:250px">
            <tr>
                <!-------------------------Routine start------------------------------->
                <td class="w3-cell-top" style="margin: 0 auto;">'; 
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
                        <h6 id="msg" style="color:limegreen;">*Student Inserted Successfully</h6>
                    </div>';
                    break;
                case 4:                    
                    echo '<div align="center">
                        <h6 id="msg" style="color:orangered;">*Student Insertion Failed</h6>
                    </div>';
                    break;
                case 5:                    
                    echo '<div align="center">
                        <h6 id="msg" style="color:orangered;">*Database Error</h6>
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
                        <h4>Add Student</h4>
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
        if(isset($_SESSION["std_id"]))
        {
            echo '<input name="student_id" id="student_id" class="w3-input w3-border w3-round" type="text" value='.$resultSTD[0]["Std_id"].' readonly>';
        }
        else
        {
            echo'<input name="student_id" id="student_id" class="w3-input w3-border w3-round" type="text" readonly>';
        }
                            echo '</td>
                            <td rowspan="6" style="padding-left:.5%;width:50%;">
                                <div class="w3-card-1">'; 
        if(isset($_SESSION["std_id"]))
        {
            echo '<img src='.$resultSTD[0]["Photo"].' alt="Profile Picture" style="width:100px;height:100px;" name="profile_picture">';
        }
        else
        {
            echo'
                                    <img src="../images/img_avatar3.png" alt="Profile Picture" style="width:100px;height:100px;" name="profile_picture">';
        }
            echo '<br>
                                    
                                    <input type="file" style="width:100px;" name="photoUpload" id="photoUpload">                                    
                                    
                                    <input type="submit" onclick="return check()" class="w3-button w3-green" style="width: 100px;" name="submit" id="submit" value="Submit">
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
                                <input class="w3-input w3-border w3-round" type="text" name="student_password" id="student_password" onkeyup="validation(this)">
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
        if(isset($_SESSION["std_id"]))
        {
            echo '
                                <input class="w3-input w3-border w3-round" type="text" name="student_name" id="student_name" onkeyup="validation(this)" value='.$resultSTD[0]["Std_Name"].'>';
        }
        else
        {
            echo'   <input class="w3-input w3-border w3-round" type="text" name="student_name" id="student_name" onkeyup="validation(this)">';
        }
            echo '
                            </td>
                        </tr>
                        <tr>
                            <td style="width:20%;">
                                Father Name
                            </td>
                            <td style="width:10%;">
                                :
                            </td>
                            <td style="width:100%;">'; 
        if(isset($_SESSION["std_id"]))
        {
            echo '
                                <input class="w3-input w3-border w3-round" type="text" name="student_father_name" id="student_father_name" onkeyup="validation(this)" value='.$resultSTD[0]["Std_Father_Name"].'>';
        }
        else
        {
            echo'   <input class="w3-input w3-border w3-round" type="text" name="student_father_name" id="student_father_name" onkeyup="validation(this)">';
        }
            echo '
                            </td>
                        </tr>
                        <tr>
                            <td style="width:20%;">
                                Mother Name
                            </td>
                            <td style="width:10%;">
                                :
                            </td>
                            <td style="width:100%;">'; 
        if(isset($_SESSION["std_id"]))
        {
            echo '
                                <input class="w3-input w3-border w3-round" type="text" name="student_mother_name" id="student_mother_name" onkeyup="validation(this)" value='.$resultSTD[0]["Std_Mother_Name"].'>';
        }
        else
        {
            echo'<input class="w3-input w3-border w3-round" type="text" name="student_mother_name" id="student_mother_name" onkeyup="validation(this)">';
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
        if(isset($_SESSION["std_id"]))
        {
            echo '
                                <input class="w3-input w3-border w3-round" type="email" name="student_email" id="student_email" onkeyup="validation(this)" value='.$resultSTD[0]["Email"].'>';
        }
        else
        {
            echo'
            <input class="w3-input w3-border w3-round" type="email" name="student_email" id="student_email" onkeyup="validation(this)">';
        }
            echo '
                            </td>
                        </tr>
                        <tr>
                            <td style="width:20%;">
                                Roll
                            </td>
                            <td style="width:10%;">
                                :
                            </td>
                            <td style="width:25%">'; 
        if(isset($_SESSION["std_id"]))
        {
            echo '
                                <input class="w3-input w3-border w3-round" type="number" name="student_roll" id="student_roll" onkeyup="validation(this)" value='.$resultSTD[0]["Roll"].'>';
        }
        else
        {
            echo'<input class="w3-input w3-border w3-round" type="number" name="student_roll" id="student_roll" onkeyup="validation(this)">';
        }
            echo '
                            </td>
                        </tr>
                        <tr>
                            <td style="width:20%;">
                                Class
                            </td>
                            <td style="width:10%;">
                                :
                            </td>
                            <td style="width:25%;">'; 
        if(isset($_SESSION["std_id"]))
        {
            echo '
                                <select onchange="getData()" class="w3-select w3-border w3-round"  name="student_class"  id="student_class">
                                
                                    <option value="0" disabled selected>Choose a class</option>';
                                    switch($resultSTD[0]["Class"])
                                    {
                                        case 6:
                                            echo '<option value="6" selected>Class 6</option>
                                            <option value="7">Class 7</option>
                                            <option value="8">Class 8</option>
                                            <option value="9">Class 9</option>
                                            <option value="10">Class 10</option>
                                            </select>';
                                            break;
                                        case 7:
                                            echo '<option value="6">Class 6</option>
                                            <option value="7" selected>Class 7</option>
                                            <option value="8">Class 8</option>
                                            <option value="9">Class 9</option>
                                            <option value="10">Class 10</option>
                                            </select>';
                                            break;
                                        case 8:
                                            echo '<option value="6">Class 6</option>
                                            <option value="7">Class 7</option>
                                            <option value="8" selectedClass 8</option>
                                            <option value="9">Class 9</option>
                                            <option value="10">Class 10</option>
                                            </select>';
                                            break;
                                        case 9:
                                            echo '<option value="6">Class 6</option>
                                            <option value="7">Class 7</option>
                                            <option value="8">Class 8</option>
                                            <option value="9" selected>Class 9</option>
                                            <option value="10">Class 10</option>
                                            </select>';
                                            break;
                                        case 10:
                                            echo '<option value="6">Class 6</option>
                                            <option value="7">Class 7</option>
                                            <option value="8">Class 8</option>
                                            <option value="9">Class 9</option>
                                            <option value="10" selected>Class 10</option>
                                            </select>';
                                            break;
                                    }
                                    
        }
        else
        {
        echo'                   <select onchange="getData()" class="w3-select w3-border w3-round"  name="student_class"  id="student_class">
                                    <option value="0" disabled selected>Choose a class</option>
                                    <option value="6">Class 6</option>
                                    <option value="7">Class 7</option>
                                    <option value="8">Class 8</option>
                                    <option value="9">Class 9</option>
                                    <option value="10">Class 10</option>
                                </select>';
        }
            echo '
                            </td>
                        </tr>
                        <tr>
                            <td style="width:20%;">
                                Batch
                            </td>
                            <td style="width:10%;">
                                :
                            </td>
                            <td style="width:25%;">'; 
                            if(isset($_SESSION["std_id"]))
                            {
                                echo '
                                <select class="w3-select w3-border w3-round"  name="student_batch" id="student_batch">'; 
                                echo '<option value="0" disabled selected>Choose a Batch</option>';        
                                
                                foreach($result as $data)
                                {
                                    if($resultSTD[0]["Batch"]==$data["Batch ID"]){
                                    echo '<option value='.$data["Batch ID"].' selected>'.$data["BatchName"].'</option>';}
                                    else
                                    {
                                        echo '<option value='.$data["Batch ID"].'>'.$data["BatchName"].'</option>';
                                    }
                                }
                            }
                            else
                            {
                                echo '
                                <select class="w3-select w3-border w3-round"  name="student_batch" id="student_batch">'; 
                                echo '<option value="0" disabled selected>Choose a Batch</option>';        
                                foreach($result as $data)
                                {
                                    echo '<option value='.$data["Batch ID"].'>'.$data["BatchName"].'</option>';
                                }
                            }

                                echo '</select>
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
                            if(isset($_SESSION["std_id"]))
                            {
                                echo '
                                <input name="student_dob" id="student_dob" class="w3-input w3-border w3-round" type="date" max="01-01-2012" value='.$resultSTD[0]["DOB"].'>';
                            }
                            else
                            {
                                echo'<input name="student_dob" id="student_dob" class="w3-input w3-border w3-round" type="date" max="01-01-2012">';
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
                            if(isset($_SESSION["std_id"]))
                            {
                                echo '<select class="w3-select w3-border w3-round" name="blood_group" id="blood_group">
                                    <option value="0" disabled selected>Choose a Blood Group</option>';
                                switch($resultSTD[0]["BG"])
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
                            if(isset($_SESSION["std_id"]))
                            {
                                if($resultSTD[0]["Gender"]=="male")
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
                            if(isset($_SESSION["std_id"]))
                            {
                                echo '
                                <select class="w3-select w3-border w3-round" name="religion" id="religion">
                                    <option value="0" disabled selected>Choose a Religion</option>';
                                switch($resultSTD[0]["Religion"])
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
                            if(isset($_SESSION["std_id"]))
                            {
                                echo '
                                <input class="w3-input w3-border w3-round" type="number" id="student_ballance" name="student_ballance" value='.$resultSTD[0]["Current Balance"].'>';
                            }
                            else
                            {
                                echo '<input class="w3-input w3-border w3-round" type="number" id="student_ballance" name="student_ballance">';
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
                            if(isset($_SESSION["std_id"]))
                            {
                                echo '
                                <input class="w3-input w3-border w3-round" type="text" name="student_address" id="student_address" value='.$resultSTD[0]["Address"].'>';
                                unset($_SESSION['std_id']);
                            }
                            else
                            {
                                echo '<input class="w3-input w3-border w3-round" type="text" name="student_address" id="student_address">';
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
            var class_id = document.getElementById("student_class").value;
            if(class_id<10)
            {var stdID = "STD0"+class_id;}
            else{var stdID = "STD"+class_id;}
            document.getElementById("student_id").value = stdID;
            
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                stdID = stdID + this.responseText;
                document.getElementById("student_id").value = stdID;
                document.getElementById("save_id").innerHTML = "Student ID : " + document.getElementById("student_id").value;
            }
            };
            var url = "Crud_Action.php?id=1";
            xhttp.open("GET", url, true);
            xhttp.send();
        }
    </script>

    <script>
        function validation(element) {
            switch (element.name) {

                case "student_password":
                    var length = element.value.length;
                    if (length < 8) {
                        element.style.color = "red";
                        element.style.border = "1px solid red";
                    } else {
                        element.style.color = "grey";
                        element.style.border = "1px solid lightgrey";
                         document.getElementById("save_password").innerHTML = "Student Password : " + document.getElementById("student_password").value;
                    }
                    break;

                case "student_name":
                    var matches = element.value.match(/\d+/g);
                    if (matches == null) {
                        element.style.color = "grey";
                        element.style.border = "1px solid lightgrey";
                    } else {
                        element.style.color = "red";
                        element.style.border = "1px solid red";
                    }
                    break;

                case "student_father_name":
                    var matches = element.value.match(/\d+/g);
                    if (matches == null) {
                        element.style.color = "grey";
                        element.style.border = "1px solid lightgrey";
                    } else {
                        element.style.color = "red";
                        element.style.border = "1px solid red";
                    }
                    break;

                case "student_mother_name":
                    var matches = element.value.match(/\d+/g);
                    if (matches == null) {
                        element.style.color = "grey";
                        element.style.border = "1px solid lightgrey";
                    } else {
                        element.style.color = "red";
                        element.style.border = "1px solid red";
                    }
                    break;

                case "student_email":
                    var val = element.value;
                    var atPos = val.indexOf("@");
                    var dotPos = val.indexOf(".");
                    if (atPos < dotPos || atPos > 0 || dotPos > 0) {
                        element.style.color = "grey";
                        element.style.border = "1px solid lightgrey";
                    } else {
                        element.style.color = "red";
                        element.style.border = "1px solid red";
                    }
                    break;

                case "student_balance":
                    var val = element.value.length;
                    if (val != 0) {
                        element.style.color = "grey";
                        element.style.border = "1px solid lightgrey";
                    } else {
                        element.style.color = "red";
                        element.style.border = "1px solid red";
                    }
                    break;

                case "student_address":
                    var val = element.value.length;
                    if (val != 0) {
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
            var id = document.getElementById("student_id").value.length;
            var password = document.getElementById("student_password").value.length;
            var name = document.getElementById("student_name").value.length;
            var father = document.getElementById("student_father_name").value.length;
            var mother = document.getElementById("student_mother_name").value.length;
            var email = document.getElementById("student_email").value.length;
            var email2 = document.getElementById("student_email").value;
            var roll = document.getElementById("student_roll").value;
            var std_class = document.getElementById("student_class");
            var batch = document.getElementById("student_batch");
            var dob = document.getElementById("student_dob").value.length;
            var bg = document.getElementById("blood_group");
            var religion = document.getElementById("religion");
            var address = document.getElementById("student_address").value.length;
            
            if(id == 0)
            {
                document.getElementById("msg").innerHTML = "*Select a Class to generate ID";
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
            else if(father == 0)
            {
                document.getElementById("msg").innerHTML = "*Father Name cannot be empty";
                document.getElementById("msg").style.color = "red";
                return false;
            }
            else if(mother == 0)
            {
                document.getElementById("msg").innerHTML = "*Mother Name cannot be empty";
                document.getElementById("msg").style.color = "red";
                return false;
            }
            else if(email == 0)
            {
                document.getElementById("msg").innerHTML = "*Email cannot be empty";
                document.getElementById("msg").style.color = "red";
                return false;
            }
            else if(email2.indexOf("@") > email2.indexOf("."))
            {
                document.getElementById("msg").innerHTML = "*Invalid Email Address";
                document.getElementById("msg").style.color = "red";
                return false;
            }
            else if(std_class==0)
            {
                document.getElementById("msg").innerHTML = "*Choose a class";
                document.getElementById("msg").style.color = "red";
                return false;
            }
            else if(batch.value==0)
            {
                document.getElementById("msg").innerHTML = "*Choose a Batch";
                document.getElementById("msg").style.color = "red";
                return false;
            }
            else if(roll==0)
            {
                document.getElementById("msg").innerHTML = "*Choose a Roll Number";
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
        doc.save("student-credential.pdf");
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

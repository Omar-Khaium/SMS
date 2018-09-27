<?php
require("Database.php");
session_start();
    if(isset($_SESSION["flag"]) && $_SESSION["flag"]=="success"){
        $sql = "select distinct Batch from std_profile;";
        $result = getDataFromDB($sql);
        $sql = "select * from batch;";
        $resultBatch = getDataFromDB($sql);
        $sql = "select distinct Class from std_profile;";
        $resultClass = getDataFromDB($sql);
        $sql = "select * from std_profile;";
        $resultName = getDataFromDB($sql);
        if(isset($_SESSION["std_id"]))
        {
            $sql = "select * from std_profile where Std_id='".$_SESSION["std_id"]."';";
            $resultSTD = getDataFromDB($sql);
        }
        
    echo '<!DOCTYPE html>
<html>
<title>Edit Student</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
    body {
        background-color: whitesmoke;
    }

    table.profile td {
        width: 80%;
        padding: .5% 2%;
    }

    hr {
        border: 0.5px solid gray;
        margin-top:2px;
    }

    button {
        background-color: lightblue;
        color: black;
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
    <table style="margin: 0 auto;margin-top: 3.5%;width:80%;">
        <form action="edit.php" method="post" enctype="multipart/form-data">
        <div class="w3-container w3-card w3-content w3-border-left" style="max-width:25%;">
            <tr>
                <!-------------------------Routine start------------------------------->
                <td class="w3-cell-top">
                <div>
                    <input style="margin: 0 auto;width:25%;" name="search" id="search" onkeyup="showData(this)" class="w3-input w3-border w3-round" type="text" placeholder="Enter a Student ID to search">
                </div>
                ';
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
                                <h6 id="msg" style="color:limegreen;">*Student Inserted Successfully</h6>
                            </div>';
                            break;
                        case "Failed":                    
                            echo '<div align="center">
                                <h6 id="msg" style="color:orangered;">*Student Insertion Failed</h6>
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
                        <h4>Edit Student</h4>
                    </div>
                    <table class="profile" style="border:1px solid grey;width:100%;">
                        <tr>
                            <td colspan="4">
                                <select style="width:20%;" onchange="updateName(this)" class="w3-select w3-border w3-round" id="Batch" name="Batch">'; 
        echo '<option value="0" disabled selected>Choose a Batch</option>';        
        foreach($resultBatch as $data)
        {
            echo '<option value='.$data["Batch ID"].'>'.$data["BatchName"].'</option>';
        }
        
        echo '</select>
                                <select style="width:20%;margin-left:40px;" onchange="updateName2(this)" class="w3-select w3-border w3-round" id="class" name="class">'; 
        echo '<option value="0" disabled selected>Choose a Class</option>';        
        foreach($resultClass as $data)
        {
            if($data["Class"] < 10)
            {
                echo '<option value='.$data["Class"].'>Class 0'.$data["Class"].'</option>';
            }
            else
            {
                echo '<option value='.$data["Class"].'>Class '.$data["Class"].'</option>';
            }
        }
        
        echo '</select>
                                <select style="width:50%;margin-left:5%;" onchange="getData()" class="w3-select w3-border w3-round" id="Name">'; 
        echo '<option value="0" disabled selected>Choose a Student Name</option>';
        foreach($resultName as $data)
        {
            echo '<option value='.$data["Std_id"].'>'.$data["Std_Name"].'   ( ID: '.$data["Std_id"].' )</option>';
        }
        
        echo '</select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <hr>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:8%;">
                                ID
                            </td>
                            <td style="width:1%;">
                                :
                            </td>
                            <td style="width:60%;">'; 
        if(isset($_SESSION["std_id"]))
        {
            echo '<input name="student_id" id="STD_ID" class="w3-input w3-border w3-round" type="text" value='.$resultSTD[0]["Std_id"].' readonly>';
        }
        else
        {
            echo'<input name="student_id" id="STD_ID" class="w3-input w3-border w3-round" type="text" readonly>';
        }
                            echo '
                            </td>
                            <td rowspan="3" style="margin:0 auto">'; 
        if(isset($_SESSION["std_id"]))
        {
            echo '<img src='.$resultSTD[0]["Photo"].' alt="Profile Picture" style="width:100px;height:100px;"  id="profile_picture" name="profile_picture">';
        }
        else
        {
            echo'
                                    <img src="../images/img_avatar3.png" alt="Profile Picture" style="width:100px;height:100px;" id="profile_picture" name="profile_picture">';
        }
            echo '<br>
                                    <input type="file" style="width:100px;" name="photoUpload" id="photoUpload">  
                            </td>
                        </tr>
                        <tr>
                            <td style="width:8%;">
                                Name
                            </td>
                            <td style="width:1%;">
                                :
                            </td>
                            <td style="width:60%;">'; 
        if(isset($_SESSION["std_id"]))
        {
            echo '
                                <input class="w3-input w3-border w3-round" type="text" name="student_name" id="STD_Name" value='.$resultSTD[0]["Std_Name"].'>';
        }
        else
        {
            echo'   <input class="w3-input w3-border w3-round" type="text" name="student_name" id="STD_Name">';
        }
            echo '
                            </td>
                        </tr>
                        <tr>
                            <td style="width:8%;">
                                Father Name
                            </td>
                            <td style="width:1%;">
                                :
                            </td>
                            <td style="width:60%;">'; 
        if(isset($_SESSION["std_id"]))
        {
            echo '
                                <input class="w3-input w3-border w3-round" type="text" name="student_father_name" id="STD_Father" value='.$resultSTD[0]["Std_Father_Name"].'>';
        }
        else
        {
            echo'   <input class="w3-input w3-border w3-round" type="text" name="student_father_name" id="STD_Father">';
        }
            echo '
                            </td>
                        </tr>
                        <tr>
                            <td style="width:8%;">
                                Mother Name
                            </td>
                            <td style="width:1%;">
                                :
                            </td>
                            <td style="width:60%;">'; 
        if(isset($_SESSION["std_id"]))
        {
            echo '
                                <input class="w3-input w3-border w3-round" type="text" name="student_mother_name" id="STD_Mother" value='.$resultSTD[0]["Std_Mother_Name"].'>';
        }
        else
        {
            echo'<input class="w3-input w3-border w3-round" type="text" name="student_mother_name" id="STD_Mother">';
        }
            echo '
                            </td>
                            <td><input type="submit" onclick="return check()" class="w3-button w3-blue" style="width: 100px;" name="submit" value="Update">
                        </tr>
                        <tr>
                            <td style="width:15%;">
                                Email
                            </td>
                            <td style="width:1%;">
                                :
                            </td>
                            <td style="width:70%;">'; 
        if(isset($_SESSION["std_id"]))
        {
            echo '
                                <input class="w3-input w3-border w3-round" type="email" name="student_email" id="STD_Email" value='.$resultSTD[0]["Email"].'>';
        }
        else
        {
            echo'
            <input class="w3-input w3-border w3-round" type="email" name="student_email" id="STD_Email">';
        }
            echo '
                            </td>
                        </tr>
                        <tr>
                            <td style="width:8%;">
                                Roll
                            </td>
                            <td style="width:1%;">
                                :
                            </td>
                            <td style="width:40%">'; 
        if(isset($_SESSION["std_id"]))
        {
            echo '
                                <input class="w3-input w3-border w3-round" type="number" name="student_roll" id="STD_Roll" value='.$resultSTD[0]["Roll"].'>';
        }
        else
        {
            echo'<input class="w3-input w3-border w3-round" type="number" name="student_roll" id="STD_Roll">';
        }
            echo '
                            </td>
                        </tr>
                        <tr>
                            <td style="width:8%;">
                                Class
                            </td>
                            <td style="width:1%;">
                                :
                            </td>
                            <td style="width:40%;">'; 
        if(isset($_SESSION["std_id"]))
        {
            echo '
                                <select class="w3-select w3-border w3-round"  name="student_class"  id="STD_Class">
                                
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
        echo'                   <select onchange="getData()" class="w3-select w3-border w3-round"  name="student_class"  id="STD_Class">
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
                            <td style="width:8%;">
                                Batch
                            </td>
                            <td style="width:1%;">
                                :
                            </td>
                            <td style="width:40%;">
                                <select class="w3-select w3-border w3-round" id="STD_Batch" name="student_batch">'; 
        echo '<option value="0" disabled selected>Choose a Batch</option>'; 
                            if(isset($_SESSION["std_id"]))
                            {   
                                foreach($resultBatch as $data)
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
                                foreach($resultBatch as $data)
                                {
                                    echo '<option value='.$data["Batch ID"].'>'.$data["BatchName"].'</option>';
                                }
                            }

                                echo '</select>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:8%;">
                                DOB
                            </td>
                            <td style="width:1%;">
                                :
                            </td>
                            <td style="width:40%;">'; 
                            if(isset($_SESSION["std_id"]))
                            {
                                echo '
                                <input name="student_dob" id="STD_DOB" class="w3-input w3-border w3-round" type="date" max="01-01-2012" value='.$resultSTD[0]["DOB"].'>';
                            }
                            else
                            {
                                echo'<input name="student_dob" id="STD_DOB" class="w3-input w3-border w3-round" type="date" max="01-01-2012">';
                            }
                            echo '
                            </td>
                        </tr>
                        <tr>
                            <td style="width:8%;">
                                Blood Group
                            </td>
                            <td style="width:1%;">
                                :
                            </td>
                            <td style="width:40%;">
                                <select class="w3-select w3-border w3-round" id="STD_BG" name="blood_group">
                                    <option value="0" disabled selected>Choose a Blood Group</option>'; 
                            if(isset($_SESSION["std_id"]))
                            {
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
                            <td style="width:8%;">
                                Gender
                            </td>
                            <td style="width:1%;">
                                :
                            </td>
                            <td style="width:40%;">'; 
                            if(isset($_SESSION["std_id"]))
                            {
                                if($resultSTD[0]["Gender"]=="male")
                                {
                                    echo '<input class="w3-radio" type="radio" name="STD_Gender" id="male" value="male" checked>
                                    <label>Male</label>

                                    <input class="w3-radio" type="radio" name="STD_Gender" id="female" value="female">
                                    <label>Female</label>';
                                }
                                else if($resultSTD[0]["Gender"]=="female")
                                {
                                    
                                    echo '<input class="w3-radio" type="radio" name="STD_Gender" id="male" value="male">
                                    <label>Male</label>

                                    <input class="w3-radio" type="radio" name="STD_Gender" id="female" value="female" checked>
                                    <label>Female</label>';
                                }
                            }
                            else
                            {
                                echo '
                                <input class="w3-radio" type="radio" name="STD_Gender" id="male" value="male" checked>
                                <label>Male</label>

                                <input class="w3-radio" type="radio" name="STD_Gender" id="female" value="female">
                                <label>Female</label>';
                            }
                            echo '
                            </td>
                        </tr>
                        <tr>
                            <td style="width:8%;">
                                Religion
                            </td>
                            <td style="width:1%;">
                                :
                            </td>
                            <td style="width:40%;">
                                <select class="w3-select w3-border w3-round" id="STD_Religion" name="religion" >
                                    <option value="" disabled selected>Choose a Religion</option>'; 
                            if(isset($_SESSION["std_id"]))
                            {
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
                            <td style="width:8%;">
                                Current Balance
                            </td>
                            <td style="width:1%;">
                                :
                            </td>
                            <td style="width:40%">'; 
                            if(isset($_SESSION["std_id"]))
                            {
                                echo '
                                <input class="w3-input w3-border w3-round" type="number" id="STD_Ballance" name="student_ballance" value='.$resultSTD[0]["Current Balance"].'>';
                            }
                            else
                            {
                                echo '<input class="w3-input w3-border w3-round" type="number" id="STD_Ballance" name="student_ballance">';
                            }
                            echo '
                            </td>
                        </tr>
                        <tr>
                            <td style="width:8%;">
                                Address
                            </td>
                            <td style="width:1%;">
                                :
                            </td>
                            <td style="width:40%">'; 
                            if(isset($_SESSION["std_id"]))
                            {
                                echo '
                                <input class="w3-input w3-border w3-round" type="text" name="student_address" id="STD_Address" value='.$resultSTD[0]["Address"].'>';
                                unset($_SESSION['std_id']);
                            }
                            else
                            {
                                echo '<input class="w3-input w3-border w3-round" type="text" name="student_address" id="STD_Address">';
                            }
                            echo '
                            </td>
                        </tr>
                    </table>
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
        function check()
        {
            var flag = false;
            var id = document.getElementById("STD_ID").value.length;
            var name = document.getElementById("STD_Name").value.length;
            var father = document.getElementById("STD_Father").value.length;
            var mother = document.getElementById("STD_Mother").value.length;
            var email = document.getElementById("STD_Email").value.length;
            var email2 = document.getElementById("STD_Email").value;
            var roll = document.getElementById("STD_Roll").value;
            var std_class = document.getElementById("STD_Class");
            var batch = document.getElementById("STD_Batch");
            var dob = document.getElementById("STD_DOB").value.length;
            var bg = document.getElementById("STD_BG");
            var religion = document.getElementById("STD_Religion");
            var address = document.getElementById("STD_Address").value.length;
            if(id == 0)
            {
                document.getElementById("msg").innerHTML = "*ID cannot be empty";
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
            else if(email2.indexOf("@") > email2.indexOf(".") || email2.indexOf("@") < 0 || email2.indexOf(".") < 0)
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
                if(confirm("Are you sure ???"))
                {
                    return true;
                }
                else
                {
                    return false;
                }
            } 
            
        }
    </script>
    <script>
        function getData() {
            
            var id = document.getElementById("Name").value;
            var url = "server.php?id="+id;
        
            
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                
                var record = JSON.parse(this.responseText);
                document.getElementById("STD_ID").value = record[0]["Std_id"];
                document.getElementById("STD_Name").value = record[0]["Std_Name"];
                document.getElementById("STD_Father").value = record[0]["Std_Father_Name"];
                document.getElementById("STD_Mother").value = record[0]["Std_Mother_Name"];
                document.getElementById("STD_Email").value = record[0]["Email"];
                document.getElementById("STD_Roll").value = record[0]["Roll"];
                document.getElementById("STD_Class").value=record[0]["Class"];
                document.getElementById("STD_Batch").value=record[0]["Batch"];
                document.getElementById("STD_DOB").value = record[0]["DOB"];
                document.getElementById("STD_BG").value = record[0]["BG"];
                document.getElementById("STD_Address").value = record[0]["Address"];
                document.getElementById("STD_Religion").value = record[0]["Religion"];
                document.getElementById(record[0]["Gender"]).checked = true;
                document.getElementById("STD_Ballance").value = record[0]["Current Balance"];
                if(record[0]["Photo"] != null)
                {
                    document.getElementById("profile_picture").src = record[0]["Photo"];
                }
                else
                {
                    document.getElementById("profile_picture").src = "../images/img_avatar3.png";
                }
            }
            };
            xhttp.open("GET", url, true);
            xhttp.send();
        }

        function showData(element) {
            
            var id = element.value;
            var url = "server.php?id="+id;
        
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var record = JSON.parse(this.responseText);
                if(record.length > 0)
                {
                    document.getElementById("STD_ID").value = record[0]["Std_id"];
                    document.getElementById("STD_Name").value = record[0]["Std_Name"];
                    document.getElementById("STD_Father").value = record[0]["Std_Father_Name"];
                    document.getElementById("STD_Mother").value = record[0]["Std_Mother_Name"];
                    document.getElementById("STD_Email").value = record[0]["Email"];
                    document.getElementById("STD_Roll").value = record[0]["Roll"];
                    document.getElementById("STD_Class").value=record[0]["Class"];
                    document.getElementById("STD_Batch").value=record[0]["Batch"];
                    document.getElementById("STD_DOB").value = record[0]["DOB"];
                    document.getElementById("STD_BG").value = record[0]["BG"];
                    document.getElementById("STD_Address").value = record[0]["Address"];
                    document.getElementById("STD_Religion").value = record[0]["Religion"];
                    document.getElementById(record[0]["Gender"]).checked = true;
                    document.getElementById("STD_Ballance").value = record[0]["Current Balance"];
                    if(record[0]["Photo"] != null)
                    {
                        document.getElementById("profile_picture").src = record[0]["Photo"];
                    }
                    else
                    {
                        document.getElementById("profile_picture").src = "../images/img_avatar3.png";
                    }
                }
                else
                {
                    
                    document.getElementById("STD_ID").value = "";
                    document.getElementById("STD_Name").value = "";
                    document.getElementById("STD_Father").value = "";
                    document.getElementById("STD_Mother").value = "";
                    document.getElementById("STD_Email").value = "";
                    document.getElementById("STD_Roll").value = "";
                    document.getElementById("STD_Class").value=0;
                    document.getElementById("STD_Batch").value=0;
                    document.getElementById("STD_DOB").value = "";
                    document.getElementById("STD_BG").value = 0;
                    document.getElementById("STD_Address").value = "";
                    document.getElementById("STD_Religion").value = 0;
                    document.getElementById(record[0]["Gender"]).checked = true;
                    document.getElementById("STD_Ballance").value = 0;
                    document.getElementById("profile_picture").src = "../images/img_avatar3.png";
                }
            }
            };
            xhttp.open("GET", url, true);
            xhttp.send();
        }

    </script>
    
    
    <script>
        function updateName(element)
        {
            var batch = element.value;
            var url = "getInfo.php?id="+batch+"&type=Batch";
        
            
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var record = JSON.parse(this.responseText);
                
                var dropdown = document.getElementById("Name");
                while (dropdown.options.length > 1) 
                {                
                    dropdown.remove(1);
                }
                var i = 1;
                var opt = [];
                
                while(i <= record.length)
                {
                    opt[i] = document.createElement("option");
                    opt[i].value = record[i-1]["Std_id"];
                    opt[i].innerHTML = record[i-1]["Std_Name"] + "( ID : "+record[i-1]["Std_id"]+")";
                    dropdown.appendChild(opt[i]);
                    i++;
                    
                }
                dropdown.options[0].selected = true;
                document.getElementById("class").options[0].selected = true;
            }
            };
            xhttp.open("GET", url, true);
            xhttp.send();
        }
    </script>
    <script>
    
        function updateName2(element)
        {
            var Class = element.value;
            var url = "getInfo.php?id="+Class+"&type=Class";
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var record = JSON.parse(this.responseText);
                
                var dropdown = document.getElementById("Name");
                while (dropdown.options.length > 1) 
                {                
                    dropdown.remove(1);
                }
                var i = 1;
                var opt = [];
                
                while(i <= record.length)
                {
                    opt[i] = document.createElement("option");
                    opt[i].value = record[i-1]["Std_id"];
                    opt[i].innerHTML = record[i-1]["Std_Name"] + "( ID : "+record[i-1]["Std_id"]+")";
                    dropdown.appendChild(opt[i]);
                    i++;
                    
                }
                dropdown.options[0].selected = true;
                document.getElementById("Batch").options[0].selected = true;
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

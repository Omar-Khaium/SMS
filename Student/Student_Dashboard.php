<?php
require("../Database.php");
session_start();
    if(isset($_SESSION["flag"]) && $_SESSION["flag"]=="success" && isset($_SESSION["logger_id"])){
        $sql = "select Batch from std_profile where Std_id='".$_SESSION["logger_id"]."'";
        $batch = getDataFromDB($sql);
        $sql = "select * from course where `Batch Id`='".$batch[0]["Batch"]."'";
        $courses = getDataFromDB($sql);
    echo '<!DOCTYPE html>
<html>
<title>Studnet Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
    td {
        padding: 3px 25px;
    }

    body {
        background-color: whitesmoke;
    }

    table.routine tr {
        border-bottom: 1px solid grey;
    }

    table.notice,
    table.event tr {
        border-bottom: 2px solid grey;
    }

    table.notice tr {
        border-bottom: 2px solid grey;
    }

    button {
        margin-top: 10px;
        margin-bottom: 0px;
        margin-left: 100px;
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

                <!-------------------------Routine start------------------------------->
                <td class="w3-cell-top" style="padding-left:150px;">
                    <div class="w3-container w3-blue">
                        <h4>Class Schedule</h4>
                    </div>
                    
                    <div class="w3-container w3-border w3-padding-16">
                        <table class="routine" border=1 frame=hsides rules=rows style="width:100%;">
                        <tr>
                            <th>Day</th>
                            <th>Course</th>
                            <th>Batch</th>
                            <th>Time</th>
                        </tr>
                        ';
            $sunArr = array();
            $monArr = array();
            $tueArr = array();
            $wedArr = array();
                            foreach($courses as $course)
                            {
                                $sql = "select * from slot where Serial='".$course["Slot"]."'";
                                $slot = getDataFromDB($sql);
                                $day = explode(", ",$slot[0]["Day"]);
                                if(trim($day[0])=="Sunday")
                                {
                                    $sunArr[] = $course;
                                }
                                if(trim($day[1])=="Tuesday")
                                {
                                    $tueArr[] = $course;
                                }
                                if(trim($day[0])=="Monday")
                                {
                                    $monArr[] = $course;
                                }
                                if(trim($day[1])=="Wednesday")
                                {
                                    $wedArr[] = $course;
                                }
                            }
            date_default_timezone_set("asia/dhaka");
            $d=strtotime("now");
            $nowDay = date("l", $d);
            $d=strtotime("+1 day");
            $tomDay = date("l", $d);
            $d=strtotime("+2 day");
            $_3rdDay = date("l", $d);
            $d=strtotime("+3 day");
            $_4thDay = date("l", $d);
            $d=strtotime("+4 day");
            $_5thDay = date("l", $d);
            $d=strtotime("+5 day");
            $_6thDay = date("l", $d);
            $d=strtotime("+6 day");
            $_7thDay = date("l", $d);
        
        //-------------------------Sunday start---------------------------
        if($nowDay=="Sunday")
        {
            if(count($sunArr)==1)//--------------Start Sunday--------------
            {
                echo '<tr>';
                echo '<td rowspan="1">Today</td>';
                $sql = "select BatchName from batch where `Batch ID`='".$sunArr[0]["Batch Id"]."'";
                $batchName = getDataFromDB($sql);
                $sql = "select Time from slot where Serial='".$sunArr[0]["Slot"]."'";
                $slotTime = getDataFromDB($sql);
                echo '<td><a href="Student_Single_Course.php?id='.$sunArr[0]["Course Id"].'">'.$sunArr[0]["Name"].'</a></td>';
                echo '<td>'.$batchName[0]["BatchName"].'</td>';
                echo '<td>'.$slotTime[0]["Time"].'</td>';
                echo '</tr>';
            }
            else if(count($sunArr)==0)
            {
                echo '<tr>';
                echo '<td rowspan="1">Today</td>';
                echo '<td colspan="3" align="center">No Class On This Day</td>';
                echo '</tr>';
            }
            else
            {                
                echo '<tr>';
                echo '<td rowspan="'.count($sunArr).'">Today</td>';
                foreach($sunArr as $data)
                {                        
                    $sql = "select BatchName  from batch where `Batch ID`='".$data["Batch Id"]."'";
                    $batchName = getDataFromDB($sql);
                    $sql = "select Time  from slot where Serial='".$data["Slot"]."'";
                    $slotTime = getDataFromDB($sql);
                    echo '<td><a href="Student_Single_Course.php?id='.$data["Course Id"].'">'.$data["Name"].'</a></td>';
                    echo '<td>'.$batchName[0]["BatchName"].'</td>';
                    echo '<td>'.$slotTime[0]["Time"].'</td>';
                    echo '</tr>';
                    echo '<tr>';
                }
                echo '</tr>';
            }//--------------End Sunday--------------
            if(count($monArr)==1)//--------------Start Monday--------------
            {
                echo '<tr>';
                echo '<td rowspan="1">Tomorrow</td>';
                $sql = "select BatchName from batch where `Batch ID`='".$monArr[0]["Batch Id"]."'";
                $batchName = getDataFromDB($sql);
                $sql = "select Time from slot where Serial='".$monArr[0]["Slot"]."'";
                $slotTime = getDataFromDB($sql);
                echo '<td><a href="Student_Single_Course.php?id='.$monArr[0]["Course Id"].'">'.$monArr[0]["Name"].'</a></td>';
                echo '<td>'.$batchName[0]["BatchName"].'</td>';
                echo '<td>'.$slotTime[0]["Time"].'</td>';
                echo '</tr>';
            }
            else if(count($monArr)==0)
            {
                echo '<tr>';
                echo '<td rowspan="1">Tomorrow</td>';
                echo '<td colspan="3" align="center">No Class On This Day</td>';
                echo '</tr>';
            }
            else
            {                
                echo '<tr>';
                echo '<td rowspan="'.count($monArr).'">Tomorrow</td>';
                foreach($monArr as $data)
                {                        
                    $sql = "select BatchName  from batch where `Batch ID`='".$data["Batch Id"]."'";
                    $batchName = getDataFromDB($sql);
                    $sql = "select Time  from slot where Serial='".$data["Slot"]."'";
                    $slotTime = getDataFromDB($sql);
                    echo '<td><a href="Student_Single_Course.php?id='.$data["Course Id"].'">'.$data["Name"].'</a></td>';
                    echo '<td>'.$batchName[0]["BatchName"].'</td>';
                    echo '<td>'.$slotTime[0]["Time"].'</td>';
                    echo '</tr>';
                    echo '<tr>';
                }
                echo '</tr>';
            }//--------------End Monday--------------
            if(count($tueArr)==1)//--------------Start Tuesday--------------
            {
                echo '<tr>';
                echo '<td rowspan="1">'.$_3rdDay.'</td>';
                $sql = "select BatchName from batch where `Batch ID`='".$tueArr[0]["Batch Id"]."'";
                $batchName = getDataFromDB($sql);
                $sql = "select Time from slot where Serial='".$tueArr[0]["Slot"]."'";
                $slotTime = getDataFromDB($sql);
                echo '<td><a href="Student_Single_Course.php?id='.$tueArr[0]["Course Id"].'">'.$tueArr[0]["Name"].'</a></td>';
                echo '<td>'.$batchName[0]["BatchName"].'</td>';
                echo '<td>'.$slotTime[0]["Time"].'</td>';
                echo '</tr>';
            }
            else if(count($tueArr)==0)
            {
                echo '<tr>';
                echo '<td rowspan="1">'.$_3rdDay.'</td>';
                echo '<td colspan="3" align="center">No Class On This Day</td>';
                echo '</tr>';
            }
            else
            {                
                echo '<tr>';
                echo '<td rowspan="'.count($tueArr).'">'.$_3rdDay.'</td>';
                foreach($tueArr as $data)
                {                        
                    $sql = "select BatchName  from batch where `Batch ID`='".$data["Batch Id"]."'";
                    $batchName = getDataFromDB($sql);
                    $sql = "select Time  from slot where Serial='".$data["Slot"]."'";
                    $slotTime = getDataFromDB($sql);
                    echo '<td><a href="Student_Single_Course.php?id='.$data["Course Id"].'">'.$data["Name"].'</a></td>';
                    echo '<td>'.$batchName[0]["BatchName"].'</td>';
                    echo '<td>'.$slotTime[0]["Time"].'</td>';
                    echo '</tr>';
                    echo '<tr>';
                }
                echo '</tr>';
            }//--------------End Tuesday--------------
            if(count($wedArr)==1)//--------------Start Wednesday--------------
            {
                echo '<tr>';
                echo '<td rowspan="1">'.$_4thDay.'</td>';
                $sql = "select BatchName from batch where `Batch ID`='".$wedArr[0]["Batch Id"]."'";
                $batchName = getDataFromDB($sql);
                $sql = "select Time from slot where Serial='".$wedArr[0]["Slot"]."'";
                $slotTime = getDataFromDB($sql);
                echo '<td><a href="Student_Single_Course.php?id='.$wedArr[0]["Course Id"].'">'.$wedArr[0]["Name"].'</a></td>';
                echo '<td>'.$batchName[0]["BatchName"].'</td>';
                echo '<td>'.$slotTime[0]["Time"].'</td>';
                echo '</tr>';
            }
            else if(count($wedArr)==0)
            {
                echo '<tr>';
                echo '<td rowspan="1">'.$_4thDay.'</td>';
                echo '<td colspan="3" align="center">No Class On This Day</td>';
                echo '</tr>';
            }
            else
            {                
                echo '<tr>';
                echo '<td rowspan="'.count($wedArr).'">'.$_4thDay.'</td>';
                foreach($wedArr as $data)
                {                        
                    $sql = "select BatchName  from batch where `Batch ID`='".$data["Batch Id"]."'";
                    $batchName = getDataFromDB($sql);
                    $sql = "select Time  from slot where Serial='".$data["Slot"]."'";
                    $slotTime = getDataFromDB($sql);
                    echo '<td><a href="Student_Single_Course.php?id='.$data["Course Id"].'">'.$data["Name"].'</a></td>';
                    echo '<td>'.$batchName[0]["BatchName"].'</td>';
                    echo '<td>'.$slotTime[0]["Time"].'</td>';
                    echo '</tr>';
                    echo '<tr>';
                }
                echo '</tr>';
            }//--------------End Wednesday--------------
            
            //--------------Start Thursday--------------            
            echo '<tr>';
            echo '<td rowspan="1">'.$_5thDay.'</td>';
            echo '<td colspan="3" align="center">No Class On This Day</td>';
            echo '</tr>';
            //--------------End Thursday--------------
            
            //--------------Start Friday--------------            
            echo '<tr>';
            echo '<td rowspan="1">'.$_6thDay.'</td>';
            echo '<td colspan="3" align="center">No Class On This Day</td>';
            echo '</tr>';
            //--------------End Friday--------------
            
            //--------------Start Saturday--------------            
            echo '<tr>';
            echo '<td rowspan="1">'.$_7thDay.'</td>';
            echo '<td colspan="3" align="center">No Class On This Day</td>';
            echo '</tr>';
            //--------------End Saturday--------------
        }
        //-------------------------Sunday End---------------------------
        
        //-------------------------Monday start---------------------------
        if($nowDay=="Monday")
        {
            if(count($monArr)==1)//--------------Start Monday--------------
            {
                echo '<tr>';
                echo '<td rowspan="1">Today</td>';
                $sql = "select BatchName from batch where `Batch ID`='".$monArr[0]["Batch Id"]."'";
                $batchName = getDataFromDB($sql);
                $sql = "select Time from slot where Serial='".$monArr[0]["Slot"]."'";
                $slotTime = getDataFromDB($sql);
                echo '<td><a href="Student_Single_Course.php?id='.$monArr[0]["Course Id"].'">'.$monArr[0]["Name"].'</a></td>';
                echo '<td>'.$batchName[0]["BatchName"].'</td>';
                echo '<td>'.$slotTime[0]["Time"].'</td>';
                echo '</tr>';
            }
            else if(count($monArr)==0)
            {
                echo '<tr>';
                echo '<td rowspan="1">Today</td>';
                echo '<td colspan="3" align="center">No Class On This Day</td>';
                echo '</tr>';
            }
            else
            {                
                echo '<tr>';
                echo '<td rowspan="'.count($monArr).'">Today</td>';
                foreach($monArr as $data)
                {                        
                    $sql = "select BatchName  from batch where `Batch ID`='".$data["Batch Id"]."'";
                    $batchName = getDataFromDB($sql);
                    $sql = "select Time  from slot where Serial='".$data["Slot"]."'";
                    $slotTime = getDataFromDB($sql);
                    echo '<td><a href="Student_Single_Course.php?id='.$data["Course Id"].'">'.$data["Name"].'</a></td>';
                    echo '<td>'.$batchName[0]["BatchName"].'</td>';
                    echo '<td>'.$slotTime[0]["Time"].'</td>';
                    echo '</tr>';
                    echo '<tr>';
                }
                echo '</tr>';
            }//--------------End Monday--------------
            if(count($tueArr)==1)//--------------Start Tuesday--------------
            {
                echo '<tr>';
                echo '<td rowspan="1">Tomorrow</td>';
                $sql = "select BatchName from batch where `Batch ID`='".$tueArr[0]["Batch Id"]."'";
                $batchName = getDataFromDB($sql);
                $sql = "select Time from slot where Serial='".$tueArr[0]["Slot"]."'";
                $slotTime = getDataFromDB($sql);
                echo '<td><a href="Student_Single_Course.php?id='.$tueArr[0]["Course Id"].'">'.$tueArr[0]["Name"].'</a></td>';
                echo '<td>'.$batchName[0]["BatchName"].'</td>';
                echo '<td>'.$slotTime[0]["Time"].'</td>';
                echo '</tr>';
            }
            else if(count($tueArr)==0)
            {
                echo '<tr>';
                echo '<td rowspan="1">Tomorrow</td>';
                echo '<td colspan="3" align="center">No Class On This Day</td>';
                echo '</tr>';
            }
            else
            {                
                echo '<tr>';
                echo '<td rowspan="'.count($tueArr).'">Tomorrow</td>';
                foreach($tueArr as $data)
                {                        
                    $sql = "select BatchName  from batch where `Batch ID`='".$data["Batch Id"]."'";
                    $batchName = getDataFromDB($sql);
                    $sql = "select Time  from slot where Serial='".$data["Slot"]."'";
                    $slotTime = getDataFromDB($sql);
                    echo '<td><a href="Student_Single_Course.php?id='.$data["Course Id"].'">'.$data["Name"].'</a></td>';
                    echo '<td>'.$batchName[0]["BatchName"].'</td>';
                    echo '<td>'.$slotTime[0]["Time"].'</td>';
                    echo '</tr>';
                    echo '<tr>';
                }
                echo '</tr>';
            }//--------------End Tuesday--------------
            if(count($wedArr)==1)//--------------Start Wednesday--------------
            {
                echo '<tr>';
                echo '<td rowspan="1">'.$_3rdDay.'</td>';
                $sql = "select BatchName from batch where `Batch ID`='".$wedArr[0]["Batch Id"]."'";
                $batchName = getDataFromDB($sql);
                $sql = "select Time from slot where Serial='".$wedArr[0]["Slot"]."'";
                $slotTime = getDataFromDB($sql);
                echo '<td><a href="Student_Single_Course.php?id='.$wedArr[0]["Course Id"].'">'.$wedArr[0]["Name"].'</a></td>';
                echo '<td>'.$batchName[0]["BatchName"].'</td>';
                echo '<td>'.$slotTime[0]["Time"].'</td>';
                echo '</tr>';
            }
            else if(count($wedArr)==0)
            {
                echo '<tr>';
                echo '<td rowspan="1">'.$_3rdDay.'</td>';
                echo '<td colspan="3" align="center">No Class On This Day</td>';
                echo '</tr>';
            }
            else
            {                
                echo '<tr>';
                echo '<td rowspan="'.count($wedArr).'">'.$_3rdDay.'</td>';
                foreach($wedArr as $data)
                {                        
                    $sql = "select BatchName  from batch where `Batch ID`='".$data["Batch Id"]."'";
                    $batchName = getDataFromDB($sql);
                    $sql = "select Time  from slot where Serial='".$data["Slot"]."'";
                    $slotTime = getDataFromDB($sql);
                    echo '<td><a href="Student_Single_Course.php?id='.$data["Course Id"].'">'.$data["Name"].'</a></td>';
                    echo '<td>'.$batchName[0]["BatchName"].'</td>';
                    echo '<td>'.$slotTime[0]["Time"].'</td>';
                    echo '</tr>';
                    echo '<tr>';
                }
                echo '</tr>';
            }//--------------End Wednesday--------------
            
            //--------------Start Thursday--------------            
            echo '<tr>';
            echo '<td rowspan="1">'.$_4thDay.'</td>';
            echo '<td colspan="3" align="center">No Class On This Day</td>';
            echo '</tr>';
            //--------------End Thursday--------------
            
            //--------------Start Friday--------------            
            echo '<tr>';
            echo '<td rowspan="1">'.$_5thDay.'</td>';
            echo '<td colspan="3" align="center">No Class On This Day</td>';
            echo '</tr>';
            //--------------End Friday--------------
            
            //--------------Start Saturday--------------            
            echo '<tr>';
            echo '<td rowspan="1">'.$_6thDay.'</td>';
            echo '<td colspan="3" align="center">No Class On This Day</td>';
            echo '</tr>';
            //--------------End Saturday--------------
            if(count($sunArr)==1)//--------------Start Sunday--------------
            {
                echo '<tr>';
                echo '<td rowspan="1">'.$_7thDay.'</td>';
                $sql = "select BatchName from batch where `Batch ID`='".$sunArr[0]["Batch Id"]."'";
                $batchName = getDataFromDB($sql);
                $sql = "select Time from slot where Serial='".$sunArr[0]["Slot"]."'";
                $slotTime = getDataFromDB($sql);
                echo '<td><a href="Student_Single_Course.php?id='.$sunArr[0]["Course Id"].'">'.$sunArr[0]["Name"].'</a></td>';
                echo '<td>'.$batchName[0]["BatchName"].'</td>';
                echo '<td>'.$slotTime[0]["Time"].'</td>';
                echo '</tr>';
            }
            else if(count($sunArr)==0)
            {
                echo '<tr>';
                echo '<td rowspan="1">'.$_7thDay.'</td>';
                echo '<td colspan="3" align="center">No Class On This Day</td>';
                echo '</tr>';
            }
            else
            {                
                echo '<tr>';
                echo '<td rowspan="'.count($sunArr).'">'.$_7thDay.'</td>';
                foreach($sunArr as $data)
                {                        
                    $sql = "select BatchName  from batch where `Batch ID`='".$data["Batch Id"]."'";
                    $batchName = getDataFromDB($sql);
                    $sql = "select Time  from slot where Serial='".$data["Slot"]."'";
                    $slotTime = getDataFromDB($sql);
                    echo '<td><a href="Student_Single_Course.php?id='.$data["Course Id"].'">'.$data["Name"].'</a></td>';
                    echo '<td>'.$batchName[0]["BatchName"].'</td>';
                    echo '<td>'.$slotTime[0]["Time"].'</td>';
                    echo '</tr>';
                    echo '<tr>';
                }
                echo '</tr>';
            }//--------------End Sunday--------------
        }
        //-------------------------Monday End---------------------------
        
        //-------------------------Tuesday start---------------------------
        if($nowDay=="Tuesday")
        {
            if(count($tueArr)==1)//--------------Start Tuesday--------------
            {
                echo '<tr>';
                echo '<td rowspan="1">Today</td>';
                $sql = "select BatchName from batch where `Batch ID`='".$tueArr[0]["Batch Id"]."'";
                $batchName = getDataFromDB($sql);
                $sql = "select Time from slot where Serial='".$tueArr[0]["Slot"]."'";
                $slotTime = getDataFromDB($sql);
                echo '<td><a href="Student_Single_Course.php?id='.$tueArr[0]["Course Id"].'">'.$tueArr[0]["Name"].'</a></td>';
                echo '<td>'.$batchName[0]["BatchName"].'</td>';
                echo '<td>'.$slotTime[0]["Time"].'</td>';
                echo '</tr>';
            }
            else if(count($tueArr)==0)
            {
                echo '<tr>';
                echo '<td rowspan="1">Today</td>';
                echo '<td colspan="3" align="center">No Class On This Day</td>';
                echo '</tr>';
            }
            else
            {                
                echo '<tr>';
                echo '<td rowspan="'.count($tueArr).'">Today</td>';
                foreach($tueArr as $data)
                {                        
                    $sql = "select BatchName  from batch where `Batch ID`='".$data["Batch Id"]."'";
                    $batchName = getDataFromDB($sql);
                    $sql = "select Time  from slot where Serial='".$data["Slot"]."'";
                    $slotTime = getDataFromDB($sql);
                    echo '<td><a href="Student_Single_Course.php?id='.$data["Course Id"].'">'.$data["Name"].'</a></td>';
                    echo '<td>'.$batchName[0]["BatchName"].'</td>';
                    echo '<td>'.$slotTime[0]["Time"].'</td>';
                    echo '</tr>';
                    echo '<tr>';
                }
                echo '</tr>';
            }//--------------End Tuesday--------------
            if(count($wedArr)==1)//--------------Start Wednesday--------------
            {
                echo '<tr>';
                echo '<td rowspan="1">Tomorrow</td>';
                $sql = "select BatchName from batch where `Batch ID`='".$wedArr[0]["Batch Id"]."'";
                $batchName = getDataFromDB($sql);
                $sql = "select Time from slot where Serial='".$wedArr[0]["Slot"]."'";
                $slotTime = getDataFromDB($sql);
                echo '<td><a href="Student_Single_Course.php?id='.$wedArr[0]["Course Id"].'">'.$wedArr[0]["Name"].'</a></td>';
                echo '<td>'.$batchName[0]["BatchName"].'</td>';
                echo '<td>'.$slotTime[0]["Time"].'</td>';
                echo '</tr>';
            }
            else if(count($wedArr)==0)
            {
                echo '<tr>';
                echo '<td rowspan="1">Tomorrow</td>';
                echo '<td colspan="3" align="center">No Class On This Day</td>';
                echo '</tr>';
            }
            else
            {                
                echo '<tr>';
                echo '<td rowspan="'.count($wedArr).'">Tomorrow</td>';
                foreach($wedArr as $data)
                {                        
                    $sql = "select BatchName  from batch where `Batch ID`='".$data["Batch Id"]."'";
                    $batchName = getDataFromDB($sql);
                    $sql = "select Time  from slot where Serial='".$data["Slot"]."'";
                    $slotTime = getDataFromDB($sql);
                    echo '<td><a href="Student_Single_Course.php?id='.$data["Course Id"].'">'.$data["Name"].'</a></td>';
                    echo '<td>'.$batchName[0]["BatchName"].'</td>';
                    echo '<td>'.$slotTime[0]["Time"].'</td>';
                    echo '</tr>';
                    echo '<tr>';
                }
                echo '</tr>';
            }//--------------End Wednesday--------------
            
            //--------------Start Thursday--------------            
            echo '<tr>';
            echo '<td rowspan="1">'.$_3rdDay.'</td>';
            echo '<td colspan="3" align="center">No Class On This Day</td>';
            echo '</tr>';
            //--------------End Thursday--------------
            
            //--------------Start Friday--------------            
            echo '<tr>';
            echo '<td rowspan="1">'.$_4thDay.'</td>';
            echo '<td colspan="3" align="center">No Class On This Day</td>';
            echo '</tr>';
            //--------------End Friday--------------
            
            //--------------Start Saturday--------------            
            echo '<tr>';
            echo '<td rowspan="1">'.$_5thDay.'</td>';
            echo '<td colspan="3" align="center">No Class On This Day</td>';
            echo '</tr>';
            //--------------End Saturday--------------
            if(count($sunArr)==1)//--------------Start Sunday--------------
            {
                echo '<tr>';
                echo '<td rowspan="1">'.$_6thDay.'</td>';
                $sql = "select BatchName from batch where `Batch ID`='".$sunArr[0]["Batch Id"]."'";
                $batchName = getDataFromDB($sql);
                $sql = "select Time from slot where Serial='".$sunArr[0]["Slot"]."'";
                $slotTime = getDataFromDB($sql);
                echo '<td><a href="Student_Single_Course.php?id='.$sunArr[0]["Course Id"].'">'.$sunArr[0]["Name"].'</a></td>';
                echo '<td>'.$batchName[0]["BatchName"].'</td>';
                echo '<td>'.$slotTime[0]["Time"].'</td>';
                echo '</tr>';
            }
            else if(count($sunArr)==0)
            {
                echo '<tr>';
                echo '<td rowspan="1">'.$_6thDay.'</td>';
                echo '<td colspan="3" align="center">No Class On This Day</td>';
                echo '</tr>';
            }
            else
            {                
                echo '<tr>';
                echo '<td rowspan="'.count($sunArr).'">'.$_6thDay.'</td>';
                foreach($sunArr as $data)
                {                        
                    $sql = "select BatchName  from batch where `Batch ID`='".$data["Batch Id"]."'";
                    $batchName = getDataFromDB($sql);
                    $sql = "select Time  from slot where Serial='".$data["Slot"]."'";
                    $slotTime = getDataFromDB($sql);
                    echo '<td><a href="Student_Single_Course.php?id='.$data["Course Id"].'">'.$data["Name"].'</a></td>';
                    echo '<td>'.$batchName[0]["BatchName"].'</td>';
                    echo '<td>'.$slotTime[0]["Time"].'</td>';
                    echo '</tr>';
                    echo '<tr>';
                }
                echo '</tr>';
            }//--------------End Sunday--------------
            if(count($monArr)==1)//--------------Start Monday--------------
            {
                echo '<tr>';
                echo '<td rowspan="1">'.$_7thDay.'</td>';
                $sql = "select BatchName from batch where `Batch ID`='".$monArr[0]["Batch Id"]."'";
                $batchName = getDataFromDB($sql);
                $sql = "select Time from slot where Serial='".$monArr[0]["Slot"]."'";
                $slotTime = getDataFromDB($sql);
                echo '<td><a href="Student_Single_Course.php?id='.$monArr[0]["Course Id"].'">'.$monArr[0]["Name"].'</a></td>';
                echo '<td>'.$batchName[0]["BatchName"].'</td>';
                echo '<td>'.$slotTime[0]["Time"].'</td>';
                echo '</tr>';
            }
            else if(count($monArr)==0)
            {
                echo '<tr>';
                echo '<td rowspan="1">'.$_7thDay.'</td>';
                echo '<td colspan="3" align="center">No Class On This Day</td>';
                echo '</tr>';
            }
            else
            {                
                echo '<tr>';
                echo '<td rowspan="'.count($monArr).'">'.$_7thDay.'</td>';
                foreach($monArr as $data)
                {                        
                    $sql = "select BatchName  from batch where `Batch ID`='".$data["Batch Id"]."'";
                    $batchName = getDataFromDB($sql);
                    $sql = "select Time  from slot where Serial='".$data["Slot"]."'";
                    $slotTime = getDataFromDB($sql);
                    echo '<td><a href="Student_Single_Course.php?id='.$data["Course Id"].'">'.$data["Name"].'</a></td>';
                    echo '<td>'.$batchName[0]["BatchName"].'</td>';
                    echo '<td>'.$slotTime[0]["Time"].'</td>';
                    echo '</tr>';
                    echo '<tr>';
                }
                echo '</tr>';
            }//--------------End Monday--------------
        }
        //-------------------------Tuesday End---------------------------
        
        //-------------------------Wednesday start---------------------------
        if($nowDay=="Wednesday")
        {
            if(count($wedArr)==1)//--------------Start Wednesday--------------
            {
                echo '<tr>';
                echo '<td rowspan="1">Today</td>';
                $sql = "select BatchName from batch where `Batch ID`='".$wedArr[0]["Batch Id"]."'";
                $batchName = getDataFromDB($sql);
                $sql = "select Time from slot where Serial='".$wedArr[0]["Slot"]."'";
                $slotTime = getDataFromDB($sql);
                echo '<td><a href="Student_Single_Course.php?id='.$wedArr[0]["Course Id"].'">'.$wedArr[0]["Name"].'</a></td>';
                echo '<td>'.$batchName[0]["BatchName"].'</td>';
                echo '<td>'.$slotTime[0]["Time"].'</td>';
                echo '</tr>';
            }
            else if(count($wedArr)==0)
            {
                echo '<tr>';
                echo '<td rowspan="1">Today</td>';
                echo '<td colspan="3" align="center">No Class On This Day</td>';
                echo '</tr>';
            }
            else
            {                
                echo '<tr>';
                echo '<td rowspan="'.count($wedArr).'">Today</td>';
                foreach($wedArr as $data)
                {                        
                    $sql = "select BatchName  from batch where `Batch ID`='".$data["Batch Id"]."'";
                    $batchName = getDataFromDB($sql);
                    $sql = "select Time  from slot where Serial='".$data["Slot"]."'";
                    $slotTime = getDataFromDB($sql);
                    echo '<td><a href="Student_Single_Course.php?id='.$data["Course Id"].'">'.$data["Name"].'</a></td>';
                    echo '<td>'.$batchName[0]["BatchName"].'</td>';
                    echo '<td>'.$slotTime[0]["Time"].'</td>';
                    echo '</tr>';
                    echo '<tr>';
                }
                echo '</tr>';
            }//--------------End Wednesday--------------
            
            //--------------Start Thursday--------------            
            echo '<tr>';
            echo '<td rowspan="1">Tomorrow</td>';
            echo '<td colspan="3" align="center">No Class On This Day</td>';
            echo '</tr>';
            //--------------End Thursday--------------
            
            //--------------Start Friday--------------            
            echo '<tr>';
            echo '<td rowspan="1">'.$_3rdDay.'</td>';
            echo '<td colspan="3" align="center">No Class On This Day</td>';
            echo '</tr>';
            //--------------End Friday--------------
            
            //--------------Start Saturday--------------            
            echo '<tr>';
            echo '<td rowspan="1">'.$_4thDay.'</td>';
            echo '<td colspan="3" align="center">No Class On This Day</td>';
            echo '</tr>';
            //--------------End Saturday--------------
            if(count($sunArr)==1)//--------------Start Sunday--------------
            {
                echo '<tr>';
                echo '<td rowspan="1">'.$_5thDay.'</td>';
                $sql = "select BatchName from batch where `Batch ID`='".$sunArr[0]["Batch Id"]."'";
                $batchName = getDataFromDB($sql);
                $sql = "select Time from slot where Serial='".$sunArr[0]["Slot"]."'";
                $slotTime = getDataFromDB($sql);
                echo '<td><a href="Student_Single_Course.php?id='.$sunArr[0]["Course Id"].'">'.$sunArr[0]["Name"].'</a></td>';
                echo '<td>'.$batchName[0]["BatchName"].'</td>';
                echo '<td>'.$slotTime[0]["Time"].'</td>';
                echo '</tr>';
            }
            else if(count($sunArr)==0)
            {
                echo '<tr>';
                echo '<td rowspan="1">'.$_5thDay.'</td>';
                echo '<td colspan="3" align="center">No Class On This Day</td>';
                echo '</tr>';
            }
            else
            {                
                echo '<tr>';
                echo '<td rowspan="'.count($sunArr).'">'.$_5thDay.'</td>';
                foreach($sunArr as $data)
                {                        
                    $sql = "select BatchName  from batch where `Batch ID`='".$data["Batch Id"]."'";
                    $batchName = getDataFromDB($sql);
                    $sql = "select Time  from slot where Serial='".$data["Slot"]."'";
                    $slotTime = getDataFromDB($sql);
                    echo '<td><a href="Student_Single_Course.php?id='.$data["Course Id"].'">'.$data["Name"].'</a></td>';
                    echo '<td>'.$batchName[0]["BatchName"].'</td>';
                    echo '<td>'.$slotTime[0]["Time"].'</td>';
                    echo '</tr>';
                    echo '<tr>';
                }
                echo '</tr>';
            }//--------------End Sunday--------------
            if(count($monArr)==1)//--------------Start Monday--------------
            {
                echo '<tr>';
                echo '<td rowspan="1">'.$_6thDay.'</td>';
                $sql = "select BatchName from batch where `Batch ID`='".$monArr[0]["Batch Id"]."'";
                $batchName = getDataFromDB($sql);
                $sql = "select Time from slot where Serial='".$monArr[0]["Slot"]."'";
                $slotTime = getDataFromDB($sql);
                echo '<td><a href="Student_Single_Course.php?id='.$monArr[0]["Course Id"].'">'.$monArr[0]["Name"].'</a></td>';
                echo '<td>'.$batchName[0]["BatchName"].'</td>';
                echo '<td>'.$slotTime[0]["Time"].'</td>';
                echo '</tr>';
            }
            else if(count($monArr)==0)
            {
                echo '<tr>';
                echo '<td rowspan="1">'.$_6thDay.'</td>';
                echo '<td colspan="3" align="center">No Class On This Day</td>';
                echo '</tr>';
            }
            else
            {                
                echo '<tr>';
                echo '<td rowspan="'.count($monArr).'">'.$_6thDay.'</td>';
                foreach($monArr as $data)
                {                        
                    $sql = "select BatchName  from batch where `Batch ID`='".$data["Batch Id"]."'";
                    $batchName = getDataFromDB($sql);
                    $sql = "select Time  from slot where Serial='".$data["Slot"]."'";
                    $slotTime = getDataFromDB($sql);
                    echo '<td><a href="Student_Single_Course.php?id='.$data["Course Id"].'">'.$data["Name"].'</a></td>';
                    echo '<td>'.$batchName[0]["BatchName"].'</td>';
                    echo '<td>'.$slotTime[0]["Time"].'</td>';
                    echo '</tr>';
                    echo '<tr>';
                }
                echo '</tr>';
            }//--------------End Monday--------------
            if(count($tueArr)==1)//--------------Start Tuesday--------------
            {
                echo '<tr>';
                echo '<td rowspan="1">'.$_7thDay.'</td>';
                $sql = "select BatchName from batch where `Batch ID`='".$tueArr[0]["Batch Id"]."'";
                $batchName = getDataFromDB($sql);
                $sql = "select Time from slot where Serial='".$tueArr[0]["Slot"]."'";
                $slotTime = getDataFromDB($sql);
                echo '<td><a href="Student_Single_Course.php?id='.$tueArr[0]["Course Id"].'">'.$tueArr[0]["Name"].'</a></td>';
                echo '<td>'.$batchName[0]["BatchName"].'</td>';
                echo '<td>'.$slotTime[0]["Time"].'</td>';
                echo '</tr>';
            }
            else if(count($tueArr)==0)
            {
                echo '<tr>';
                echo '<td rowspan="1">'.$_7thDay.'</td>';
                echo '<td colspan="3" align="center">No Class On This Day</td>';
                echo '</tr>';
            }
            else
            {                
                echo '<tr>';
                echo '<td rowspan="'.count($tueArr).'">'.$_7thDay.'</td>';
                foreach($tueArr as $data)
                {                        
                    $sql = "select BatchName  from batch where `Batch ID`='".$data["Batch Id"]."'";
                    $batchName = getDataFromDB($sql);
                    $sql = "select Time  from slot where Serial='".$data["Slot"]."'";
                    $slotTime = getDataFromDB($sql);
                    echo '<td><a href="Student_Single_Course.php?id='.$data["Course Id"].'">'.$data["Name"].'</a></td>';
                    echo '<td>'.$batchName[0]["BatchName"].'</td>';
                    echo '<td>'.$slotTime[0]["Time"].'</td>';
                    echo '</tr>';
                    echo '<tr>';
                }
                echo '</tr>';
            }//--------------End Tuesday--------------
        }
        //-------------------------Wednesday End---------------------------
        
        //-------------------------Thursday start---------------------------
        if($nowDay=="Thursday")
        {            
            //--------------Start Thursday--------------            
            echo '<tr>';
            echo '<td rowspan="1">Today</td>';
            echo '<td colspan="3" align="center">No Class On This Day</td>';
            echo '</tr>';
            //--------------End Thursday--------------
            
            //--------------Start Friday--------------            
            echo '<tr>';
            echo '<td rowspan="1">Tomorrow</td>';
            echo '<td colspan="3" align="center">No Class On This Day</td>';
            echo '</tr>';
            //--------------End Friday--------------
            
            //--------------Start Saturday--------------            
            echo '<tr>';
            echo '<td rowspan="1">'.$_3rdDay.'</td>';
            echo '<td colspan="3" align="center">No Class On This Day</td>';
            echo '</tr>';
            //--------------End Saturday--------------
            if(count($sunArr)==1)//--------------Start Sunday--------------
            {
                echo '<tr>';
                echo '<td rowspan="1">'.$_4thDay.'</td>';
                $sql = "select BatchName from batch where `Batch ID`='".$sunArr[0]["Batch Id"]."'";
                $batchName = getDataFromDB($sql);
                $sql = "select Time from slot where Serial='".$sunArr[0]["Slot"]."'";
                $slotTime = getDataFromDB($sql);
                echo '<td><a href="Student_Single_Course.php?id='.$sunArr[0]["Course Id"].'">'.$sunArr[0]["Name"].'</a></td>';
                echo '<td>'.$batchName[0]["BatchName"].'</td>';
                echo '<td>'.$slotTime[0]["Time"].'</td>';
                echo '</tr>';
            }
            else if(count($sunArr)==0)
            {
                echo '<tr>';
                echo '<td rowspan="1">'.$_4thDay.'</td>';
                echo '<td colspan="3" align="center">No Class On This Day</td>';
                echo '</tr>';
            }
            else
            {                
                echo '<tr>';
                echo '<td rowspan="'.count($sunArr).'">'.$_4thDay.'</td>';
                foreach($sunArr as $data)
                {                        
                    $sql = "select BatchName  from batch where `Batch ID`='".$data["Batch Id"]."'";
                    $batchName = getDataFromDB($sql);
                    $sql = "select Time  from slot where Serial='".$data["Slot"]."'";
                    $slotTime = getDataFromDB($sql);
                    echo '<td><a href="Student_Single_Course.php?id='.$data["Course Id"].'">'.$data["Name"].'</a></td>';
                    echo '<td>'.$batchName[0]["BatchName"].'</td>';
                    echo '<td>'.$slotTime[0]["Time"].'</td>';
                    echo '</tr>';
                    echo '<tr>';
                }
                echo '</tr>';
            }//--------------End Sunday--------------
            if(count($monArr)==1)//--------------Start Monday--------------
            {
                echo '<tr>';
                echo '<td rowspan="1">'.$_5thDay.'</td>';
                $sql = "select BatchName from batch where `Batch ID`='".$monArr[0]["Batch Id"]."'";
                $batchName = getDataFromDB($sql);
                $sql = "select Time from slot where Serial='".$monArr[0]["Slot"]."'";
                $slotTime = getDataFromDB($sql);
                echo '<td><a href="Student_Single_Course.php?id='.$monArr[0]["Course Id"].'">'.$monArr[0]["Name"].'</a></td>';
                echo '<td>'.$batchName[0]["BatchName"].'</td>';
                echo '<td>'.$slotTime[0]["Time"].'</td>';
                echo '</tr>';
            }
            else if(count($monArr)==0)
            {
                echo '<tr>';
                echo '<td rowspan="1">'.$_5thDay.'</td>';
                echo '<td colspan="3" align="center">No Class On This Day</td>';
                echo '</tr>';
            }
            else
            {                
                echo '<tr>';
                echo '<td rowspan="'.count($monArr).'">'.$_5thDay.'</td>';
                foreach($monArr as $data)
                {                        
                    $sql = "select BatchName  from batch where `Batch ID`='".$data["Batch Id"]."'";
                    $batchName = getDataFromDB($sql);
                    $sql = "select Time  from slot where Serial='".$data["Slot"]."'";
                    $slotTime = getDataFromDB($sql);
                    echo '<td><a href="Student_Single_Course.php?id='.$data["Course Id"].'">'.$data["Name"].'</a></td>';
                    echo '<td>'.$batchName[0]["BatchName"].'</td>';
                    echo '<td>'.$slotTime[0]["Time"].'</td>';
                    echo '</tr>';
                    echo '<tr>';
                }
                echo '</tr>';
            }//--------------End Monday--------------
            if(count($tueArr)==1)//--------------Start Tuesday--------------
            {
                echo '<tr>';
                echo '<td rowspan="1">'.$_6thDay.'</td>';
                $sql = "select BatchName from batch where `Batch ID`='".$tueArr[0]["Batch Id"]."'";
                $batchName = getDataFromDB($sql);
                $sql = "select Time from slot where Serial='".$tueArr[0]["Slot"]."'";
                $slotTime = getDataFromDB($sql);
                echo '<td><a href="Student_Single_Course.php?id='.$tueArr[0]["Course Id"].'">'.$tueArr[0]["Name"].'</a></td>';
                echo '<td>'.$batchName[0]["BatchName"].'</td>';
                echo '<td>'.$slotTime[0]["Time"].'</td>';
                echo '</tr>';
            }
            else if(count($tueArr)==0)
            {
                echo '<tr>';
                echo '<td rowspan="1">'.$_6thDay.'</td>';
                echo '<td colspan="3" align="center">No Class On This Day</td>';
                echo '</tr>';
            }
            else
            {                
                echo '<tr>';
                echo '<td rowspan="'.count($tueArr).'">'.$_6thDay.'</td>';
                foreach($tueArr as $data)
                {                        
                    $sql = "select BatchName  from batch where `Batch ID`='".$data["Batch Id"]."'";
                    $batchName = getDataFromDB($sql);
                    $sql = "select Time  from slot where Serial='".$data["Slot"]."'";
                    $slotTime = getDataFromDB($sql);
                    echo '<td><a href="Student_Single_Course.php?id='.$data["Course Id"].'">'.$data["Name"].'</a></td>';
                    echo '<td>'.$batchName[0]["BatchName"].'</td>';
                    echo '<td>'.$slotTime[0]["Time"].'</td>';
                    echo '</tr>';
                    echo '<tr>';
                }
                echo '</tr>';
            }//--------------End Tuesday--------------
            if(count($wedArr)==1)//--------------Start Wednesday--------------
            {
                echo '<tr>';
                echo '<td rowspan="1">'.$_7thDay.'</td>';
                $sql = "select BatchName from batch where `Batch ID`='".$wedArr[0]["Batch Id"]."'";
                $batchName = getDataFromDB($sql);
                $sql = "select Time from slot where Serial='".$wedArr[0]["Slot"]."'";
                $slotTime = getDataFromDB($sql);
                echo '<td><a href="Student_Single_Course.php?id='.$wedArr[0]["Course Id"].'">'.$wedArr[0]["Name"].'</a></td>';
                echo '<td>'.$batchName[0]["BatchName"].'</td>';
                echo '<td>'.$slotTime[0]["Time"].'</td>';
                echo '</tr>';
            }
            else if(count($wedArr)==0)
            {
                echo '<tr>';
                echo '<td rowspan="1">'.$_7thDay.'</td>';
                echo '<td colspan="3" align="center">No Class On This Day</td>';
                echo '</tr>';
            }
            else
            {                
                echo '<tr>';
                echo '<td rowspan="'.count($wedArr).'">'.$_7thDay.'</td>';
                foreach($wedArr as $data)
                {                        
                    $sql = "select BatchName  from batch where `Batch ID`='".$data["Batch Id"]."'";
                    $batchName = getDataFromDB($sql);
                    $sql = "select Time  from slot where Serial='".$data["Slot"]."'";
                    $slotTime = getDataFromDB($sql);
                    echo '<td><a href="Student_Single_Course.php?id='.$data["Course Id"].'">'.$data["Name"].'</a></td>';
                    echo '<td>'.$batchName[0]["BatchName"].'</td>';
                    echo '<td>'.$slotTime[0]["Time"].'</td>';
                    echo '</tr>';
                    echo '<tr>';
                }
                echo '</tr>';
            }//--------------End Wednesday--------------
        }
        //-------------------------Thursday End---------------------------
        
        //-------------------------Friday start---------------------------
        if($nowDay=="Friday")
        {            
            //--------------Start Friday--------------            
            echo '<tr>';
            echo '<td rowspan="1">Today</td>';
            echo '<td colspan="3" align="center">No Class On This Day</td>';
            echo '</tr>';
            //--------------End Friday--------------
            
            //--------------Start Saturday--------------            
            echo '<tr>';
            echo '<td rowspan="1">Tomorrow</td>';
            echo '<td colspan="3" align="center">No Class On This Day</td>';
            echo '</tr>';
            //--------------End Saturday--------------
            if(count($sunArr)==1)//--------------Start Sunday--------------
            {
                echo '<tr>';
                echo '<td rowspan="1">'.$_3rdDay.'</td>';
                $sql = "select BatchName from batch where `Batch ID`='".$sunArr[0]["Batch Id"]."'";
                $batchName = getDataFromDB($sql);
                $sql = "select Time from slot where Serial='".$sunArr[0]["Slot"]."'";
                $slotTime = getDataFromDB($sql);
                echo '<td><a href="Student_Single_Course.php?id='.$sunArr[0]["Course Id"].'">'.$sunArr[0]["Name"].'</a></td>';
                echo '<td>'.$batchName[0]["BatchName"].'</td>';
                echo '<td>'.$slotTime[0]["Time"].'</td>';
                echo '</tr>';
            }
            else if(count($sunArr)==0)
            {
                echo '<tr>';
                echo '<td rowspan="1">'.$_3rdDay.'</td>';
                echo '<td colspan="3" align="center">No Class On This Day</td>';
                echo '</tr>';
            }
            else
            {                
                echo '<tr>';
                echo '<td rowspan="'.count($sunArr).'">'.$_3rdDay.'</td>';
                foreach($sunArr as $data)
                {                        
                    $sql = "select BatchName  from batch where `Batch ID`='".$data["Batch Id"]."'";
                    $batchName = getDataFromDB($sql);
                    $sql = "select Time  from slot where Serial='".$data["Slot"]."'";
                    $slotTime = getDataFromDB($sql);
                    echo '<td><a href="Student_Single_Course.php?id='.$data["Course Id"].'">'.$data["Name"].'</a></td>';
                    echo '<td>'.$batchName[0]["BatchName"].'</td>';
                    echo '<td>'.$slotTime[0]["Time"].'</td>';
                    echo '</tr>';
                    echo '<tr>';
                }
                echo '</tr>';
            }//--------------End Sunday--------------
            if(count($monArr)==1)//--------------Start Monday--------------
            {
                echo '<tr>';
                echo '<td rowspan="1">'.$_4thDay.'</td>';
                $sql = "select BatchName from batch where `Batch ID`='".$monArr[0]["Batch Id"]."'";
                $batchName = getDataFromDB($sql);
                $sql = "select Time from slot where Serial='".$monArr[0]["Slot"]."'";
                $slotTime = getDataFromDB($sql);
                echo '<td><a href="Student_Single_Course.php?id='.$monArr[0]["Course Id"].'">'.$monArr[0]["Name"].'</a></td>';
                echo '<td>'.$batchName[0]["BatchName"].'</td>';
                echo '<td>'.$slotTime[0]["Time"].'</td>';
                echo '</tr>';
            }
            else if(count($monArr)==0)
            {
                echo '<tr>';
                echo '<td rowspan="1">'.$_4thDay.'</td>';
                echo '<td colspan="3" align="center">No Class On This Day</td>';
                echo '</tr>';
            }
            else
            {                
                echo '<tr>';
                echo '<td rowspan="'.count($monArr).'">'.$_4thDay.'</td>';
                foreach($monArr as $data)
                {                        
                    $sql = "select BatchName  from batch where `Batch ID`='".$data["Batch Id"]."'";
                    $batchName = getDataFromDB($sql);
                    $sql = "select Time  from slot where Serial='".$data["Slot"]."'";
                    $slotTime = getDataFromDB($sql);
                    echo '<td><a href="Student_Single_Course.php?id='.$data["Course Id"].'">'.$data["Name"].'</a></td>';
                    echo '<td>'.$batchName[0]["BatchName"].'</td>';
                    echo '<td>'.$slotTime[0]["Time"].'</td>';
                    echo '</tr>';
                    echo '<tr>';
                }
                echo '</tr>';
            }//--------------End Monday--------------
            if(count($tueArr)==1)//--------------Start Tuesday--------------
            {
                echo '<tr>';
                echo '<td rowspan="1">'.$_5thDay.'</td>';
                $sql = "select BatchName from batch where `Batch ID`='".$tueArr[0]["Batch Id"]."'";
                $batchName = getDataFromDB($sql);
                $sql = "select Time from slot where Serial='".$tueArr[0]["Slot"]."'";
                $slotTime = getDataFromDB($sql);
                echo '<td><a href="Student_Single_Course.php?id='.$tueArr[0]["Course Id"].'">'.$tueArr[0]["Name"].'</a></td>';
                echo '<td>'.$batchName[0]["BatchName"].'</td>';
                echo '<td>'.$slotTime[0]["Time"].'</td>';
                echo '</tr>';
            }
            else if(count($tueArr)==0)
            {
                echo '<tr>';
                echo '<td rowspan="1">'.$_5thDay.'</td>';
                echo '<td colspan="3" align="center">No Class On This Day</td>';
                echo '</tr>';
            }
            else
            {                
                echo '<tr>';
                echo '<td rowspan="'.count($tueArr).'">'.$_5thDay.'</td>';
                foreach($tueArr as $data)
                {                        
                    $sql = "select BatchName  from batch where `Batch ID`='".$data["Batch Id"]."'";
                    $batchName = getDataFromDB($sql);
                    $sql = "select Time  from slot where Serial='".$data["Slot"]."'";
                    $slotTime = getDataFromDB($sql);
                    echo '<td><a href="Student_Single_Course.php?id='.$data["Course Id"].'">'.$data["Name"].'</a></td>';
                    echo '<td>'.$batchName[0]["BatchName"].'</td>';
                    echo '<td>'.$slotTime[0]["Time"].'</td>';
                    echo '</tr>';
                    echo '<tr>';
                }
                echo '</tr>';
            }//--------------End Tuesday--------------
            if(count($wedArr)==1)//--------------Start Wednesday--------------
            {
                echo '<tr>';
                echo '<td rowspan="1">'.$_6thDay.'</td>';
                $sql = "select BatchName from batch where `Batch ID`='".$wedArr[0]["Batch Id"]."'";
                $batchName = getDataFromDB($sql);
                $sql = "select Time from slot where Serial='".$wedArr[0]["Slot"]."'";
                $slotTime = getDataFromDB($sql);
                echo '<td><a href="Student_Single_Course.php?id='.$wedArr[0]["Course Id"].'">'.$wedArr[0]["Name"].'</a></td>';
                echo '<td>'.$batchName[0]["BatchName"].'</td>';
                echo '<td>'.$slotTime[0]["Time"].'</td>';
                echo '</tr>';
            }
            else if(count($wedArr)==0)
            {
                echo '<tr>';
                echo '<td rowspan="1">'.$_6thDay.'</td>';
                echo '<td colspan="3" align="center">No Class On This Day</td>';
                echo '</tr>';
            }
            else
            {                
                echo '<tr>';
                echo '<td rowspan="'.count($wedArr).'">'.$_6thDay.'</td>';
                foreach($wedArr as $data)
                {                        
                    $sql = "select BatchName  from batch where `Batch ID`='".$data["Batch Id"]."'";
                    $batchName = getDataFromDB($sql);
                    $sql = "select Time  from slot where Serial='".$data["Slot"]."'";
                    $slotTime = getDataFromDB($sql);
                    echo '<td><a href="Student_Single_Course.php?id='.$data["Course Id"].'">'.$data["Name"].'</a></td>';
                    echo '<td>'.$batchName[0]["BatchName"].'</td>';
                    echo '<td>'.$slotTime[0]["Time"].'</td>';
                    echo '</tr>';
                    echo '<tr>';
                }
                echo '</tr>';
            }
            //--------------End Wednesday--------------
            
            //--------------Start Thursday--------------            
            echo '<tr>';
            echo '<td rowspan="1">'.$_7thDay.'</td>';
            echo '<td colspan="3" align="center">No Class On This Day</td>';
            echo '</tr>';
            //--------------End Thursday--------------
        }
        //-------------------------Friday End---------------------------
        
        //-------------------------Saturday start---------------------------
        if($nowDay=="Saturday")
        { 
            
            //--------------Start Saturday--------------            
            echo '<tr>';
            echo '<td rowspan="1">Today</td>';
            echo '<td colspan="3" align="center">No Class On This Day</td>';
            echo '</tr>';
            //--------------End Saturday--------------
            if(count($sunArr)==1)//--------------Start Sunday--------------
            {
                echo '<tr>';
                echo '<td rowspan="1">Tomorrow</td>';
                $sql = "select BatchName from batch where `Batch ID`='".$sunArr[0]["Batch Id"]."'";
                $batchName = getDataFromDB($sql);
                $sql = "select Time from slot where Serial='".$sunArr[0]["Slot"]."'";
                $slotTime = getDataFromDB($sql);
                echo '<td><a href="Student_Single_Course.php?id='.$sunArr[0]["Course Id"].'">'.$sunArr[0]["Name"].'</a></td>';
                echo '<td>'.$batchName[0]["BatchName"].'</td>';
                echo '<td>'.$slotTime[0]["Time"].'</td>';
                echo '</tr>';
            }
            else if(count($sunArr)==0)
            {
                echo '<tr>';
                echo '<td rowspan="1">Tomorrow</td>';
                echo '<td colspan="3" align="center">No Class On This Day</td>';
                echo '</tr>';
            }
            else
            {                
                echo '<tr>';
                echo '<td rowspan="'.count($sunArr).'">Tomorrow</td>';
                foreach($sunArr as $data)
                {                        
                    $sql = "select BatchName  from batch where `Batch ID`='".$data["Batch Id"]."'";
                    $batchName = getDataFromDB($sql);
                    $sql = "select Time  from slot where Serial='".$data["Slot"]."'";
                    $slotTime = getDataFromDB($sql);
                    echo '<td><a href="Student_Single_Course.php?id='.$data["Course Id"].'">'.$data["Name"].'</a></td>';
                    echo '<td>'.$batchName[0]["BatchName"].'</td>';
                    echo '<td>'.$slotTime[0]["Time"].'</td>';
                    echo '</tr>';
                    echo '<tr>';
                }
                echo '</tr>';
            }//--------------End Sunday--------------
            if(count($monArr)==1)//--------------Start Monday--------------
            {
                echo '<tr>';
                echo '<td rowspan="1">'.$_3rdDay.'</td>';
                $sql = "select BatchName from batch where `Batch ID`='".$monArr[0]["Batch Id"]."'";
                $batchName = getDataFromDB($sql);
                $sql = "select Time from slot where Serial='".$monArr[0]["Slot"]."'";
                $slotTime = getDataFromDB($sql);
                echo '<td><a href="Student_Single_Course.php?id='.$monArr[0]["Course Id"].'">'.$monArr[0]["Name"].'</a></td>';
                echo '<td>'.$batchName[0]["BatchName"].'</td>';
                echo '<td>'.$slotTime[0]["Time"].'</td>';
                echo '</tr>';
            }
            else if(count($monArr)==0)
            {
                echo '<tr>';
                echo '<td rowspan="1">'.$_3rdDay.'</td>';
                echo '<td colspan="3" align="center">No Class On This Day</td>';
                echo '</tr>';
            }
            else
            {                
                echo '<tr>';
                echo '<td rowspan="'.count($monArr).'">'.$_3rdDay.'</td>';
                foreach($monArr as $data)
                {                        
                    $sql = "select BatchName  from batch where `Batch ID`='".$data["Batch Id"]."'";
                    $batchName = getDataFromDB($sql);
                    $sql = "select Time  from slot where Serial='".$data["Slot"]."'";
                    $slotTime = getDataFromDB($sql);
                    echo '<td><a href="Student_Single_Course.php?id='.$data["Course Id"].'">'.$data["Name"].'</a></td>';
                    echo '<td>'.$batchName[0]["BatchName"].'</td>';
                    echo '<td>'.$slotTime[0]["Time"].'</td>';
                    echo '</tr>';
                    echo '<tr>';
                }
                echo '</tr>';
            }//--------------End Monday--------------
            if(count($tueArr)==1)//--------------Start Tuesday--------------
            {
                echo '<tr>';
                echo '<td rowspan="1">'.$_4thDay.'</td>';
                $sql = "select BatchName from batch where `Batch ID`='".$tueArr[0]["Batch Id"]."'";
                $batchName = getDataFromDB($sql);
                $sql = "select Time from slot where Serial='".$tueArr[0]["Slot"]."'";
                $slotTime = getDataFromDB($sql);
                echo '<td><a href="Student_Single_Course.php?id='.$tueArr[0]["Course Id"].'">'.$tueArr[0]["Name"].'</a></td>';
                echo '<td>'.$batchName[0]["BatchName"].'</td>';
                echo '<td>'.$slotTime[0]["Time"].'</td>';
                echo '</tr>';
            }
            else if(count($tueArr)==0)
            {
                echo '<tr>';
                echo '<td rowspan="1">'.$_4thDay.'</td>';
                echo '<td colspan="3" align="center">No Class On This Day</td>';
                echo '</tr>';
            }
            else
            {                
                echo '<tr>';
                echo '<td rowspan="'.count($tueArr).'">'.$_4thDay.'</td>';
                foreach($tueArr as $data)
                {                        
                    $sql = "select BatchName  from batch where `Batch ID`='".$data["Batch Id"]."'";
                    $batchName = getDataFromDB($sql);
                    $sql = "select Time  from slot where Serial='".$data["Slot"]."'";
                    $slotTime = getDataFromDB($sql);
                    echo '<td><a href="Student_Single_Course.php?id='.$data["Course Id"].'">'.$data["Name"].'</a></td>';
                    echo '<td>'.$batchName[0]["BatchName"].'</td>';
                    echo '<td>'.$slotTime[0]["Time"].'</td>';
                    echo '</tr>';
                    echo '<tr>';
                }
                echo '</tr>';
            }//--------------End Tuesday--------------
            if(count($wedArr)==1)//--------------Start Wednesday--------------
            {
                echo '<tr>';
                echo '<td rowspan="1">'.$_5thDay.'</td>';
                $sql = "select BatchName from batch where `Batch ID`='".$wedArr[0]["Batch Id"]."'";
                $batchName = getDataFromDB($sql);
                $sql = "select Time from slot where Serial='".$wedArr[0]["Slot"]."'";
                $slotTime = getDataFromDB($sql);
                echo '<td><a href="Student_Single_Course.php?id='.$wedArr[0]["Course Id"].'">'.$wedArr[0]["Name"].'</a></td>';
                echo '<td>'.$batchName[0]["BatchName"].'</td>';
                echo '<td>'.$slotTime[0]["Time"].'</td>';
                echo '</tr>';
            }
            else if(count($wedArr)==0)
            {
                echo '<tr>';
                echo '<td rowspan="1">'.$_5thDay.'</td>';
                echo '<td colspan="3" align="center">No Class On This Day</td>';
                echo '</tr>';
            }
            else
            {                
                echo '<tr>';
                echo '<td rowspan="'.count($wedArr).'">'.$_5thDay.'</td>';
                foreach($wedArr as $data)
                {                        
                    $sql = "select BatchName  from batch where `Batch ID`='".$data["Batch Id"]."'";
                    $batchName = getDataFromDB($sql);
                    $sql = "select Time  from slot where Serial='".$data["Slot"]."'";
                    $slotTime = getDataFromDB($sql);
                    echo '<td><a href="Student_Single_Course.php?id='.$data["Course Id"].'">'.$data["Name"].'</a></td>';
                    echo '<td>'.$batchName[0]["BatchName"].'</td>';
                    echo '<td>'.$slotTime[0]["Time"].'</td>';
                    echo '</tr>';
                    echo '<tr>';
                }
                echo '</tr>';
            }
            //--------------End Wednesday--------------
            
            //--------------Start Thursday--------------            
            echo '<tr>';
            echo '<td rowspan="1">'.$_6thDay.'</td>';
            echo '<td colspan="3" align="center">No Class On This Day</td>';
            echo '</tr>';
            //--------------End Thursday--------------           
            //--------------Start Friday--------------            
            echo '<tr>';
            echo '<td rowspan="1">'.$_7thDay.'</td>';
            echo '<td colspan="3" align="center">No Class On This Day</td>';
            echo '</tr>';
            //--------------End Friday--------------
        }
        //-------------------------Saturday End---------------------------
        
                        echo '</table>
                    </div>
                </td>
                <td class="w3-cell-top" style="padding-left:0px;width:20%;">
                    <div class="w3-container w3-blue">
                        <h4>Notice Board</h4>
                    </div>
                    <div class="w3-container w3-border w3-padding-16">
                        <table class="notice" border=2 frame=hsides rules=rows>';
                            $sql = "select `Course Id` from course where `Batch Id`='".$batch[0]["Batch"]."'";
                            $courseResult = getDataFromDB($sql);
                            foreach($courseResult as $info)
                            {
                                $sql = "select * from notice where `Course id`='".$info["Course Id"]."'";
                                $noticeResult = getDataFromDB($sql);
                                foreach($noticeResult as $post)
                                {
                                    echo "<tr>";
                                        echo "<td style='width:300px;'>";
                                            echo $post["Subject"];
                                        echo "</td>";
                                    echo "</tr>";
                                    
                                }
                            }
                        echo '</table>
                        <a href="Students_Notices.php"><button class="w3-button w3-blue">Archive</button></a>


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

</body>

</html>';
}
else{
	header("Location: ../index.html?error=access restricted");
}
?>

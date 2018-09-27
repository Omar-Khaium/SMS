<?php
require("Database.php");
session_start();
    if(isset($_SESSION["flag"]) && $_SESSION["flag"]=="success"){
    $sql = "select * from complain where Status='Pending';";
        $result = getDataFromDB($sql);
        
    echo '<!DOCTYPE html>
<html>
<title>Pending Complain</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
    td {
        padding: 1px 35px;
    }

    table.grade td {
        padding-left: 0px;
        width: 40%;
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
        width: 50%;
    }

    select {
        font-style: bold;
        padding-left: 5px;
        margin: 5px;
        border-radius: 5px;
        border: .5px solid gray;
        background-color: snow;
        width: 120%;
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
    <table style="margin-top: 50px;margin-left: 50px;width:90%">

        <div class="w3-container w3-card w3-content w3-border-left" style="max-width:500px">
            <tr>
                <td class="w3-cell-top" style="padding-left:150px;">
                    <div class="w3-container w3-blue">
                        <h4>Pending Complain</h4>
                    </div>
                    <div class="w3-container w3-border w3-padding-16">
                        <!-------------------------Course start------------------------------->
                        <div class="w3-container w3-border w3-padding-16">
                            <div class="w3-container">
                                <ul class="w3-ul w3-card-4">';        
        if(count($result)==0)
        {
            echo '
            <li class="w3-bar">
            <div class="w3-bar-item">
                <span style="color:red;cursor: pointer;">No pending Complain</span>
            </div>
                </li>';
        }
        else
        {
            foreach($result as $data)
            {
                echo '<li class="w3-bar" id="Show-'.$data["Serial"].'">
                        <div class="w3-bar-item">
                            <span style="color:red;cursor: pointer;" id="Serial-'.$data["Serial"].'" class="w3-xlarge" onclick="showDesc(this)">'.$data["Subject"].'</span><br>';

            $sql = "select Name from tcr_profile where Id='".$data["Teacher Id"]."';";
            $teacher = getDataFromDB($sql);

                echo '
                            <span class="w3-large">From&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;'.$teacher[0]["Name"].'(<span>'.$data["Teacher Id"].')</span><br>';

            $sql = "select Std_Name from std_profile where Std_id='".$data["Student Id"]."';";
            $student = getDataFromDB($sql);

                echo '
                            <span class="w3-large">To&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;'.$student[0]["Std_Name"].'</span>(<span>'.$data["Student Id"].')</span>
                        </div>
                        <div style="float:right;margin-top:3%">
                            <input onclick="TakeAction(this)" class="w3-radio" type="radio" value="Approve" name="'.$data["Serial"].'-'.$data["Complain Id"].'" id="'.$data["Serial"].'-'.$data["Complain Id"].'"><span style="color:green;"><b>Approve</b></span>&nbsp;&nbsp;&nbsp;&nbsp;
                            <input onclick="TakeAction(this)" class="w3-radio" type="radio" value="Reject" name="'.$data["Serial"].'-'.$data["Complain Id"].'" id="'.$data["Serial"].'-'.$data["Complain Id"].'"><span style="color:red;"><b>Reject</b></span>
                        </div>
                    </li>
                ';
            }
        }
        echo '
                                        
                                </ul>
                            </div>
                        </div>
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
    <script>
        function TakeAction(element) {
            var arr = element.id.split("-");
            if(element.value=="Approve"){
                var url = "submitAction2.php?id="+arr[1]+"&status=1";
            }
            else if(element.value=="Reject"){
                var url = "submitAction2.php?id="+arr[1]+"&status="+2;
            }
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {                
                document.getElementById("Show-"+arr[0]).style.display = "none";
            }
            };
            xhttp.open("GET", url, true);
            xhttp.send();
        }
        function showDesc(element){
            var arr = element.id.split("-");
            var url = "getDesc2.php?id="+arr[1];
        
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                
                alert(this.responseText);
            }
            };
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

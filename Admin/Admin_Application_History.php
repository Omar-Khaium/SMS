<?php
require("Database.php");
session_start();
    if(isset($_SESSION["flag"]) && $_SESSION["flag"]=="success"){
    $sql = "select * from applcation";
        $result = getDataFromDB($sql);
        
    echo '<!DOCTYPE html>
<html>
<title>Application History</title>
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
                        <h4>Application History</h4>
                    </div>
                    <div class="w3-container w3-border w3-padding-16">
                        <!-------------------------Course start------------------------------->
                        <div class="w3-container w3-border w3-padding-16">
                            <div class="w3-container">
                                <ul class="w3-ul w3-card-4">';        
        foreach($result as $data)
        {
            echo '<li class="w3-bar" id="Show-'.$data["Serial"].'">
                    <div class="w3-bar-item">
                        <span style="color:red;cursor: pointer;" id="Serial-'.$data["Serial"].'" class="w3-xlarge" onclick="showDesc(this)">'.$data["Subject"].'</span><br>';
            
        $sql = "select Name from tcr_profile where Id='".$data["User Id"]."';";
        $teacher = getDataFromDB($sql);
            
            echo '
                        <span class="w3-large">'.$teacher[0]["Name"].'</span><br>
                        <span>'.$data["User Id"].'</span>
                    </div>
                    <div style="float:right;margin-top:3%">
                        ';
            if($data["Status"]=="Approved")
            {
                echo '<span style="background-color:green;padding:5px;color:white;border-radius:5px;"><b>Approved</b></span>';
            }
            else if($data["Status"]=="Pending")
            {
                echo '<span style="background-color:grey;padding:5px;color:white;border-radius:5px;"><b>Pending</b></span>';
            }
            else if($data["Status"]=="Rejected")
            {
                echo '<span style="background-color:red;padding:5px;color:white;border-radius:5px;"><b>Rejected</b></span>';
            }'
                    </div>
                </li>
            ';
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
        function showDesc(element){
            var arr = element.id.split("-");
            var url = "getDesc.php?id="+arr[1];
        
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

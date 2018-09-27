<?php
require("Database.php");
session_start();
    if(isset($_SESSION["flag"]) && $_SESSION["flag"]=="success"){
        
        $sql = "select * from batch;";
        $result = getDataFromDB($sql);
        if(isset($_SESSION['btc_id']))
        {
            $sql = "SELECT * FROM batch where `Batch ID`='".$_SESSION["btc_id"]."';";
            $resultBTC = getDataFromDB($sql);
            echo "Found";
        }
        
    echo '<!DOCTYPE html>
<html>
<title>Edit Batch</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    td {
        padding: 10px 25px;
    }

    table.card {
        border: .5px solid gray;
    }

    table.card td {
        padding: 10px 50px;
    }

    body {
        background-color: whitesmoke;
    }

    a {
        color: deepskyblue;
        text-decoration: none;
    }

    input {
        width: 100%;
    }

    hr {
        border: 0.5px solid gray;
        margin-top: auto;
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
    <table style="margin: 0 auto;margin-top: 5%;width:80%;">
        <form action="editBatch.php" method="post">
        <div class="w3-container w3-card w3-content w3-border-left" style="width:100%;">
            <tr>
                <td class="w3-cell-top">
                <div>
                    <input style="margin: 0 auto;width:25%;" name="search" id="search" onkeyup="showData(this)" class="w3-input w3-border w3-round" type="text" placeholder="Enter a Batch ID to search">
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
                        <h6 id="msg" style="color:limegreen;">*Batch Updated Successfully</h6>
                    </div>';
                    break;
                case "Failed":                    
                    echo '<div align="center">
                        <h6 id="msg" style="color:orangered;">*Batch Updation Failed</h6>
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
                        <h4>Edit Batch</h4>
                    </div>
                    <table class="profile" style="border:1px solid grey;width:100%;">
                    <tr>
                            <td align="center" colspan="3" style="width:100%;">
                                <select onchange="getData()" style="width:100%;" class="w3-select w3-border w3-round" name="Batch" id="Batch">'; 
        echo '<option value="0" disabled selected>Choose a Batch</option>';        
        foreach($result as $data)
        {
            echo '<option value='.$data["Batch ID"].'>'.$data["BatchName"].'</option>';
        }
        
        echo '</select>
        </td>
                        </tr>
                        <tr>
                        <td colspan="3"><hr>
                        </td>
                        </tr>';
        //-------------------------for updated info------------------Starts---------
        if(isset($_SESSION["btc_id"]))
        {
            echo'                        
                        <tr>
                            <td style="width:5%;">ID</td>
                            <td style="width:2%;">:</td>
                            <td style="width:50%;"><input type="text" id="batch_id" name="batch_id" class="w3-input w3-border w3-round" style="width:100%;" value='.$resultBTC[0]["Batch ID"].' readonly></td>
                        </tr>
                        <tr>
                            <td style="width:5%;">Name</td>
                            <td style="width:2%;">:</td>
                            <td style="width:50%;"><input type="text" value='.$resultBTC[0]["BatchName"].' id="batch_name" name="batch_name" class="w3-input w3-border w3-round" style="width:100%;"></td>
                        </tr>
                        <tr>
                            <td style="width:5%;">Class</td>
                            <td style="width:2%;">:</td>
                            <td style="width:50%;">
                            <select onchange="generateID()" class="w3-select w3-border w3-round" name="batch_class" id="batch_class">
                                    <option value="0" disabled selected>Choose a Class</option>';
                                switch($resultBTC[0]["Class"])
                                    {
                                        case 6:
                                            echo '<option value="6" selected>Class 6</option>
                                            <option value="7">Class 7</option>
                                            <option value="8">Class 8</option>
                                            <option value="9">Class 9</option>
                                            <option value="10">Class 10</option>';
                                            break;
                                        case 7:
                                            echo '<option value="6">Class 6</option>
                                            <option value="7" selected>Class 7</option>
                                            <option value="8">Class 8</option>
                                            <option value="9">Class 9</option>
                                            <option value="10">Class 10</option>';
                                            break;
                                        case 8:
                                            echo '<option value="6">Class 6</option>
                                            <option value="7">Class 7</option>
                                            <option value="8" selected>Class 8</option>
                                            <option value="9">Class 9</option>
                                            <option value="10">Class 10</option>';
                                            break;
                                        case 9:
                                            echo '<option value="6">Class 6</option>
                                            <option value="7">Class 7</option>
                                            <option value="8">Class 8</option>
                                            <option value="9" selected>Class 9</option>
                                            <option value="10">Class 10</option>';
                                            break;
                                        case 10:
                                            echo '<option value="6">Class 6</option>
                                            <option value="7">Class 7</option>
                                            <option value="8">Class 8</option>
                                            <option value="9">Class 9</option>
                                            <option value="10" selected>Class 10</option>';
                                            break;
                                    }
            unset($_SESSION['btc_id']);
                                  
                                echo '
                                            </select>
                            </td>
                        </tr>
                        <tr>
                            <td align="center" colspan="3" style="width:100%;">
                            <input type="submit" id="batch_submit" name="batch_submit" onclick="return check()" class="w3-input w3-border w3-round w3-green" style="width:100%;" value="Submit">
                            </td>
                        </tr>';
        }
        //-------------------------for updated info-------------------ends----------
        
        else
        {
            echo'
                        <tr>
                            <td style="width:5%;">ID</td>
                            <td style="width:2%;">:</td>
                            <td style="width:50%;"><input type="text" id="batch_id" name="batch_id" class="w3-input w3-border w3-round" style="width:100%;" readonly></td>
                        </tr>
                        <tr>
                            <td style="width:5%;">Name</td>
                            <td style="width:2%;">:</td>
                            <td style="width:50%;"><input type="text" id="batch_name" name="batch_name" class="w3-input w3-border w3-round" style="width:100%;" placeholder="Enter ther Batch Name Here."></td>
                        </tr>
                        <tr>
                            <td style="width:5%;">Class</td>
                            <td style="width:2%;">:</td>
                            <td style="width:50%;">
                            <select class="w3-select w3-border w3-round" name="batch_class" id="batch_class">
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
                            <td align="center" colspan="3" style="width:100%;"><input type="submit" id="batch_submit" name="batch_submit" onclick="return check()"class="w3-input w3-border w3-round w3-blue" style="width:100%;" value="Update">
                            </td>
                        </tr>';
        }
        echo '
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
            
            var id = document.getElementById("Batch").value;
            var url = "serverBatch.php?id="+id;
        
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                
                var record = JSON.parse(this.responseText);
                document.getElementById("batch_id").value = record[0]["Batch ID"];
                document.getElementById("batch_name").value = record[0]["BatchName"];
                document.getElementById("batch_class").value=record[0]["Class"];
            }
            };
            xhttp.open("GET", url, true);
            xhttp.send();
        }
        function check()
        {
            var flag = false;
            var id = document.getElementById("batch_id").value.length;
            var name = document.getElementById("batch_name").value.length;
            var Class = document.getElementById("batch_class").value;
            if(id==0)
            {
                document.getElementById("msg").innerHTML = "*Choose a Class to Generate ID";
                document.getElementById("msg").style.color = "red";
                return false;
            }
            else if(name==0)
            {
                document.getElementById("msg").innerHTML = "*Name cannot be empty";
                document.getElementById("msg").style.color = "red";
                return false;
            }
            else if(id==0)
            {
                document.getElementById("msg").innerHTML = "*Choose a Class to Generate ID";
                document.getElementById("msg").style.color = "red";
                return false;
            }
            else
            {
                if(confirm("Are you sure"))
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
    function showData(element) {

        var id = element.value;
        var url = "serverBatch.php?id=" + id;

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var record = JSON.parse(this.responseText);
                if (record.length > 0) {
                    document.getElementById("batch_id").value = record[0]["Batch ID"];
                    document.getElementById("batch_name").value = record[0]["BatchName"];
                    document.getElementById("batch_class").value=record[0]["Class"];
                } else {

                    document.getElementById("batch_id").value = "";
                    document.getElementById("batch_name").value = "";
                    document.getElementById("batch_class").value= 0;
                    document.getElementById("Batch").options[0].selected = true;
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

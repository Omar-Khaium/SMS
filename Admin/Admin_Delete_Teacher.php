<?php
require("Database.php");
session_start();
    if(isset($_SESSION["flag"]) && $_SESSION["flag"]=="success"){
        $sql = "select distinct Department from tcr_profile;";
        $resultDepartment = getDataFromDB($sql);
        $sql = "select distinct Designation from tcr_profile;";
        $resultDesignation = getDataFromDB($sql);
        $sql = "select * from tcr_profile;";
        $resultName = getDataFromDB($sql);
        
    echo '<!DOCTYPE html>
<html>
<title>Delete Teacher</title>
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
    <table style="margin:0 auto;margin-top: 5%;width:80%;">
        <form action="delete_tcr.php" method="post">
        <div class="w3-container w3-card w3-content w3-border-left" style="max-width:250px">
            <tr>
                <!-------------------------Routine start------------------------------->
                <td class="w3-cell-top">
                <td class="w3-cell-top"><div>
                    <input style="margin: 0 auto;width:25%;" name="search" id="search" onkeyup="showData(this)" class="w3-input w3-border w3-round" type="text" placeholder="Enter a Teacher ID to search">
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
                    <div class="w3-container w3-red">
                        <h4>Delete Teacher</h4>
                    </div>
                    <table class="profile" style="border:1px solid grey;">
                        <tr>
                            <td colspan="4">
                                <select style="width:20%;" onchange="nameByDept(this)" class="w3-select w3-border w3-round" name="Department id="Department">'; 
        echo '<option value="0" disabled selected>Choose a Department</option>';        
        foreach($resultDepartment as $data)
        {
            switch($data["Department"])
            {
                case 1:
                    echo '<option value='.$data["Department"].'>Bangla</option>';
                    break;
                case 2:
                    echo '<option value='.$data["Department"].'>English</option>';
                    break;
                case 3:
                    echo '<option value='.$data["Department"].'>Mathematics</option>';
                    break;
                case 4:
                    echo '<option value='.$data["Department"].'>Science</option>';
                    break;
                case 5:
                    echo '<option value='.$data["Department"].'>Commerce</option>';
                    break;
                case 6:
                    echo '<option value='.$data["Department"].'>Arts</option>';
                    break;
            }
            
        }
        
        echo '</select>
                                <select style="width:20%;margin-left:3%;" onchange="nameByDesg(this)" class="w3-select w3-border w3-round" name="Designation" id="Designation">'; 
        echo '<option value="0" disabled selected>Choose a Designation</option>';        
        foreach($resultDesignation as $data)
        {
            switch($data["Designation"])
            {
                case 1:
                    echo '<option value='.$data["Designation"].'>Senior Teacher</option>';
                    break;
                case 2:
                    echo '<option value='.$data["Designation"].'>Junior Teacher</option>';
                    break;
                case 3:
                    echo '<option value='.$data["Designation"].'>Part-time Teacher</option>';
                    break;
                case 4:
                    echo '<option value='.$data["Designation"].'>Guest Teacher</option>';
                    break;
            }
        }
        
        echo '</select>
                                <select style="width:50%;margin-left:3%;" onchange="getData(this)" class="w3-select w3-border w3-round" id="Name">'; 
        echo '<option value="0" disabled selected>Choose a Teacher Name</option>';
        foreach($resultName as $data)
        {
            echo '<option value='.$data["Id"].'>'.$data["Name"].'( ID: '.$data["Id"].' )</option>';
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
                            <td style="width:20%;">
                                ID
                            </td>
                            <td style="width:10%;">
                                :
                            </td>
                            <td style="width:100%;">
                                <input name="tcr_id" id="tcr_id" class="w3-input w3-border w3-round" type="text" readonly>
                            </td>
                            <td rowspan="3" style="padding-left:5px;">
                                <div class="w3-card-1">
                                    <img src="../images/img_avatar3.png" alt="Profile Picture" style="width:100px;height:100px;" id="profile_picture" name="profile_picture">
                                    <br><input type="submit" onclick="return check()" class="w3-button w3-red w3-border w3-round" style="width: 100px;" name="submit" value="Delete">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:20%;">
                                Name
                            </td>
                            <td style="width:10%;">
                                :
                            </td>
                            <td style="width:100%;">
                                <input name="tcr_name" id="tcr_name" class="w3-input w3-border w3-round" type="text">
                            </td>
                        </tr>
                       
                        <tr>
                            <td style="width:20%;">
                                Email
                            </td>
                            <td style="width:10%;">
                                :
                            </td>
                            <td style="width:100%;">
                                <input name="tcr_email" id="tcr_email" class="w3-input w3-border w3-round" type="email">
                            </td>
                        </tr>
                        <tr>
                            <td style="width:20%;">
                                Mobile
                            </td>
                            <td style="width:10%;">
                                :
                            </td>
							
                            <td style="width:25%">
                                <input name="tcr_mobile" id="tcr_mobile" class="w3-input w3-border w3-round" type="text">
                            </td>
							 <td style="padding-left:50px;"></td>
                        </tr>
						
						 <tr>
                            <td style="width:20%;">
                                Department
                            </td>
                            <td style="width:10%;">
                                :
                            </td>
                            <td style="width:25%;">
                                <select class="w3-select w3-border w3-round" name="tcr_department" id="tcr_department">
                                    <option value="0" disabled selected>Choose a Department</option>
                                    <option value="1">Bangla</option>
                                    <option value="2">English</option>
                                    <option value="3">Mathmatics</option>
                                    <option value="4">Science</option>
                                    <option value="5">Commerce</option>
                                    <option value="6">Arts</option>
                                  
                                </select>
                            </td>
                        </tr>
						
						
						<tr>
                            <td style="width:20%;">
                                Designation
                            </td>
                            <td style="width:10%;">
                                :
                            </td>
                            <td style="width:25%;">
                                <select class="w3-select w3-border w3-round" name="tcr_designation" id="tcr_designation">
                                    <option value="0" disabled selected>Choose a Designation</option>
                                    <option value="1">Senior Teacher</option>
                                    <option value="2">Junior Teacher</option>
                                    <option value="3">Part-time Teacher</option>
                                    <option value="4">Guest Teacher</option>
                                  
                                </select>
                            </td>
							
                        </tr>
                        <tr>
                            <td style="width:20%;">
                                Salary
                            </td>
                            <td style="width:10%;">
                                :
                            </td>
                            <td style="width:25%">
                                <input name="tcr_salary" id="tcr_salary" class="w3-input w3-border w3-round" type="number">
                            </td>
                        </tr>
                       
                        <tr>
                            <td style="width:20%;">
                                Date Of Birth
                            </td>
                            <td style="width:10%;">
                                :
                            </td>
                            <td style="width:25%;">
                                <input type="date" class="w3-input w3-border w3-round" name="tcr_dob" id="tcr_dob">
                            </td>
                        </tr>
                        <tr>
                            <td style="width:20%;">
                                Blood Group
                            </td>
                            <td style="width:10%;">
                                :
                            </td>
                            <td style="width:25%;">
                                <select class="w3-select w3-border w3-round" name="tcr_bg" id="tcr_bg">
                                    <option value="" disabled selected>Choose a Blood Group</option>
                                    <option value="1">A positive</option>
                                    <option value="2">A negetive</option>
                                    <option value="3">B positive</option>
                                    <option value="4">B negetive</option>
                                    <option value="5">AB positive</option>
                                    <option value="6">AB negetive</option>
                                    <option value="7">O positive</option>
                                    <option value="8">O negetive</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:20%;">
                                Gender
                            </td>
                            <td style="width:10%;">
                                :
                            </td>
                            <td style="width:25%;">
                                <input class="w3-radio" type="radio" name="tcr_gender" id="male" value="male" checked>
                                <label>Male</label>

                                <input class="w3-radio" type="radio" name="tcr_gender" id="female" value="female">
                                <label>Female</label>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:20%;">
                                Religion
                            </td>
                            <td style="width:10%;">
                                :
                            </td>
                            <td style="width:25%;">
                                <select class="w3-select w3-border w3-round" name="tcr_religion" id="tcr_religion"">
                                    <option value="0" disabled selected>Choose a Religion</option>
                                    <option value="1"> Islam</option>
                                    <option value="2"> Hindu</option>
                                    <option value="3"> Buddhist</option>
                                    <option value="4"> Christian</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:20%;">
                                Current Balance
                            </td>
                            <td style="width:10%;">
                                :
                            </td>
                            <td style="width:25%">
                                <input name="tcr_ballance" id="tcr_ballance" class="w3-input w3-border w3-round" type="text">
                            </td>
                        </tr>
                        <tr>
                            <td style="width:20%;">
                                Address
                            </td>
                            <td style="width:10%;">
                                :
                            </td>
                            <td style="width:25%">
                                <input name="tcr_address" id="tcr_address" class="w3-input w3-border w3-round" type="text">
                            </td>
                        </tr>
                    </table>
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
        function getData(element) {
            
            var id = document.getElementById("Name").value;
            var url = "serverTcr.php?id="+id;
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                
                var record = JSON.parse(this.responseText);
                document.getElementById("tcr_id").value = record[0]["Id"];
                document.getElementById("tcr_name").value = record[0]["Name"];             
                document.getElementById("tcr_email").value = record[0]["Email"];
				document.getElementById("tcr_mobile").value = record[0]["Mobile"];
				document.getElementById("tcr_department").value = record[0]["Department"];
				document.getElementById("tcr_designation").value = record[0]["Designation"];
				document.getElementById("tcr_salary").value = record[0]["Salary"];               
                document.getElementById("tcr_dob").value = record[0]["DOB"];
                document.getElementById("tcr_bg").value = record[0]["Blood group"];
                document.getElementById("tcr_address").value = record[0]["Address"];
                document.getElementById("tcr_religion").value = record[0]["Religion"];
                document.getElementById(record[0]["Gender"]).checked = true;
                document.getElementById("tcr_ballance").value = record[0]["Current Balance"];
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
        function nameByDept(element)
        {
            var dept = element.value;
            var url = "getInfo.php?id="+dept+"&type=Department";
        
            
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
                    opt[i].value = record[i-1]["Id"];
                    opt[i].innerHTML = record[i-1]["Name"] + "( ID : "+record[i-1]["Id"]+")";
                    dropdown.appendChild(opt[i]);
                    i++;
                    
                }
                dropdown.options[0].selected = true;
                document.getElementById("Designation").options[0].selected = true;
            }
            };
            xhttp.open("GET", url, true);
            xhttp.send();
        }
        function nameByDesg(element)
        {
            var desg = element.value;
            var url = "getInfo.php?id="+desg+"&type=Designation";
        
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
                    opt[i].value = record[i-1]["Id"];
                    opt[i].innerHTML = record[i-1]["Name"] + "( ID : "+record[i-1]["Id"]+")";
                    dropdown.appendChild(opt[i]);
                    i++;                    
                }
                dropdown.options[0].selected = true;
                document.getElementById("Department").options[0].selected = true;
            }
            };
            xhttp.open("GET", url, true);
            xhttp.send();
        }

        function check()
        {
            var flag = false;
            var id = document.getElementById("tcr_id").value.length;
            var name = document.getElementById("tcr_name").value.length;
            var email = document.getElementById("tcr_email").value.length;
            var email2 = document.getElementById("tcr_email").value;
            var mobile = document.getElementById("tcr_mobile").value.length;
            var deparment = document.getElementById("tcr_department");
            var designation = document.getElementById("tcr_designation");
            var salary = document.getElementById("tcr_salary").value.length;
            var dob = document.getElementById("tcr_dob").value.length;
            var bg = document.getElementById("tcr_bg");
            var religion = document.getElementById("tcr_religion");
            var address = document.getElementById("tcr_address").value.length;
            if(id == 0)
            {
                document.getElementById("msg").innerHTML = "*Choose a Teacher to procced";
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
            else if(mobile<11)
            {
                document.getElementById("msg").innerHTML = "*Mobile number should be atleast 11 character long";
                document.getElementById("msg").style.color = "red";
                return false;
            }
            else if(deparment.value==0)
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
                document.getElementById("msg").innerHTML = "*Salary cannot be empty";
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

        function showData(element) {
            
            var id = element.value;
            var url = "serverTcr.php?id="+id;
        
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var record = JSON.parse(this.responseText);
                if(record.length > 0)
                {
                    document.getElementById("tcr_id").value = record[0]["Id"];
                    document.getElementById("tcr_name").value = record[0]["Name"]; document.getElementById("tcr_email").value = record[0]["Email"]; document.getElementById("tcr_mobile").value = record[0]["Mobile"]; document.getElementById("tcr_department").value = record[0]["Department"]; document.getElementById("tcr_designation").value = record[0]["Designation"]; document.getElementById("tcr_salary").value = record[0]["Salary"]; document.getElementById("tcr_dob").value = record[0]["DOB"]; document.getElementById("tcr_bg").value = record[0]["Blood group"]; document.getElementById("tcr_address").value = record[0]["Address"]; document.getElementById("tcr_religion").value = record[0]["Religion"]; document.getElementById(record[0]["Gender"]).checked = true; document.getElementById("tcr_ballance").value = record[0]["Current Balance"]; if(record[0]["Photo"] != null) { document.getElementById("profile_picture").src = record[0]["Photo"]; } else { document.getElementById("profile_picture").src = "../images/img_avatar3.png"; }
                }
                else
                {
                    document.getElementById("tcr_id").value = "";
                    document.getElementById("tcr_name").value = "";             
                    document.getElementById("tcr_email").value = "";
                    document.getElementById("tcr_mobile").value = "";
                    document.getElementById("tcr_department").value = 0;
                    document.getElementById("tcr_designation").value = 0;
                    document.getElementById("tcr_salary").value = "";               
                    document.getElementById("tcr_dob").value = "";
                    document.getElementById("tcr_bg").value = 0;
                    document.getElementById("tcr_address").value = "";
                    document.getElementById("tcr_religion").value = 0;
                    document.getElementById(record[0]["Gender"]).checked = true;
                    document.getElementById("tcr_ballance").value = "";
                    document.getElementById("profile_picture").src = "../images/img_avatar3.png";
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

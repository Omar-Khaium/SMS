<?php
session_start();
    if(isset($_SESSION["flag"]) && $_SESSION["flag"]=="success"){
    echo '<!DOCTYPE html>
<html>
<title>Payment Transaction</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>

    body {
        background-color: whitesmoke;
    }
 .box { margin:0 auto; padding : 0; width:75%; }
 .box2 { margin:0 auto; margin-top:4%; padding : 0; width:75%; }
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
    <div class="w3-container box2">';
                if(isset($_REQUEST["info"]))
                {
                    switch($_REQUEST["info"])
                    {
                        case "input_error":                    
                            echo '<div align="center">
                                <h6 id="msg" style="color:orangered;">*Fill all the fields correctly</h6>
                            </div>';
                            break;
                        case "Successfull":                    
                            echo '<div align="center">
                                <h6 id="msg" style="color:limegreen;">*Transaction Successful</h6>
                            </div>';
                            break;
                        case "Failed":                    
                            echo '<div align="center">
                                <h6 id="msg" style="color:orangered;">*Transaction Failed</h6>
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
    </div>
        <div class="w3-container box w3-card" >
                <!-------------------------Routine start------------------------------->
                    <div class="w3-container w3-blue">
                        <h4>Transaction</h4>
                    </div>
                    <div class="w3-container w3-border w3-padding-16">
                        <br>

                        <form action="transaction.php" method="post" class="w3-container w3-round w3-card-4 w3-light-grey w3-text-blue w3-margin">

                            <div class="w3-row w3-section">
                                <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user"></i></div>
                                <div class="w3-rest">
                                    <input class="w3-input w3-round w3-border" onkeyup="getName(this)" name="user_id" id="user_id" type="text" placeholder="User ID">
                                </div>
                            </div>
                            
                            <div class="w3-row w3-section">
                                <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user"></i></div>
                                <div class="w3-rest">
                                    <input class="w3-input w3-round w3-border" name="user_name" id="user_name" type="text" placeholder="User Name" readonly>
                                </div>
                            </div>
                            
                            <div class="w3-row w3-section">
                                <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-envelope-o"></i></div>
                                <div class="w3-rest">
                                    <select class="w3-select w3-round w3-border" id="payment_category" name="payment_category">
                                      <option value="0" disabled selected>Payment Type</option>
                                    </select>
                                </div>
                            </div>

                            <div class="w3-row w3-section">
                                <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-pencil"></i></div>
                                <div class="w3-rest">
                                    <input id="total_amount" class="w3-input w3-round w3-border" name="total_amount" type="number" placeholder="Amount to be paid">
                                </div>
                            </div>

                            <div class="w3-row w3-section">
                                <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-pencil"></i></div>
                                <div class="w3-rest">
                                    <input id="discount_amount" class="w3-input w3-round w3-border" name="discount_amount" type="number" placeholder="Discount" onkeyup="Discount()">
                                </div>
                            </div>

                            <div class="w3-row w3-section">
                                <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-pencil"></i></div>
                                <div class="w3-rest">
                                    <input id="amount_paid" class="w3-input w3-round w3-border" name="amount_paid" type="number" placeholder="Total Amount" disabled>
                                </div>
                            </div>

                            <input type="submit" onclick="return check()" class="w3-input w3-round w3-border w3-button w3-block w3-section w3-blue w3-ripple w3-padding" value="Submit">

                        </form>
                    </div>
        </div>
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
    <script>
        function setCategory() {
            var cat = document.getElementById("payment_category");
            var len = cat.options.length;
            while (cat.options.length > 0) 
            {                
                cat.remove(0);
            }
            var type = document.getElementById("user_type").value;
            
            if(type==1){
                var opt1 = document.createElement("option");
                opt1.value = 1;
                opt1.innerHTML = "Select A Category";
                cat.appendChild(opt1);
                var opt2 = document.createElement("option");
                opt2.value = 2;
                opt2.innerHTML = "Semester Fee";
                cat.appendChild(opt2);
                var opt3 = document.createElement("option");
                opt3.value = 3;
                opt3.innerHTML = "Exam Fee";
                cat.appendChild(opt3);
            }
            else if(type==2){
                var opt1 = document.createElement("option");
                opt1.value = 1;
                opt1.innerHTML = "Select A Category";
                cat.appendChild(opt1);
                var opt2 = document.createElement("option");
                opt2.value = 2;
                opt2.innerHTML = "Transport Fee";
                cat.appendChild(opt2);
                var opt3 = document.createElement("option");
                opt3.value = 3;
                opt3.innerHTML = "Utility Fee";
                cat.appendChild(opt3);
            }
            cat.options[0].disabled = true;
        }
    </script>
    <script>
        function Discount() {
            var x = document.getElementById("discount_amount").value;
            var y = document.getElementById("total_amount").value;
            var amount = y - (y * (x/100));
            document.getElementById("amount_paid").value = amount;
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
        function getName(element)
        {
            var id = element.value;
            if(id.length > 3)
            {
                var type  = id.substring(0, 3);
                if(type=="STD")
                {
                    var url = "getInfo.php?id="+id+"&type=Student";
                }
                else if(type=="TCR")
                {
                    var url = "getInfo.php?id="+id+"&type=Teacher";
                }
                else
                {           
                    document.getElementById("user_name").value = ""; 
                    var dropdown = document.getElementById("payment_category"); 
                    while(dropdown.options.length > 1)
                    {
                        dropdown.remove(1); 
                    }
                }
            }
            else
            {           
                document.getElementById("user_name").value = ""; 
                var dropdown = document.getElementById("payment_category"); 
                while(dropdown.options.length > 1)
                {
                    dropdown.remove(1); 
                }
            }
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {                
                var record = JSON.parse(this.responseText);
                if(record.length  > 0)
                {
                    if(type=="STD")
                    {
                        document.getElementById("user_name").value = record[0]["Std_Name"];
                        var dropdown = document.getElementById("payment_category");
                        while (dropdown.options.length > 1) 
                        {                
                            dropdown.remove(1);
                        }
                        var opt1 = document.createElement("option");
                        opt1.value = 1;
                        opt1.innerHTML = "Admission Fee";
                        dropdown.appendChild(opt1);
                        
                        var opt2 = document.createElement("option");
                        opt2.value = 2;
                        opt2.innerHTML = "Tution Fee";
                        dropdown.appendChild(opt2);
                        
                        var opt3 = document.createElement("option");
                        opt3.value = 3;
                        opt3.innerHTML = "Exam Fee";
                        dropdown.appendChild(opt3);
                        
                        dropdown.options[0].selected = true;
                    }
                    else if(type=="TCR")
                    {
                        document.getElementById("user_name").value = record[0]["Name"];
                        var dropdown = document.getElementById("payment_category");
                        while (dropdown.options.length > 1) 
                        {                
                            dropdown.remove(1);
                        }
                        var opt1 = document.createElement("option");
                        opt1.value = 1;
                        opt1.innerHTML = "Salary";
                        dropdown.appendChild(opt1);
                        
                        var opt2 = document.createElement("option");
                        opt2.value = 2;
                        opt2.innerHTML = "Bonus";
                        dropdown.appendChild(opt2);
                        
                        dropdown.options[0].selected = true;
                    }                    
                }
                else
                {           
                    document.getElementById("user_name").value = ""; 
                    var dropdown = document.getElementById("payment_category"); 
                    while(dropdown.options.length > 1)
                    {
                        dropdown.remove(1); 
                    }
                }
            }
            };
            xhttp.open("GET", url, true);
            xhttp.send();
        }

        function check()
        {
            var flag = false;
            var id = document.getElementById("user_id").value.length;
            var name = document.getElementById("user_name").value.length;
            var category = document.getElementById("payment_category").value;
            var amount = document.getElementById("total_amount").value.length;
            if(id == 0)
            {
                document.getElementById("msg").innerHTML = "*Choose a User ID to procced";
                document.getElementById("msg").style.color = "red";
                return false;
            }            
            
            else if(name == 0)
            {
                document.getElementById("msg").innerHTML = "*Name cannot be empty";
                document.getElementById("msg").style.color = "red";
                return false;
            }
            else if(category == 0)
            {
                document.getElementById("msg").innerHTML = "*Choose a payment type";
                document.getElementById("msg").style.color = "red";
                return false;
            }
            else if(amount==0)
            {
                document.getElementById("msg").innerHTML = "*Amount cannot be empty";
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

</body>

</html>
';
}
else{
	header("Location: ../index.html?error=access restricted");
}
?>

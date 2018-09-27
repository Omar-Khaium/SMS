<?php
session_start();
    if(isset($_SESSION["flag"]) && $_SESSION["flag"]=="success"){
    echo '<!DOCTYPE html>
<html>
<title>Edit Event</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    td {
        padding: 1px 35px;
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

    input {
        width: 200px;
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
    <table style="margin-top: 50px;">

        <div class="w3-container w3-card w3-content w3-border-left">
            <tr>
                <td class="w3-cell-top" style="padding: 10px 150px;width:100%">
                    <div class="w3-container w3-blue">
                        <h4>Edit Event</h4>
                    </div>
                    <table class="profile" style="border:1px solid grey;;width:100%">
                        <tr>
                            <td style="width:100%;">
                                <br>
                                <select class="w3-select" name="Batch">
                                    <option value="" disabled selected>Choose a Event Name</option>
                                    <option value="610">Event Name</option>
                                    <option value="611">Event Name</option>
                                    <option value="612">Event Name</option>
                                    <option value="613">Event Name</option>
                                    <option value="614">Event Name</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <hr>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:100%;">
                                <div class="w3-container w3-border w3-padding-16">
                                    <br>

                                    <form action="/action_page.php" class="w3-container w3-card-4 w3-light-grey w3-text-blue w3-margin" style="width:100%;">

                                        <div class="w3-row w3-section">
                                            <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user"></i></div>
                                            <div class="w3-rest">
                                                <input class="w3-input w3-border" name="student_id" type="text" placeholder="Student ID">
                                            </div>
                                        </div>

                                        <div class="w3-row w3-section">
                                            <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-envelope-o"></i></div>
                                            <div class="w3-rest">
                                                <input class="w3-input w3-border" name="subject" type="text" placeholder="Subject">
                                            </div>
                                        </div>

                                        <div class="w3-row w3-section">
                                            <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-pencil"></i></div>
                                            <div class="w3-rest">
                                                <input class="w3-input w3-border" name="message" type="text" placeholder="Description">
                                            </div>
                                        </div>

                                        <button class="w3-button w3-block w3-section w3-blue w3-ripple w3-padding">Send</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    </table>
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

</html>
';
}
else{
	header("Location: ../index.html?error=access restricted");
}
?>

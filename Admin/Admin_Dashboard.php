<?php
session_start();
    if(isset($_SESSION["flag"]) && $_SESSION["flag"]=="success"){
    echo '
    <!DOCTYPE html>
    <html>
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        td {
            padding: 1px 35px;
        }

        table.card {
            border: .5px solid gray;
        }

        table.card td {
            padding: 10px 50px;
            width: 50px;
        }

        body {
            background-color: whitesmoke;
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
            <a href="Admin_Dashboard.php" class="w3-bar-item w3-button">Home</a>
            <a href="../logout.php" class="w3-bar-item w3-button w3-hide-small w3-right w3-dark-grey">Logout</a>
            <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium" onclick="myFunction()">&#9776;</a>
        </div>
    </div>
    <!-------------------------------navigation end--------------------------------------->
        <table style="margin: 0 auto;margin-top: 50px;">

            <div class="w3-container w3-card w3-content w3-border-left" style="max-width:500px">
                <tr>
                    <td class="w3-cell-top" style="padding-left:100px;">
                        <div class="w3-container w3-blue">
                            <h4>Admin Dashboard</h4>
                        </div>
                        <table class="card">
                            <tr>
                                <td style="padding:25px;width:30%;">
                                    <div class="w3-card-4 w3-light-grey">
                                        <div class="w3-container w3-center" style="padding-bottom:10px;">
                                            <h3>Student</h3>
                                            <div class="w3-center" style="width:100%;height:100px;"><i class="w3-xxxlarge fa fa-id-badge"></i></div>
                                            <a href="admin_edit_student.php"><button class="w3-button w3-blue"><i class="w3-large fa fa-edit"></i>&nbsp;Edit</button></a>
                                            <a href="admin_add_student.php"><button class="w3-button w3-green"><i class="w3-large fa fa-user-plus"></i>&nbsp;Add</button></a>
                                            <a href="admin_delete_student.php"><button class="w3-button w3-red"><i class="w3-large fa fa-trash"></i>&nbsp;Delete</button></a>
                                        </div>
                                    </div>
                                </td>
                                <td style="padding:25px;width:30%;">
                                    <div class="w3-card-4 w3-light-grey">
                                        <div class="w3-container w3-center" style="padding-bottom:10px;">
                                            <h3>Teacher</h3>
                                            <div class="w3-center" style="width:100%;height:100px;"><i class="w3-xxxlarge fa fa-graduation-cap"></i></div>
                                            <a href="admin_edit_teacher.php"><button class="w3-button w3-blue"><i class="w3-large fa fa-edit"></i>&nbsp;Edit</button></a>
                                            <a href="admin_add_teacher.php"><button class="w3-button w3-green"><i class="w3-large fa fa-user-plus"></i>&nbsp;Add</button></a>
                                            <a href="admin_delete_teacher.php"><button class="w3-button w3-red"><i class="w3-large fa fa-trash"></i>&nbsp;Delete</button></a>
                                        </div>
                                    </div>
                                </td>
                                <td style="padding:25px;width:30%;">
                                    <div class="w3-card-4 w3-light-grey">
                                        <div class="w3-container w3-center" style="padding-bottom:10px;">
                                            <h3>Course</h3>
                                            <div class="w3-center" style="width:100%;height:100px;"><i class="w3-xxxlarge fa fa-book"></i></div>
                                            <a href="admin_edit_course.php"><button class="w3-button w3-blue"><i class="w3-large fa fa-edit"></i>&nbsp;Edit</button></a>
                                            <a href="admin_add_course.php"><button class="w3-button w3-green"><i class="w3-large fa fa-user-plus"></i>&nbsp;Add</button></a>
                                            <a href="admin_delete_course.php"><button class="w3-button w3-red"><i class="w3-large fa fa-trash"></i>&nbsp;Delete</button></a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:25px;width:30%;">
                                    <div class="w3-card-4 w3-light-grey">
                                        <div class="w3-container w3-center" style="padding-bottom:10px;">
                                            <h3>Batch</h3>
                                            <div class="w3-center" style="width:100%;height:100px;"><i class="w3-xxxlarge fa fa-group"></i></div>
                                            <a href="admin_edit_batch.php"><button class="w3-button w3-blue"><i class="w3-large fa fa-edit"></i>&nbsp;Edit</button></a>
                                            <a href="admin_add_batch.php"><button class="w3-button w3-green"><i class="w3-large fa fa-user-plus"></i>&nbsp;Add</button></a>
                                            <a href="admin_delete_batch.php"><button class="w3-button w3-red"><i class="w3-large fa fa-trash"></i>&nbsp;Delete</button></a>
                                        </div>
                                    </div>
                                </td>
                                <td style="padding:25px;width:30%;">
                                    <div class="w3-card-4 w3-light-grey">
                                        <div class="w3-container w3-center" style="padding-bottom:10px;">
                                            <h3>Payment</h3>
                                            <div class="w3-center" style="width:100%;height:100px;"><i class="w3-xxxlarge fa fa-credit-card"></i></div>
                                            <a href="Admin_Payment_Transaction.php"><button class="w3-button w3-green"><i class="w3-large fa fa-user-plus"></i>&nbsp;Transaction</button></a>
                                            <a href="Admin_Payment_History.php"><button class="w3-button w3-red"><i class="w3-large fa fa-globe"></i>&nbsp;History</button></a>
                                        </div>
                                    </div>
                                </td>
                                <td style="padding:25px;width:30%;">
                                    <div class="w3-card-4 w3-light-grey">
                                        <div class="w3-container w3-center" style="padding-bottom:10px;">
                                            <h3>Application</h3>
                                            <div class="w3-center" style="width:100%;height:100px;"><i class="w3-xxxlarge fa fa-envelope-open-o"></i></div>
                                            <a href="Admin_Pending_Application.php"><button class="w3-button w3-blue"><i class="w3-large fa fa-envelope"></i>&nbsp;Pending</button></a>
                                            <a href="Admin_Application_History.php"><button class="w3-button w3-green"><i class="w3-large fa fa-globe"></i>&nbsp;History</button></a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:25px;width:30%;">
                                    <div class="w3-card-4 w3-light-grey">
                                        <div class="w3-container w3-center" style="padding-bottom:10px;">
                                            <h3>Complain</h3>
                                            <div class="w3-center" style="width:100%;height:100px;"><i class="w3-xxxlarge fa fa-frown-o"></i></div>
                                            <a href="Admin_Pending_Complain.php"><button class="w3-button w3-blue"><i class="w3-large fa fa-envelope-o"></i>&nbsp;Pending</button></a>
                                            <a href="Admin_Complain_History.php"><button class="w3-button w3-green"><i class="w3-large fa fa-globe"></i>&nbsp;History</button></a>
                                        </div>
                                    </div>
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
    </body>

    </html>';
}
else{
	header("Location: ../index.html?error=access restricted");
}
?>

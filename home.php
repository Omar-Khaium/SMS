<?php
    if($_GET["id"]=="****")
    {
        echo "<h1>Login Successful</h1>";
    }
    else
    {
        header("Location: index.php?error=Illegal login Attemp");
    }
?>

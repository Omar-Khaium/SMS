<?php
require("Database.php");
    if(isset($_REQUEST['id']) && $_REQUEST['id']==1)
    {
        $sql = "select serial from std_profile";
        
        $arr = getDataFromDB($sql);
        
        $counter = 1;
        
        foreach($arr as $row)
        {
            $counter++;
        }
        if($counter >= 100)
        {
            echo $counter;
        }
        else if($counter < 100 && $counter >= 10)
        {
            echo "0".$counter;
        }
        else if($counter < 10 && $counter >= 1)
        {
            echo "00".$counter;
        }
        
    }
    else if(isset($_REQUEST['id']) && $_REQUEST['id']==2)
    {
        $sql = "select * from tcr_profile";
        
        $arr = getDataFromDB($sql);
        
        $counter = 1;
        
        foreach($arr as $row)
        {
            $counter++;
        }
        if($counter >= 100)
        {
            echo $counter;
        }
        else if($counter < 100 && $counter >= 10)
        {
            echo "0".$counter;
        }
        else if($counter < 10 && $counter >= 1)
        {
            echo "00".$counter;
        }
        
    }
    else if(isset($_REQUEST['id']) && $_REQUEST['id']==3)
    {
        $sql = "select * from batch";
        
        $arr = getDataFromDB($sql);
        
        $counter = 1;
        
        foreach($arr as $row)
        {
            $counter++;
        }
        if($counter >= 100)
        {
            echo $counter;
        }
        else if($counter < 100 && $counter >= 10)
        {
            echo "0".$counter;
        }
        else if($counter < 10 && $counter >= 1)
        {
            echo "00".$counter;
        }
        
    }
    else if(isset($_REQUEST['id']) && $_REQUEST['id']==4)
    {
        $sql = "select * from course";
        
        $arr = getDataFromDB($sql);
        
        $counter = 1;
        
        foreach($arr as $row)
        {
            $counter++;
        }
        if($counter >= 100)
        {
            echo $counter;
        }
        else if($counter < 100 && $counter >= 10)
        {
            echo "0".$counter;
        }
        else if($counter < 10 && $counter >= 1)
        {
            echo "00".$counter;
        }
        
    }
?>

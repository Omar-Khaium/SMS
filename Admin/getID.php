<?php 
    if(isset($_REQUEST['type']) && $_REQUEST['type']==1)
    {
        $sql = "select * from std_profile";
        $last_ID = 0;
        if(getDataFromDB($sql))
        {
            $arr = getDataFromDB($sql);
            foreach($arr as $row)
            {
                $last_ID = $row["Serial"];
            }
        }
        $last_ID += 1;
        echo $last_ID;
    }
    else if(isset($_REQUEST["type"]) && $_REQUEST["type"]==2)
    {
        $sql = "select * from tcr_profile";
        $last_ID = 0;
        if(getDataFromDB($sql))
        {
            $arr = getDataFromDB($sql);
            foreach($arr as $row)
            {
                $last_ID = $row["Serial"];
            }
        }
        $last_ID += 1;
        echo $last_ID;
    }
?>

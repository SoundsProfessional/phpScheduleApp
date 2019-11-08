<!--Connor Was Here-->
<?php
function getConnection()
{
    $db = new mysqli('localhost', 'user', '', 'test');
    if (mysqli_connect_errno()) {
        echo 'Error: Could not connect to database.';
        exit;
    }

    return $db;
}

function getLastMonday($date){

    if(date("N",$date) == 7){

        return $date;
    }
    else{

        return date($date) - (86400 *  date("N",$date));
    }

}


function getProjectRoot(){ //I dont think this works
    echo dirname(dirname("footer.php"));

}

?>
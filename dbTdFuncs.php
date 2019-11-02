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

    $date = date($date) - 86400 *  (date("N",$date) - 1);

    return $date;
}


?>
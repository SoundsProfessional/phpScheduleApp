<!--Connor Was Here-->
<!--BOTH DATABASE AND TIMEDATE FUNCTIONS ARE HERE-->

<?php


function submitString($query)
{
    $connec = getConnection();
    if (!mysqli_query($connec, $query)) {
        echo("Error description: " . mysqli_error($connec));
    }


}

class scheduleSubmission
{
//    Initializes and generates the string to schedule a whole week
    public function __construct()
    {

    }

}




//get Days Availability
function getDayAvail($monDate, $currT){ //This returns TRUE or FALSE if EMP is available this day.

    $query = "select count(*) as c from
    (select * from availability where `Name` = '".$_SESSION['empName']."' and `".date('N', $currT)."`=1) as a
where (a.`is` = 1 and a.date <= '".date('Y-m-d',$monDate)."')
or
(date = '".date('Y-m-d',$monDate)."' )";
    $db = getConnection();
    $result = $db->query($query) or die ("getting your specific availability failed");
    $num_results = $result->num_rows;
    if(!$result) {
        echo "Cannot run query.";
        exit;
    }
    $row1 = $result->fetch_assoc();
//    echo "in getDatAvail".$query.'<br/>'.$row1['c']; //useful noise
    return $row1['c'];
}

function getAssociativeOfAvailableEmployees($monDate, $currT)
{
    $dayIncr = date('N', intval($currT));
    $monDate = SQLfmtDate($monDate);

    $query = "select name from availability  where date = '".$monDate."' or `is` = 0 and `".$dayIncr."` = 1
    union
    (select name from availability where date <= '".$monDate."' and `IS` = 1 and `".$dayIncr."` = 1 group by date limit 1 )";

    $db=getConnection();
    $result = $db->query($query) or die ("gettingListofAvailableEmployees failed");

    if(!$result) {
        echo "Cannot run query.";
        exit;
    }

    return $result;
}

function SQLfmtDate($time){
    $time=intval($time);

    return date('Y-m-d', $time);

}













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
    $date=intval($date);

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
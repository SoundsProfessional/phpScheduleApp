<?php
if (session_status() == PHP_SESSION_NONE || session_id() == '') {
    session_start();
}
//<!--Connor Was Here-->
//<!--BOTH DATABASE AND TIMEDATE FUNCTIONS ARE HERE-->


function submitString($query)
{
    $connec = getConnection();
    echo "<BR/>String Submission In Its Entirity<br/>" . $query . "<BR/>";
    if (!mysqli_multi_query($connec, $query)) {
        echo("Error description: " . mysqli_error($connec));
    }


}

class scheduleSubmission
{
//    Initializes and generates the string to schedule a whole week
    private static $instance = null;

    private function __construct($bizName, $monDate)
    {
        $this->bizName = $bizName;
        $this->monDate = $monDate;

        $this->query = "delete from explicitListDayEmp where bizName = '" . $bizName . "' and monDate = '" . SQLfmtDate($monDate) . "';";
    }

    public function append($continuation)
    {
        $this->query .= $continuation;

        //echo'<br/>'.$this->query.'<br/>';
    }

    public function execute()
    {
        submitString($this->query);
        self::$instance = null;


    }

    public function __toString()
    {
        return " {{{" . $this->query . "}}}<br/>";
    }

    public static function getInstance($bizName, $monDate)
    {
        if (self::$instance == null) {
            self::$instance = new scheduleSubmission($bizName, $monDate);
        }
        return self::$instance;
    }
}


function getVariableDump()
{
    return '
    </br>printing all arrays as a courtesy.
    <br/>' . var_dump($_GET) .
        "<br/>" . var_dump($_POST) .
        "<br/>" . var_dump($_SESSION);
}

//get Days Availability
function getDayAvail($monDate, $currT){ //This returns TRUE or FALSE if EMP is available this day.

    $query = "select count(*) as c from
    (select * from availability where bizName = '" . $_SESSION['bizName'] . "' and `Name` = '" . $_SESSION['empName'] . "' and `" . date('N', $currT) . "`=1) as a
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

    $query = "select name from availability  where bizName = '" . $_SESSION['bizName'] . "' and date = '" . $monDate . "' or bizName = '" . $_SESSION['bizName'] . "' and `is` = 0 and `" . $dayIncr . "` = 1
    union
    (select name from availability where bizName = '" . $_SESSION['bizName'] . "' and date <= '" . $monDate . "' and `IS` = 1 and `" . $dayIncr . "` = 1 group by date limit 1 )";

    $db=getConnection();
    $result = $db->query($query) or die ("gettingListofAvailableEmployees failed");

    if(!$result) {
        echo "Cannot run query.";
        exit;
    }

    return $result;
}


function getAssociativeOfScheduledEmployees($monDate, $currT)
{
    $dayIncr = date('N', intval($currT));
    $monDate = SQLfmtDate($monDate);

//    $query = "select name from availability  where bizName = '" . $_SESSION['bizName'] . "' and date = '" . $monDate . "' or bizName = '" . $_SESSION['bizName'] . "' and `is` = 0 and `" . $dayIncr . "` = 1
//    union
//    (select name from availability where bizName = '" . $_SESSION['bizName'] . "' and date <= '" . $monDate . "' and `IS` = 1 and `" . $dayIncr . "` = 1 group by date limit 1 )";

    $query = "select * from explicitListDayEmp
    where bizName='" . $_SESSION['bizName'] . "' and (monDate='" . $monDate . "' and isDefault=0 and dayIncr = '`" . $dayIncr . "`')
    union
    (select * from explicitListDayEmp where bizName='" . $_SESSION['bizName'] . "' and monDate <= '" . $monDate . "' and isDefault=1 and dayIncr = '`" . $dayIncr . "`' group by monDate limit 1 );";


    $db = getConnection();
    $result = $db->query($query) or die ("gettingListofAvailableEmployees failed");

    if (!$result) {
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
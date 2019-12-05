<?php
if (session_status() == PHP_SESSION_NONE || session_id() == '') {
    session_start();
}
//<!--Connor Was Here-->
//<!--BOTH DATABASE AND TIMEDATE FUNCTIONS ARE HERE-->


//YOU MAY NOTE THAT SOME OF THESE FUNCTION AND VARIABLE NAMES ARE EXCESSIVELY LONG. THIS IS INTENTIONAL!
//THE CONVENTIONAL WISDOM IS THAT LONG NAMES ARE MORE PRONE TO ERRORS, WHICH IS REASONABLE
//BUT MOST PEOPLE USE ideS TODAY, OR COPY AND PASTE, OR WHATEVER, AND ARE NOT NECESSARILY USING THE KEYBOARD
//A VERY LONG NAME PRECLUDES PEOPLE EVEN TRYING TO TYPE IT, THUS AVOIDING ALL ERRORS
//BY THIS LOGIC, THE PERFECT FUNCTION NAME WOULD BE thisFunctinName120954712 BECAUSE NOBODY WOULD PRESUME TO REMEMBER IT!!

function submitString($query)
{ //THIS IS ONLY FOR PASSIVE SUBMISSIONS
//IT DOESNT DO A RETURN VALUE
    $connec = getConnection();
    echo "<BR/>String Submission In Its Entirity<br/>" . $query . "<BR/>";
    if (!mysqli_multi_query($connec, $query)) {
        echo("Error description: " . mysqli_error($connec));
    }
}


class scheduleSubmission
{ //I GUESS YOU COULD CALL THIS A REPOSITORY TO MANAGE THE INITIALIZATION AND UPDATE OF A SCHEDULED WEEK
//    Initializes and generates the string to schedule a whole week
//SINCE WE DONT KNOW HOW MANY INSERTIONS WILL OCCUR, EXECUTION IS SEPARATE FROM APPENDAGE
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


function getRequestQueue()
{
    $query = "SELECT * FROM `messageEntry` WHERE bizName = '" . $_SESSION['bizName'] . "' order by date";
    $db = getConnection();
    $result = $db->query($query) or die ("getting your queue failed");
    $return = "";
    foreach ($result as $w => $k) {
        $return .= $k['date'] . " -- " . $k['emplName'] . "<br/>" . $k['message'] . "<br/><br/>";
    }
    return $return;
}

//get Days Availability
function getDayAvail($monDate, $currT)
{ //This returns TRUE or FALSE if EMP is available this day.
    //IT IS TOTALLY AWFUL
    $query = "select (select count(*) from availability where bizName = '" . $_SESSION['bizName'] . "' and `Name` = '" . $_SESSION['empName'] . "' and `" . date('N', $currT) . "`=1
    and `is` = 1 and date <= '" . date('Y-m-d', $monDate) . "')
    +
    (select count(*) from availability where bizName = '" . $_SESSION['bizName'] . "' and `Name` = '" . $_SESSION['empName'] . "' and `" . date('N', $currT) . "`=1
    and date = '" . date('Y-m-d', $currT) . "')";

    //echo $query;

    //echo date('N', $currT)."  ".$monDate.'<br/>';
    $db = getConnection();
    $result = $db->query($query) or die ("getting your specific availability failed");
    $num_results = $result->num_rows;
    if(!$result) {
        echo "Cannot run query.";
        exit;
    }
    $res = "";
    $row1 = $result->fetch_assoc();
    foreach ($row1 as $p){$res .= $p;}
//    echo "in getDatAvail".$query.'<br/>'.$row1['c']; //useful noise
    return $res == 0 ? 0 : 1;
}





function getAssociativeOfAvailableEmployees($monDate, $currT)
{
    $dayIncr = date('N', intval($currT));
    $monDate = SQLfmtDate($monDate);

    $query = "select name from availability  where bizName = '" . $_SESSION['bizName'] . "' and date = '" . $monDate . "' or bizName = '" . $_SESSION['bizName'] . "' and `is` = 0 and `" . $dayIncr . "` = 1
    union
    (select name from availability where bizName = '" . $_SESSION['bizName'] . "' and date <= '" . $monDate . "' and `IS` = 1 and `" . $dayIncr . "` = 1 group by date)";

    $db=getConnection();
    echo $query;
    $result = $db->query($query) or die ("gettingListofAvailableEmployees failed");

    if(!$result) {
        echo "Cannot run query.";
        exit;
    }
    //echo "<br/>".$query."   <br/>";
    return $result;
}


function getAssociativeOfScheduledEmployees($monDate, $currT)
{
    $dayIncr = date('N', intval($currT));
    $monDate = SQLfmtDate($monDate);

    $query = "select empName from explicitListDayEmp
    where bizName='" . $_SESSION['bizName'] . "' and (monDate='" . $monDate . "' and isDefault=0 and dayIncr = '`" . $dayIncr . "`')
    union
    (select empName from explicitListDayEmp where bizName='" . $_SESSION['bizName'] . "' and monDate <= '" . $monDate . "' and isDefault=1 and dayIncr = '`" . $dayIncr . "`' group by monDate);";

    //echo "<br/>".$query."   <br/>";
    $db = getConnection();
    $result = $db->query($query) or die ("gettingListofAvailableEmployees failed");

    if (!$result) {
        echo "Cannot run query.";
        exit;
    }

//    foreach($result as $x=>$y){
//        echo $dayIncr."  ".$y['empName']."  ";
//        foreach($y as $w=>$e) {
//            echo $w." INSIDE GETSCHED ".$e;
//        }
//    }

    return $result;
}



function SQLfmtDate($time)
{//WE USE THIS A LOT!!!
    $time=intval($time);
    return date('Y-m-d', $time);
}

function getConnection()
{ //WE USE THIS A LOT!
    $db = new mysqli('localhost', 'user', '', 'test');
    if (mysqli_connect_errno()) {
        echo 'Error: Could not connect to database.';
        exit;
    }

    return $db;
}

function getLastMonday($date)
{ //WE USE THIS A LOT!
    $date=intval($date);
    if(date("N",$date) == 7){
        return $date;
    }
    else{
        return date($date) - (86400 *  date("N",$date));
    }
}


function getVariableDump()
{  //THIS IS ONLY USED IN THE HEADER AND FOOTER FOR THE DEVELOPER.
//IT WILL BE TOTALLY USELESS FOR PROD
    return '
    </br>printing all arrays as a courtesy.
    <br/>' . var_dump($_GET) .
        "<br/>" . var_dump($_POST) .
        "<br/>" . var_dump($_SESSION);
}



?>


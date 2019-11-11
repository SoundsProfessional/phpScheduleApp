<!--Connor Was Here-->
<?php
require('../header.php');
require('reusable/empNav.php');
include_once('../dbTdFuncs.php');

$db = getConnection();
$queryPrefix = null;
$querySuffix = null;
$queryMidfix = "";
$_POST = array_filter($_POST);

if(!isset($_SESSION['empName'])){
    if (isset($_POST['empName'])) {
        $_SESSION['empName'] = $_POST['empName'];
    } else {
        $_SESSION['empName'] = "tuyg";
        echo 'SOMETHING IS TERRIBLY WRONG, I DONT KNOW WHO YOU ARE. PROCEEDING WITH THE SIMULATION, YOUR NAME IS tuyg';
    }
}

echo '<div><p>This Page is where linked pages (those in the navbar) output their stuff. The database functions happen here.</p>';
echo '<p>Name your form POSTS (from the linked pages) in such a way that you can match for them in this big loop. Perhaps with regexp.</p>';
echo "<p>A nice resource for regexp is <a href='https://www.rexegg.com/regex-quickstart.html'>HERE</a>.</p>";
echo '<p>This whole functionality works on catching POST variables from the other pages and deciding what to do next. </p>';
echo '<p></p></div>';

//    [^a-z]

if (preg_grep ( '/sunDateMirror/', array_keys($_POST))) {
    $_POST['sunDate'] = $_POST['sunDateMirror'];

    $queryPrefix = "insert into availability (`Name`, `Date`, `BizName`, `is";
    //this one is the condition that there is not an entry in the table
    $queryPostfix = " on duplicate key update "; //`is`=
    //$queryPostfix is for the condition where there is already an entry in the table
    //examine the SQL scratch pad in Documentation to see the underlying sql.
    $queryMidFix = ""; //THIS IS JUST SOME ONES

    $numDayTrue = preg_grep('/^\d{1, 2}$/', $_POST, true);
//    $whichAreOn =   preg_grep ( '/on/', array_values($_POST), true);
//    foreach ($whichAreOn as $w){ echo "((".$w."))";}
    foreach ($numDayTrue as $k=>$v) { //this part creates the numeric fields
        //echo $_POST[$k]. " -- ".$k ."--".$v.'<br/>';
        if ($_POST[$k] == 'on' && $k != 'DefaultP') {
            echo "make a thing for " . $k;
            $queryMidFix .= ", 1";
            $queryPrefix .= '`, `' . $k;           //put in the field, ending quote for the previous and leading quote for itself
            $queryPostfix .= '`' . $k . "`=1,";   //closing quote for the previous one, the field name,
        }
    }
    //$queryPostfix= rtrim($queryPostfix, ","); //dropping the last comma from the numeric fields
    $queryPostfix .="`is`="; //`is` is the last field we add for the update conditon

    //this block is the midfix, it builds the values out to the right
    $queryPrefix .= "`) values ('"
        .$_SESSION['empName']."', '".
        date('Y-m-d', $_POST['sunDate'])
        . "', '" . $_SESSION['bizName'] . "',";  //the above is for the insert values, date and name fields

    if(isset($_POST['DefaultP'])) { //does the IS key
        if ($_POST['DefaultP'] != 0) {
            $queryPrefix .= '1'; //for the insert condition
            $queryPostfix .= '1'; //for the update condition
        } else {
            $queryPrefix .= '0';
            $queryPostfix .= '0';
        }
    }
    else
    {$queryPrefix .=  '0';
        $queryPostfix .=  '0';}


        //this is the value that is always added to numeric fields


    echo 'I intend to post the following: <br/>'.$queryPrefix.$queryPostfix.'<br/>';
    submitString($queryPrefix . $queryMidFix . ")" . $queryPostfix);
//    insert into availability (`name`, `date`, `is`, `1`) VALUES ('Connor', '2019-04-11', 1, 1);

    }



if (preg_grep ( '/empName/', array_keys($_POST))) {
    //User is coming in from createAccount
    $_SESSION['empName'] = $_POST['empName'];
    $_SESSION['bizName'] = $_POST['bizName'];
    echo 'Welcome, ' . $_SESSION['empName'] . "!!";
    $query = 'INSERT INTO employee_account (bizName, Name, Password) VALUES (\''
        . $_POST['bizName'] . "','" . $_POST['empName'] . "','" . $_POST['empPW'] . "') on duplicate key update employee_account.Password = employee_account.Password;";

    submitString($query);
//    $db->query($query) or die('<br/>BUT I FAILED .. probably a duplicate name.');
}


?>






<?php

require('../footer.php');
?>
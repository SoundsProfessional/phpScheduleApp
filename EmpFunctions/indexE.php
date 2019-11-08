<!--Connor Was Here-->
<?php
require('../header.php');
require('reusable/empNav.php');
include('../dbTdFuncs.php');

$db = getConnection();
$queryPrefix = null;
$querySuffix = null;
$queryMidfix = "";
$_POST = array_filter($_POST);

if(!isset($_SESSION['empName'])){
    echo 'SOMETHING IS TERRIBLY WRONG, I DONT KNOW WHO YOU ARE!';
}

echo '<div><p>This Page is where linked pages (those in the navbar) output their stuff. The database functions happen here.</p>';
echo '<p>Name your form POSTS (from the linked pages) in such a way that you can match for them in this big loop. Perhaps with regexp.</p>';
echo "<p>A nice resource for regexp is <a href='https://www.rexegg.com/regex-quickstart.html'>HERE</a>.</p>";
echo '<p>This whole functionality works on catching POST variables from the other pages and deciding what to do next. </p>';
echo '<p></p></div>';

//    [^a-z]

if (preg_grep ( '/sunDate/', array_keys($_POST))) {

    $queryPrefix = "insert into availability (`Name`, `Date`, `is";
    $numDayTrue =   preg_grep ( '/\d/', array_values($_POST), true);

    foreach ($numDayTrue as $k=>$v) {
        echo $k." and ".$v."<br/>";
        $queryPrefix .= '`, `'.$k;
        $querySuffix .= ", 1";
            }
    $queryPrefix .= "`) values ('".$_SESSION['empName']."', '".date('Y-m-d', $_POST['sunDate'])
    ."', 1 ".str_repeat(', 1 ', count($numDayTrue)).")";

    echo 'I intend to post the following: <br/>'.$queryPrefix.'<br/>';
    $resp = $db->query($queryPrefix) or die('<br/>BUT I FAILED for unknown reasons. Maybe duplicate monDate?<br/>The ability to UPDATE an availability is necessary but not implemented. ');




//    insert into availability (`name`, `date`, `is`, `1`) VALUES ('Connor', '2019-04-11', 1, 1);




    }




if (preg_grep ( '/empName/', array_keys($_POST))) {
    //User is coming in from createAccount
    $_SESSION['empName'] = $_POST['empName'];
    $_SESSION['bizName'] = $_POST['bizName'];
    echo 'Welcome, ' . $_SESSION['empName'] . "!!";
    $query = 'INSERT INTO employee_account (bizName, Name, Password) VALUES (\''
        . $_POST['bizName'] . "','" . $_POST['empName'] . "','" . $_POST['empPW'] . "')";
    echo 'I intend to post the following: <br/>' . $query;
    $db->query($query) or die('<br/>BUT I FAILED .. probably a duplicate name.');
}





//foreach($_POST as $key => $value) {
//    //this preg_match returns
//    $match = preg_match('/^[0-9][0-9]$/', $temp);
//    echo  '<br>\'/^[0-9][0-9]$/\'------>'.$match. "< matched on key.<br/>";
//    $match = preg_match('\w$/', $key);
//    echo '\w$/ ------>'.$match."<br/>";
//
//    echo '<h2>testing ' . $key . "   " . $value . '</h2><br/>';
//
//
//
//    if (false) { //Coming in from a CreateAccount
//        //The problem with this function, is that it needs to be waiting for all three inputs to insert the entry ONCE.
//        //so it is being called out of order in some cases. Gotta figure that out.
//        //It should be constructed as one big variable which is later taken apart, OR
//        //use a REGEX to grab the right keys
//
//        echo 'Welcome, '.$value."!!";
//        $query = 'INSERT INTO `employee_account` (`Biz_Id`, `Name`, `Password`) VALUES ('
//            .$_POST['bizName'].",".$_POST['empName'].",".$_POST['empPW'].")";
//        $db->query($query);
//    }
//
//    if (is_numeric($key) && intval($key) > 100) { //This absolutely must be a SUNDAY!!!!
//        // Coming in from availMonth
//        echo 'avail: '.date("N d",$key).", ";
//        if ($longQuery == null) {
//            $longQuery = 'insert into availability (name, date, 0, 0';
//        }
//    }
//
//
//    if (is_numeric($key) && intval($key) <= 100) {
//        if ($querySuffix == null) {
//            echo 'init new querysuffix<br/>';
//            $querySuffix = ') values ("' . $value == 'on' ? 1 : 0;
//            $midquery .= "\", \"" . $key;
//        } else {
//            echo 'appendQS' . $value . "  " . $key . '<br/>';
//            $querySuffix .= ', ' . $value == 'on' ? 1 : 0;
//            echo '';
//            $midquery .= ", " . $key;
//        }
//
//
//    }
//    $longQuery .= $midquery . $querySuffix . "\")";
//    echo $longQuery;
//    $db->query($longQuery);
//    //put long, midfix, suffix, together
//    //add the last parenthes
//    //throw it into the database all nice
//}


?>






<?php

require('../footer.php');
?>
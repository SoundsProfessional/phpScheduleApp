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

if (preg_grep ( '/sunDateMirror/', array_keys($_POST))) {
    $_POST['sunDate'] = $_POST['sunDateMirror'];

    $queryPrefix = "insert into availability (`Name`, `Date`, `is";
    //this one is the condition that there is not an entry in the table
    $queryPostfix = " on duplicate key update "; //`is`=
    //$queryPostfix is for the condition where there is already an entry in the table
    //examine the SQL scratch pad in Documentation to see the underlying sql.
    $numDayTrue =   preg_grep ( '/\d{1}/', array_keys($_POST), true);




    foreach ($numDayTrue as $k=>$v) { //this part creates the numeric fields
        //echo intval($k)." and ".$v."<br/>";  //noise
        $queryPrefix .= '`, `'.$k;           //put in the field, ending quote for the previous and leading quote for itself
        $queryPostfix .= '`'.$k."`=1,";   //closing quote for the previous one, the field name,
            }
    //$queryPostfix= rtrim($queryPostfix, ","); //dropping the last comma from the numeric fields
    $queryPostfix .="`is`="; //`is` is the last field we add for the update conditon

    //this block is the midfix, it builds the values out to the right
    $queryPrefix .= "`) values ('"
        .$_SESSION['empName']."', '".
        date('Y-m-d', $_POST['sunDate'])
    ."', ";  //the above is for the insert values, date and name fields

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

    $queryPrefix .= str_repeat(', 1 ', count($numDayTrue)).")";
        //this is the value that is always added to numeric fields


    echo 'I intend to post the following: <br/>'.$queryPrefix.$queryPostfix.'<br/>';
    $resp = $db->query($queryPrefix.$queryPostfix) or die('<br/>BUT I FAILED for unknown reasons. Maybe duplicate monDate?<br/>The ability to UPDATE an availability is necessary but not implemented. ');
//    insert into availability (`name`, `date`, `is`, `1`) VALUES ('Connor', '2019-04-11', 1, 1);

    }




if (preg_grep ( '/empName/', array_keys($_POST))) {
    //User is coming in from createAccount
    $_SESSION['empName'] = $_POST['empName'];
    $_SESSION['bizName'] = $_POST['bizName'];
    echo 'Welcome, ' . $_SESSION['empName'] . "!!";
    $query = 'INSERT INTO employee_account (bizName, Name, Password) VALUES (\''
        . $_POST['bizName'] . "','" . $_POST['empName'] . "','" . $_POST['empPW'] . "') on duplicate key update employee_account.Password = employee_account.Password;";
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
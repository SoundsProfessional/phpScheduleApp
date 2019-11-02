<?php



require('../header.php');
require('reusable/empNav.php');
include('../dbTdFuncs.php');

$db = getConnection();
$longQuery = null;
$querySuffix = null;
$midquery = "";
$_POST = array_filter($_POST);

echo '<h1>This Page is where avail and request dump to when they are done. Their database insertions happen in this file.</h1>';
echo '<h1>Name your form POSTS in such a way that you can match for them in this big loop.</h1>';
foreach($_POST as $key => $value)


{
    echo '<h2>testing ' . $key . "   " . $value . '</h2>';

    if ($key == 'empName')
    { //Coming in from a CreateAccount
        echo 'Welcome, '.$value."!!";
        $query = 'INSERT INTO `employee_account` (`Biz_Id`, `Name`, `Password`) VALUES ('
            .$_POST['bizAffiliation'].",".$_POST['empName'].",".$_POST['empPW'].")";
        $db->query($query);
    }

    if (is_numeric($key) && intval($key) > 100) { //This absolutely must be a SUNDAY!!!!
        // Coming in from availMonth
        echo 'avail: '.date("N d",$key).", ";
        if ($longQuery == null) {
            $longQuery = 'insert into availability (name, date, 0, 0';
        }
    }


    if (is_numeric($key) && intval($key) <= 100) {
        if ($querySuffix == null) {
            echo 'init new querysuffix<br/>';
            $querySuffix = ') values ("' . $value == 'on' ? 1 : 0;
            $midquery .= "\", \"" . $key;
        } else {
            echo 'appendQS' . $value . "  " . $key . '<br/>';
            $querySuffix .= ', ' . $value == 'on' ? 1 : 0;
            echo '';
            $midquery .= ", " . $key;
        }


    }
    $longQuery .= $midquery . $querySuffix . "\")";
    echo $longQuery;
    $db->query($longQuery);
    //put long, midfix, suffix, together
    //add the last parenthes
    //throw it into the database all nice
}



?>






<?php

require('../footer.php');
?>
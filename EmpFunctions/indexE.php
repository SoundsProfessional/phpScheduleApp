<?php



require('../header.php');
require('reusable/empNav.php');
include('../dbTdFuncs.php');

$db = getConnection();

$_POST = array_filter($_POST);

echo '<h1>This Page is where avail and request dump to when they are done. Their database insertions happen in this file.</h1>';
echo '<h1>Name your form POSTS in such a way that you can match for them in this big loop.</h1>';
foreach($_POST as $key => $value)


{

    if ($key == 'empName')
    { //Coming in from a CreateAccount
        echo 'Welcome, '.$value."!!";
        $query = 'INSERT INTO `employee_account` (`Biz_Id`, `Name`, `Password`) VALUES ('
            .$_POST['bizAffiliation'].",".$_POST['empName'].",".$_POST['empPW'].")";
        $db->query($query);
    }

    if (is_numeric ($key) && $value == true)
    { //only shows if keys come in named as a timestamp!
        // Coming in from availMonth
        echo 'avail: '.date("N d",$key).", ";
        $query = 'INSERT INTO `availability`';
    }
}



?>






<?php

require('../footer.php');
?>
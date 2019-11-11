<!--Connor Was Here-->
<?php
require('../header.php');
require('reusable/bizNav.php');
include('../dbTdFuncs.php');

$db = getConnection();
$queryPrefix = null;
$querySuffix = null;
$queryMidfix = "";
$_POST = array_filter($_POST);


$bizName = isset($_POST['bizName'])? $_POST['bizName']:null;


$query = "";


if (preg_grep('/bizName/', array_keys($_POST))) {
    //User is coming in from createAccount
    $_SESSION['bizName'] = isset($_POST['bizName']) ? $_POST['bizName'] : 'november';
    $bizPW = isset($_POST['bizPW']) ? $_POST['bizPW'] : null;
    $conn = getConnection();
    $query .= "INSERT INTO biz_account (Name, Password) VALUES
('" . $bizName . "', '" . $bizPW . "')";
    submitString($query);

    echo 'Your business is called ' . $bizName;
}



require('../footer.php');
?>
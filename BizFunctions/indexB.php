<?php
if (session_status() == PHP_SESSION_NONE || session_id() == '') {
    session_start();
}
//<!--Connor Was Here-->
require('../header.php');
require('reusable/bizNav.php');
include_once('../dbTdFuncs.php');

$db = getConnection();
$queryPrefix = null;
$querySuffix = null;
$queryMidfix = "";
$_POST = array_filter($_POST);


$bizName = isset($_POST['bizName'])? $_POST['bizName']:null;


$query = "";

if (preg_grep ( '/bizName/', array_keys($_GET))) {
echo 'you have entered from login, BIZ!';
$_SESSION['bizName'] = $_GET['bizName'];
}

if (preg_grep('/worker/', array_keys($_POST))) {
//USER IS COMING IN FROM SHAREDSCHEDULE
//MUST COMPOSE A COMPLEX INSERTION STATEMENT

    $statementsToMake = preg_grep('/\d/', array_keys($_POST));
    $tempDate = '';
    foreach ($statementsToMake as $k => $v) { //this part creates the numeric fields
        $name = $_POST[$v];
        $tempDate = $v;


        $submission = scheduleSubmission::getInstance($_SESSION['bizName'], getLastMonday($v));

        $singleInsertStatement = "insert into explicitListDayEmp" .
            " (bizname, empname, mondate, dayIncr, isDefault) values ";
        $singleInsertStatement .= "('" . $_SESSION['bizName'] . "', '" . $name .
            "','" . SQLfmtDate(getLastMonday($v)) . "','`" . date('N', $v) . "`', 0); ";
        $submission->append($singleInsertStatement);


    }

    if (isset($_POST['DefaultP'])) {
        $submission->append(
            "update explicitListDayEmp SET isDefault = '1' where bizname='"
            . $_SESSION['bizName'] . "' and mondate= '" . SQLfmtDate(getLastMonday($tempDate)) . "';"
        );
    }


    $submission->execute();
}

if (preg_grep('/note/', array_keys($_POST))) {
//USER IS COMING IN FROM SET REQUIREMENTSMONTH
    $notice = "0";
    if (!empty($_POST['notice'])) {
        $notice = $_POST['notice'];
    }

    echo "setting the notice: " . $_POST['notice'] . " weeks";
    $query = "update biz_account set Notice = " . $_POST['notice'] . " where Name = '" . $_SESSION['bizName'] . "'";
    $conn = getConnection();
    echo $query;
    $conn->query($query);

}



if (preg_grep('/bizName/', array_keys($_POST))) {
    //User is coming in from createAccount
    echo 'coming in from createAccount';
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
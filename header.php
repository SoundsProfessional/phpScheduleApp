<?php
if (session_status() == PHP_SESSION_NONE || session_id() == '') {
    session_start();
}
//<!--GERSON ESCOBAR-->
if (isset($_GET['empName'])) {
    $_SESSION['empName'] = $_GET['empName'];
}
include_once('dbTdFuncs.php');
?>

<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        <?php
        include("calendar.css")
        ?>
    </style>

    <!--    <link href="/opt/lampp/htdocs/Slim/phpScheduleApp/calendar.css" type="text/css" rel="stylesheet"/>-->
    <meta name="theme-color" content="#fafafa">


    <meta name="theme-color" content="#fafafa">

</head>
<body>
<table width="100%" cellpadding="12" cellspacing="0" border="0">
    <tr bgcolor="black">
        <td align="left"><a href="../BizFunctions/indexB.php"><img src="logo.gif" alt="TLA logo" height="70" width="70"></a>
        </td>
        <td>
            <h1>Schedule Viewer and Composer</h1><br/>
            <p class="foot">The entire contents of $_POST is being displayed here as a service:
                <br/> <?php echo getVariableDump(); ?></p>
        </td>
        <td align="right"><a href="../EmpFunctions/indexE.php"><img src="logo.gif" alt="TLA logo" height="70"
                                                                    width="70"></a></td>
    </tr>
</table>


<?php
// CONNOR WAS HERE
include_once('dbTdFuncs.php');
$conn=getConnection();
$allow = 0;
$query = "select Name from biz_account where name = '".$_POST['username']."' and password = '".$_POST['password']."'";
// echo $query;
$res = $conn->query($query);
foreach($res as $p){
if($p['Name']) {
// LOGIC FOR A SUCCESSFL BUSINESS ADMIN LOGIN
//THIS IS A FAKE LOOP, THERE WILL ONLY BE ONE ROW!!!
$_POST['bizName'] = $_POST['username'];
header("location: BizFunctions/indexB.php?bizName=".$p['Name']);

}

else{
$query = "select name, bizName from employee_account where name = '".$_POST['username']."' and password = '".$_POST['password']."'";
$reso = $conn->query($query);
foreach($reso as $p){if($p['name']) {
// LOGIC FOR A SUCCESSFL EMPLOYEE LOGIN
//THIS IS A FAKE LOOP, THERE WILL ONLY BE ONE ROW!!!
header('location: EmpFunctions/indexE.php?empName='.$p['name']."&bizName=".$p['bizName']);
}
else {
//LOGIC FOR A FAILED LOGIN
echo $query;
header('location: createAccount.php?query='.$query);
}}
}
}

//
// require('header.php');
// require('reusable/noLogNav.php');
//
// if (session_status() == PHP_SESSION_NONE || session_id() == '') {
//     session_start();
// }
//
// require('footer.php');
?>
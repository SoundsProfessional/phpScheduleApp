<?php


require('header.php');
require('reusable/noLogNav.php');
//DROP IN THE LOGIC FOR THIS INSERT STATEMENT


echo '
<h2>Please enter the name of your business shift, such as "JoesKitchenPMShift."</h2>
<form action="BizFunctions/indexB.php" method="post">
BIZ NAME: <input type="text" name="bizName" value="">
BIZ PASSWORD: <input type="text" name="bizPW" value="">
<input type="submit" value="OKAY">
</form>';

echo '--------Alternatively, create an employee account---------------
<BR/><BR/>Where do you work?';

//


//$db = new mysqli('localhost', 'user', '', 'test');
//if (mysqli_connect_errno()) {
//    echo 'Error: Could not connect to database.';
//    exit;
//}

$db = getConnection();

$getbiz = "select name, biz_id from biz_account";
$bizList = $db->query($getbiz);

echo '<form action="EmpFunctions/indexE.php" method="post"><select name="bizAffiliation">';
for ($i=0; $i < $bizList->num_rows; $i++) {
    $row = $bizList->fetch_assoc();
    $temp = stripslashes($row['name']);
    $id = $row['biz_id'];
    echo '<option value="'.$id.'">'.$temp.'and'.$id.'</option>';
}
$bizList->free();
echo '</select><br/>EMP NAME: <input type="text" name="empName" value="">
EMP PASSWORD: <input type="text" name="empPW" value=""><input type="submit" value="OKAY"></form>';


//

require('footer.php');

?>
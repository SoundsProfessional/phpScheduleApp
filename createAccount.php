<!--Connor Was Here-->
<?php

require('header.php');
require('reusable/noLogNav.php');
include_once('dbTdFuncs.php');


echo '
<h2>Please enter the name of your business shift, such as "JoesKitchenPMShift."</h2>
<form action="BizFunctions/indexB.php" method="post">
BIZ NAME: <input type="text" name="bizName" value="">
BIZ PASSWORD: <input type="text" name="bizPW" value="">
<input type="submit" value="OKAY">
</form>';

echo '--------Alternatively, create an employee account---------------
<BR/><BR/>Where do you work?';


$db = getConnection();

$getbiz = "select name from biz_account";
$bizList = $db->query($getbiz);


echo '<form action="EmpFunctions/indexE.php" method="post">
<select name="bizName">';
for ($i=0; $i < $bizList->num_rows; $i++) {
    $row = $bizList->fetch_assoc();
    $temp = stripslashes($row['name']);
    echo $temp;
    echo '<option value="'.$temp.'">'.$temp.'</option>';
}
$bizList->free();
echo '</select><br/>EMP NAME: <input type="text" name="empName" value="">
EMP PASSWORD: <input type="text" name="empPW" value=""><input type="submit" value="OKAY"></form>';

//

require('footer.php');

?>

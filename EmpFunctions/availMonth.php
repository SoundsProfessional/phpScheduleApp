

<!--Connor Ireland-->


<?php

require('../header.php');
require('reusable/empNav.php');




include ('../calendarContainer.php');
include_once ('../dbTdFuncs.php');

$monthb = new CalendarContainer('month');

$query = "select Notice from biz_account join employee_account on biz_account.Name = employee_account.bizName where employee_account.Name = '".$_SESSION['empName']."'";
//echo $query;
$db = getConnection();
$res =$db ->query($query);
foreach($res as $r){ echo 'Please do not change your availaibilty within '.  $r['Notice'].' full weeks of the current date.';}
echo '<form method="post" action="indexE.php">';
echo $monthb->show(htmlentities($_SERVER['PHP_SELF']),

    //THIS IS THE MOST IMPORTANT THING ABOUT USING THIS FILE AND OTHERS LIKE IT.
    'availCellCreator');
//IS SPECIFYING THE CELLCREATOR. THIS IS THE ONLY THING YOU CHANGE IN THIS FILE

echo '</form>';

require('../footer.php');
?>


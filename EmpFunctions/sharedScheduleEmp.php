
<!--Connor Ireland-->
<?php

require('../header.php');
require('reusable/empNav.php');

include('../calendarContainer.php');

//  THIS ISN'T WORKING QUITE RIGHT, BECAUSE IT CLICKS TO THE MONTH VIEW
//  INSTEAD OF NOTHING AT ALL.

$monthsc = new CalendarContainer('month');

echo "<form method='post' action='indexE.php'>";
echo $monthsc->show(htmlentities($_SERVER['PHP_SELF']), 'schedCellCreator');

echo "</form>";

require('../footer.php');
?>


<!---->
<!--include('../calendarContainer.php');-->
<!---->
<!---->
<!--$monthb = new CalendarContainer('month');-->
<!---->
<!--//the nature of the payload will change with the cellcreator and be inserted into it later-->
<!--//I hate sending this in with a string.-->
<!--echo $monthb->show(htmlentities($_SERVER['PHP_SELF']), 'sharedSchedEmpCellCreator');-->


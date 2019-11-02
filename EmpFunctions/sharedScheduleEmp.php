
<!--Connor Ireland-->
<?php

require('../header.php');
require('reusable/empNav.php');

include('../calendarContainer.php');


$monthb = new CalendarContainer('month');

//the nature of the payload will change with the cellcreator and be inserted into it later
//I hate sending this in with a string.
echo $monthb->show(htmlentities($_SERVER['PHP_SELF']), 'sharedSchedEmpCellCreator');

require('../footer.php');
?>
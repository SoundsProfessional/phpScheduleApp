
<!--Connor Ireland-->

<?php


require('../header.php');
require('reusable/bizNav.php');

include('../calendarContainer.php');


$monthb = new CalendarContainer('month');

//the nature of the payload will change with the cellcreator and be inserted into it later
//I hate sending this in with a string.
echo 'Theprototype calendar is being stored here temporarily</br>';
echo $monthb->show(htmlentities($_SERVER['PHP_SELF']), 'requirementsCellCreator');

require('../footer.php');
?>


?>
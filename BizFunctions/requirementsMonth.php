<?php
if (session_status() == PHP_SESSION_NONE || session_id() == '') {
    session_start();
}
//<!--Connor Was Here-->


require('../header.php');
require('reusable/bizNav.php');

include('../calendarContainer.php');


$monthb = new CalendarContainer('month');

//the nature of the payload will change with the cellcreator and be inserted into it later
//I hate sending this in with a string.

echo 'I have come to believe that this is not a useful functionality.</br>';
echo $monthb->show(htmlentities($_SERVER['PHP_SELF']), 'requirementsCellCreator');

require('../footer.php');
?>


?>
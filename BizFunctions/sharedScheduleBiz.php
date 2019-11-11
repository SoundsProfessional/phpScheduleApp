<?php
if (session_status() == PHP_SESSION_NONE || session_id() == '') {
    session_start();
}
//<!--Connor Was Here-->

require('../header.php');
require('reusable/bizNav.php');


include('../calendarContainer.php');


$monthsc = new CalendarContainer('month');

//the nature of the payload will change with the cellcreator and be inserted into it later
//I hate sending this in with a string.
echo "<form method='post' action='indexB.php'>";
echo $monthsc->show(htmlentities($_SERVER['PHP_SELF']), 'schedCellCreator');

echo "</form>";

require('../footer.php');
?>




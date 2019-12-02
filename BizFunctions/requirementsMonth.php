<?php
if (session_status() == PHP_SESSION_NONE || session_id() == '') {
    session_start();
}
//<!--Connor Was Here-->


require('../header.php');
require('reusable/bizNav.php');

include('../calendarContainer.php');


$monthb = new CalendarContainer('month');


echo "Set required notice for a change to availability, in calendar weeks.
<br/>If you input zero then employees can change their availability during the current week.
<br/>If you input '1', they can change their availability as soon as this coming Monday.
<br/>Employees can't set their availability as negative OR affirmative within this threshold.<br/>";
echo '<span id="range">
<form method="post" action="indexB.php">
<input type="number" value="11" min = "0" max = "52" name="notice" />
<input type="submit", value="Okay">
<input type="hidden" name="note" value="x">
</form>
</span></p></div>';


require('../footer.php');
?>


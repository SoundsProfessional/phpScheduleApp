<!--Placeholder-->
<!--Connor Ireland-->

<!--Connor Was Here-->
<?php

require('../header.php');
require('reusable/bizNav.php');


include('../calendarContainer.php');


$monthsc = new CalendarContainer('month');

//the nature of the payload will change with the cellcreator and be inserted into it later
//I hate sending this in with a string.
echo $monthsc->show(htmlentities($_SERVER['PHP_SELF']), 'schedCellCreator');

require('../footer.php');
?>

$makeMonth = new MakeMonth('scheduleBuilder.php',
    new SchedCellCreatorMonthBiz);
//the cell creator above is what distinguishes the different month views in the process
//API or other DB functions will be affected by the cellCreator in play.
echo $makeMonth->show();

require('../footer.php');


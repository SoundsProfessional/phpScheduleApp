<!--This is a modified version of the sevenDayView, it is the branch of the RequirementsMonth-->
<!--Connor Ireland-->

<?php

require('../header.php');
require('reusable/bizNav.php');

include('../calendarContainer.php');
echo "there's nothing developed here, yet. The calendar below is JUNK, just delete it.";

$monthb = new CalendarContainer('month');

//the nature of the payload will change with the cellcreator and be inserted into it later
//I hate sending this in with a string.
echo $monthb->show(htmlentities($_SERVER['PHP_SELF']),

//THIS IS THE MOST IMPORTANT THING ABOUT USING THIS FILE AND OTHERS LIKE IT.
    'minimalCellCreator2');
//IS SPECIFYING THE CELLCREATOR. THIS IS THE ONLY THING YOU CHANGE IN THIS FILE



require('../footer.php');
?>

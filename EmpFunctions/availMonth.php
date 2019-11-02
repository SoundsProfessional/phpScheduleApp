<!--just a placeholder-->

<!--Connor Ireland-->


<?php

require('../header.php');
require('reusable/empNav.php');




include('../calendarContainer.php');


$monthb = new CalendarContainer('month');



echo '<form method="post" action="indexE.php">';
echo $monthb->show(htmlentities($_SERVER['PHP_SELF']),

    //THIS IS THE MOST IMPORTANT THING ABOUT USING THIS FILE AND OTHERS LIKE IT.
    'availCellCreator');
//IS SPECIFYING THE CELLCREATOR. THIS IS THE ONLY THING YOU CHANGE IN THIS FILE

echo 'checkbox to make this a default moving fwd, button to submit';
echo '

    <input type="checkbox" name="DefaultP"><br/>
    <input type="submit">
</form>
';

require('../footer.php');
?>


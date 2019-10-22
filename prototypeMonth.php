<!--This file is not really a page that will appear in the final program. It is a
basic working prototype of the wide month, which shows leading and trailing days,
and it matches the week view which shows 7 days. I am willing to try improving this
code but it was my intention to work from this base line for the other app pages which
involve a month view or a week view.-->

<!--Connor Ireland-->


<?php

require('reusable/header.php');
require('reusable/nav.php');

include('cellCreators.php');
include('functionalizedMonthPrototype.php');
$functionalizedMonthPrototype = new FunctionalizedMonthPrototype(
    new minimalCellCreatorWithLink);
//the cell creator above is what distinguishes the different month views in the process
//API or other DB functions will be affected by the cellCreator in play.
echo $functionalizedMonthPrototype->show();

require('reusable/footer.php');
?>

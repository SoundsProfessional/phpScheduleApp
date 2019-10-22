<?php

//This has the needCellCreator in it, and it looks terrible because of the CSS formatting.
//it looks so bad that it is non functional.
require('reusable/header.php');
require('reusable/nav.php');
include('cellCreators.php');
include('functionalizedMonthPrototype.php');
$functionalizedMonthPrototype = new FunctionalizedMonthPrototype(
    new needCellCreator);
//the cell creator above is what distinguishes the different month views in the process
//API or other DB functions will be affected by the cellCreator in play.
require('reusable/footer.php');

?>
<!--Connor Was Here-->
<?php
include("cellCreators.php");

class CalendarIter
{
    private $workTime = null; //the working day for the iterator
    private $weekOrMonth = 'month';
    private $cellCreator = null;

    /**
     * CalendarIter constructor.
     */
    public function __construct($weekOrMonth)
    {  //set the function to stop the two iterators in show.
        $this->weekOrMonth = $weekOrMonth;
        $_GET['naviHref'] = htmlentities($_SERVER['PHP_SELF']);
        if (!isset($_GET['currT'])) {

            $_GET['currT'] = time();
        }

        if ($_GET['weekOrMonth'] != 'week') {
            $this->weekOrMonth = 'week';
        } else {
            $weekOrMonth = 'WONT EVER CALL THIS';
        }

        if ($this->workTime == null) {
            $this->workTime = $_GET['currT'];
        }

    }

    public function show($payload, $func)
    //THE CELL CREATOR WORKS ON AN ITERATIVE BASIS

    {
        $this->workTime = $_GET['currT'];
        $this->cellCreator = new $func();
        $contents = $this->cellCreator->show($this->workTime, $payload . '?weekOrMonth=' . $this->weekOrMonth, $this->weekOrMonth);

        //FIRST WE ITERATE BACKWARDS

        while (!$this->haltDecrementation()) {
            $this->workTime = intval($this->workTime) - 86400;
            //echo 'dec' . $this->workTime;
            $contents = $this->cellCreator->show($this->workTime, $payload . '?weekOrMonth=' . $this->weekOrMonth,
                    $this->weekOrMonth
                ) . $contents;
        }
        $this->workTime = intval($_GET['currT']) + 86400;

        //THEN WE ITERATE FORWARDS

        while (!$this->haltIncrementation()) { //the forwards iteration
            $contents .= $this->cellCreator->show($this->workTime, $payload . '?weekOrMonth=' . $this->weekOrMonth,
                $this->weekOrMonth
            );
            $this->workTime += 86400;
        }
        $contents .= '</ul>';


        if ($_GET['weekOrMonth'] == 'week') {

            $contents .= '<div class="clear" style="width:100%">
    <input type="hidden" name="currT" value=' . $_GET['currT'] . '>
    <input type="checkbox" name="DefaultP">Consider this as a default week
    <input type="submit"></div>';

        }
        return $contents;
    }
    //THESE ARE THE RULES TO FIND THE TOP-LEFT CORNER OF THE CALENDAR
    function haltDecrementation()
    {
        return ( //THIS BLOCK TEST WHETHER THE CURRENT DAY IS A SUNDAY
            date('N', intval($this->workTime)) == 7
            && // THIS BLOCK CHECKS THAT THE DATE HAS ASCENDED IN DECREMENTATION
            // MEANING THAT WE HAVE ENTERED A NEW MONTH
            (
                intval(date('m', $this->workTime - 86400))
                !=
                intval(date('m', intval($_GET['currT'])))
                || // IF IT WAS JUST A WEEK VIEW, WE WILL STOP NOW.
                $_GET['weekOrMonth'] == 'week'
            )
        );
    }

    //THESE ARE THE RULES TO FIND THE BOTTOM RIGHT CORNER OF THE CALENDAR
    function haltIncrementation()
    {
        return ( //it must be a saturday
            date('N', $this->workTime) == 7
            && // AND the month has changed
            (
                intval(date('m', $this->workTime + 86400))
                !=
                intval(date('m', intval($_GET['currT'])))
                || // OR we only ever wanted to see a week anyway
                $_GET['weekOrMonth'] == 'week'
                || // OR the last day of the month is a Saturday
                date('t', intval($_GET['currT'])) == date('d', intval($this->workTime))
            )
        );
    }

}


?>
<!--Connor Was Here-->
<?php //initialize the vars
include('calendarIter.php');

//include('cellCreators.php');


class CalendarContainer
//Some hard consideration for the question of the currT construct
//when you click down to the week the currT will change to the cell you clicked on
//but will that cast a red box and suggest to the world that this is the actual current time
//
//so the solution is another global variable called realTime
//that is the actual current time, the red box will draw based on realtime
//but the reference variable will be currT
//Also every time I say 'time' i just mean date, there is no concept of time in this app


{
    private $weekOrMonth = 'NOT_INITIALIZED';

    /**
     * CalendarContainer constructor.
     */
    public function __construct($weekOrMonth)
    {
        $this->weekOrMonth = $weekOrMonth;
    }


    function show($pay, $func)
    {
        $callnIt = new CalendarIter($this->weekOrMonth);
        return '<div id="calendar"><div class="box">'
            . $this->_createNavi() . '
    </div>
    <div class="box-content">
        <ul class="label">
            ' . $this->_createLabels() . '
        </ul>
        <div class="clear"></div><ul class="dates">

            ' . '' . $callnIt->show($pay, $func) . '
    </ul><div class="clear"></div></div></div>';
    }


    private function _createNavi()
    {
        if ($_GET['weekOrMonth'] != 'week') {
            $working = intval($_GET['currT']);
            $prev = intval($_GET['currT']) - (30 * 86400);
            $next = intval($_GET['currT']) + (30 * 86400);
            return '<div class="header">' .
                '<a class="prev" href="'
                . $_GET['naviHref'] . '?currT=' . $prev . '&weekOrMonth=month">back to ' . date('M', $prev) . '</a><span class=title>' .
                date("M,Y", $working) . '</span>
<a class="next" href="'
                . $_GET['naviHref'] . '?currT=' . $next . '&weekOrMonth=month">Next</a> </div>';
        } else {

            return '<div class="header">' .
                '<a class="prev" href="'
                . $_GET['naviHref'] . '?currT=' . $_GET['currT'] . '&weekOrMonth=month">Back Up To Month</a><span class=title>' .
                date("M,Y", intval($_GET['currT'])) . '</span>
</div>';
        }
    }

    /**
     * create calendar week labels
     */
    private function _createLabels()
    {
        $content = '';
        foreach (array("Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat")
                 as $index => $label) {
            $content .= '<li class=" title">' . $label . '</li>';
        }
        return $content;
    }

}

?>
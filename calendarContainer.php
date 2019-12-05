<!--Connor Was Here-->
<?php //initialize the vars
include('calendarIter.php');

//include('cellCreators.php');

//CALENDAR CONTAINER WORKS IN A PARTICULAR WAY
//IT TAKES AN ARG, IF THE ARG IS 'WEEK' IT WILL STOP AT SUNDAY
// OTHERWISE IT WILL STOP AT SUNDAY IF THAT DAY IS THE FIRST OF THE MONTH OR THE FALLS WITHIN THE PREVIOUS MONTH
//THUSLY, IT DETERMINES WHEN IT WILL STOP CREATING NEW DAYS FOR THE VIEW.

class CalendarContainer

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
    <div class="clear"></div></div></div>';
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
                . $_GET['naviHref'] . '?currT=' . $next . '&weekOrMonth=month">' . SQLfmtDate($next) . '</a> </div>';
        } else {

            return '<div class="header">' .
                '<a class="prev" href="'
                . $_GET['naviHref'] . '?currT=' . $_GET['currT'] . '&weekOrMonth=month">Back Up To Month</a><span class=title>' .
                date("M,Y", intval($_GET['currT'])) . '</span>
</div>';
        }
    }


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
<!--This file is not really a page that will appear in the final program. It is a
basic working prototype of the wide month, which shows leading and trailing days,
and it matches the week view which shows 7 days. I am willing to try improving this
code but it was my intention to work from this base line for the other app pages which
involve a month view or a week view.-->

<!--Connor Ireland-->


<?php
//include 'cellCreators.php';

class FunctionalizedMonthPrototype
{

    /******z**** properties ********************/
    private $dayLabels = array("Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun");
    private $currentYear = 0;
    private $currentMonth = 0;
    private $dayIncr = 0;
    private $completeDate = null;
    private $daysInMonth = 0;
    private $naviHref = null;
    private $creator = null;

    /**
     * Constructor
     */
    public function __construct($cellCreator)
    {
        $this->naviHref = htmlentities($_SERVER['PHP_SELF']);
        $this->cellCreator = $cellCreator;
    }


    /**
     * print out the calendar
     */
    public function show()
    {
        $year = null;
        $month = null;

        if (null == $year && isset($_GET['year'])) {
            $year = $_GET['year'];
        } else if (null == $year) {
            $year = date("Y", time());
        }

        if (null == $month && isset($_GET['month'])) {
            $month = $_GET['month'];
        } else if (null == $month) {
            $month = date("m", time());
        }
//^^^^^^^^setup for the top bar ^ time stuff
        $this->currentYear = $year;
        $this->currentMonth = $month;


        $this->daysInMonth = $this->_daysInMonth($month, $year);

        $content = '<div id="calendar">' .
            '<div class="box">' .
            $this->_createNavi() .
            '</div>' .
//^^^^^^^^^^^^^^^^^^^^^^^navbar
            '<div class="box-content">' .
            '<ul class="label">' . $this->_createLabels() . '</ul>';
        $content .= '<div class="clear"></div>';
//^^^^^^^^^^^^^^sun mon tues etc
        $content .= '<ul class="dates">';
//--^^^^^unordered list
        $weeksInMonth = $this->_weeksInMonth($month, $year);
        // Create weeks in a month
        for ($i = 0; $i < $weeksInMonth; $i++) {
            for ($j = 1; $j <= 7; $j++) {
                //-----------^^^row assembly
                $content .= $this->_showDay($i * 7 + $j);
                //----^^^^cell assembly
            }
        }

        $content .= '</ul><div class="clear"></div></div></div>';
        return $content;
    }


    private function _showDay($cellNumber)
        //THIS IS THE BRANCHING WHERE LEADING, TRAILING, AND PROPER DAYS ARE MANAGED.
    {
        if ($this->dayIncr == 0) {
            $firstDayOfTheMonth = date('N', strtotime($this->currentYear . '-' . $this->currentMonth . '-01'));
//--^^numeric label for mon tues wed etc


//catches the transition from leading month days to current month days
            if (intval($cellNumber) == intval($firstDayOfTheMonth)) {
                $this->dayIncr = 1;
            } else {


                //                THIS HANDLES LEADING DAYS
                $adjustedDay = $cellNumber % 7;
                $adjustedMonth = $this->currentMonth == 1 ? 12 : $this->currentMonth - 1;
                $adjustedYear = $this->currentMonth == 1 ? intval($this->currentYear) - 1 : $this->currentYear;
                $numDaysLastMonth = $this->_daysInMonth($adjustedMonth, $adjustedYear);
                $adjustedDate = $numDaysLastMonth - $firstDayOfTheMonth + $adjustedDay + 1;
                $linkTo = 'sevenDayView.php?month=' . $this->currentMonth . '&year=' . $this->currentYear . '&date=' . $adjustedDate . '&cell=' . $cellNumber;
            }
        }

//        THIS HANDLES PROPER DAYS OF THIS MONTH
        if (($this->dayIncr != 0) && ($this->dayIncr <= $this->daysInMonth)) {
            $this->completeDate = date('Y-m-d', strtotime($this->currentYear . '-' . $this->currentMonth . '-' . ($this->dayIncr)));
            //--vv the big number in the middle of the cell
            $linkTo = 'sevenDayView.php?month=' . $this->currentMonth . '&year=' . $this->currentYear . '&date=' . $this->dayIncr . '&cell=' . $cellNumber;
            $adjustedDate = $this->dayIncr;
            $this->dayIncr++;
        } //-------------------THIS HANDLES TRAILING DAYS
        elseif ($this->dayIncr != 0) {
            $adjustedDay = $cellNumber % 7;
            $adjustedMonth = $this->currentMonth == 11 ? 1 : $this->currentMonth + 1;
            $adjustedYear = $this->currentMonth == 11 ? intval($this->currentYear + 1) : $this->currentYear;
            $numDaysThisMonth = $this->_daysInMonth($this->currentMonth, $this->currentYear);

            $adjustedDate = $this->dayIncr - $numDaysThisMonth;
            $this->dayIncr++;
            $linkTo = 'sevenDayView.php?month=' . intval($adjustedMonth) . '&year=' . $adjustedYear . '&date=' . $this->dayIncr . '&cell=' . $cellNumber;
        }
        $minCCWithLink = new $this->cellCreator();
        $content = $minCCWithLink->show($adjustedDate, $linkTo);
        return $content;
        ($cellContent == null ? 'mask' : '') . '">' . $cellContent . '</li></a>';
    }

    /**
     * create navigation
     */
    private function _createNavi()
    {

        $nextMonth = $this->currentMonth == 12 ? 1 : intval($this->currentMonth) + 1;
        $nextYear = $this->currentMonth == 12 ? intval($this->currentYear) + 1 : $this->currentYear;
        $preMonth = $this->currentMonth == 1 ? 12 : intval($this->currentMonth) - 1;
        $preYear = $this->currentMonth == 1 ? intval($this->currentYear) - 1 : $this->currentYear;

        return
            '<div class="header">' .
            '<a class="prev" href="' . $this->naviHref . '?month=' . sprintf('%02d', $preMonth) . '&year=' . $preYear . '">Prev</a>' .
            '<span class="title">' . date('Y M', strtotime($this->currentYear . '-' . $this->currentMonth . '-1')) . '</span>' .
            '<a class="next" href="' . $this->naviHref . '?month=' . sprintf("%02d", $nextMonth) . '&year=' . $nextYear . '">Next</a>' .
            '</div>';
    }

    /**
     * create calendar week labels
     */
    private function _createLabels()
    {

        $content = '';

        foreach ($this->dayLabels as $index => $label) {
            $content .= '<li class="' . ($label == 6 ? 'end title' : 'start title') . ' title">' . $label . '</li>';
        }

        return $content;
    }


    /**
     * calculate number of weeks in a particular month
     */
    private function _weeksInMonth($month = null, $year = null)
    {

        if (null == ($year)) {
            $year = date("Y", time());
        }
        if (null == ($month)) {
            $month = date("m", time());
        }

        // find number of days in this month
        $daysInMonths = $this->_daysInMonth($month, $year);
        $numOfweeks = ($daysInMonths % 7 == 0 ? 0 : 1) + intval($daysInMonths / 7);
        $monthEndingDay = date('N', strtotime($year . '-' . $month . '-' . $daysInMonths));
        $monthStartDay = date('N', strtotime($year . '-' . $month . '-01'));

        if ($monthEndingDay < $monthStartDay) {
            $numOfweeks++;
        }

        return $numOfweeks;
    }

    /**
     * calculate number of days in a particular month
     */
    private function _daysInMonth($month = null, $year = null)
    {
        if (null == ($year)) {
            $year = date("Y", time());
        }
        if (null == ($month)) {
            $month = date("m", time());
        }
        return date('t', strtotime($year . '-' . $month . '-01'));
    }

}

?>



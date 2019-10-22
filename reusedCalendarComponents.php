<?php

class reusedCalendarComponents
{

    //This isn't working, it doesn't drop itself into the calendar view
    //<!--MonthInnerNavbar-->

    public function getMonthInnerNavbar($month, $year)
    {
        $naviHref = htmlentities($_SERVER['PHP_SELF']);
        $nextMonth = $month == 12 ? 1 : intval($month) + 1;
        $nextYear = $month == 12 ? intval($year) + 1 : $year;
        $preMonth = $month == 1 ? 12 : intval($month) - 1;
        $preYear = $month == 1 ? intval($year) - 1 : $year;

        echo
            '<div class="header">' .
            '<a class="prev" href="' . $naviHref . '?month=' . sprintf('%02d', $preMonth) . '&year=' . $preYear . '">Prev</a>' .
            '<span class="title">' . date('Y M', strtotime($year . '-' . $month . '-1')) . '</span>' .
            '<a class="next" href="' . $naviHref . '?month=' . sprintf("%02d", $nextMonth) . '&year=' . $nextYear . '">Next</a>' .
            '</div>';
    }

//<!--WeekInnerNavbar-->

    public function getWeekInnerNavbar()
    {

        echo ' ';

    }


}

?>


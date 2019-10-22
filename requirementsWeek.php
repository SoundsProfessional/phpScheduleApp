<!--This is a modified version of the sevenDayView, it is the branch of the RequirementsMonth-->
<!--Connor Ireland-->

<?php
include 'cellCreators.php';
require('reusable/header.php');
require('reusable/nav.php');
?>




<?php

class sevenDayView
{


    public function __construct()
    {

    }

    /********************* PROPERTIES ********************/
    private $dayLabels = array("Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun");
    private $currentYear = 0;
    private $currentMonth = 0;
    private $dayIncr = 0;
    private $completeDate = null;

    /********************* PUBLIC **********************/

    /**
     * print out the calendar
     */
    public function show()
    {
        $year = null;
        $month = null;
        $date = null;
        $weekOfMonth = null;
        $cellN = null;
        $cellCounter = 0;

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

        if (null == $date && isset($_GET['date'])) {
            $date = $_GET['date'];
        } else if (null == $month) {
            $date = date("m", time());
        }

        if (null == $cellN && isset($_GET['cell'])) {
            $cellN = $_GET['cell'];
        } else if (null == $cellN) {
            $cellNum = 0;
        }
        //$weekOfMonth GONNA PASS IN THE CELL NUM, MAKE THIS EASIERER

//^^^^^^^^setup for the top bar ^ time stuff
        $this->currentYear = $year;
        $this->currentMonth = $month;


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

        $dayOfWeek = date('N', strtotime($this->currentYear . '-' . $this->currentMonth . '-' . ($date)));
//        echo 'DOW and date: '.$dayOfWeek.' '.$date.'<br/>';
        $difference = $dayOfWeek - 1;
//        echo 'DIF: '.$difference.'<br/>';
        $workingDate = strtotime($this->currentYear . '-' . $this->currentMonth . '-' . ($date)) - 86400 * $difference;
//        echo 'WD: '.date('N-m-d',$workingDate).'<br/>';
        $minCell = new needCellCreator();
        for ($i = 0; $i < 7; $i++) {
            //$content .= $this->simplifiedDay(date('N',$workingDate));
            $workingDate += 82400;
            $content .= $minCell->show(date('d', $workingDate));
        }


        $content .= '</ul>';
        $content .= '<div class="clear"></div>';
        $content .= '</div>';
        $content .= '</div>';
        return $content;
    }


    private function _createNavi()
    {

        return
            '<div class="header">' .
            '<a class="prev" href="requirementsMonth.php?month=' . sprintf('%02d', $this->currentMonth) . '&year=' . $this->currentYear . '">Back Up To Month</a>' .
            '<span class="title">REQUIREMENTS</span></div>';
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


}


?>


<?php

$sevenDays = new sevenDayView();

echo $sevenDays->show();

require('reusable/footer.php');
?>









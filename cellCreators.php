<!--minimal creator-->

<?php

class minimalCellCreator2 //this is the name that will be called from the calendarContainer's show function
{
//this is only a prototype, all cell creators will now have a week and month dimension.
//the payload will be defined at the caller of the calenderiter class
//and passed anonymously through calenderiter's show function
    public function show($time, $payload, $weekOrMonth)
    {
        if ($_GET['weekOrMonth'] != 'week') { //MONTH VIEW
            return "<li class='calendIterCell'><a href="
                . $payload .

                ">PrototypeMonthCell<br/>Needs to be replaced!"
                . date('d', $time) . "</a></li>";
        } else { //WEEK VIEW
            $content = "<li class='calendIterCell"; //see that it lacks an inner close quote
            $content .= "'>prototypeWeekCell" . date('S, d', $time) . " time/realtime " . $time . "==" . time() . "</li>";
            return $content;
        }
    }
}


class schedCellCreator
{
//this is only a prototype, all cell creators will now have a week and month dimension.
//the payload will be defined at the caller of the calenderiter class
//and passed anonymously through calenderiter's show function
    public function show($time, $payload, $weekOrMonth)
    {
        if ($_GET['weekOrMonth'] != 'week') { //MONTH VIEW
            return "<li class='calendIterCell'><a href="
                . $payload .

                ">scheduleBuilderMonthCell"
                . date('d', $time) . "</a></li>";
        } else { //WEEK VIEW
            $content = "<li class='calendIterCell"; //see that it lacks an inner close quote
            $content .= "'>scheduleBuilderWeekCell" . date('S, d', $time) . " time/realtime " . $time . "==" . time() . "</li>";
            return $content;

        }

    }
}

class requirementsCellCreator
{
//this is only a prototype, all cell creators will now have a week and month dimension.
//the payload will be defined at the caller of the calenderiter class
//and passed anonymously through calenderiter's show function
    public function show($time, $payload, $weekOrMonth)
    {
        if ($_GET['weekOrMonth'] != 'week') { //MONTH VIEW
            return "<li class='calendIterCell'><a href="
                . $payload .

                ">requiMonthCell"
                . date('d', $time) . "</a></li>";
        } else { //WEEK VIEW
            $content = "<li class='calendIterCell"; //see that it lacks an inner close quote
            $content .= "'>requiWeekCell" . date('S, d', $time) . " time/realtime " . $time . "==" . time() . "</li>";
            return $content;

        }

    }
}

class availCellCreator
{
//this is only a prototype, all cell creators will now have a week and month dimension.
//the payload will be defined at the caller of the calenderiter class
//and passed anonymously through calenderiter's show function
    public function show($time, $payload, $weekOrMonth)
    {
        if ($_GET['weekOrMonth'] != 'week') { //MONTH VIEW
            return "<li class='calendIterCell'><a href="
                . $payload .

                ">requiMonthCell"
                . date('d', $time) . "</a></li>";
        } else { //WEEK VIEW
            $content = "<li class='calendIterCell"; //see that it lacks an inner close quote
            $content .= "'>requiWeekCell" . date('S, d', $time) . " time/realtime " . $time . "==" . time() . "</li>";
            return $content;

        }

    }
}

class sharedSchedEmpCellCreator
{
//this is only a prototype, all cell creators will now have a week and month dimension.
//the payload will be defined at the caller of the calenderiter class
//and passed anonymously through calenderiter's show function
    public function show($time, $payload, $weekOrMonth)
    {
        if ($_GET['weekOrMonth'] != 'week') { //MONTH VIEW
            return "<li class='calendIterCell'><a href="
                . $payload .

                ">sharedEmpMonthCell"
                . date('d', $time) . "</a></li>";
        } else { //WEEK VIEW
            $content = "<li class='calendIterCell"; //see that it lacks an inner close quote
            $content .= "'>sharedEmpWeekCell" . date('S, d', $time) . " time/realtime " . $time . "==" . time() . "</li>";
            return $content;

        }

    }
}


class minimalCellCreator
{

    public function __construct()
    {

    }

    public function show($displayDirectly)
    {
        $content = "<li class='simpleCell'>" . $displayDirectly . "</li>";
        return $content;
    }
}

class minimalCellCreatorWithLink
{

    public function __construct()
    {

    }

    public function show($displayDirectly, $linkToPrefix, $linkToSuffix)
    {
        $content = '<li class="calendIterCell">' . $displayDirectly . '</li>'; //<a href="' . $linkToPrefix . $linkToSuffix . '">
        return $content;
    }
}


?>


<!--staffing creator -->

<!--need creator -->
<?php

class weekAvailCellCreator
{
    public function show($displayDirectly, $linkTo)
    {
        return "<li class='crowdedCell'>" . date('m/d', $displayDirectly) . "</li>";
    }
}

class needCellCreatorWeek
{
    private $naviHref = null;

    public function __construct()
    {
        $this->naviHref = htmlentities($_SERVER['PHP_SELF']);
    }

    public function show($displayDirectly, $linkTo) //I would like to put in the MON, TUES, WEDS here, instead of in the other cell
    { //THE FORM SUBMIT ISNT WORKING, BUT i WANT IT TO GO TO THE DB ANYWAY
        $mo = date("M", $displayDirectly);
        $day = date("M", $displayDirectly);

        $content = "<li class = 'crowdedCell'>
<a href=" . $linkTo .
            "?month=" . date("m", $displayDirectly) .
            "?year=" . date("Y", $displayDirectly) .
            "?date=" . date("d", $displayDirectly) .
            " method='post'>" . date("M d", $displayDirectly);
        $content .= '<input type="text" name="requirement" value="">';
        $content .= '<input type="submit" value="Submit">';
        $content .= '</form></li>';
        return $content;
    }
}

class needCellCreatorMonth
{
    private $naviHref = null;

    public function __construct()
    {
        $this->naviHref = htmlentities($_SERVER['PHP_SELF']);
    }

    public function show($displayDirectly, $linkToPrefix, $linkToSuffix) //I would like to put in the MON, TUES, WEDS here, instead of in the other cell
    { //THE FORM SUBMIT ISNT WORKING, BUT i WANT IT TO GO TO THE DB ANYWAY
        $content = "<li class='crowdedCell'><a href=" . $linkToPrefix . $linkToSuffix . " method='post'>" . $displayDirectly . "<br/>needCellCreator is being used. ";

        $content .= '<br/>x/y</li>';
        return $content;
    }
}

class SchedCellCreatorWeek
{

    public function show($displayDirectly, $linkTo)
    {
        return "<li class='crowdedCell'><a href=" . $linkTo . " method='post'>" . "this will be the most complicated cell creator" . "</a></li>";
    }


}

class SchedCellCreatorMonthBiz
{

    public function __construct()
    {
        $this->naviHref = htmlentities($_SERVER['PHP_SELF']);
    }

    public function show($displayDirectly, $linkToPrefix, $linkToSuffix) //I would like to put in the MON, TUES, WEDS here, instead of in the other cell
    { //THE FORM SUBMIT ISNT WORKING, BUT i WANT IT TO GO TO THE DB ANYWAY
        $content = "<li class='crowdedCell'><a href=" . $linkToPrefix . $linkToSuffix . " method='post'>" . "scheduleCellCreator" . "<br/>x/y</a></li>";


        return $content;
    }
}

?>


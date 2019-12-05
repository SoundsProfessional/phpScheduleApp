<?php
//<!--Connor Was Here-->
include_once('dbTdFuncs.php');

//CELL CREATORS WORK IN A PARTICULAR WAY.
//THEY ARE CALLED BY THE CALENDARITER
//WHICH HAS GOTTEN ITS ARG FROM THE CALENDARCREATOR
//(THIS ARG IS WEEK OR MONTH)
//THE CELL CREATOR HAS DIFFERENT VIEWS
//WHETHER WE ARE LOOKING AT THE WEEK OR MONTH

class schedCellCreator
{
    public function show($time, $payload, $wastedArgument)
    {
        if ($_GET['weekOrMonth'] != 'week') { //MONTH VIEW

            $content = "<li class='calendIterCell'><a href="
                . $payload . "&currT=" . $time . " >";
            $content .= '<b>' . SQLfmtDate($time) . '</b><br/>';
            $result = getAssociativeOfScheduledEmployees(getLastMonday($time), $time);
            for ($i = 0; $i < $result->num_rows; $i++) {
                $row = $result->fetch_assoc();

                $content .= $row['empName'] . "<BR/>";

            }
            $content .= "</a></li>";
            return $content;


        } else { //WEEK VIEW
            $content = "<li class='calendIterCell"; //see that it lacks an inner close quote
            $content .= "'><div>"
                . $this->createTopCell($time) . "</div><div>" .
                //BOTTOM CELL CREATOR
                $this->createBottomCell($time) . "</div>
</a></li>";
            return $content;
        }
    }


    private function createBottomCell($time)
    { //WHO IS AVAILABLE? CHECK BOXES ARE PROVIDED.
        $submission = scheduleSubmission::getInstance($_SESSION['bizName'], getLastMonday($time));

        $content = 'availableToSchedule<br/>';
        $result = getAssociativeOfAvailableEmployees(getLastMonday($time), $time);

        for ($i = 0; $i < $result->num_rows; $i++) {
            $row = $result->fetch_assoc();

            $content .= "<input type='checkbox' name='" . $time . "' value='" .
                $row['name'] . "'";
            $content .= "'>   <input type='hidden' name='worker' value='True'> " .
                $row['name'] . "<br/>";
        }

        return $content;
    }


    private function createTopCell($time)
    { //THIS IS THE ACTUAL SCHEDULE. NO CHECK BOXES ARE PROVIDED
        $content = 'Curr(' . SQLfmtDate($time) . ')<br/>';
        $result = getAssociativeOfScheduledEmployees(getLastMonday($time), $time);
        //    echo 'bang!';
        foreach ($result as $x => $y) {
            $content .= $y['empName'] . "<br/>";
        }
        for ($i = 0; $i < $result->num_rows; $i++) {
            $row = $result->fetch_assoc();
            $content .= $row['empName'] . "<BR/>";

        }

        return $content;
    }
}


class availCellCreator
{
    public function show($time, $payload, $wastedArgument)
    {
        $sunDate = getLastMonday($time);


        if ($_GET['weekOrMonth'] != 'week') { //MONTH VIEW
            //query for true or false value attached to monday
            //maybe pass the payload or just alter this return string as a $content
            return "<li class='calendIterCell'><a href="
                . $payload .
                "&currT=" . $time . ">"
                . date('d', $time) . "</a></li>";

//            YOU WILL NEED SPECIAL LOGIC HERE AND IN THE OTHER
//            S.T. YOU RUN THE FINDMONDAY FUNCTION, GET THE STRING OF THE
//            'N' VALUE OF THE TIME OBJECT, CALL THE DATABASE WITH THE MONDAY
//            TIMESTAMP AND THE N VALUE TO ACCESS THE STORED AVAILABILITY
        } else { //WEEK VIEW
            $content = "<li class='calendIterCell"; //see that it lacks an inner close quote
            $content .= "'>";

            $content .= getDayAvail($sunDate, $time) .
                "<BR/>" . date('d', $time) . "
                <input type='checkbox' name='" . date('N', $time) . "'>

                <input type='hidden' name='sunDateMirror' value='".$sunDate."'>
                <input type='hidden' name='sunDate' value='".$sunDate."'>
                </li>";
            return $content;


            return $content;

        }
    }
}

?>
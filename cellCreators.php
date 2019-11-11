<?php
//<!--Connor Was Here-->
include_once('dbTdFuncs.php');


//GETTING THE LIST OF SCHEDULED PEOPLE FOR THAT DAY





class schedCellCreator
{
//this is only a prototype, all cell creators will now have a week and month dimension.
//the payload will be defined at the caller of the calenderiter class
//and passed anonymously through calenderiter's show function
    public function show($time, $payload, $wastedArgument)
    {
        if ($_GET['weekOrMonth'] != 'week') { //MONTH VIEW
            return "<li class='calendIterCell'><a href="
                . $payload .
                "><h3>Q/Q/Q<br/>" . SQLfmtDate($time) . "</h3>";


        } else { //WEEK VIEW
            $content = "<li class='calendIterCell"; //see that it lacks an inner close quote
            $content .= "'><div>"
                //TOP FIELD CREATOR
                //CHECK BOXES GENERATED FOR EACH SCHEDULED PERSON
                . $this->createTopCell($time) . "</div><div>" .
                //BOTTOM CELL CREATOR
                $this->createBottomCell($time) . "</div>
</a></li>";
            return $content;
        }
    }


    private function createBottomCell($time)
    {
        $submission = scheduleSubmission::getInstance($_SESSION['bizName'], getLastMonday($time));

        $content = '';
        $result = getAssociativeOfAvailableEmployees(getLastMonday($time), $time);
//        $deletionStatement = 'delete from explicitListDayEmp where bizName = '.$_SESSION['bizName'].' and mondate = '.getLastMonday($time).';';
//        $submission->append($deletionStatement);
//This creates a whole insert statement for the checkbox
        for ($i = 0; $i < $result->num_rows; $i++) {
//            $singleInsertStatement = "insert into explicitListDayEmp" .
//                " (bizname, empname, mondate, dayIncr, isDefault) values ";
//
//            $singleInsertStatement .= "('".$_SESSION['bizName'] . "', '";
            $row = $result->fetch_assoc();


            //$submission->append($singleInsertStatement); I need to do this later, on the next page.

            $content .= "<input type='checkbox' name='" . $time . "' value='" . $row['name'] . "'";
            $content .= "'>   <input type='hidden' name='worker' value='True'> " . $row['name'] . "<br/>";
        }

        return $content;
    }


    private function createTopCell($time)
    {
        return date('d', $time);
    }
}


//DISUSED
class requirementsCellCreator
{
//this is only a prototype, all cell creators will now have a week and month dimension.
//the payload will be defined at the caller of the calenderiter class
//and passed anonymously through calenderiter's show function
    public function show($time, $payload, $wastedArgument)
    {
        $sunDate = getLastMonday($time);
        if ($_GET['weekOrMonth'] != 'week') { //MONTH VIEW
            return "<li class='calendIterCell'><a href="
                . $payload . "&currT=" . $time .

                ">" //. getDayAvail($sunDate, $_GET['currT'])
                . "<br/>" //changed 11/9
                . date('d', $time) . "</a></li>";
        } else { //WEEK VIEW
            $content = "<li class='calendIterCell"; //see that it lacks an inner close quote
            $content .= "'>";

            $content .= //getDayAvail($sunDate, $_GET['currT']) .
                "<BR/>" . date('d', $time) . " <input type='checkbox' name='" . date('N', $time) . "'>
                <input type='hidden' name='sunDateMirror' value='" . $sunDate . "'>
                <input type='hidden' name='sunDate' value='" . $sunDate . "'>
                </li>";
            return $content;


            return $content;

        }

    }
}

class availCellCreator
{
//this is only a prototype, all cell creators will now have a week and month dimension.
//the payload will be defined at the caller of the calenderiter class
//and passed anonymously through calenderiter's show function
    public function show($time, $payload, $wastedArgument)
    {
        $sunDate = getLastMonday($time);


        $nSteps = ($time - $sunDate + 86400) / 86400;
        $db = getConnection();
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

            $content .= getDayAvail($sunDate, $_GET['currT']) .
                "<BR/>" . date('d', $time) . " <input type='checkbox' name='" . date('N', $time) . "'>
                <input type='hidden' name='sunDateMirror' value='".$sunDate."'>
                <input type='hidden' name='sunDate' value='".$sunDate."'>
                </li>";
            return $content;


            return $content;

        }
    }
}


class sharedSchedEmpCellCreator
{
//this is only a prototype, all cell creators will now have a week and month dimension.
//the payload will be defined at the caller of the calenderiter class
//and passed anonymously through calenderiter's show function
    public function show($time, $payload, $wastedArgument)
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


//OLD JUNK. IT IS APPLIED IN THE REQUESTQUEUE
//I AM KEEPING THIS HERE FOR REFERENCE' SAKE
class minimalCellCreator2 //this is the name that will be called from the calendarContainer's show function
{
//this is only a prototype, all cell creators will now have a week and month dimension.
//the payload will be defined at the caller of the calenderiter class
//and passed anonymously through calenderiter's show function

    public function show($time, $payload, $wastedArgument)
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


?>
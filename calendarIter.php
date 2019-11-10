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

    {
        $this->workTime = $_GET['currT'];
        $this->cellCreator = new $func();
        //$orphanedCellCreator = new $func(); //what was I doing here, I am confused.
        //none of these creators have constructors, i guess maybe there is a default constructor for them.



//        $this->cellCreator = $func;
//        $orphanedCellCreator = new $func(); //what was I doing here, I am confused.


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
//            echo 'inc'.$this->workTime;
        }
        return $contents;
    }

    function haltDecrementation()
    {
        //echo date("N" ,$this->workTime)."  and  ".intval(date('d N', $this->workTime - 86400 ))." > ".intval(date('d N', $this->workTime));

        return ( //it must be a sunnday

            date('N', intval($this->workTime)) == 7 //WTF AM I DOING HERE??
            && // AND the date has ascended during decrementation
            (
                intval(date('m', $this->workTime - 86400))
                !=
                intval(date('m', intval($_GET['currT'])))

                //2nd arg was //intval(['currT'])
                || // OR we only ever wanted to see a week anyway
                $_GET['weekOrMonth'] == 'week'
            )
        );
    }

    function haltIncrementation()
    {
        //echo date("N" ,$this->workTime)."  and  ".intval(date('d N', $this->workTime - 86400 ))." > ".intval(date('d N', $this->workTime));
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
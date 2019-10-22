<!--minimal creator-->

<?php

class minimalCellCreator
{

    public function __construct()
    {

    }

    public function show($displayDirectly)
    {
        $content = "<li>" . $displayDirectly . "</li>";
        return $content;
    }
}

class minimalCellCreatorWithLink
{

    public function __construct()
    {

    }

    public function show($displayDirectly, $linkTo)
    {
        $content = '<a href="' . $linkTo . '"><li>' . $displayDirectly . '</li></a>';
        return $content;
    }
}


?>


<!--staffing creator -->

<!--need creator -->
<?php

class needCellCreator
{
    private $naviHref = null;

    public function __construct()
    {
        $this->naviHref = htmlentities($_SERVER['PHP_SELF']);
    }

    public function show($displayDirectly) //I would like to put in the MON, TUES, WEDS here, instead of in the other cell
    { //THE FORM SUBMIT ISNT WORKING, BUT i WANT IT TO GO TO THE DB ANYWAY
        $content = "<li><form action=" . $this->naviHref . " method='post'>" . $displayDirectly;
        $content .= '<input type="text" name="requirement" value="">';
//$content .= '<input type="submit" value="Submit">';
        $content .= '</form></li>';
        return $content;
    }
}

?>

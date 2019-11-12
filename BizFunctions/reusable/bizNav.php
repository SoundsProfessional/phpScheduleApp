<!--GERSON ESCOBAR-->
<?php
function tail()
{
    $suffix = '?weekOrMonth=month';
    if (isset($_GET['currT'])) {
        return $suffix . "&currT=" . $_GET['currT'];
    } else {
        return $suffix . "&currT=" . time();
    }
}


?>

<table width="100%" bgcolor="white" cellpadding="4" cellspacing="4">
    <tr>
        <td width="25%">
            <span class="menu"><a href="indexB.php<?php echo tail(); ?>">Home</a></span>
        </td>
        <td width="25%">
            <span class="menu"><a href="requirementsMonth.php<?php echo tail(); ?>">Staffing Needs</a></span>
        </td>
        <td width="25%">
            <span class="menu"><a href="sharedScheduleBiz.php<?php echo tail(); ?>">Shared Schedule</a></span>
        </td>
        <td width="25%">
            <span class="menu"><a href="requestQueue.php<?php echo tail(); ?>">Pending Requests Off</span>
        </td>
    </tr>
</table>


<!--These are Gerson's latest modifications, but they were made without regard to the
existing code base and broke too much stuff for me to fix by the time we needed to turn it in.
so I'm submitting this old, lame navbar, header and footer, from the classwork.
-->

<!--<div id="page">-->
<!--    <div id="top-nav">-->
<!--        <ul>-->
<!--            <li><a href="index.php">Home</a></li>-->
<!--            <li><a href="#">Schedule</a></li>-->
<!--            <li><a href="prototypeMonth.php">Basic Calendar Prototype</a></li>-->
<!--            <li><a href="requirementsMonth.php">Request Off/Request Approval</a></li>-->
<!--        </ul>-->
<!--    </div>-->
<!--    <div class="clr"></div>-->
<!---->
<!--    <div class="feature">-->
<!--        <div class="feature-inner">-->
<!--            <h1>Employee/Manager Home page</h1>-->
<!--        </div>-->
<!--    </div>-->
<!---->
<!---->
<!--    <div id="content">-->
<!--        <div id="content-inner">-->
<!---->
<!--            <main id="contentbar">-->
<!--                <div class="article">-->
<!--                    <p></p>-->
<!--                </div>-->
<!--            </main>-->
<!---->
<!--      -->
<!--        </div>-->
<!--    </div>-->
<!---->
<!---->
<!---->
<!--</div>-->
<!--</div>-->

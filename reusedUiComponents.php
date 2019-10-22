<!--Header-->
<?php

class ReusedUIComponents
{
    public function getHeader()
    {

        echo ' 
<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="calendar.css" type="text/css" rel="stylesheet"/>
    <meta name="theme-color" content="#fafafa">


    <meta name="theme-color" content="#fafafa">
    <style type="text/css">
        h1 {
            color: white;
            font-size: 24pt;
            text-align: center;
            font-family: arial, sans-serif
        }

        .menu {
            color: white;
            font-size: 12pt;
            text-align: center;
            font-family: arial, sans-serif;
            font-weight: bold
        }

        td {
            background: black
        }

        p {
            color: black;
            font-size: 12pt;
            text-align: justify;
            font-family: arial, sans-serif
        }

        p.foot {
            color: white;
            font-size: 9pt;
            text-align: center;
            font-family: arial, sans-serif;
            font-weight: bold
        }

        a:link, a:visited, a:active {
            color: white
        }
    </style>
</head>
<body>
<table width="100%" cellpadding="12" cellspacing="0" border="0">
    <tr bgcolor="black">
        <td align="left"><img src="logo.gif" alt="TLA logo" height="70" width="70"></td>
        <td>
            <h1>Employee/Manager Interface</h1>
        </td>
        <td align="right"><img src="logo.gif" alt="TLA logo" height="70" width="70"></td>
    </tr>
</table>';
    }


//<!--Footer-->
    public function getFooter()
    {

        echo '
        <table width="100%" bgcolor="black" cellpadding="12" border="0">
    <tr>
        <td>
            <p class="foot">Contact us on our email address.</p>

        </td>
    </tr>
</table>
</body>
</html>
        
        ';

    }

    public function getNavbar()
    {

        echo '
         
         <table width="100%" bgcolor="white" cellpadding="4" cellspacing="4">
    <tr>
        <td width="25%">
            <span class="menu"><a href="index.php">Home</a></span>
        </td>
        <td width="25%">
            <span class="menu"><a href="requirementsMonth.php">Request Off/Request Approval</a></span>
        </td>
        <td width="25%">
            <span class="menu"><a href="prototypeMonth.php">Basic Calendar Prototype</a></span>
        </td>
        <td width="25%">
            <span class="menu">Shared Schedule</span>
        </td>
    </tr>
</table>
         
         ';

    }
}


?>
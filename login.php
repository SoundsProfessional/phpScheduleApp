<?php
session_start();
if (!isset($_SESSION['logged_in1']) || $_SESSION['logged_in1'] == false) {
    header("Location:index.php");
}

?>
<!DOCTYPE HTML>
<html>
<?php

require('reusable/header.php');
require('reusable/nav.php');
?>
<head>
    <title>This is the Home Page</title>
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
</body>


<?php
require('reusable/footer.php');

?>
</html>
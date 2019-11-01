<?php
//session_start();
//if (!isset($_SESSION['logged_in1']) || $_SESSION['logged_in1'] == false) {
//    header("Location:index.php");
//}
//?>
<!DOCTYPE HTML>
<html>
<?php
require('header.php');
require('reusable/noLogNav.php');
?>
<head>
    <title>This is the Home Page</title>
</head>

<body>
<a href="BizFunctions/indexB.php" style="color: black">Biz Function Interface</a>
<a href="EmpFunctions/indexE.php" style="color: black">Emp Function Interface</a>
</body>


<?php
require('footer.php');
?>
</html>
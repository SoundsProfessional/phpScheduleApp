<!--Connor Was Here-->

<?php

require('../header.php');
require('reusable/bizNav.php');
include('../dbTdFuncs.php');

//There is a much more mature build of this page in indexE, as an example.
//all of the biz functionalities (like setting a schedule) dump into this file
//so there is a big loop, it's nice. You'll like it.


$bizName = isset($_POST['bizName'])? $_POST['bizName']:null;
$bizPW = isset($_POST['bizPW'])? $_POST['bizPW']:null;
$conn = getConnection();
$sql = "INSERT INTO biz_account (Name, Password) VALUES
('" . $bizName . "', '" . $bizPW . "')";
$result = $conn->query($sql);

echo 'Your business is called ' . $bizName;

?>


<?php

require('../footer.php');
?>


<?php

require('../header.php');
require('reusable/bizNav.php');
$bizName = $_POST['bizName'];
$bizPW = $_POST['bizPW'];
$conn = getConnection();
$sql = "INSERT INTO biz_account (Name, Password) VALUES
('" . $bizName . "', '" . $bizPW . "')";
$result = $conn->query($sql);

echo 'Your business is called ' . $bizName;

?>


<?php

require('../footer.php');
?>
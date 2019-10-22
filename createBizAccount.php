<?php
//account creation, MINIMAL implementation, for a business.
$db = new mysqli('localhost', 'user', '', 'restaurantShift');
if (mysqli_connect_errno()) {
    echo 'Error: Could not connect to database.';
exit;
}

require('reusable/header.php');
require('reusable/nav.php');

echo '
<h2>Please enter the name of your business shift, such as "JoesKitchenPMShift."</h2>
<form action="createBizAccount2.php" method="post">
<input type="text" name="establishment" value="">
<input type="submit" value="OKAY">
</form>
';
require('reusable/footer.php');

?>

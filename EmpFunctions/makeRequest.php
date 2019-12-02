
<!--Connor Ireland-->

<?php

require('../header.php');
require('reusable/empNav.php');

echo 'Scheduling requests that can\'t be expressed in the availability interface 
<form method="post" action="indexE.php">
<textarea name="requestField"></textarea>
<input type="submit" value="submit message">
</form>

';

require('../footer.php');
?>

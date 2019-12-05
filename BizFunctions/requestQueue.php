<!--Connor Ireland-->
<?php

require('../header.php');
require('reusable/bizNav.php');

include('../calendarContainer.php');

echo "<div>
Below lie employee scheduling requests, in chronological order of the request.
<br/><br/>" . getRequestQueue() . "</div>";

require('../footer.php');


?>

<!--Connor Was Here-->
<!DOCTYPE HTML>
<?php

require('header.php');
require('reusable/noLogNav.php');
?>

<html>
<body>
<form method="post" action="authenticate.php">
    Username: <br/>
    <input type="text" name="username"><br/>
    Password: <br/>
    <input type="password" name="password"><br/>
    <input type="submit" value="Login">
</form>

Alternately, you can <a href="createAccount.php"> create a new account.</a>
</body>
</html>
<!--GERSON ESCOBAR-->


<!--This visual scheme is Escobar's new work.
I don't have it applied to every page because it was breaking some stuff.
We are trying to work as a team but that is a difficult set of skills, especially
if you want this code to be DRY then our work needs to be coupled tightly together.

We have a github repo but are still learning how to really use it properly.

-C

https://github.com/SoundsProfessional/phpScheduleApp
-->

<!DOCTYPE HTML>
<?php
session_start();

$username = "user";
$password = "password";

if (isset($_SESSION['logged_in1']) && $_SESSION['logged_in1'] == true) {
    header("Location: login.php");
}
if (isset($_POST['username']) && isset($_POST['password'])) {
    if ($_POST['username'] == $username && $_POST['password'] == $password) {
        $_SESSION['logged_in1'] = true;
        header("Locate: login.php");
    }

}


?>

<html>
<body>
<form method="post" action="index.php">
    Username: <br/>
    <input type="text" name="username"><br/>
    Password: <br/>
    <input type="password" name="password"><br/>
    <input type="submit" value="Login">
</form>
</body>
</html>


<?php
$db = new mysqli('localhost', 'user', '', 'restaurantShift');
if (mysqli_connect_errno()) {
    echo 'Error: Could not connect to database.';
    exit;
}

require('reusable/header.php');
require('reusable/nav.php');


$establishment=$_POST['establishment'];
echo 'YEAH '.$establishment;

$statement = "INSERT INTO establishment  (name, var) VALUE ('".$establishment."', 7)";
echo $statement;

if ($db->query($statement) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $statement . "<br>" . $db->error;
}

$db->close();
require('reusable/footer.php');
?>


<?php
$con = mysqli_connect("localhost", "root", "root", "randomfruit");
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$subject = $_POST['ticket-subject'];

$sql = "INSERT INTO tickets (subject) VALUES ('$subject')";

if (!mysqli_query($con, $sql)) {
    die('Error: ' . mysqli_error($con));
}
echo "<html><head><script>top.location = '../../instructordash.php';</script></head><body></body></html>";

mysqli_close($con);
?>
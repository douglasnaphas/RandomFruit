<?php
$con=mysqli_connect("localhost","root","root","rfdb");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$sql="INSERT INTO tickets (subject)
VALUES
('')";

//if (!mysqli_query($con,$sql))
//{
  //die('Error: ' . mysqli_error($con));
  //}
$content = file_get_contents('php://input');
echo $content;
//echo "<script>top.location = '../../instructordash.php';</script>";

mysqli_close($con);
?> 
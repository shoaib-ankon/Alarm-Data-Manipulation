<?php
$con=mysqli_connect("localhost","root","","ipasso") or die ("Not connected");
$sql="truncate table cata";
$query=mysqli_query($con,$sql);

header("Location: index.php");

?>

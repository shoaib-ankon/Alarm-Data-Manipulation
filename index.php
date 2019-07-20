<?php 
include("csv.php");
$csv=new csv();
if (isset($_POST['sub'])) {
	$csv->import($_FILES['file']['tmp_name']);
}

 ?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<form method="post" enctype="multipart/form-data">
	<input type="file" name="file">
	<input type="submit" name="sub" value="import">
</form>



<?php
echo "<table style='border: solid 1px black;'>";
 echo "<tr>

        <th>Link</th>
        <th>Alarm</th>
        <th>Start Time</th>
        <th>End Time</th>
        <th>Type</th>
        <th>IP</th>
       <th>STATUS</th>
      <th>Location</th>
 </tr>";

class TableRows extends RecursiveIteratorIterator { 
    function __construct($it) { 
        parent::__construct($it, self::LEAVES_ONLY); 
    }

    function current() {
        return "<td style='width: 150px; border: 1px solid black;'>" . parent::current(). "</td>";
    }

    function beginChildren() { 
        echo "<tr>"; 
    } 

    function endChildren() { 
        echo "</tr>" . "\n";
    } 
} 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ipasso";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT link, alarm, start,endt,type,ip,status,location,extra FROM cata WHERE alarm='Low BER'"); 
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
        echo $v;
    }
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";
?> 




</body>
</html>
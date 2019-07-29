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
	<title>NEC Ipasso Alarm</title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<div class="container">
  <h1>NEC Ipasso MW Alarm Window</h1>
  
</div>



</head>
<body>

<form method="post" enctype="multipart/form-data">
	<input type="file" name="file" class="btn btn-default"><br>


	<button type="submit" class="btn btn-default" name="sub">Import</button>
    
</form>
<form action="delete.php" method="get"><br>
  <button type="submit" class="btn btn-default">Delete</button>
</form>
<br><br>

<?php
echo "<table style='border: solid 1px black;'>";
 echo "<tr>

        <th>Blank</th>
        <th>Occured Time</th>
        <th>Link</th>
        <th>Alarm</th>
        <th>Status</th>
        <th>State</th>
        <th>IP</th>
       <th>Hexa</th>
       <th>AnoBlank</th>
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

    
    $stmt = $conn->prepare("SELECT blank, occur, link,alarm,status,state,ip,hexa,anblank,location FROM cata WHERE status='Alarm' GROUP BY link"); 
    

    
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

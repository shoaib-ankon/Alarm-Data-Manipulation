<!DOCTYPE html>
<html>
<head>
  <title>NEC Ipasso Alarm</title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>


<?php
/*
foreach($age as $x => $x_value) {
    echo "Key=" . $x . ", Value=" . $x_value;
    echo "<br>";
*/
//if ($fh = fopen("\\alarm-ipasso\\inputFile\\server1.txt", 'r')) {
    $LinkHash = array();
    if ($fh = fopen("another.log", 'r')) 
    {
        while (!feof($fh)) 
        {
            //$line_Array = arrary();
            $line = fgets($fh);
            $line_Array = explode(',' , $line);
            //print_r( $LinkHash[$line_Array[2]] );
            if(isset($line_Array[4]) == "Alarm")
            {
                //print_r($LinkHash[$line_Array[2]]);//[$line_Array[2]];
                if(isset($LinkHash[$line_Array[2]]) == NULL)
                {
                    $LinkHash[$line_Array[2]] = $line_Array[3] . "--" . $line_Array[4] . "--" . $line_Array[1] . "---" . $line_Array[9];
                    print_r($line_Array[2] . "  => " . $LinkHash[$line_Array[2]] . "<BR>");
                }
            }
        }
    fclose($fh);
}

?>

</body>
</html>
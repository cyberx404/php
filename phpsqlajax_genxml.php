<?php
require("config.php");



if(isset($_GET['date']) && isset($_GET['user'])){

$date = $_GET['date'];
$user = $_GET['user'];

  function parseToXML($htmlStr) 
  { 
  $xmlStr=str_replace('<','&lt;',$htmlStr); 
  $xmlStr=str_replace('>','&gt;',$xmlStr); 
  $xmlStr=str_replace('"','&quot;',$xmlStr); 
  $xmlStr=str_replace("'",'&#39;',$xmlStr); 
  $xmlStr=str_replace("&",'&amp;',$xmlStr); 
  return $xmlStr; 
  } 

  // Select all the rows in the markers table
  $query = "SELECT * FROM address WHERE LOWER(name) = '$user' AND rdate = '$date' ";
  $result = mysql_query($query);
  if (!$result) {
    die('Invalid query: ' . mysql_error());
  }
  header("Content-type: text/xml");
  // Start XML file, echo parent node
  echo '<markers>';
  // Iterate through the rows, printing XML nodes for each
  while ($row = @mysql_fetch_assoc($result)){
    // ADD TO XML DOCUMENT NODE
    echo '<marker ';
    echo 'name="' . parseToXML($row['name']) . '" ';
    echo 'address="' . parseToXML($row['address']) . '" ';
    echo 'lat="' . $row['lat'] . '" ';
    echo 'lng="' . $row['lng'] . '" ';
    echo 'type="' . $row['type'] . '" ';
     echo 'time="' . $row['time'] . '" ';
    echo '/>';
  }
  // End XML file
  echo '</markers>';
}else{
  echo "Invalid Request";
}

?>

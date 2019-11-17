<?php

include('connectionData.txt');

$conn = mysqli_connect($server, $user, $pass, $dbname, $port)
or die('Error connecting to MySQL server.');

?>

<html>
<head>
  <title>Another Simple PHP-MySQL Program</title>
  </head>
  
  <body bgcolor="white">
  
  
  <hr>
  
  
<?php
  
$manufacturer = $_POST['manufacturer'];

$manufacturer = mysqli_real_escape_string($conn, $manufacturer);
// this is a small attempt to avoid SQL injection
// better to use prepared statements

$query = "SELECT s.description, CONCAT('$', IFNULL(SUM(i.total_price), 0)) AS totalSpent
FROM stores7.manufact m
			JOIN stores7.stock s using(manu_code)
			LEFT JOIN stores7.items i USING(stock_num, manu_code)
            WHERE manu_name =  ";
$query = $query.'"'.$manufacturer.'" group by stock_num, manu_code;';

?>

<p>
The query:
<p>
<?php
print $query;
?>

<hr>
<p>
Result of query:
<p>

<?php
$result = mysqli_query($conn, $query)
or die(mysqli_error($conn));

print "<pre>";
while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
  {
    print "\n";
    print "$row[description]  $row[totalSpent]";
  }
print "</pre>";

mysqli_free_result($result);

mysqli_close($conn);

?>

<p>
<hr>

<p>
<a href="findCustState.php" >Contents</a>
of the PHP program that created this page. 	 
 
</body>
</html>
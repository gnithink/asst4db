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

$query = "SELECT c.fname, c.lname, s.description
          FROM stores7.customer c 
			      JOIN stores7.orders USING(customer_num)
            JOIN stores7.items USING(order_num)
            JOIN stores7.items i USING(stock_num, manu_code)
			      JOIN stores7.stock s using(manu_code)
            JOIN stores7.manufact m using(manu_code)
            WHERE manu_name =  ";
$query = $query.'"'.$manufacturer.'" order by c.lname;';

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
    print "$row[fname]  $row[lname] $row[description]";
  }
print "</pre>";

mysqli_free_result($result);

mysqli_close($conn);

?>

<p>
<hr>

<p>
<a href="findCustState.txt" >Contents</a>
of the PHP program that created this page. 	 
 
</body>
</html>
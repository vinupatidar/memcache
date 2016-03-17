<?php
/*
$memcache = new Memcache;
$memcache->connect("localhost",11211); # You might need to set "localhost" to "127.0.0.1"
echo "Server's version: " . $memcache->getVersion() . "<br />\n";
$tmp_object = new stdClass;
$tmp_object->str_attr = "test";
$tmp_object->int_attr = 123;
$memcache->set("key",$tmp_object,false,10);
echo "Store data in the cache (data will expire in 10 seconds)<br />\n";
echo "Data from the cache:<br />\n";
var_dump($memcache->get("key"));

  
  exit;
*/

/*
$hostname = "localhost";
$user = "root";
$password = "";
$database = "pandora";

$conn = mysql_connect($hostname, $user, $password) 
or die("Ooppsss!! Something went wrong");
mysql_select_db($database, $conn) or die(": Ooppsss !! Could not able to connect database");
*/
//class Myfile extends MemCache{
include('db.php');

	$query ="SELECT @serial := @serial+1 AS `serial_number`,proposition.* from proposition cross join (select @serial := 0) AS serial limit 0,500";
	$result_prop = mysql_query($query,$conn);
	$row = mysql_fetch_array($result_prop);
    //echo '<pre>'; print_r($row); exit;      



//}

?>

<html>


<table>

<tr>
<th>Serial number</th>
<th>Key Proposition</th>
<th>Libelle</th>
<th>Creation</th>
</tr>

<?php  while ($row = mysql_fetch_array($result_prop)){ ?>
<tr>
<td><?php echo $row['serial_number']; ?></td>
<td><?php echo '<a href="prop_det.php?key='.$row['key_proposition'].'" target="_blank">'.$row['key_proposition'].'</a>'; ?></td>
<td><?php echo $row['libelle'] ?></td>
<td><?php echo $row['creation'] ?></td>
</tr>
<?php } ?>

</table>



</html>
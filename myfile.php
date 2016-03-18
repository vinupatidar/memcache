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
include('db.php');
include('memcache.php');

class myfile extends memCacheClass {

	public function __construct() {
		parent::__construct(); 
	}	
		 
		 
	public function get_all_data(){	 
	//class Myfile extends MemCache{


	$query ="SELECT @serial := @serial+1 AS `serial_number`,proposition.* from proposition cross join (select @serial := 0) AS serial limit 0,500";
	
	$product = null;
	$cacheKey = md5("mykey_".$query);
	//parent::deleteData($cacheKey);
	if($this->objCache == true)
	{
		echo '2';
		///echo $cacheKey;exit;
		$getcacheresult = $this->objCache->get($cacheKey);
		$assoc = $getcacheresult;
		//$row = mysql_fetch_array($result_prop);
		//echo '<pre>'; print_r($getcacheresult); exit;      
	}
	
	if (!$assoc)
	{	
		echo '1';
		//echo $cacheKey;exit;
		include('db.php');
		// In case we do...because our $product variable is still null
		// We have validated and sanitized our data
		// We have escaped every risky char with mysql_real_escape_string()
		// Now we want to read from our database :
		$rec = mysql_query($query,$conn);
		while($result=mysql_fetch_array($rec)) {
			$assoc[]=$result; // Results storing in array 
			$this->objCache->set($cacheKey, $assoc, 0, $this->expireTime);
		} 
		//$row = mysql_fetch_array($result_prop);
		//$data = $this->objCache->set($cacheKey, $result_prop, 0, $this->expireTime);
	}
			
	/*$query ="SELECT @serial := @serial+1 AS `serial_number`,proposition.* from proposition cross join (select @serial := 0) AS serial limit 0,500";
	$result_prop = mysql_query($query,$conn);
	$row = mysql_fetch_array($result_prop);*/
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

<?php 
foreach($assoc as $row) 
{  ?>
<tr>
<td><?php echo $row['serial_number']; ?></td>
<td><?php echo '<a href="prop_det.php?key='.$row['key_proposition'].'" target="_blank">'.$row['key_proposition'].'</a>'; ?></td>
<td><?php echo $row['libelle'] ?></td>
<td><?php echo $row['creation'] ?></td>
</tr>
<?php
}



/* while ($row = mysql_fetch_array($result_prop)){ ?>
<tr>
<td><?php echo $row['serial_number']; ?></td>
<td><?php echo '<a href="prop_det.php?key='.$row['key_proposition'].'" target="_blank">'.$row['key_proposition'].'</a>'; ?></td>
<td><?php echo $row['libelle'] ?></td>
<td><?php echo $row['creation'] ?></td>
</tr>
<?php }*/ ?>

</table>



</html>
<?php

}
}

//$prop_det = new prop_det;
$myfile = new myfile(); 
$myfile->get_all_data();
<?php
/*
$memcache = new Memcache;
$memcache->connect('localhost', 11211) or die ("Could not connect");

$version = $memcache->getVersion();
echo "Server's version: ".$version."<br/>\n";

$tmp_object = new stdClass;
$tmp_object->str_attr = 'test';
$tmp_object->int_attr = 123;

$memcache->set('key', $tmp_object, false, 10) or die ("Failed to save data at the server");
echo "Store data in the cache (data will expire in 10 seconds)<br/>\n";

$get_result = $memcache->get('key');
echo "Data from the cache:<br/>\n";

var_dump($get_result);
exit;
*/

include('db.php');
include('memcache.php');
//echo $propkey; exit;

class prop_det extends memCacheClass {

	public function __construct() {
		
		parent::__construct(); 
		$this->propkey = $_GET['key'];
	}	
		 
		 
	public function get_data(){	 
		 
		if($this->propkey)
		{
			$product = null;
			$cacheKey = md5("mykey_".$this->propkey);
			if($this->objCache == true)
			{
				//echo '2';exit;
				$product = $this->objCache->get($cacheKey);
			
			}
		
		
			if (!$product)
			{	//echo '1';exit;
				include('db.php');
				// In case we do...because our $product variable is still null
				// We have validated and sanitized our data
				// We have escaped every risky char with mysql_real_escape_string()
				// Now we want to read from our database :
				$query ="SELECT prop_campaign.key_campaign,prop_campaign.libelle as prop_libelle1 from proposition join prop_campaign ON prop_campaign.id_proposition = proposition.id_proposition where `key_proposition` = '".$this->propkey."'";
				$result_prop = mysql_query($query,$conn);
				$product = mysql_fetch_assoc($result_prop);
				$data = $this->objCache->set($cacheKey, $product, 0, $this->expireTime);
			}
			
			//echo $this->propkey; exit;
			//$cacheResult = $this->objCache->get($cacheKey);
			/*if (!$this->objCache->get($cacheKey)) {
				$result_prop = $this->objCache->get($cacheKey);
				 echo '<pre>'; print_r($result_prop); exit; 
			} else {
				include('db.php');
				$query ="SELECT prop_campaign.key_campaign,prop_campaign.libelle as prop_libelle1 from proposition join prop_campaign ON prop_campaign.id_proposition = proposition.id_proposition where `key_proposition` = '".$this->propkey."'";
				$result_prop = mysql_query($query,$conn);
				//$row1 = mysql_fetch_array($result_prop);
				//echo '<pre>'; print_r($row); exit; 
				$data = $this->objCache->set($cacheKey, $result_prop, 0, $this->expireTime);
				//$cacheResult = $this->objCache->get($cacheKey);
				//var_dump($cacheResult);
			}*/
		
	//echo $query; exit;
	//$result_prop = mysql_query($query,$conn);
	//$row = mysql_fetch_array($result_prop);
	//echo '<pre>'; print_r($row); exit;      


	
?>

<html>


<table>
<tr>
<th>Key Campaign</th>
<th>Libelle</th>
</tr>

<?php 
//echo '<pre>'; print_r($product); exit;      
//while ($row = mysql_fetch_array($result_prop)){  
//foreach($product as $list){
?>
<tr>

<td><?php echo $product['key_campaign']; ?></td>
<td><?php echo $product['prop_libelle1'] ?></td>

</tr>
<?php //}  ?>

</table>



</html>

<?php
}
}

	

}

//$prop_det = new prop_det;
$prop_det = new prop_det(); 
$prop_det->get_data();

?>
<?php

include('db.php');
include('memcache.php');
//echo $propkey; exit;

class prop_det extends memCacheClass {

	public function __construct() {
		$this->propkey = $_GET['key'];
	}
		 
		 
	public function get_data(){	 
		 
		if($this->propkey)
		{
			
			$query ="SELECT *,prop_campaign.libelle as prop_libelle from proposition join prop_campaign ON prop_campaign.id_proposition = proposition.id_proposition where `key_proposition` = '".$this->propkey."'";
			//echo $query; exit;
			$cacheKey = md5("mykey_".$this->propkey);
			echo $this->objCache; exit;
			$cacheResult = $this-> objCache ->get($cacheKey);
			if ($cacheResult) {
				  echo 'vi'; exit;
			} else {
				$result_prop = mysql_query($query,$conn);
				$row = mysql_fetch_array($result_prop);
				$data = $this->objCache->set($cacheKey, $row, 0, $this->expireTime);
			}
		}
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

<?php while ($row = mysql_fetch_array($result_prop)){ ?>
<tr>

<td><?php echo $row['key_campaign']; ?></td>
<td><?php echo $row['prop_libelle'] ?></td>

</tr>
<?php } ?>

</table>



</html>

<?php

}

	

}

//$prop_det = new prop_det;
$prop_det = new prop_det(); 
$prop_det->get_data();

?>
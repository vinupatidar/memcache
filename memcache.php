<?php

class MemCacheClass {

public $expireTime = 60; // Set the expire time
private $isEnabled = false; /* Memcache Isenabled */
private $objCache = null;   
public $a; 
    public function __construct() {
		$this -> a = 'we are in the parent class'; 
        if (class_exists('Memcache')) {

            $this->objCache = new Memcache();
           
            if(!$this->objCache->connect('localhost', 11211)) {
                  $this->objCache->connect('localhost', 11211);
                    $this->isEnabled = true;
                    include(“db.php”);
            }
        }
    }
   
   public function name() { 
        echo $this->expireTime; 
    } 
	
  public function getDetails() {
           
             //Set the key and check the cache
      $cacheKey = md5("SELECT * from user_info where user_id='121'");
      $cacheResult = $this-> objCache ->get($cacheKey);

      if ($cacheResult) {
          echo $cacheResult['username'];
          echo $cacheResult['email_id'];
      } else {
          $data=setData();   
          echo $data[‘username’]." -".$data[‘password’] ."-".$data[‘email_id’]." 
";

      }

  }

  public function setData() {

            $query="SELECT * from user_info where user_id='121'";
            $result = mysql_query($query);
            $row = mysql_fetch_array($result);
             //Use MEMCACHE_COMPRESSED to store the item compressed (uses zlib).
            $data = $this->objCache->set($cacheKey, $row, 0, $this->expireTime);
            // Store the result in cache for 60 seconds

    return $data;
  }

// delete data from cache server
  function deleteData($cacheKey) {
         $success_val = $this-> objCache ->delete($cacheKey);
        return $success_val;
  }
}

?>
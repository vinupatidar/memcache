<?php
class test { 
	public $xname = 'vinod';
    public function __construct() { 
    } 

    public function name() { 
       echo $this->xname; 
    } 

    private function showName($name) { 
        echo 'my name in test is '.$name; 
    } 
} 
?>
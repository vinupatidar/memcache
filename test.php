<?php
include('vinod.php');
class extendTest extends test { 

    public function __construct() { 
        parent::__construct(); 
    } 

    private function showName($name) { 
        echo 'my name in extendTest is '.$name; 
    } 
} 

$test = new extendTest(); 
echo $test->name(); 
?>
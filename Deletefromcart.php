<?php
$isbn=$_POST['isbn'];
$isbn=intval($isbn);
$c = new MongoClient();
$db = $c->bookDB;
$collection = $db->cartData;
$count = $collection.count(); 
$collection->remove(array('ISBN' => $isbn), array("justOne" => true));
$count = $collection.count();
?>
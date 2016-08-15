<?php
$m = new MongoClient();
   $db = $m->bookDB;
   $collection = $db->cartData;
   $ISBN = intval($_GET['isbn']);
   $price = intval($_GET['price']);
   $user = "user1";
   $document = array( 
      "user" => $user, 
      "ISBN" => $ISBN, 
      "price" => $price,
   );
   $collection->insert($document);
   echo "Added to Cart Successfully";
?>
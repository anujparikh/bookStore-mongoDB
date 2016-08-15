<?php
ini_set ( 'mongo.long_as_object', 1 );
//include 'commonFunctions.php';
include ("detailsHeader.php");
include ("left.php");
$id = 'user1';
$m = new MongoClient();
$collection = $m->bookDB->cartData;
$collection1 = $m->bookDB->project;
$cursor = $collection->find ( array (
		'user' => $id 
) );
$map = new MongoCode("function() { emit(this.user,this.price); }");
$reduce = new MongoCode("function(key, values) {return Array.sum(values)}");
$mapreduceOutput = $dbconnection->command(array(
		"mapreduce" => "cartData",
		"map" => $map,
		"reduce" => $reduce,
		"query" => array("user"=>$id),
		"out" => array("replace" => "carttotal")));
$cursortotal = $dbconnection->selectCollection($mapreduceOutput['result'])->find();
?>
<style>
.cartcontainer{
float : left;
}
.item{
clear:left;
float : left;
padding : 4px;
margin-left: 20px;
margin-top: 20px;
}

.title{

float : left;
width:200px;

}
.price {
float : left;
margin-left: 8px;
width:30px;
}
.delbutton{
float : left;
padding : 3px;
margin-left : 8px;
background-color: gray;
}
</style>
<script type="text/javascript" src="scripts/jquery-1.8.2.js">

</script>
<script type="text/javascript">
$(document).ready(function(e){
	$(".delbutton").click(function(a){
		var isbn=$(this).attr('id');
		$.ajax({
           type : "post",
           url : "Deletefromcart.php",
           data : {
               isbn : isbn
               },
           success : function(b){
        	   window.location.replace("Showcart.php");
               }
			});
		});
});
</script>
<div class="cartcontainer">
<?php 

foreach ( $cursor as $cartentry ) {
	$cursorbook = $collection1->findOne ( array (
			'ISBN' => $cartentry ['ISBN'] 
	) );
	?>
<div class="item">
	<span class="title"> <?php echo $cursorbook['Title'];?></span>
	<span class="price"><?php echo '$'.$cartentry['price'];?></span>
	<a href="#"><span class="delbutton" id="<?php echo $cursorbook['ISBN'];?>">delete</span></a>
</div>
<?php
}
foreach ($cursortotal as $total){
?>
<div class="item">
	<span class="title" style="font-weight:bold; font-size:medium; color : red;"> Total</span>
	<span class="price" style="font-weight: bold;"><?php echo '$'.$total['value'];?></span>
	
</div><?php }?>
</div>
<?php 
include 'footer.php';
?>